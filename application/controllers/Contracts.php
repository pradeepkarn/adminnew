<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contracts extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Admin_acess');
		$this->load->model('Contracts_model', 'contracts');
		$this->load->model('Properties_model', 'properties');
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
				return $this->contracts->search_data($obj->search);
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

	public function contractsList()
	{

		$filter = isset($_GET['filter'])?strval($_GET['filter']):null;
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['contracts'] = $this->contracts->getAllContracts($filter);
		$data['searched_data'] = $this->set_searched_data();
		//$data['ownersDueIno'] = $this->contracts->getOnwersDueInfo();

		//$data['installmentData'] = $this->contracts->getInstallmentsByContractNumber($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('contracts/contractsList', $data);
		$this->load->view('admin/footer', $data);
	}

	public function addContracts()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['propertyData'] = $this->contracts->getAllVacantProperties();
		$data['tenantsData'] = $this->tenants->getAllTenants();

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/addContracts', $data);
		$this->load->view('admin/footer', $data);
	}
	public function renewContracts()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['propertyData'] =  $this->contracts->getAllVacantProperties();
		$data['contractData'] = $this->contracts->getContractwithUnits($this->uri->segment(2));
		$data['tenantsData'] = $this->tenants->getAllTenants();

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/renewContract', $data);
		$this->load->view('admin/footer', $data);
	}



	public function editContracts()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(2);
		$data['propertyData'] =  $this->contracts->getAllVacantProperties();
		$dbdata = $this->contracts->getContractsByContractsNumber($this->uri->segment(2));
		$data['contractsData'] = $dbdata?$dbdata:[];
		// $data['contractsData'] = $this->contracts->getContractsById($this->uri->segment(2));
		// print_r($data['contractsData']);
		$data['tenantsData'] = $this->tenants->getAllTenants();
		$this->load->view('admin/header', $data);
		$this->load->view('contracts/editContracts', $data);
		$this->load->view('admin/footer', $data);
	}

	public function insertContracts()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['action'] = $this->input->post('action');
		if (is_null($this->input->post('mgmtFeesPercentage'))) {
			$mgmtFeesPercentage = 0.00;
		} else {
			$mgmtFeesPercentage = $this->input->post('mgmtFeesPercentage');
		}
		if (is_null($this->input->post('mgmtFeesFixed'))) {
			$mgmtFeesFixed = 0.00;
		} else {
			$mgmtFeesFixed = $this->input->post('mgmtFeesFixed');
		}
		foreach ($this->input->post('units') as $value) {
			$totalRent = $this->input->post('rentAmount') + $this->input->post('waterFee') + $this->input->post('electricityFee') + $this->input->post('otherFee');
			$contractsData =  array(
				'propertyId' => $this->input->post('propertyId'),
				'unitNumber' => $value,
				'tenantId' => $this->input->post('tenantId'),
				'contractNumber' => $this->input->post('contractNumber'),
				'contractPeriod' => $this->input->post('contractPeriod'),
				'startDate' => $this->input->post('startDate'),
				'expiryDate' => $this->input->post('expiryDate'),
				'installments' => $this->input->post('installments'),
				'rentAmount' => $this->input->post('rentAmount'),
				'waterFee' => $this->input->post('waterFee'),
				'electricityFee' => $this->input->post('electricityFee'),
				'otherFee' => $this->input->post('otherFee'),
				'totalRent' => $totalRent,
				//'insurance' => $this->input->post('insurance'),
				'agencyFee' => $this->input->post('agencyFee'),
				'mgmtFeesPercentage' => $mgmtFeesPercentage,
				'mgmtFeesFixed' => $mgmtFeesFixed,
				'contractStatus' => 1,
				'isActive' => '1',
				'createdOn' => date("Y-m-d")
			);


			if ($this->input->post('action') == 'Edit') {
				$this->db->where("id", $ID);
				$this->db->update('tbl_contracts', $contractsData);
			} else {
				$this->db->insert('tbl_contracts', $contractsData);
			}

			$unitData =  array(
				'id' => $value,
				'propertyId' => $this->input->post('propertyId'),
				'currentStatus' => 1,
				'isActive' => '1',
				'createdOn' => date("Y-m-d")
			);
			$this->db->where("propertyId", $this->input->post('propertyId'));
			$this->db->where("id", $value);
			$this->db->update('tbl_units', $unitData);
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('CONTRACTS_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback();
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_CONTRACTS'));
			echo json_encode($result);
			exit();
		}
	}
	public function updateContracts()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$contractNumber = $this->input->post('contractNumber');
		$data['action'] = $this->input->post('action');
		if (is_null($this->input->post('mgmtFeesPercentage'))) {
			$mgmtFeesPercentage = 0.00;
		} else {
			$mgmtFeesPercentage = $this->input->post('mgmtFeesPercentage');
		}
		if (is_null($this->input->post('mgmtFeesFixed'))) {
			$mgmtFeesFixed = 0.00;
		} else {
			$mgmtFeesFixed = $this->input->post('mgmtFeesFixed');
		}
		// foreach ($this->input->post('units') as $value) {
			$totalRent = $this->input->post('rentAmount') + $this->input->post('waterFee') + $this->input->post('electricityFee') + $this->input->post('otherFee');
			$contractsData =  array(
				// 'propertyId' => $this->input->post('propertyId'),
				// 'unitNumber' => $value,
				// 'tenantId' => $this->input->post('tenantId'),
				// 'contractNumber' => $this->input->post('contractNumber'),
				'contractPeriod' => $this->input->post('contractPeriod'),
				'startDate' => $this->input->post('startDate'),
				'expiryDate' => $this->input->post('expiryDate'),
				// 'installments' => $this->input->post('installments'),
				// 'rentAmount' => $this->input->post('rentAmount'),
				'waterFee' => $this->input->post('waterFee'),
				'electricityFee' => $this->input->post('electricityFee'),
				'otherFee' => $this->input->post('otherFee'),
				'totalRent' => $totalRent,
				//'insurance' => $this->input->post('insurance'),
				'agencyFee' => $this->input->post('agencyFee'),
				'mgmtFeesPercentage' => $mgmtFeesPercentage,
				'mgmtFeesFixed' => $mgmtFeesFixed,
				// 'contractStatus' => 1,
				'isActive' => '1',
				// 'createdOn' => date("Y-m-d")
			);


			if ($this->input->post('action') == 'Edit') {
				$this->db->where("contractNumber", $contractNumber);
				$this->db->update('tbl_contracts', $contractsData);
			} else {
				// $this->db->insert('tbl_contracts', $contractsData);
			}

			// $unitData =  array(
			// 	'id' => $value,
			// 	'propertyId' => $this->input->post('propertyId'),
			// 	'currentStatus' => 1,
			// 	'isActive' => '1',
			// 	'createdOn' => date("Y-m-d")
			// );
			// $this->db->where("propertyId", $this->input->post('propertyId'));
			// $this->db->where("id", $value);
			// $this->db->update('tbl_units', $unitData);
		// }


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('CONTRACTS_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback();
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_CONTRACTS'));
			echo json_encode($result);
			exit();
		}
	}



	public function renewContractsInfo()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['action'] = $this->input->post('action');
		$s = explode(",", $this->input->post('units'));
		if (is_null($this->input->post('mgmtFeesPercentage'))) {
			$mgmtFeesPercentage = 0.00;
		} else {
			$mgmtFeesPercentage = $this->input->post('mgmtFeesPercentage');
		}
		if (is_null($this->input->post('mgmtFeesFixed'))) {
			$mgmtFeesFixed = 0.00;
		} else {
			$mgmtFeesFixed = $this->input->post('mgmtFeesFixed');
		}

		foreach ($s as $value) {
			$totalRent = $this->input->post('rentAmount') + $this->input->post('waterFee') + $this->input->post('electricityFee') + $this->input->post('otherFee');
			$contractsData =  array(
				'propertyId' => $this->input->post('propertyId'),
				'unitNumber' => $value,
				'tenantId' => $this->input->post('tenantId'),
				'contractNumber' => $this->input->post('contractNumber'),
				'contractPeriod' => $this->input->post('contractPeriod'),
				'startDate' => $this->input->post('startDate'),
				'expiryDate' => $this->input->post('expiryDate'),
				'installments' => $this->input->post('installments'),
				'rentAmount' => $this->input->post('rentAmount'),
				'waterFee' => $this->input->post('waterFee'),
				'electricityFee' => $this->input->post('electricityFee'),
				'otherFee' => $this->input->post('otherFee'),
				'totalRent' => $totalRent,
				//'insurance' => $this->input->post('insurance'),
				'agencyFee' => $this->input->post('agencyFee'),
				'mgmtFeesPercentage' => $mgmtFeesPercentage,
				'mgmtFeesFixed' => $mgmtFeesFixed,
				'contractStatus' => 1,
				'isActive' => '1',
				'createdOn' => date("Y-m-d")
			);



			if ($this->input->post('action') == 'Edit') {
				$this->db->where("id", $ID);
				$this->db->update('tbl_contracts', $contractsData);
			} else {
				$this->db->insert('tbl_contracts', $contractsData);
				$oldcontractsData =  array(
					'renewStatus' => 1
				);
				$this->db->where("contractNumber", $this->input->post('oldContractNumber'));
				$this->db->update('tbl_contracts', $oldcontractsData);
			}
			$type = substr($value, 0, 1);
			if ($type == 'R') {
				$unitType = 1;
			} else {
				$unitType = 2;
			}
			$unitData =  array(
				'id' => $value,
				'propertyId' => $this->input->post('propertyId'),
				'unitType' => $unitType,
				'currentStatus' => 1,
				'isActive' => '1',
				'createdOn' => date("Y-m-d")
			);
			$this->db->where("propertyId", $this->input->post('propertyId'));
			$this->db->where("id", $value);
			$this->db->update('tbl_units', $unitData);
		}


		if ($this->db->trans_status() === TRUE) {
			$this->db->trans_commit();
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('CONTRACTS_SAVED_SUCCESSFULLY'));
			echo json_encode($result);
			exit();
		} else {
			$this->db->trans_rollback();
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_SAVE_CONTRACTS'));
			echo json_encode($result);
			exit();
		}
	}

	public function deleteContracts()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['contractNo'] = $this->uri->segment(2);
		if (!empty($data['contractNo'])) {
			$res_del = $this->contracts->deleteContractsByContractNumber($data['contractNo']);

			if (empty($res_del)) {
				$this->session->set_flashdata('errcontracts', $this->lang->line('UNABLE_DELETE_CONTRACTS'));
				redirect('contracts');
			} else {
				$this->session->set_flashdata('successcontracts', $this->lang->line('CONTRACTS_DELETED_SUCCESSFULLY'));
				redirect('contracts');
			}
		} else {
			$this->session->set_flashdata('errcontracts', $this->lang->line('CONTRACTS_NOT_FOUND'));
			redirect('contracts');
		}
	}

	public function getVacantUnits()
	{
		//	$propertyId = $this->input->post('propertyId');
		$data['result'] = $this->db->query("SELECT * FROM `tbl_units` WHERE currentStatus=0 AND propertyId=?", array($this->input->post('propertyId')))->result();
		if ($data['result']) {
			$data['status'] = 'true';
		} else {
			$data['status'] = 'false';
		}

		echo json_encode($data);
	}
	public function getOccupiedUnits()
	{
		//	$propertyId = $this->input->post('propertyId');
		$data['result'] = $this->db->query("SELECT * FROM `tbl_units` WHERE propertyId=?", array($this->input->post('propertyId')))->result();
		if ($data['result']) {
			$data['status'] = 'true';
		} else {
			$data['status'] = 'false';
		}

		echo json_encode($data);
	}

	public function payments()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['contractsData'] = $this->contracts->getContractsByContractNumber($this->uri->segment(3));
		// $data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		$data['installmentData'] = $this->contracts->getInstallmentsByContractNumber($this->uri->segment(3));

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/payments', $data);
		$this->load->view('admin/footer', $data);
	}

	public function expenses()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		// $data['contractsData'] = $this->contracts->getContractsByContractNumber($this->uri->segment(3));
		$data['installmentData'] = $this->contracts->getCompletedInstallment($this->uri->segment(3));
		$data['expenseData'] = $this->contracts->getExpenseByContractNumber($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('contracts/expenses', $data);
		$this->load->view('admin/footer', $data);
	}


	public function getPaymentInfo()
	{

		if (!empty($_POST['installmentNumber']) && ($_POST['contractNumber'])) {

			$res_unit = $this->contracts->updateInstallment($_POST);
			$data['status'] = "true";
			$data['message'] = $this->lang->line('PAYMENTS_DONE_SUCCESSFULLY');
			echo json_encode($data);
		}
	}

	public function addExpense()
	{

		$expenseData =  array(
			'contractNumber' =>  $this->input->post('contractNumber'),
			'expenseDate' => $this->input->post('expenseDate'),
			'expenseType' => $this->input->post('expenseType'),
			'expenseAmount' => $this->input->post('expenseAmount'),
			'note' => $this->input->post('note'),
			'chargeTo' => $this->input->post('chargeTo'),
			'isActive' => '1',
			'createdOn' => date("Y-m-d")
		);

		$contractsData = $this->contracts->insertExpenses($expenseData);
		if ($contractsData) {
			$data['status'] = "true";
			$data['message'] =  $this->lang->line('EXPENSES_ADDED_SUCCESSFULLY');
			echo json_encode($data);
		}
	}

	public function management()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		// $data['contractsData'] = $this->contracts->getContractsByContractNumber($this->uri->segment(3));
		$data['installmentData'] = $this->contracts->getInstallmentInfo($this->uri->segment(3));
		$data['agentData'] = $this->contracts->getAgentData($this->uri->segment(3));
		$data['managementData'] = $this->contracts->getManagementData($this->uri->segment(3));
		//print_r($data); die();
		$data['recordMgmtData'] = $this->contracts->getMgmtDataById($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('contracts/management', $data);
		$this->load->view('admin/footer', $data);
	}

	public function getAgencyFee()
	{

		$pendingAmount = ($this->input->post('totalAmount') - $this->input->post('agencyFeeAmount'));
		if ($pendingAmount == 0) {
			$status = "1";
		} else {
			$status = "2";
		}
		$d = date_create($this->input->post('agencyFeeDate'));
		$installmentDate = date_format($d, 'Y-m-d');
		$agencyFeeData =  array(
			'contractNumber' =>  $this->input->post('contractNumber'),
			'type' => 1,
			'installmentDate' => $installmentDate,
			'paidDate' => $this->input->post('agencyPaymentDate'),
			'totalAmount' => $this->input->post('totalAmount'),
			'paidAmount' => $this->input->post('agencyFeeAmount'),
			'pendingAmount' => $pendingAmount,
			'notes' =>  $this->input->post('notes'),
			'paidStatus' => $status,
			'createdOn' => date("Y-m-d")
		);

		$managementFeeData = $this->contracts->insertAgencyFee($agencyFeeData);
		if ($managementFeeData) {
			$data['status'] = "true";
			$data['message'] = $this->lang->line('AGENCY_FEE_ADDED_SUCCESSFULLY');
			echo json_encode($data);
		}
	}

	public function getManagementFee()
	{

		$pendingAmount = ($this->input->post('installmentAmount') - $this->input->post('paidAmount'));
		if ($pendingAmount == 0) {
			$status = "1";
		} else {
			$status = "2";
		}
		if ($this->input->post('type')) {
			$type = $this->input->post('type');
		} else {
			$type = 2;
		}
		$d = date_create($this->input->post('installmentDate'));
		$installmentDate = date_format($d, 'Y-m-d');

		$managementFeeData =  array(
			'contractNumber' =>  $this->input->post('contractNumber'),
			'type' => $type,
			'installmentDate' =>  $installmentDate,
			'installmentNumber' =>  $this->input->post('installmentNumber'),
			'paidDate' => $this->input->post('paidDate'),
			'totalAmount' => $this->input->post('installmentAmount'),
			'paidAmount' => $this->input->post('paidAmount'),
			'pendingAmount' => $pendingAmount,
			'notes' => $this->input->post('notes'),
			'paidStatus' => $status,
			'createdOn' => date("Y-m-d")
		);



		if (!empty($_POST['installmentNumber']) && ($_POST['contractNumber'])) {

			$res_unit = $this->contracts->updateManagementFee($managementFeeData);
			$data['status'] = "true";
			if ($type == 3) {
				$data['message'] =  $this->lang->line('OWNERS_DUE_ADDED_SUCCESSFULLY');
			} else {
				$data['message'] =  $this->lang->line('MANAGEMENT_FEE_ADDED_SUCCESSFULLY');
			}
			echo json_encode($data);
		}
	}

	public function ownersdue()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		$data['installmentData'] = $this->contracts->getInstallmentInfo($this->uri->segment(3));

		$data['ownersdueData'] = $this->contracts->getOwnersdueData($this->uri->segment(3));
		$data['expenseData'] = $this->contracts->getTotalExpenseByContractNumber($this->uri->segment(3));

		$data['recordOwnersDueData'] = $this->contracts->getOwnersDueDataById($this->uri->segment(3));

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/ownersdue', $data);
		$this->load->view('admin/footer', $data);
	}
	public function statement()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['allData'] = $this->contracts->getAllData($this->uri->segment(3));
		$data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		// // $data['ownerData'] = $this->contracts->getAgentData($this->uri->segment(3));
		// $data['ownersdueData'] = $this->contracts->getOwnersdueData($this->uri->segment(3));
		// $data['expenseData'] = $this->contracts->getTotalExpenseByContractNumber($this->uri->segment(3));

		//	$data['recordMgmtData'] = $this->contracts->getMgmtDataById($this->uri->segment(3));

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/statement', $data);
		$this->load->view('admin/footer', $data);
	}

	public function contractStatus()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		// $data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		// $data['agentData'] = $this->contracts->getAgentData($this->uri->segment(3));
		// $data['managementData'] = $this->contracts->getManagementData($this->uri->segment(3));

		$data['recordMgmtData'] = $this->contracts->getMgmtDataById($this->uri->segment(3));
		$this->load->view('admin/header', $data);
		$this->load->view('contracts/contractStatus', $data);
		$this->load->view('admin/footer', $data);
	}

	public function tenantPaymentStatus()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'contracts';
		$data['ID'] = $this->uri->segment(3);
		$data['contractsData'] = $this->contracts->getContract($this->uri->segment(3));
		$data['paidInstallmentData'] = $this->contracts->getOnlyInstallmentNumber($this->uri->segment(3));
		$data['installmentData'] = $this->contracts->getInstallmentsByContractNumber($this->uri->segment(3));

		$this->load->view('admin/header', $data);
		$this->load->view('contracts/tenantPaymentStatus', $data);
		$this->load->view('admin/footer', $data);
	}

	public function changeContractStatus()
	{

		$contractNumber = $this->input->post('contractNumber');
		$status = $this->input->post('status');

		$active = $this->contracts->changeContractStatus($status, $contractNumber);

		if ($active == true) {
			if ($status == 2) {
				$data['message'] = $this->lang->line('CONTRACT_DETAILS_SUSPENDED_SUCCESSFULLY');
			} else if ($status == 1) {
				$data['message'] =  $this->lang->line('CONTRACT_ACTIVATED_SUCCESSFULLY');
			} else if ($status == 0) {
				$data['message'] =  $this->lang->line('CONTRACT_INACTIVATED_SUCCESSFULLY');
			}

			$data['status'] = "true";
			echo json_encode($data);
		} else if ($active == false) {
			$data['status'] = "false";
			if ($status == 1) {
				$data['message'] =  $this->lang->line('CANNOT_ACTIVE');
			} else {
				$data['message'] =  $this->lang->line('CANNOT_INACTIVE');
			}


			echo json_encode($data);
		}
	}
	public function checkOwnersDue()
	{
		$contractNumber = $this->input->post('contractNumber');
		$checkOwnerDueInfo = $this->contracts->checkOwnersDue($contractNumber);
		if ($checkOwnerDueInfo == "false") {
			$data['status'] = "false";
			$data['message'] =  $this->lang->line('OWNERS_DUE_OVER');
		} else {
			$data['status'] = "true";
		}
		echo json_encode($data);
	}

	public function checkContractNumber()
	{

		$checkContractNumber = $this->contracts->checkContractNumber($this->input->post('contractNumber'));
		if ($checkContractNumber) {
			$data['status'] = "false";
			echo json_encode($data);
		} else {
			$data['status'] = "true";
			echo json_encode($data);
		}
	}
}
