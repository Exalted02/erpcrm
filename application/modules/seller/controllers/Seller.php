<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seller extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('seller/Seller_model','seller_model');
        $this->load->model('Country_state_district');
    }

    public function index()
    {
        $data['sellers'] = $this->seller_model->get_all();
        $data['page'] = 'seller/index';
        $data['script'] = 'seller/index_script';

        $this->load->view('layout/main',$data);
    }

    public function create()
    {
        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Re-Seller Name', 'required|trim');
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim');
        $this->form_validation->set_rules('have_gst', 'GST', 'required|trim');
        if($this->input->post('have_gst') == 1){
			$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		}
        $this->form_validation->set_rules('working_experience', 'Working Experience', 'required|trim');
		$this->form_validation->set_rules('seller_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('seller_state', 'State', 'required|trim');
		$this->form_validation->set_rules('seller_district', 'District', 'required|trim');
		$this->form_validation->set_rules('seller_city', 'City', 'required|trim');
		$this->form_validation->set_rules('seller_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('seller_address', 'Address', 'trim');
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|valid_email|is_unique[users.email]'
        );
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('discount_percent', 'Discount Percent', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['getAllState'] = $this->Country_state_district->get_all_state();
            $data['page'] = 'seller/form';
			$data['script'] = 'seller/form_script';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'firm_name'       => $this->input->post('firm_name', true),
                'name'       => $this->input->post('name', true),
                'mobile_no'       => $this->input->post('mobile_no', true),
                'alternate_mobile_no'       => $this->input->post('alternate_mobile_no', true),
                'email'      => $this->input->post('email', true),
                'have_gst'      => $this->input->post('have_gst', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'working_experience'      => $this->input->post('working_experience', true),
                'seller_country'      => $this->input->post('seller_country', true),
                'seller_state'      => $this->input->post('seller_state', true),
                'seller_district'      => $this->input->post('seller_district', true),
                'seller_city'      => $this->input->post('seller_city', true),
                'seller_pin_code'      => $this->input->post('seller_pin_code', true),
                'seller_address'      => $this->input->post('seller_address', true),
                'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'discount_percent'   => $this->input->post('discount_percent'),
                'user_role'  => 1,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->seller_model->insert($data);

            $this->session->set_flashdata('success','Seller Added Successfully');
            redirect('seller');
        }
    }

    public function edit($id)
    {
        $seller = $this->seller_model->get($id);

        if(!$seller){
            show_404();
        }

        $this->form_validation->set_rules('firm_name', 'Firm Name', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        // Email unique check (ignore current)
        $email = $this->input->post('email');
        if ($email && $email != $seller->email) {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email|is_unique[users.email]'
            );
        } else {
            $this->form_validation->set_rules(
                'email',
                'Email',
                'required|valid_email'
            );
        }
        $this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|trim');
        $this->form_validation->set_rules('have_gst', 'GST', 'required|trim');
        if($this->input->post('have_gst') == 1){
			$this->form_validation->set_rules('gst_no', 'GST No', 'required|trim');
		}
        $this->form_validation->set_rules('working_experience', 'Working Experience', 'required|trim');
		$this->form_validation->set_rules('seller_country', 'Country', 'required|trim');
		$this->form_validation->set_rules('seller_state', 'State', 'required|trim');
		$this->form_validation->set_rules('seller_district', 'District', 'required|trim');
		$this->form_validation->set_rules('seller_city', 'City', 'required|trim');
		$this->form_validation->set_rules('seller_pin_code', 'Pin Code', 'required|trim');
		$this->form_validation->set_rules('seller_address', 'Address', 'trim');

        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('discount_percent', 'Discount Percent', 'required');

        if ($this->form_validation->run() == FALSE)
        {
			$data['getAllState'] = $this->Country_state_district->get_all_state();
            $data['seller'] = $seller;
            $data['page'] = 'seller/form';
			$data['script'] = 'seller/form_script';
            $this->load->view('layout/main',$data);
        }
        else
        {
            $data = [
                'firm_name'       => $this->input->post('firm_name', true),
                'name'  => $this->input->post('name', true),
                'mobile_no'       => $this->input->post('mobile_no', true),
                'alternate_mobile_no'       => $this->input->post('alternate_mobile_no', true),
                'email' => $this->input->post('email', true),
                'have_gst'      => $this->input->post('have_gst', true),
                'gst_no'      => $this->input->post('gst_no', true),
                'working_experience'      => $this->input->post('working_experience', true),
                'seller_country'      => $this->input->post('seller_country', true),
                'seller_state'      => $this->input->post('seller_state', true),
                'seller_district'      => $this->input->post('seller_district', true),
                'seller_city'      => $this->input->post('seller_city', true),
                'seller_pin_code'      => $this->input->post('seller_pin_code', true),
                'seller_address'      => $this->input->post('seller_address', true),
                'discount_percent' => $this->input->post('discount_percent', true),
            ];

            // Update password only if entered
            if (!empty($this->input->post('password'))) {
                $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $this->seller_model->update($id,$data);

            $this->session->set_flashdata('success','Seller Updated Successfully');
            redirect('seller');
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');

        $this->seller_model->delete($id);

        echo json_encode([
            'status' => 'success'
        ]);
    }

    public function change_status()
    {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $update = $this->seller_model->update_status($id,$status);

        if($update){
            echo json_encode(['status'=>'success']);
        }else{
            echo json_encode(['status'=>'error']);
        }
    }
	public function get_seller_details()
	{
		$seller_id = $this->input->post('seller_id');
		
		$seller = $this->seller_model->get($seller_id);
		
		$experience = '-';
		if (!empty($seller->working_experience)) {
			$experience = $seller->working_experience . ' ' .
				($seller->working_experience == 1 ? 'Year Experience' : 'Years Experience');
		}
		$state_name = '-';
		if(!empty($seller->seller_state)){
			$state = $this->Country_state_district->get_state_name($seller->seller_state);
			$state_name = $state->state_name ?? '-';
		}
		$district_name = '-';
		if(!empty($seller->seller_district)){
			$district = $this->Country_state_district->get_district_name($seller->seller_district);
			$district_name = $district->district_name ?? '-';
		}
		$html = '
			<div class="card-header">
				<h4 class="card-title">Seller Information</h4>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-6">
						<ul class="personal-info">
							<li>
								<div class="title">Firm Name</div>
								<div class="text">' . ($seller->firm_name ?? '-') . '</div>
							</li>
							<li>
								<div class="title">Re-Seller Name</div>
								<div class="text">' . ($seller->name ?? '-') . '</div>
							</li>
							<li>
								<div class="title">Mobile No.</div>
								<div class="text"><a href="tel:' . ($seller->mobile_no ?? '') . '">' . ($seller->mobile_no ?? '-') . '</a></div>
							</li>
							<li>
								<div class="title">Alternate No.</div>
								<div class="text"><a href="tel:' . ($seller->alternate_mobile_no ?? '') . '">' . ($seller->alternate_mobile_no ?? '-') . '</a></div>
							</li>
							<li>
								<div class="title">Email ID</div>
								<div class="text"><a href="mailto:' . ($seller->email ?? '') . '">' . ($seller->email ?? '-') . '</a></div>
							</li>
							<li>
								<div class="title">GST No.</div>
								<div class="text">' . ($seller->gst_no ?? '-') . '</div>
							</li>
							<li>
								<div class="title">Working Experience</div>
								<div class="text">' . $experience . '</div>
							</li>
						</ul>
					</div>	
					<div class="col-md-6">
						<ul class="personal-info">
							<li>
								<div class="title">Country</div>
								<div class="text">India</div>
							</li>
							<li>
								<div class="title">State</div>
								<div class="text">' . $state_name . '</div>
							</li>
							<li>
								<div class="title">District</div>
								<div class="text">' . $district_name . '</div>
							</li>
							<li>
								<div class="title">City</div>
								<div class="text">' . ($seller->seller_city ?? '-') . '</div>
							</li>
							<li>
								<div class="title">Pin Code</div>
								<div class="text">' . ($seller->seller_pin_code ?? '-') . '</div>
							</li>
							<li>
								<div class="title">Seller Full Address</div>
								<div class="text">' . nl2br($seller->seller_address ?? '-') . '</div>
							</li>
						</ul>
					</div>
				</div>
			</div>';
		echo json_encode([
			'status' => true,
			'html' => $html,
		]);
	}
}
