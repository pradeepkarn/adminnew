<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tenants extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Admin_acess');
		$this->load->model('Tenants_model', 'tenants');
		// if ($this->session->userdata('ln') == 'ar') {
		// 	$this->load->lang('ar/common_lang');
		// } else {
		// 	$this->load->lang('en/common_lang');
		// }
	}
	function search_data($obj)
	{
		switch ($obj->page) {
			case 'tenants':
				$this->load->model('Tenants_model', 'tenantModel');
				return $this->tenantModel->search_data($obj->search);
				break;
			default:
				return [];
				break;
		}
		return [];
	}
	function set_searched_data()
	{
		if (isset($_GET['page']) && isset($_GET['search'])) {
			$obj = new stdClass;
			$obj->page = $_GET['page'];
			$obj->search = $_GET['search'];
			return $this->search_data($obj);
		}
		return [];
	}
	public function tenantsList()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'tenants';
		$data['tenants'] = $this->tenants->getAllTenants();
		$data['searched_data'] = $this->set_searched_data();
		$this->load->view('admin/header', $data);
		$this->load->view('tenants/tenantsList', $data);
		$this->load->view('admin/footer', $data);
	}

	public function addTenants()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'tenants';
		$this->load->view('admin/header', $data);
		$this->load->view('tenants/add_tenants', $data);
		$this->load->view('admin/footer', $data);
	}

	public function editTenants()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'tenants';
		$data['ID'] = $this->uri->segment(3);
		$data['tenantsData'] = $this->tenants->getTenantsById($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('tenants/add_tenants', $data);
		$this->load->view('admin/footer', $data);
	}

	public function insertTenants()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'tenants';
		$data['action'] = $this->input->post('action');

		$tenantsData =  array(
			'fullName' => $this->input->post('fullName'),
			'mobileNumber' => $this->input->post('mobileNumber'),
			'isActive' => '1',
			'createdOn' => date("Y-m-d")
		);



		if ($this->input->post('action') == 'Edit') {
			$this->tenants->updatetenants($tenantsData, $this->input->post('tenantId'));
		} else {
			$this->tenants->inserttenants($tenantsData);
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('TENANTS_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback(); // [[ =======  Rollback all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_TENANTS'));
			echo json_encode($result);
			exit();
		}
	}

	public function deleteTenants()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'tenants';
		$data['ID'] = $this->uri->segment(2);

		if (!empty($data['ID'])) {
			$res_del = $this->tenants->deleteTenants($data['ID']);

			if (empty($res_del)) {
				$this->session->set_flashdata('errtenants', $this->lang->line('UNABLE_DELETE_TENANTS'));
				redirect('tenants');
			} else {
				$this->session->set_flashdata('successtenants', $this->lang->line('TENANTS_DELETED_SUCCESSFULLY'));
				redirect('tenants');
			}
		} else {
			$this->session->set_flashdata('errtenants', $this->lang->line('TENANTS_NOT_FOUND'));
			redirect('tenants');
		}
	}
}
