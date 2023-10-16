<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Properties extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Admin_acess');
		$this->load->model('Properties_model', 'properties');
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
			case 'properties':
				return $this->properties->search_data($obj->search);
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
	public function propertiesList()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'properties';
		$data['properties'] = $this->properties->getAllProperties();
		$data['searched_data'] = $this->set_searched_data();
		$this->load->view('admin/header', $data);
		$this->load->view('properties/propertiesList', $data);
		$this->load->view('admin/footer', $data);
	}

	public function addproperties()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'properties';
		$data['ownerData'] = $this->owners->getAllOwners();

		$this->load->view('admin/header', $data);
		$this->load->view('properties/addProperties', $data);
		$this->load->view('admin/footer', $data);
	}

	public function editproperties()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'properties';
		$data['ID'] = $this->uri->segment(3);
		$data['propertiesData'] = $this->properties->getPropertiesById($this->uri->segment(3));
		$data['ownerData'] = $this->owners->getAllOwners();
		$this->load->view('admin/header', $data);
		$this->load->view('properties/addProperties', $data);
		$this->load->view('admin/footer', $data);
	}

	public function insertProperties()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'properties';
		$data['action'] = $this->input->post('action');

		$propertiesData =  array(
			'ownerId' => $this->input->post('ownerId'),
			'propertyName' => $this->input->post('propertyName'),
			'residentialUnits' => $this->input->post('residentialUnits'),
			'commercialUnits' => $this->input->post('commercialUnits'),
			'isActive' => '1',
			'createdOn' => date("Y-m-d")
		);


		if ($this->input->post('action') == 'Edit') {
			$this->properties->updateProperties($propertiesData, $this->input->post('propertyId'));
		} else {
			$this->properties->insertProperties($propertiesData);
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('PROPERTIES_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback(); // [[ =======  Rollback all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_PROPERTIES'));
			echo json_encode($result);
			exit();
		}
	}

	public function deleteproperties()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'properties';
		$data['ID'] = $this->uri->segment(2);

		if (!empty($data['ID'])) {
			$res_del = $this->properties->deleteProperties($data['ID']);

			if (empty($res_del)) {
				$this->session->set_flashdata('errproperties', $this->lang->line('UNABLE_DELETE_PROPERTIES'));
				redirect('properties');
			} else {
				$this->session->set_flashdata('successproperties', $this->lang->line('PROPERTIES_DELETED_SUCCESSFULLY'));
				redirect('properties');
			}
		} else {
			$this->session->set_flashdata('errproperties', $this->lang->line('PROPERTIES_NOT_FOUND'));
			redirect('properties');
		}
	}
}
