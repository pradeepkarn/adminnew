<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Tenants_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function search_data($keyword)
	{
		$this->db->select('*');
		$this->db->from('tbl_tenants');
		$this->db->where('IsActive', '1');

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('fullName', $keyword); // Search in tenant_name
			$this->db->or_like('mobileNumber', $keyword); // Search in mobileNumber
			$this->db->group_end();
		}

		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}


	public function getAllTenants()
	{
		$this->db->select('*');
		$this->db->from('tbl_tenants');
		$this->db->where('IsActive', '1');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getTenantsById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_tenants');
		$this->db->where('IsActive', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}




	public function insertTenants($data)
	{
		$this->db->insert('tbl_tenants', $data);
		return $this->db->insert_id();
	}

	public function updateTenants($data, $ID)
	{
		//  print_r($data);die();
		$this->db->where("id", $ID);
		$this->db->update('tbl_tenants', $data);
		return $this->db->affected_rows();
	}

	public function deleteTenants($ID)
	{
		$this->db->where("id", $ID);
		$tenantsData =  array(
			'isActive' => '0',
			'createdOn' => date("Y-m-d H:i:s")
		);
		$this->db->update('tbl_tenants', $tenantsData);
		return $this->db->affected_rows();
	}
}
