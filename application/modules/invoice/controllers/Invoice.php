<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice/Invoice_model', 'invoice_model');
        $this->load->model('services/Services_model', 'services_model');
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
        $this->form_validation->set_rules('invoice_prefix',   'Invoice Prefix',   'required|trim');

        $subscription_type = (array) $this->input->post('subscription_type');
        $type_error = $this->input->method() === 'post' && empty(array_filter($subscription_type));

        if ($this->form_validation->run() == FALSE || $type_error)
        {
            if ($type_error) {
                $this->session->set_flashdata('error', 'Please select at least one Subscription Type (Plan and/or Services).');
            }
            $data['domains']        = $this->invoice_model->get_domains();
            $data['services']       = $this->services_model->get_all_active();
            $data['invoice_number'] = $this->invoice_model->generate_invoice_number();
            $data['page']           = 'invoice/form';
            $data['script']         = 'invoice/form_script';
            $this->load->view('layout/main', $data);
        }
        else
        {
            $data = $this->_build_invoice_data();
            $data['invoice_prefix'] = strtoupper($this->input->post('invoice_prefix', true));
            $data['invoice_number'] = $this->input->post('invoice_number', true);
            $data['status']         = 0;

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
        $this->form_validation->set_rules('invoice_prefix',   'Invoice Prefix',   'required|trim');

        $subscription_type = (array) $this->input->post('subscription_type');
        $type_error = $this->input->method() === 'post' && empty(array_filter($subscription_type));

        if ($this->form_validation->run() == FALSE || $type_error)
        {
            if ($type_error) {
                $this->session->set_flashdata('error', 'Please select at least one Subscription Type (Plan and/or Services).');
            }
            $data['invoice']  = $invoice;
            $data['domains']  = $this->invoice_model->get_domains();
            $data['services'] = $this->services_model->get_all_active();
            $data['existing_service_items'] = !empty($invoice->service_items) ? json_decode($invoice->service_items, true) : [];
            $data['page']     = 'invoice/form';
            $data['script']   = 'invoice/form_script';
            $this->load->view('layout/main', $data);
        }
        else
        {
            $data = $this->_build_invoice_data();
            $data['invoice_prefix'] = strtoupper($this->input->post('invoice_prefix', true));
            $data['invoice_number'] = $invoice->invoice_number; // never change on edit

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
    // AJAX: get service details (id/title/price) for a set of service ids.
    // Used when editing an invoice whose services are no longer active.
    // -----------------------------------------------------------------------
    public function get_services_by_ids()
    {
        $ids = (array) $this->input->post('ids');
        $services = $this->services_model->get_by_ids($ids);
        echo json_encode(['services' => $services]);
    }

    // -----------------------------------------------------------------------
    // Private helpers
    // -----------------------------------------------------------------------

    /**
     * Reads the posted Plan / Services line items, computes every row's
     * tax + total, aggregates the Final row, and returns the full data
     * array ready to insert/update in the `invoices` table.
     */
    private function _build_invoice_data()
    {
        $domain    = $this->invoice_model->get_domain($this->input->post('domain_id', true));
        $school_id = $domain ? $domain->code_year . $domain->code_number : '';

        $types = array_values(array_filter((array) $this->input->post('subscription_type')));
        $has_plan     = in_array('plan', $types);
        $has_services = in_array('services', $types);

        $final_amount   = 0;
        $final_discount = 0;
        $final_cgst     = 0;
        $final_igst     = 0;
        $final_total    = 0;

        // ---- Plan row ----
        $plan_amount = $plan_discount = $plan_cgst_pct = $plan_cgst = $plan_igst_pct = $plan_igst = $plan_total = null;

        if ($has_plan) {
            $plan_amount   = (float) $this->input->post('plan_amount', true);
            $plan_discount = (float) $this->input->post('plan_discount', true);
            $plan_cgst_pct = (float) $this->input->post('plan_cgst_pct', true);
            $plan_igst_pct = (float) $this->input->post('plan_igst_pct', true);

            $taxable_base = $plan_amount - $plan_discount;
            $plan_cgst    = round($taxable_base * $plan_cgst_pct / 100, 2);
            $plan_igst    = round($taxable_base * $plan_igst_pct / 100, 2);
            $plan_total   = round($taxable_base + $plan_cgst + $plan_igst, 2);

            $final_amount   += $plan_amount;
            $final_discount += $plan_discount;
            $final_cgst     += $plan_cgst;
            $final_igst     += $plan_igst;
            $final_total    += $plan_total;
        }

        // ---- Services rows ----
        $service_ids_posted = array_filter((array) $this->input->post('service_ids'));
        $service_items      = [];
        $service_ids_saved  = [];

        if ($has_services && !empty($service_ids_posted)) {

            $svc_amount   = (array) $this->input->post('service_amount');
            $svc_discount = (array) $this->input->post('service_discount');
            $svc_cgst_pct = (array) $this->input->post('service_cgst_pct');
            $svc_igst_pct = (array) $this->input->post('service_igst_pct');
            $svc_title    = (array) $this->input->post('service_title');

            foreach ($service_ids_posted as $sid) {

                $amount   = isset($svc_amount[$sid])   ? (float) $svc_amount[$sid]   : 0;
                $discount = isset($svc_discount[$sid]) ? (float) $svc_discount[$sid] : 0;
                $cgstPct  = isset($svc_cgst_pct[$sid]) ? (float) $svc_cgst_pct[$sid] : 0;
                $igstPct  = isset($svc_igst_pct[$sid]) ? (float) $svc_igst_pct[$sid] : 0;
                $title    = isset($svc_title[$sid])    ? $svc_title[$sid]           : '';

                $taxable_base = $amount - $discount;
                $cgst  = round($taxable_base * $cgstPct / 100, 2);
                $igst  = round($taxable_base * $igstPct / 100, 2);
                $total = round($taxable_base + $cgst + $igst, 2);

                $service_items[] = [
                    'id'        => $sid,
                    'title'     => $title,
                    'amount'    => $amount,
                    'discount'  => $discount,
                    'cgst_pct'  => $cgstPct,
                    'cgst'      => $cgst,
                    'igst_pct'  => $igstPct,
                    'igst'      => $igst,
                    'total'     => $total,
                ];
                $service_ids_saved[] = $sid;

                $final_amount   += $amount;
                $final_discount += $discount;
                $final_cgst     += $cgst;
                $final_igst     += $igst;
                $final_total    += $total;
            }
        }

        return [
            'domain_id'         => $this->input->post('domain_id', true),
            'school_id'         => $school_id,
            'item_description'  => $this->input->post('item_description', true),
            'subscription_type' => implode(',', $types),

            // Plan line item
            'plan_amount'   => $has_plan ? $plan_amount   : null,
            'plan_discount' => $has_plan ? $plan_discount : null,
            'plan_cgst_pct' => $has_plan ? $plan_cgst_pct : null,
            'plan_cgst'     => $has_plan ? $plan_cgst     : null,
            'plan_igst_pct' => $has_plan ? $plan_igst_pct : null,
            'plan_igst'     => $has_plan ? $plan_igst     : null,
            'plan_total'    => $has_plan ? $plan_total    : null,

            // Services line items
            'service_ids'   => !empty($service_ids_saved) ? implode(',', $service_ids_saved) : null,
            'service_items' => !empty($service_items) ? json_encode($service_items) : null,

            // Final aggregated row (kept in the original invoice columns
            // so the list page / print view keep working unmodified)
            'price_amount' => round($final_amount, 2),
            'discount'     => round($final_discount, 2),
            'cgst'         => round($final_cgst, 2),
            'cgst_pct'     => 0,
            'igst'         => round($final_igst, 2),
            'igst_pct'     => 0,
            'total'        => round($final_total, 2),
        ];
    }
}
