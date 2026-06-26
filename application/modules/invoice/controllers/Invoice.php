<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice/Invoice_model', 'invoice_model');
    }

    // -----------------------------------------------------------------------
    // List
    // -----------------------------------------------------------------------
    public function index()
    {
        $data['invoices'] = $this->invoice_model->get_all();
        $data['page']     = 'invoice/index';
        $data['script']   = 'invoice/index_script';
        $this->load->view('layout/main', $data);
    }

    // -----------------------------------------------------------------------
    // Create
    // -----------------------------------------------------------------------
    public function create()
    {
        $this->form_validation->set_rules('domain_id',        'School',           'required|numeric');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required|trim');
        $this->form_validation->set_rules('price_amount',     'Price Amount',     'required|numeric');
        $this->form_validation->set_rules('discount',         'Discount',         'numeric');
        $this->form_validation->set_rules('cgst_pct',         'CGST %',           'numeric');
        $this->form_validation->set_rules('igst_pct',         'IGST %',           'numeric');
        $this->form_validation->set_rules('invoice_prefix',   'Invoice Prefix',   'required|trim');

        if ($this->form_validation->run() == FALSE)
        {
            $data['domains']        = $this->invoice_model->get_domains();
            $data['invoice_number'] = $this->invoice_model->generate_invoice_number();
            $data['page']           = 'invoice/form';
            $data['script']         = 'invoice/form_script';
            $this->load->view('layout/main', $data);
        }
        else
        {
            $domain    = $this->invoice_model->get_domain($this->input->post('domain_id', true));
            $school_id = $domain ? $domain->code_year . $domain->code_number : '';

            $price_amount = (float) $this->input->post('price_amount', true);
            $discount     = (float) $this->input->post('discount',     true);
            $cgst_pct     = (float) $this->input->post('cgst_pct',     true);
            $igst_pct     = (float) $this->input->post('igst_pct',     true);

            // Convert percentages → flat amounts on the taxable base (after discount)
            $taxable_base = $price_amount - $discount;
            $cgst_amount  = round($taxable_base * $cgst_pct / 100, 2);
            $igst_amount  = round($taxable_base * $igst_pct / 100, 2);

            $total = $this->_calculate_total($price_amount, $discount, $cgst_amount, $igst_amount);

            $data = [
                'domain_id'        => $this->input->post('domain_id',        true),
                'school_id'        => $school_id,
                'item_description' => $this->input->post('item_description', true),
                'price_amount'     => $price_amount,
                'discount'         => $discount,
                'cgst'             => $cgst_amount,   // stored as flat amount
                'igst'             => $igst_amount,   // stored as flat amount
                'cgst_pct'         => $cgst_pct,      // stored for display/edit
                'igst_pct'         => $igst_pct,      // stored for display/edit
                'total'            => $total,
                'invoice_prefix'   => strtoupper($this->input->post('invoice_prefix', true)),
                'invoice_number'   => $this->input->post('invoice_number',   true),
                'status'           => 0,
            ];

            $this->invoice_model->insert($data);

            $this->session->set_flashdata('success', 'Invoice Added Successfully');
            redirect('invoice');
        }
    }

    // -----------------------------------------------------------------------
    // Edit
    // -----------------------------------------------------------------------
    public function edit($id)
    {
        $invoice = $this->invoice_model->get($id);

        if (!$invoice) {
            show_404();
        }

        $this->form_validation->set_rules('domain_id',        'School',           'required|numeric');
        $this->form_validation->set_rules('item_description', 'Item Description', 'required|trim');
        $this->form_validation->set_rules('price_amount',     'Price Amount',     'required|numeric');
        $this->form_validation->set_rules('discount',         'Discount',         'numeric');
        $this->form_validation->set_rules('cgst_pct',         'CGST %',           'numeric');
        $this->form_validation->set_rules('igst_pct',         'IGST %',           'numeric');
        $this->form_validation->set_rules('invoice_prefix',   'Invoice Prefix',   'required|trim');

        if ($this->form_validation->run() == FALSE)
        {
            $data['invoice']  = $invoice;
            $data['domains']  = $this->invoice_model->get_domains();
            $data['page']     = 'invoice/form';
            $data['script']   = 'invoice/form_script';
            $this->load->view('layout/main', $data);
        }
        else
        {
            $domain    = $this->invoice_model->get_domain($this->input->post('domain_id', true));
            $school_id = $domain ? $domain->code_year . $domain->code_number : '';

            $price_amount = (float) $this->input->post('price_amount', true);
            $discount     = (float) $this->input->post('discount',     true);
            $cgst_pct     = (float) $this->input->post('cgst_pct',     true);
            $igst_pct     = (float) $this->input->post('igst_pct',     true);

            $taxable_base = $price_amount - $discount;
            $cgst_amount  = round($taxable_base * $cgst_pct / 100, 2);
            $igst_amount  = round($taxable_base * $igst_pct / 100, 2);

            $total = $this->_calculate_total($price_amount, $discount, $cgst_amount, $igst_amount);

            $data = [
                'domain_id'        => $this->input->post('domain_id',        true),
                'school_id'        => $school_id,
                'item_description' => $this->input->post('item_description', true),
                'price_amount'     => $price_amount,
                'discount'         => $discount,
                'cgst'             => $cgst_amount,
                'igst'             => $igst_amount,
                'cgst_pct'         => $cgst_pct,
                'igst_pct'         => $igst_pct,
                'total'            => $total,
                'invoice_prefix'   => strtoupper($this->input->post('invoice_prefix', true)),
                'invoice_number'   => $invoice->invoice_number, // never change on edit
            ];

            $this->invoice_model->update($id, $data);

            $this->session->set_flashdata('success', 'Invoice Updated Successfully');
            redirect('invoice');
        }
    }

    // -----------------------------------------------------------------------
    // Delete (AJAX)
    // -----------------------------------------------------------------------
    public function delete()
    {
        $id = $this->input->post('id');
        $this->invoice_model->delete($id);
        echo json_encode(['status' => 'success']);
    }

    // -----------------------------------------------------------------------
    // Change status (AJAX)
    // -----------------------------------------------------------------------
    public function change_status()
    {
        $id     = $this->input->post('id');
        $status = $this->input->post('status');

        $update = $this->invoice_model->update_status($id, $status);

        echo json_encode(['status' => $update ? 'success' : 'error']);
    }

    // -----------------------------------------------------------------------
    // Print invoice (AJAX — returns HTML fragment for modal)
    // -----------------------------------------------------------------------
    public function print_invoice($id)
    {
        $invoice = $this->invoice_model->get_with_domain($id);

        if (!$invoice) {
            show_404();
        }

        $data['invoice']  = $invoice;
        $data['company']  = $this->invoice_model->get_company_settings();
        // Return HTML fragment (no layout wrapper) for embedding in modal
        $this->load->view('invoice/print_invoice', $data);
    }

    // -----------------------------------------------------------------------
    // AJAX: get next invoice number (called when prefix changes)
    // -----------------------------------------------------------------------
    public function get_next_number()
    {
        $prefix = strtoupper($this->input->post('prefix', true));
        $number = $this->invoice_model->generate_invoice_number($prefix);
        echo json_encode(['invoice_number' => $number]);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * total = (price_amount - discount) + cgst_amount + igst_amount
     * CGST and IGST are stored/passed as flat amounts.
     */
    private function _calculate_total($price_amount, $discount, $cgst, $igst)
    {
        $after_discount = $price_amount - $discount;
        $total          = $after_discount + $cgst + $igst;
        return round($total, 2);
    }
}
