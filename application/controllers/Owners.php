<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owners extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Admin_acess');
		$this->load->model('Owners_model', 'owners');
		// if ($this->session->userdata('ln') == 'ar') {
		// 	$this->load->lang('ar/common_lang');
		// } else {
		// 	$this->load->lang('en/common_lang');
		// }
	}

	function search_data($obj)
	{
		switch ($obj->page) {
			case 'owners':
				return $this->owners->search_data($obj->search);
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

	public function ownersList()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'owners';
		$data['owners'] = $this->owners->getAllOwners();
		$data['searched_data'] = $this->set_searched_data();

		$this->load->view('admin/header', $data);
		$this->load->view('owners/ownersList', $data);
		$this->load->view('admin/footer', $data);
	}

	public function addOwners()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'owners';
		$this->load->view('admin/header', $data);
		$this->load->view('owners/add_owners', $data);
		$this->load->view('admin/footer', $data);
	}

	public function editOwners()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'owners';
		$data['ID'] = $this->uri->segment(3);
		$data['ownersData'] = $this->owners->getownersById($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('owners/add_owners', $data);
		$this->load->view('admin/footer', $data);
	}

	public function insertOwners()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'owners';
		$data['action'] = $this->input->post('action');

		$ownersData =  array(
			'fullName' => $this->input->post('fullName'),
			'mobileNumber' => $this->input->post('mobileNumber'),
			'isActive' => '1',
			'createdOn' => date("Y-m-d")
		);



		if ($this->input->post('action') == 'Edit') {
			$this->owners->updateowners($ownersData, $this->input->post('tenantId'));
		} else {
			$this->owners->insertowners($ownersData);
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('OWNERS_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback(); // [[ =======  Rollback all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_OWNERS'));
			echo json_encode($result);
			exit();
		}
	}

	public function deleteOwners()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'owners';
		$data['ID'] = $this->uri->segment(2);

		if (!empty($data['ID'])) {
			$res_del = $this->owners->deleteOwners($data['ID']);

			if (empty($res_del)) {
				$this->session->set_flashdata('errowners', $this->lang->line('UNABLE_DELETE_OWNERS'));
				redirect('owners');
			} else {
				$this->session->set_flashdata('successowners', $this->lang->line('OWNERS_DELETED_SUCCESSFULLY'));
				redirect('owners');
			}
		} else {
			$this->session->set_flashdata('errowners', $this->lang->line('OWNERS_NOT_FOUND'));
			redirect('owners');
		}
	}
}
