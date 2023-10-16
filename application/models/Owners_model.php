<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Owners_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function search_data($keyword)
	{
		$this->db->select('*');
		$this->db->from('tbl_owners');
		$this->db->where('IsActive', '1');

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('fullName', $keyword); 
			$this->db->or_like('mobileNumber', $keyword);
			$this->db->group_end();
		}

		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}

	public function getAllOwners()
	{
		$this->db->select('*');
		$this->db->from('tbl_owners');
		$this->db->where('IsActive', '1');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOwnersById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_owners');
		$this->db->where('IsActive', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}




	public function insertOwners($data)
	{
		$this->db->insert('tbl_owners', $data);
		return $this->db->insert_id();
	}

	public function updateOwners($data, $ID)
	{
		//  print_r($data);die();
		$this->db->where("id", $ID);
		$this->db->update('tbl_owners', $data);
		return $this->db->affected_rows();
	}

	public function deleteOwners($ID)
	{
		$this->db->where("id", $ID);
		$ownersData =  array(
			'isActive' => '0',
			'createdOn' => date("Y-m-d H:i:s")
		);
		$this->db->update('tbl_owners', $ownersData);
		return $this->db->affected_rows();
	}
}
