<?php
class Invoice_model extends CI_Model {

    // -----------------------------------------------------------------------
    // Invoice CRUD
    // -----------------------------------------------------------------------

    function get_all()
    {
        // Join with api_domains to get domain_name for display
        return $this->db
            ->select('invoices.*, api_domains.domain_name, api_domains.code_year, api_domains.code_number')
            ->from(INVOICES)
            ->join('api_domains', 'api_domains.id = invoices.domain_id', 'left')
            ->get()
            ->result();
    }

    function get($id)
    {
        return $this->db->where('id', $id)->get(INVOICES)->row();
    }

    function get_with_domain($id)
    {
        return $this->db
            ->select('invoices.*, api_domains.domain_name, api_domains.code_year, api_domains.code_number,
                      api_domains.name, api_domains.address, api_domains.phone, api_domains.alternate_no,
                      api_domains.email, api_domains.dise_code, api_domains.aff_no')
            ->from(INVOICES)
            ->join('api_domains', 'api_domains.id = invoices.domain_id', 'left')
            ->where('invoices.id', $id)
            ->get()
            ->row();
    }

    function insert($data)
    {
        return $this->db->insert(INVOICES, $data);
    }

    function update($id, $data)
    {
        return $this->db->where('id', $id)->update(INVOICES, $data);
    }

    function delete($id)
    {
        return $this->db->where('id', $id)->delete(INVOICES);
    }

    function update_status($id, $status)
    {
        return $this->db->where('id', $id)->update(INVOICES, ['status' => $status]);
    }

    // -----------------------------------------------------------------------
    // api_domains helpers
    // -----------------------------------------------------------------------

    function get_domains()
    {
        return $this->db->get('api_domains')->result();
    }

    function get_domain($id)
    {
        return $this->db->where('id', $id)->get('api_domains')->row();
    }

    // -----------------------------------------------------------------------
    // Company settings
    // -----------------------------------------------------------------------

    function get_company_settings()
    {
        return $this->db->get('company_settings')->row();
    }

    // -----------------------------------------------------------------------
    // Auto invoice number generator
    // -----------------------------------------------------------------------
    /**
     * Generates the next sequential invoice number for the given prefix.
     * Format: 001, 002, … (3-digit zero-padded).
     * Looks at the highest existing invoice_number in the invoices table
     * filtered by invoice_prefix, then increments by 1.
     */
    function generate_invoice_number($prefix = 'INV')
    {
        $row = $this->db
            ->select_max('invoice_number')
            ->where('invoice_prefix', $prefix)
            ->get(INVOICES)
            ->row();

        $next = ($row && $row->invoice_number) ? ((int) $row->invoice_number + 1) : 1;

        return str_pad($next, 3, '0', STR_PAD_LEFT);
    }
	public function get_invoice_dashboard()
	{
		return $this->db->select("
			SUM(total) AS total_invoice_generated,
			SUM(CASE WHEN status = 1 THEN total ELSE 0 END) AS total_paid,
			SUM(CASE WHEN status = 0 THEN total ELSE 0 END) AS total_unpaid,
			SUM(cgst) AS total_cgst,
			SUM(igst) AS total_igst
		", false)
		->get(INVOICES)
		->row_array();
	}
	public function get_total_paid_this_month()
	{
		return $this->db->select('SUM(total) AS total_paid_this_month', false)
						->where('status', 1)
						->where('MONTH(created_at) = MONTH(CURDATE())', null, false)
						->where('YEAR(created_at) = YEAR(CURDATE())', null, false)
						->get(INVOICES)
						->row_array();
	}
}
