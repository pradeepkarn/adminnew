<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_model extends CI_Model {
    

/* ************* get all data as where class *************** */	
	function getWhere($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->result();
		if($get){
			return $get;
		}else{
			return FALSE;
		}
	}

/* ************* add  data *************** */
	function insert_data($table,$data)
	{ 
	
     	$this->db->insert($table,$data);
		$num = $this->db->insert_id();
		
			return $num;
	
	}
	
/* ************* update  data *************** */	
	function update_data($table,$where,$data)
	{
		 $this->db->where($where);
	     $update = $this->db->update($table,$data);
		
			if($update)
			{ 
				return TRUE;
			}
			else
			{ 
				return FALSE;
			}
	}
    
	function update_data_all($table,$data)
	{
	     $update = $this->db->update($table,$data);
		
			if($update)
			{ 
				return TRUE;
			}
			else
			{ 
				return FALSE;
			}
	}

	function getSingle($table,$where)
	{
		$this->db->where($where);
		$data = $this->db->get($table);
		$get = $data->row();
	   
		$num = $data->num_rows();
		
		if($num){
			return $get;
		}
		else
		{
			return false;
		}
	}
    
	function getSingleFromLast($table,$where)
	{
		$this->db->where($where);
		
		$this->db->order_by('id', 'desc');

		$data = $this->db->get($table);
		$get = $data->row();
	   
		$num = $data->num_rows();
		
		if($num){
			return $get;
		}
		else
		{
			return false;
		}
	}

}
?>
