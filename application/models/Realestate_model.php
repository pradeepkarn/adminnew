<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Realestate_model extends CI_Model
{

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}
	public function search_data($keyword)
	{
		$this->db->select('*');
		$this->db->from('tbl_ad');
		$this->db->where('is_active', '1');

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('purpose', $keyword); 
			$this->db->or_like('title', $keyword);
			$this->db->or_like('district', $keyword);
			$this->db->or_like('city', $keyword);
			$this->db->or_like('site', $keyword);
			$this->db->group_end();
		}

		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();

		return $query->result();
	}
	public function getAllRealEstateOffers()
	{
		$this->db->select('*');
		$this->db->from('tbl_ad');
		$this->db->where('is_active', '1');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getUniqueValues() {
        $table_name = 'tbl_ad';
        
        // Define an array of column names you want to select.
        $columns = array('purpose', 'district', 'property_type');
        
        // Select the unique values from the specified columns.
        $this->db->distinct();
        $this->db->select($columns);
        $query = $this->db->get($table_name);
        
        // Check if the query was successful.
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
	public function search_offers($search)
	{
		// print_r($search);
		
		$this->db->select('*');
		$this->db->from('tbl_ad');
		$this->db->where('is_active', '1');

		if ($search['purpose']) {
			$this->db->where('purpose', $search['purpose']);
		}

		if ($search['property_type']) {
			$this->db->where('property_type', $search['property_type']);
		}

		if ($search['district']) {
			$this->db->where('district', $search['district']);
		}

		if ($search['start_price'] !== null && $search['end_price'] !== null) {
			$this->db->where('the_value >=', $search['start_price']);
			$this->db->where('the_value <=', $search['end_price']);
		} elseif ($search['start_price'] !== null) {
			$this->db->where('the_value >=', $search['start_price']);
		} elseif ($search['end_price'] !== null) {
			$this->db->where('the_value <=', $search['end_price']);
		}

		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function getOfferById($id)
	{
		$this->db->select('*');
		$this->db->from('tbl_ad');
		$this->db->where('is_active', '1');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function insertEstate($data)
	{
		$this->db->insert('tbl_ad', $data);
		return $this->db->insert_id();
	}

	public function updateOffer($data, $ID)
	{
		//  print_r($data);die();
		$this->db->where("id", $ID);
		$this->db->update('tbl_ad', $data);
		return $this->db->affected_rows();
	}
	function delete_offer($id)
	{
		$this->db->where("id", $id);
		$offersData =  array(
			'is_active' => '0',
			'created_on' => date("Y-m-d H:i:s")
		);
		$this->db->update('tbl_ad', $offersData);
		return $this->db->affected_rows();
	}
}
