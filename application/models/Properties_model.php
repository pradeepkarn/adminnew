<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Properties_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}

	public function search_data($keyword)
	{
		$this->db->select('*,tbl_properties.id as pId');
		$this->db->from('tbl_properties');
		$this->db->join('tbl_owners', 'tbl_properties.ownerId=tbl_owners.id');
		$this->db->where('tbl_properties.IsActive', '1');
		$this->db->where('tbl_owners.IsActive', '1');
		$this->db->order_by('tbl_properties.id', 'ASC');

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('tbl_properties.propertyName', $keyword); 
			$this->db->or_like('tbl_owners.fullName', $keyword); 
			// Add more 'like' conditions for other columns as needed
			$this->db->group_end();
		}

		$query = $this->db->get();

		return $query->result();
	}

	public function getAllProperties()
	{
		$this->db->select('*,tbl_properties.id as pId');
		$this->db->from('tbl_properties');
		$this->db->join('tbl_owners', 'tbl_properties.ownerId=tbl_owners.id');
		$this->db->where('tbl_properties.IsActive', '1');
		$this->db->where('tbl_owners.IsActive', '1');
		$this->db->order_by('tbl_properties.id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPropertiesById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_properties');
		$this->db->where('IsActive', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}




	public function insertProperties($data)
	{



		$this->db->insert('tbl_properties', $data);
		$propertyId = $this->db->insert_id();
		for ($i = 1; $i <= $data['residentialUnits']; $i++) {
			$unitName = 'R' . $i;
			$unitData =  array(
				'propertyId' => $propertyId,
				'unitName' => $unitName,
				'unitType' => 1
			);
			$this->db->insert('tbl_units', $unitData);
		}

		for ($i = 1; $i <= $data['commercialUnits']; $i++) {
			$unitName = 'C' . $i;
			$unitData =  array(
				'propertyId' => $propertyId,
				'unitName' => $unitName,
				'unitType' => 2
			);
			$this->db->insert('tbl_units', $unitData);
		}
		return $propertyId;
	}

	public function updateProperties($data, $ID)
	{

		$this->db->where("id", $ID);
		$this->db->update('tbl_properties', $data);

		return $this->db->affected_rows();
	}

	public function deleteProperties($ID)
	{
		$this->db->where("id", $ID);
		$propertiesData =  array(
			'isActive' => '0',
			'createdOn' => date("Y-m-d H:i:s")
		);
		$this->db->update('tbl_properties', $propertiesData);
		return $this->db->affected_rows();
	}
}
