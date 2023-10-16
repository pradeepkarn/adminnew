<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Permission_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	
	public function getAllPermission(){
		$this->db->select('ID, NameAr, NameEn, UsersManagement, CardsManagement, CopunsManagement, ProvidersManagement, MediaManagement, OffersManagement, WithdrawRequestsManagement, OffersRequestsManagement, MarketManagement, NotificationManagement, AdminManagement, Reviewer, Groups, Reviewwf, IsActive');	
		$this->db->from('tbl_permissions');
		$this->db->order_by('ID','ASC');
		$query = $this->db->get();		
		return $query->result();
		
	}
	
	public function getPermisionByID($ID){
		$this->db->select('ID, NameAr, NameEn, UsersManagement, CardsManagement, CopunsManagement, ProvidersManagement, MediaManagement, OffersManagement, WithdrawRequestsManagement, OffersRequestsManagement, MarketManagement, NotificationManagement, AdminManagement, Reviewer, Groups, Reviewwf, IsActive');	
		$this->db->from('tbl_permissions');
		$this->db->where('ID',$ID);
		$query = $this->db->get();		
		return $query->row();
	}
	
	// [[ =======  This is used to CREATE permission ======= ]]
	public function addPermission($data){
		$this->db->insert('tbl_permissions', $data);
        return $this->db->insert_id();

	}
	
	// [[ =======  This is used to UPDATE permission ======= ]]
	public function updatePermision($data,$ID){
        $this->db->where("ID", $ID);
        $this->db->update('tbl_permissions', $data);
        return $this->db->affected_rows();
	}
	
	
	
	public function checkduplicatePermission($data,$ID=''){
		
		$this->db->select('ID');
		$this->db->from('tbl_permissions');
		$this->db->where($data);
		if($ID){
			$this->db->where('ID<>',$ID);
		}
		$query = $this->db->get();	
		
		//echo $this->db->last_query(); die();	
		return $query->result();
		
	}
	
	
	
	// [[ =======  This is used to check permission is used in another table ======= ]]
	public function checkPermissionByID($ID){
		
		$this->db->select('ID');
		$this->db->from('tbl_portal_users');
		$this->db->where('PermissionID',$ID);
		$query = $this->db->get();		
		return $query->result();
		
	}
	
	
	// [[ =======  Used to delete the permission By ID ======= ]]	 
	public function deletePermissionByID($ID){
        $this->db->where("ID", $ID);
        $this->db->delete('tbl_permissions');
        return $this->db->affected_rows();
	}
	
	
	
	
	
	
}