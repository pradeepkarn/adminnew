<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('User_model', 'userModel'); 	  // [[ =======  this is used to load model to use db ======= ]]
		$this->load->library('Admin_acess');			 // [[ ======= this will restrict direct access to users who are not logged in ======= ]]

	}

	function search_data($obj)
	{
		switch ($obj->page) {
			case 'users':
				return $this->userModel->search_data($obj->search);
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


	// [[ =======  this is used to load all the portal user ======= ]]
	public function userlist()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['searched_data'] = $this->set_searched_data();
		$data['users'] = $this->userModel->getUsersList(); // [[ ======= this will fetch all the records from tbl_portal_users  ======= ]]	
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('admin/footer', $data);
	}

	// [[ =======  this is used to load Add Portal User ======= ]]
	public function adduser()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['permissions'] = $this->userModel->getPermission(); // [[ ======= Load all the permission whose status is active ======= ]]
		$data['admin_groups'] = $this->userModel->getAdminGroups(); // [[ ======= Load all the auth groups whose status is active ======= ]]
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_user', $data);
		$this->load->view('admin/footer', $data);
	}

	// [[ =======  this is used to load Edit Portal User ======= ]]
	public function edituser()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['ID'] = $this->uri->segment('2');
		$data['permissions'] = $this->userModel->getPermission();   // [[ ======= Load all the permission whose status is active ======= ]]
		$data['user'] = $this->userModel->getUserById($data['ID']); // [[ ======= Load user details by ID ======= ]]
		$data['admin_groups'] = $this->userModel->getAdminGroups(); // [[ ======= Load all the auth groups whose status is active ======= ]]
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_user', $data);
		$this->load->view('admin/footer', $data);
	}



	// [[ =======  this is used to load Add Edit User ======= ]]
	public function saveuser()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'users';
		$result = array();

		$FirstName = $this->input->post('FirstName', TRUE);
		// $LastName = $this->input->post('LastName', TRUE);
		// $IDNumber = $this->input->post('IDNumber', TRUE);
		$Email = $this->input->post('Email', TRUE);
		$Mobile = $this->input->post('Mobile', TRUE);
		// $SEX = $this->input->post('SEX', TRUE);
		$Password = $this->input->post('Password', TRUE);
		$admin_group = $this->input->post('admin_group', TRUE);
		// $PermissionID = $this->input->post('PermissionID',TRUE);
		$PermissionID = 1;
		$IsActive = $this->input->post('IsActive', TRUE);
		$recid = $this->input->post('recid', TRUE);
		$task = $this->input->post('task', TRUE);

		$user_check = $this->userModel->getUserById($recid);
		if (in_array($user_check->Email,["click2nithya@gmail.com"])) {
			$IsActive = 1;
		}
		$data = array(
			'FirstName' => $FirstName,
			// 'LastName' => $LastName,
			// 'IDNumber' => $IDNumber,
			'Email' => $Email,
			'Mobile' => $Mobile,
			// 'SEX' => $SEX,
			'Password' => $Password,
			'PermissionID' => $PermissionID,
			'admin_group' => $admin_group,
			'IsActive' => $IsActive==1?"1":"0"
		);


		// [[ =======  If task is one perform Insert else perform update ======= ]]
		if ($task == 1) {
			$insert_id = $this->userModel->addUser($data);
		} else {
			$insert_id = $this->userModel->updateUser($data, $recid);
		}


		if ($insert_id) {
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('user_saved_successfully'));
			echo json_encode($result);
			exit();
		} else {
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('no_changes'));
			echo json_encode($result);
			exit();
		}
	}

	// [[ =======  this is used to Delete Portal User ======= ]]
	public function deleteuser()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'users';
		$data['ID'] = $this->uri->segment(2);
		if (!empty($data['ID'])) {
			$user_check = $this->userModel->getUserById($data['ID']);
			if (in_array($user_check->Email,["click2nithya@gmail.com"])) {
				$this->session->set_flashdata('erruser', $this->lang->line('user_not_found'));
				$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('PROTECTED_USER'));
				echo json_encode($result);
				return;
			}
			$res_del = $this->userModel->deleteUsernByID($data['ID']);
			if (empty($res_del)) {
				$this->session->set_flashdata('erruser', $this->lang->line('user_cannot_be_deleted'));
				redirect('users');
			} else {
				$this->session->set_flashdata('successuser', $this->lang->line('user_deleted_successfully'));
				redirect('users');
			}
		} else {
			$this->session->set_flashdata('erruser', $this->lang->line('user_not_found'));
			redirect('users');
		}
	}

	// ---- To show mapping list -----------

	public function managerlist()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['users'] = $this->userModel->getMappingList(); // [[ ======= this will fetch all the records from tbl_manager_supervisor  ======= ]]	
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/managers', $data);
		$this->load->view('admin/footer', $data);
	}

	// [[ =======  this is  Add Mappings======= ]]
	public function addmapping()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['manager'] = $this->userModel->getManagerwithoutsupervisor();
		$data['supervisor'] = $this->userModel->getAllSupervisor();
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_mapping', $data);
		$this->load->view('admin/footer', $data);
	}


	// [[ =======  this is used to load Add Edit Mapping ======= ]]
	public function savemapping()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'manager';
		$result = array();

		$managerid = $this->input->post('managerid', TRUE);
		$supervisorid = $this->input->post('supervisorid', TRUE);
		$IsActive = $this->input->post('IsActive', TRUE);
		$recid = $this->input->post('recid', TRUE);
		$task = $this->input->post('task', TRUE);
		$result = array();
		$data = array(
			'managerID' => $managerid,
			'supervisorID' => $supervisorid,
			'IsActive' => !empty($IsActive) ? '1' : '0'
		);
		//print_r($data);die();
		// [[ =======  If task is one perform Insert else perform update ======= ]]
		if ($task == 1) {
			$insert_id = $this->userModel->addmappinginfo($data);
		} else {
			$insert_id = $this->userModel->updatemapping($data, $recid);
		}

		if ($insert_id) {

			$this->session->set_flashdata('successuser', $this->lang->line('mapping_saved_successfully'));
			redirect('manager');
		} else {
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('unable_to_save_mapping'));
			redirect('manager');
		}
	}


	// [[ =======  this is used to Delete Mapping======= ]]
	public function deletemapping()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'users';
		$data['ID'] = $this->uri->segment(2);
		if (!empty($data['ID'])) {
			$res_del = $this->userModel->deleteMapping($data['ID']);
			if (empty($res_del)) {
				$this->session->set_flashdata('erruser', $this->lang->line('mapping_cannot_be_deleted'));
				redirect('manager');
			} else {
				$this->session->set_flashdata('successuser', $this->lang->line('mapping_deleted_successfully'));
				redirect('manager');
			}
		} else {
			$this->session->set_flashdata('erruser', $this->lang->line('mapping_not_found'));
			redirect('manager');
		}
	}


	// [[ =======  this is used Edit Mapping ======= ]]
	public function editmapping()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		$data['menu'] = 'users';
		$data['ID'] = $this->uri->segment('2');
		$data['manager'] = $this->userModel->getManagerwithoutsupervisor();
		$data['supervisor'] = $this->userModel->getAllSupervisor();

		$data['managerinfo'] = $this->userModel->getmanager($data['ID']);
		$data['supervisorinfo'] = $this->userModel->getAllSupervisor();


		//$data['manager'] = $this->userModel->getAllManager(); 
		//$data['supervisor'] = $this->userModel->getAllSupervisor(); 
		//$data['permissions'] = $this->userModel->getPermission();   // [[ ======= Load all the permission whose status is active ======= ]]
		//$data['user'] = $this->userModel->getAlMapping($data['ID']);// [[ ======= Load user details by ID ======= ]]

		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_mapping', $data);
		$this->load->view('admin/footer', $data);
	}
}
