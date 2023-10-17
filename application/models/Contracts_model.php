<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Contracts_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}


	public function search_data($keyword)
	{
		$qry = "(SELECT MAX(e.id) FROM tbl_installments e WHERE e.contractNumber = a.contractNumber GROUP BY e.contractNumber)";

		$this->db->select('a.contractNumber as contractNo, b.propertyName, a.startDate, a.expiryDate, a.id as contractId, a.contractStatus, d.*');
		$this->db->from('tbl_contracts a');
		$this->db->join('tbl_properties b', 'a.propertyId = b.id');
		$this->db->join('tbl_installments d', 'a.contractNumber = d.contractNumber', 'LEFT');
		$this->db->where('a.isActive', '1');

		// Decide whether to include columns in the GROUP BY clause or use aggregate functions
		$includeColumnsInGroupBy = false; // Set to true to include columns in GROUP BY

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('a.contractNumber', $keyword);
			$this->db->or_like('b.propertyName', $keyword);
			$this->db->or_like('a.startDate', $keyword);
			$this->db->or_like('a.expiryDate', $keyword);
			// Add more columns to search as needed
			$this->db->group_end();
		}

		if ($includeColumnsInGroupBy) {
			$this->db->group_by('a.contractNumber, b.propertyName, a.startDate, a.expiryDate, a.id, a.contractStatus, d.id, d.installmentNumber');
		} else {
			$this->db->select('MAX(a.contractNumber) as contractNumber, MAX(b.propertyName) as propertyName, MAX(a.startDate) as startDate, MAX(a.expiryDate) as expiryDate, MAX(a.id) as contractId, MAX(a.contractStatus) as contractStatus, MAX(d.id) as installmentId, MAX(d.installmentNumber) as installmentNumber');
			$this->db->group_by('a.contractNumber'); // Group only by contractNumber
		}

		$this->db->or_where_in("d.id", $qry, FALSE);

		$this->db->order_by('a.id', 'DESC');
		$query = $this->db->get();

		return $query->result();
	}

	public function getAllContracts(string $contractStatus = null)
	{
		$wherstatus = $contractStatus != null ? "and `a`.`contractStatus` = '$contractStatus'" : null;
		$sql = "SELECT `a`.`renewStatus`, `d`.`installmentNumber` as `installmentNo`, `a`.`id` as `contractId`, `a`.`contractNumber` as `contractNo`, GROUP_CONCAT(DISTINCT c.unitName) as Name, `b`.`propertyName`, `a`.`startDate`, `a`.`expiryDate`, `a`.`id` as `contractId`, `a`.`contractStatus`, `d`.*
                FROM `tbl_contracts` `a`
                JOIN `tbl_properties` `b` ON `a`.`propertyId` = `b`.`id`
                JOIN `tbl_units` `c` ON `a`.`unitNumber` = `c`.`id`
                LEFT JOIN `tbl_installments` `d` ON `a`.`contractNumber` = `d`.`contractNumber`
                WHERE (`a`.`isActive` = '1'
                OR d.id IN((select max(e.id) from tbl_installments e where e.contractNumber = a.contractNumber group by e.contractNumber))) $wherstatus
                GROUP BY `a`.`contractNumber`
                ORDER BY `a`.`id` DESC";
		$query = $this->db->query($sql);
		// echo $sql;
		return $query->result(); // 
	}


	// public function getAllContracts($contractStatus=null)
	// {
	// 	$qry = "(select max(e.id) from tbl_installments e where e.contractNumber=a.contractNumber group by e.contractNumber)";
	// 	$this->db->select('a.renewStatus,d.installmentNumber as installmentNo,a.id as contractId,a.contractNumber as contractNo,GROUP_CONCAT(DISTINCT c.unitName) as Name,b.propertyName,a.startDate,a.expiryDate,a.id as contractId,a.contractStatus,d.*');
	// 	$this->db->from('tbl_contracts a');
	// 	$this->db->join('tbl_properties b', 'a.propertyId=b.id');
	// 	$this->db->join('tbl_units c', 'a.unitNumber=c.id');
	// 	$this->db->join('tbl_installments d', 'a.contractNumber=d.contractNumber', 'LEFT');
	// 	$this->db->where('a.isActive', '1');
	// 	$this->db->or_where_in("d.id", $qry, FALSE);
	// 	$this->db->group_by('a.contractNumber');
	// 	$this->db->order_by('a.id', 'desc');
	// 	$query = $this->db->get();

	// 	return $query->result();
	// }

	public function getContractsById($id)
	{

		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where('isActive', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getContractsByContractsNumber($cnumber)
	{
		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where('isActive', '1');
		$this->db->where('contractNumber', $cnumber);
		$query = $this->db->get();
		$d = $query->result();
		$cdata = new stdClass;
		if ($d) {
			foreach ($d as $key => $c) {
				$cdata->contractNumber = $c->contractNumber;
				$cdata->propertyId = $c->propertyId;
				$cdata->tenantId = $c->tenantId;
				$cdata->contractPeriod = $c->contractPeriod;
				$cdata->startDate = $c->startDate;
				$cdata->expiryDate = $c->expiryDate;
				$cdata->installments = $c->installments;
				$cdata->rentAmount = $c->rentAmount;
				$cdata->waterFee = $c->waterFee;
				$cdata->electricityFee = $c->electricityFee;
				$cdata->otherFee = $c->otherFee;
				$cdata->totalRent = $c->totalRent;
				$cdata->agencyFee = $c->agencyFee;
				$cdata->mgmtFeesPercentage = $c->mgmtFeesPercentage;
				$cdata->mgmtFeesFixed = $c->mgmtFeesFixed;
				$cdata->contractStatus = $c->contractStatus;
				$cdata->renewStatus = $c->renewStatus;
				$cdata->arr[] = $c;
			}
			return $cdata;
		}
		return $cdata;
	}
	public function getContractAndRelatedDataById($id)
	{

		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where('isActive', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getContract($id)
	{

		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where('isActive', '1');
		$this->db->where('contractNumber', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getContractwithUnits($id)
	{

		$this->db->select('*,GROUP_CONCAT(DISTINCT tbl_units.unitName) as Name,GROUP_CONCAT(DISTINCT a.unitNumber) as unitNo');
		$this->db->from('tbl_contracts a');
		$this->db->join('tbl_units', 'a.unitNumber=tbl_units.id');
		$this->db->join('tbl_properties', 'a.propertyId=tbl_properties.id');

		$this->db->where('a.isActive', '1');
		$this->db->where('a.contractNumber', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getAgentData($id)
	{

		$this->db->select('type,a.paidDate,sum(a.paidAmount) as paidAmount,(select pendingAmount from tbl_managementfee where id =(SELECT Max(id)as id FROM `tbl_managementfee` where contractNumber=a.contractNumber AND type=1 AND installmentNumber IS  NULL GROUP by contractNumber)) as pendingAmount');
		$this->db->from('tbl_managementfee a');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('a.installmentNumber', NULL);
		$this->db->where('a.type', 1);
		$query = $this->db->get();
		return $query->row();
	}

	public function getMgmtDataById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_managementfee a');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('a.type!=', 3);
		$query = $this->db->get();
		return $query->result();
	}

	public function getOwnersDueDataById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_managementfee a');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('a.type', 3);
		$query = $this->db->get();
		return $query->result();
	}



	public function getManagementData($id)
	{
		//SELECT b.installmentNumber,b.pendingAmount,(select sum(paidAmount) from tbl_installments c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as paidAmt FROM `tbl_contracts` a JOIN tbl_installments b on a.contractNumber=b.contractNumber where b.id in (SELECT Max(id)as id FROM `tbl_installments` GROUP by installmentNumber,contractNumber) group by b.id;
		$this->db->select('*,(select sum(paidAmount) from tbl_managementfee c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as totalPaidAmount');
		$this->db->from('tbl_contracts a');
		$this->db->join('tbl_managementfee b', 'a.contractNumber=b.contractNumber');
		$this->db->where('a.isActive', '1');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('b.type', 2);
		$this->db->where('b.id in (SELECT Max(id)as id FROM `tbl_managementfee` GROUP by installmentNumber,contractNumber)');
		$this->db->group_by('b.id');

		$this->db->order_by('b.installmentNumber');
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->select('*');
			$this->db->from('tbl_contracts');
			$this->db->where('contractNumber', $id);
			$this->db->where('IsActive', '1');
			$query = $this->db->get();
		}



		return $query->result();
	}



	public function getContractsByContractNumber($id)
	{
		//SELECT b.installmentNumber,b.pendingAmount,(select sum(paidAmount) from tbl_installments c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as paidAmt FROM `tbl_contracts` a JOIN tbl_installments b on a.contractNumber=b.contractNumber where b.id in (SELECT Max(id)as id FROM `tbl_installments` GROUP by installmentNumber,contractNumber) group by b.id;
		$this->db->select('*,(select sum(paidAmount) from tbl_installments c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as totalPaidAmount');
		$this->db->from('tbl_contracts a');
		$this->db->join('tbl_installments b', 'a.contractNumber=b.contractNumber');
		$this->db->where('a.isActive', '1');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('b.id in (SELECT Max(id)as id FROM `tbl_installments` GROUP by installmentNumber,contractNumber)');
		$this->db->group_by('b.id');
		$this->db->order_by('b.installmentNumber');
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->select('*');
			$this->db->from('tbl_contracts');
			$this->db->where('contractNumber', $id);
			$this->db->where('IsActive', '1');
			$query = $this->db->get();
		}

		return $query->result();
	}

	public function getInstallmentsByContractNumber($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_installments a');
		//$this->db->join('tbl_contracts b', 'a.contractNumber=b.contractNumber');
		$this->db->where('a.contractNumber', $id);
		$this->db->order_by('a.installmentNumber');
		$query = $this->db->get();
		return $query->result();
	}
	public function getOnlyInstallmentNumber($id)
	{
		$this->db->select(' max(installmentNumber) as maxInstallment');
		$this->db->from('tbl_installments a');
		$this->db->where('a.contractNumber', $id);
		$this->db->order_by('a.installmentNumber');
		$query = $this->db->get();
		return $query->result();
	}




	public function insertContracts($data)
	{

		$this->db->insert('tbl_contracts', $data);
		$this->db->last_query();
		//$users = $this->db->query("SELECT designation FROM employee_official WHERE deleteStatus=0")->result();
		// $d = $this->db->query("INSERT INTO `tbl_contracts` (`id`, `propertyId`, `unitNumber`, `tenantId`, `contractNumber`, `contractPeriod`, `startDate`, `expiryDate`, `installments`, `rentAmount`, `waterFee`, `electricityFee`, `otherFee`, `totalRent`, `insurance`, `agencyFee`, `mgmtFeesPercentage`, `mgmtFeesFixed`, `contractStatus`, `isActive`, `createdOn`) VALUES (NULL, data['propertyId'], data['unitNumber'], data['tenantId'], data[contractNumber'], data['contractPeriod'], data['startDate'], data['expiryDate'], data['installments'], data['rentAmount'], data['waterFee'], data['otherFee'], data['electricityFee'],data['totalRent'], data['insurance'],data['agencyFee'], data['mgmtFeesPercentage'], NULL, '1', '1', current_timestamp())");
		// echo $d;
		//$this->db->_error_message();
		//$this->db->insert('tbl_contracts', $data);

		return $this->db->insert_id();
	}

	public function updateContracts($data, $ID)
	{
		//  print_r($data);die();
		$this->db->where("id", $ID);
		$this->db->update('tbl_contracts', $data);
		return $this->db->affected_rows();
	}

	public function deleteContracts($ID)
	{
		$this->db->where("id", $ID);
		$contractsData =  array(
			'isActive' => '0',
			'createdOn' => date("Y-m-d H:i:s")
		);
		$this->db->update('tbl_contracts', $contractsData);
		return $this->db->affected_rows();
	}

	public function deleteContractsByContractNumber($contractNo)
	{
		try {
			// Start a database transaction to ensure data consistency
			$this->db->trans_start();

			// Step 1: Update contractStatus in tbl_units
			$updateSql = "UPDATE tbl_units
                      SET currentStatus = '0'
                      WHERE id IN (SELECT unitNumber FROM tbl_contracts WHERE contractNumber = ?)
                      AND propertyId IN (SELECT propertyId FROM tbl_contracts WHERE contractNumber = ?)";
			$this->db->query($updateSql, array($contractNo, $contractNo));

			// Step 2: Delete related rows from other tables
			$tablesToDeleteFrom = ['tbl_installments', 'tbl_managementfee', 'payments', 'tbl_expense', 'tbl_contracts'];
			foreach ($tablesToDeleteFrom as $table) {
				$this->db->where('contractNumber', $contractNo);
				$this->db->delete($table);
			}
			// Commit the transaction
			$this->db->trans_complete();

			// Check if the transaction was successful
			if ($this->db->trans_status() === FALSE) {
				// Transaction failed, return an error or handle accordingly
				return false;
			} else {
				// Transaction successful, return success or any relevant data
				return true;
			}
		} catch (Exception $e) {
			// Handle exceptions, log errors, etc.
			// echo $e;
			return false;
		}
	}


	public function getAllVacantProperties()
	{
		//select *,(SELECT count(b.id) FROM tbl_properties a left join `tbl_units` b on a.id=b.propertyId where b.currentStatus=0 and b.unitType=1 and a.id=e.id)as rCount,(SELECT count(d.id) FROM tbl_properties c left join `tbl_units` d on c.id=d.propertyId where d.currentStatus=0 and d.unitType=2 and c.id=e.id)as cCount FROM tbl_properties e left join `tbl_units` f on e.id=f.propertyId group by e.id;
		//select *FROM tbl_properties e left join `tbl_units` f on e.id=f.propertyId where f.currentStatus=0;
		$this->db->select('*,e.id as pId,(SELECT count(b.id) FROM tbl_properties a left join `tbl_units` b on a.id=b.propertyId where b.currentStatus=0 and b.unitType=1 and a.id=e.id)as rCount,(SELECT count(d.id) FROM tbl_properties c left join `tbl_units` d on c.id=d.propertyId where d.currentStatus=0 and d.unitType=2 and c.id=e.id)as cCount');
		$this->db->from('tbl_properties e');
		$this->db->join('tbl_units f', 'e.id=f.propertyId');
		$this->db->where('e.IsActive', '1');
		$this->db->group_by('e.id');
		$query = $this->db->get();
		return $query->result();
	}

	public function updateUnitStatus($data)
	{
		$this->db->where("propertyId", $data['propertyId']);
		$this->db->where("unitName", $data['unitName']);
		$this->db->update('tbl_units', $data);
		return $this->db->affected_rows();
	}

	public function updateInstallment($data)
	{

		$this->db->select('sum(paidAmount)');
		$this->db->from('tbl_installments a');
		$this->db->where("contractNumber", $data['contractNumber']);
		$this->db->where("installmentNumber", $data['installmentNumber']);
		$query_data = $this->db->get()->row_array();

		if (isset($query_data)) {

			$installmentDate = date("Y-m-d", strtotime($data['installmentDate']));
			//$pendingAmount = $query_data['pendingAmount'] - $data['paidAmount'];
			$pendingAmount = $data['installmentAmount'] - $data['paidAmount'];
			if ($pendingAmount == 0) {
				$paidStatus = 1;
			} else if ($pendingAmount > 1) {
				$paidStatus = 2;
			}
			$installmentData =  array(
				'contractNumber' => $data['contractNumber'],
				'paidDate' => $data['paidDate'],
				'installmentDate' => $installmentDate,
				'installmentNumber' => $data['installmentNumber'],
				'installmentAmount' => $data['installmentAmount'],
				'paidAmount' => $data['paidAmount'],
				'pendingAmount' => $pendingAmount,
				'paidStatus' => $paidStatus,
				'notes' => $data['notes']
			);

			$this->db->insert('tbl_installments', $installmentData);
			$this->db->last_query();
		} else {
			$data['pendingAmount'] = $data['installmentAmount'] - $data['paidAmount'];
			if ($data['pendingAmount'] == 0) {
				$data['paidStatus'] = 1;
			} else if ($data['pendingAmount'] > 1) {
				$data['paidStatus'] = 2;
			}

			$data['installmentDate'] = date("Y-m-d", strtotime($data['installmentDate']));
			$this->db->insert('tbl_installments', $data);
			$this->db->last_query();
		}
	}

	public function insertExpenses($data)
	{
		$this->db->insert('tbl_expense', $data);
		$this->db->last_query();
		return $this->db->insert_id();
	}

	public function getExpenseByContractNumber($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_expense e');
		$this->db->where('e.IsActive', '1');
		$this->db->where('e.contractNumber', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getTotalExpenseByContractNumber($id)
	{
		$this->db->select('sum(e.expenseAmount)as expenseAmount,e.chargeTo,e.expenseType,e.id as expenseId');
		$this->db->from('tbl_expense e');
		$this->db->where('e.IsActive', '1');
		$this->db->where('e.contractNumber', $id);
		$this->db->group_by('e.chargeTo,e.contractNumber');
		$query = $this->db->get();
		return $query->result();
	}


	public function getManagementByContractNumber($id)
	{
		//SELECT b.installmentNumber,b.pendingAmount,(select sum(paidAmount) from tbl_installments c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as paidAmt FROM `tbl_contracts` a JOIN tbl_installments b on a.contractNumber=b.contractNumber where b.id in (SELECT Max(id)as id FROM `tbl_installments` GROUP by installmentNumber,contractNumber) group by b.id;
		// $this->db->select('*');
		// $this->db->from('tbl_contracts a');
		// $this->db->join('tbl_managementfee b', 'a.contractNumber=b.contractNumber');
		// $this->db->where('a.IsActive', '1');
		// $this->db->where('a.contractNumber', $id);
		// $this->db->where('b.id in (SELECT Max(id)as id FROM `tbl_managementfee` GROUP by type,installmentNumber,contractNumber)');
		// $this->db->group_by('b.id');
		// //	$this->db->order_by('b.installmentNumber');
		// $query = $this->db->get();

		//if ($query->num_rows() == 0) {
		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where('contractNumber', $id);
		$this->db->where('IsActive', '1');
		$query = $this->db->get();
		//}

		return $query->result();
	}

	public function insertAgencyFee($data)
	{

		$this->db->insert('tbl_managementfee', $data);
		$this->db->last_query();
		return $this->db->insert_id();
	}

	public function updateManagementFee($data)
	{
		$this->db->insert('tbl_managementfee', $data);
		$this->db->last_query();
		return $this->db->insert_id();
	}
	
	public function updateAgencyFeeTrans($data)
	{
		try {
			$this->db->trans_start(); // Start transaction

			$sql = "SELECT agencyFee FROM tbl_contracts WHERE contractNumber = '{$data->contractNumber}'";
			$agencyFee = $this->db->query($sql)->row()->agencyFee;
			
			$sql = "SELECT * FROM tbl_managementfee WHERE contractNumber = '{$data->contractNumber}' AND id >= {$data->id} AND type=1 ORDER BY id ASC";
			$hdsg = $this->db->query($sql);
			$rw = $hdsg->result();
			
			$prevPending = $data->totalAmt - $data->paidAmt;
			for ($i = 0; $i < count($rw); $i++) {
				if ($i == 0) {
					$sql = "UPDATE tbl_managementfee 
                        SET paidAmount = '{$data->paidAmt}',
                        pendingAmount = '$prevPending'
                        WHERE id = {$data->id} and type=1";
					$this->db->query($sql);
				} else {
					$currentPaid = $this->db->query("SELECT paidAmount FROM tbl_managementfee WHERE id = '{$rw[$i]->id}'")->row()->paidAmount;
					$sql = "UPDATE tbl_managementfee 
                        SET pendingAmount = ($prevPending - $currentPaid),
                        totalAmount = '$prevPending'
                        WHERE id = {$rw[$i]->id} AND type=1";
					$this->db->query($sql);
					$prevPending -= $currentPaid;
				}
			}

			$sql = "SELECT SUM(paidAmount) as totalPaidAmount FROM tbl_managementfee WHERE contractNumber = '{$data->contractNumber}' AND type = 1";
			$result = $this->db->query($sql)->row();
			// echo $result->totalPaidAmount;
			if ($result->totalPaidAmount > $agencyFee) {
				$this->db->trans_rollback(); // Rollback the transaction if the condition is met
				return false;
			}

			$this->db->trans_commit(); // Commit the transaction if all operations are successful
			return true;
		} catch (Exception $e) {
			$this->db->trans_rollback(); // Rollback the transaction in case of any exception
			return false;
		}
	}



	public function getOwnersdueData($id)
	{
		//SELECT b.installmentNumber,b.pendingAmount,(select sum(paidAmount) from tbl_installments c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber group by c.installmentNumber,c.contractNumber )as paidAmt FROM `tbl_contracts` a JOIN tbl_installments b on a.contractNumber=b.contractNumber where b.id in (SELECT Max(id)as id FROM `tbl_installments` GROUP by installmentNumber,contractNumber) group by b.id;
		$this->db->select('*,(select sum(paidAmount) from tbl_managementfee c where c.contractNumber=a.contractNumber and c.installmentNumber=b.installmentNumber AND type=3 group by c.installmentNumber,c.contractNumber )as totalPaidAmount');
		$this->db->from('tbl_contracts a');
		$this->db->join('tbl_managementfee b', 'a.contractNumber=b.contractNumber');
		$this->db->where('a.isActive', '1');
		$this->db->where('a.contractNumber', $id);
		$this->db->where('b.type', 3);
		$this->db->where('b.id in (SELECT Max(id)as id FROM `tbl_managementfee` GROUP by installmentNumber,contractNumber)');
		$this->db->group_by('b.id');

		$this->db->order_by('b.installmentNumber');
		$query = $this->db->get();

		if ($query->num_rows() == 0) {
			$this->db->select('*');
			$this->db->from('tbl_contracts');
			$this->db->where('contractNumber', $id);
			$this->db->where('IsActive', '1');
			$query = $this->db->get();
		}

		return $query->result();
	}

	public function getAllData($id)
	{

		$query = $this->db->query("(SELECT b.notes,@id := 1 as tabletype, b.id,b.paidDate as paidDate,b.paidAmount,b.installmentNumber,b.pendingAmount,b.paidStatus,@type='' as type,@expenseType='' as expenseType,@expenseId='' as expenseId  FROM `tbl_contracts` a inner join tbl_installments b on a.contractNumber=b.contractNumber where a.contractNumber=" . $id . ") union (SELECT c.notes,@id := 2 as tabletype,c.id,c.paidDate as paidDate,c.paidAmount,c.installmentNumber,c.pendingAmount,c.paidStatus,c.type,c.expenseType,c.expenseId FROM `tbl_contracts` a inner join tbl_managementfee c on a.contractNumber=c.contractNumber where a.contractNumber=" . $id . " AND c.type!=1)Union (select d.note as notes,@id :=3 as tabletype, d.id,d.expenseDate as paidDate,d.expenseAmount,d.chargeTo,@pendingAmount='' as pendingAmount,@paidStatus='' as paidStatus,@type='' as type,d.expenseType,d.id as expenseId FROM tbl_contracts a inner join tbl_expense d on a.contractNumber=d.contractNumber where a.contractNumber= " . $id . ")order by paidDate ");

		return $query->result();
	}

	public function changeContractStatus($status, $contractNumber)
	{


		if ($status == 0) {
			$this->db->select('(SELECT count(id) FROM `tbl_installments`a where a.contractNumber=' . $contractNumber . ' and paidStatus=1)-(select count(id) from tbl_managementfee where type=3 and contractNumber= ' . $contractNumber . ' and paidStatus=1)as paid');

			$query_data = $this->db->get()->row_array();

			//$query = $this->db->query("select(SELECT count(id) FROM `tbl_installments`a where a.contractNumber=" . $contractNumber . " and paidStatus=1)-(select count(id) from tbl_managementfee where type=3 and contractNumber= " . $contractNumber . " and paidStatus=1)as paid");
			if (($query_data['paid']) == 0) {
				//echo "REady to Inactivate";
				$contractsData =  array(
					'contractStatus' => $status
				);
				$this->db->where("contractNumber", $contractNumber);
				$this->db->update('tbl_contracts', $contractsData);


				$this->db->select('unitNumber');
				$this->db->from('tbl_contracts');
				$this->db->where('contractNumber', $contractNumber);
				$query = $this->db->get();

				foreach ($query->result_array() as $row) {
					$installmentData =  array(
						'currentStatus' => $status
					);
					$this->db->where("id",  $row['unitNumber']);
					$this->db->update('tbl_units', $installmentData);
				}
				return true;
			} else if (($query_data['paid']) > 0) {
				//echo "Can't inactive as owners due pending";
				return false;
			}
		} else if (($status == 1) || ($status == 2)) {

			if ($status == 1) {
				$this->db->select('unitNumber');
				$this->db->from('tbl_contracts');
				$this->db->where('contractNumber', $contractNumber);
				$query = $this->db->get();
				foreach ($query->result_array() as $row) {
					$this->db->select('*');
					$this->db->from('tbl_units');
					$this->db->where("id",  $row['unitNumber']);
					$unitQuery = $this->db->get();
					foreach ($unitQuery->result_array() as $row1) {
						if ($row1['currentStatus'] == 0) {
							$unitStatus = 0;
						} else if ($row1['currentStatus'] == 1) {
							$unitStatus = 1;
							return false;
						}
					}
				}
			}
			$contractsData =  array(
				'contractStatus' => $status
			);
			$this->db->where("contractNumber", $contractNumber);
			$this->db->update('tbl_contracts', $contractsData);


			$this->db->select('unitNumber');
			$this->db->from('tbl_contracts');
			$this->db->where('contractNumber', $contractNumber);
			$query = $this->db->get();
			if ($status == 2) {
				$status = 0;
			}
			foreach ($query->result_array() as $row) {
				$installmentData =  array(
					'currentStatus' => $status
				);
				$this->db->where("id",  $row['unitNumber']);
				$this->db->update('tbl_units', $installmentData);
			}
			return true;
		}
	}
	public function checkOwnersDue($contractNumber)
	{

		$this->db->select('a.contractNumber,b.installments-max(a.installmentNumber)as paid');
		$this->db->from('tbl_contracts b');
		$this->db->join('tbl_managementfee a', 'a.contractNumber=b.contractNumber');
		$this->db->where('a.contractNumber', $contractNumber);
		$this->db->where('a.type', 3);
		$query_data = $this->db->get()->row_array();

		if (is_null($query_data['paid'])) {
			$status = "true";
		} else if (($query_data['paid'] == 0)) {
			$status = "false";
		} else if ($query_data['paid'] > 0) {
			$status = "true";
		}

		return $status;
	}


	public function getInstallmentInfo($contractNumber)
	{
		//SELECT * FROM `tbl_installments` where id in (select max(id) from tbl_installments where contractNumber=35345435 GROUP by installmentNumber);
		$str = "select max(id) from tbl_installments where contractNumber=$contractNumber GROUP by installmentNumber";
		$this->db->select('*');
		$this->db->from('tbl_installments');
		$this->db->where_in("id", $str, FALSE);
		$query_data = $this->db->get()->result();
		return $query_data;
	}


	public function checkContractNumber($contractNumber)
	{
		$this->db->select('*');
		$this->db->from('tbl_contracts');
		$this->db->where("contractNumber", $contractNumber);
		$query_data = $this->db->get()->row_array();
		return $query_data;
	}

	public function getCompletedInstallment($contractNumber)
	{
		$this->db->select('*');
		$this->db->from('tbl_managementfee');
		$this->db->where("contractNumber", $contractNumber);
		$this->db->where("type", '3');
		$this->db->where("paidStatus", '1');

		$query_data = $this->db->get()->result();
		return $query_data;
	}
}
