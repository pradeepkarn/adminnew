<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}



	// public function getRentRequests()
	// {

	// 	$this->db->select('sum(totalRent)  as cnt,(select sum(paidAmount) from tbl_installments) as stat');
	// 	$this->db->from('tbl_contracts');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function getRentRequests(string $contractStatus = null)
	{
		$this->db->select('
        SUM(totalRent) AS cnt,
        (
            SELECT SUM(i.paidAmount)
            FROM tbl_installments i
            JOIN tbl_contracts c ON i.contractNumber = c.contractNumber
            WHERE ' . ($contractStatus !== null ? "c.contractStatus = '$contractStatus'" : "1=1") . '
        ) AS stat
    ');

		$this->db->from('tbl_contracts');

		$query = $this->db->get();
		return $query->result();
	}

	// public function getOwnersDuesRequests()
	// {

	// $this->db->select('(SELECT sum(paidAmount) FROM `tbl_managementfee` where type=3)as stat,
	// 	(select(select sum(paidAmount) from tbl_installments) -(SELECT sum(paidAmount) FROM `tbl_managementfee` where type=3))as cnt');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	public function getOwnersDuesRequests(string $contractStatus = null)
	{
		$this->db->select("
			(SELECT SUM(mf.paidAmount) 
			 FROM `tbl_managementfee` mf
			 JOIN tbl_contracts c ON mf.contractNumber = c.contractNumber
			 WHERE (mf.paidAmount != '' OR mf.paidAmount IS NOT NULL) AND mf.type = 3 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "AND 1=1") . ") AS stat,
			
			(
				(SELECT SUM(i.paidAmount) 
				 FROM tbl_installments i
				 JOIN tbl_contracts c ON i.contractNumber = c.contractNumber
				 WHERE (i.paidAmount != '' OR i.paidAmount IS NOT NULL) AND " . ($contractStatus !== null ? "c.contractStatus = '$contractStatus'" : "1=1") . ") - 
			
				(SELECT SUM(mf.paidAmount) 
				 FROM `tbl_managementfee` mf
				 JOIN tbl_contracts c ON mf.contractNumber = c.contractNumber
				 WHERE (mf.paidAmount != '' OR mf.paidAmount IS NOT NULL) AND mf.type = 3 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "AND 1=1") . ")
			) AS cnt
		");

		$query = $this->db->get();
		// echo $this->db->last_query();
		return $query->result();
	}


	public function getIncomeRequests(string $contractStatus = null)
	{
		$this->db->select("
        (SELECT SUM(mf.paidAmount) 
         FROM `tbl_managementfee` mf
         JOIN tbl_contracts c ON mf.contractNumber = c.contractNumber
         WHERE mf.type = 1 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "AND 1=1") . ") AS stat,
        
        (SELECT SUM(mf.paidAmount) 
         FROM `tbl_managementfee` mf
         JOIN tbl_contracts c ON mf.contractNumber = c.contractNumber
         WHERE mf.type = 2 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "AND 1=1") . ") AS cnt
    ");

		$query = $this->db->get();
		return $query->result();
	}

	// function contract_stats(string $contractStatus= null) {
	// 	$sql = "SELECT DATE_FORMAT(createdOn, '%b %Y') AS stat, COUNT(*) AS cnt
	// 	FROM tbl_contracts WHERE ($contractStatus !== null ? 'contractStatus = '$contractStatus' : '1=1')
	// 	GROUP BY DATE_FORMAT(createdOn, '%b %Y')
	// 	ORDER BY DATE_FORMAT(createdOn, '%Y-%m');";
	// 	$this->db->select($sql);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	function contract_stats($contractStatus = null, $selectedYear = null) {
		// Initialize the WHERE clause
		$whereClause = "";
	
		// Check if a year filter is provided
		if ($selectedYear !== null) {
			// Use CodeIgniter's query builder to add the year filter
			$this->db->where("YEAR(startDate)", $selectedYear);
		}
	
		// Select the desired columns and group by month and year
		$this->db->select("DATE_FORMAT(startDate, '%b %Y') AS stat, COUNT(*) AS cnt");
		$this->db->from("tbl_contracts");
	
		// Apply the WHERE clause if it's not empty
		if (!empty($whereClause)) {
			$this->db->where($whereClause);
		}
	
		// Group by the formatted date and order by year-month
		$this->db->group_by("DATE_FORMAT(startDate, '%Y-%m')");
		$this->db->order_by("DATE_FORMAT(startDate, '%Y-%m')");
	
		// Execute the query
		$query = $this->db->get();
	
		// Debugging: Print the last executed query
		// echo $this->db->last_query();
	
		// Return the result as an array of objects
		return $query->result();
	}
	
	// public function getIncomeRequests()
	// {
	// 	//	select(SELECT sum(totalAmount) FROM `tbl_managementfee` where type=1)as mgmtFee,(SELECT sum(totalAmount) FROM `tbl_managementfee` where type=2)as agencyFee
	// 	$this->db->select('(SELECT sum(paidAmount) FROM `tbl_managementfee` where type=1)as stat,(SELECT sum(paidAmount) FROM `tbl_managementfee` where type=2)as cnt');

	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
	// public function getUnitsRequests(string $contractStatus = null)
	// {
	// 	$this->db->select("
	//     (SELECT COUNT(u.id) 
	//      FROM `tbl_units` u
	//      JOIN `tbl_contracts` c ON u.propertyId = c.propertyId
	//      WHERE u.currentStatus = 1 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "") . ") AS stat,

	//     (SELECT COUNT(u.id) 
	//      FROM `tbl_units` u
	//      JOIN `tbl_contracts` c ON u.propertyId = c.propertyId
	//      WHERE u.currentStatus = 0 " . ($contractStatus !== null ? "AND c.contractStatus = '$contractStatus'" : "") . ") AS cnt
	// ");

	// 	$query = $this->db->get();
	// 	return $query->result();
	// }



	public function getUnitsRequests()
	{
		//	$this->db->select('(SELECT count(id) FROM `tbl_units` where currentStatus=0)as stat,(SELECT count(id) FROM `tbl_units` where currentStatus=1)as cnt');
		$this->db->select('(select count(id) from tbl_units  where currentStatus=1)as stat, (select count(id) from tbl_units  where currentStatus=0)as cnt');

		$query = $this->db->get();
		return $query->result();
	}
	public function getContractStatusRequests()
	{
		$this->db->select('(select count(id) from tbl_contracts  where contractStatus=1)as stat, (select count(id) from tbl_contracts  where contractStatus=0)as cnt,(select count(id) from tbl_contracts  where contractStatus=2)as suspended');
		$query = $this->db->get();
		return $query->result();
	}
}
