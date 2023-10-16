<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		
    }
	
	// [[ =======  Validate the given user credentials ======= ]]
	public function validate_login($user_email,$user_pwd,$remember_me){
		
		$this->db->select('tpu.ID, tpu.FirstName, tpu.LastName, tpu.IDNumber, tpu.Email, tpu.Mobile, 
		tpu.SEX, tpu.Password, tpu.PermissionID, tpu.IsActive, tp.NameAr, tp.NameEn, tp.UsersManagement, 
		tp.CardsManagement, tp.CopunsManagement, tp.ProvidersManagement, tp.MediaManagement, 
		tp.OffersManagement, tp.WithdrawRequestsManagement, tp.OffersRequestsManagement, tp.MarketManagement, 
		tp.NotificationManagement, tp.AdminManagement, tp.Reviewer,tp.Groups,tp.Reviewwf, 
		ag.id as ag_id, ag.can_create, ag.can_read, ag.can_update, ag.can_delete, ag.can_analytics_view as view_stats, ag.ad_offer');
		$this->db->from('tbl_portal_users AS tpu');
		$this->db->join('tbl_permissions AS tp','tpu.PermissionID = tp.ID');
		$this->db->join('admin_group AS ag','tpu.admin_group = ag.id');
		$this->db->where(array('tpu.Email' => $user_email, 'tpu.IsActive' => 1));
        $query = $this->db->get();
		
		if($query->num_rows() > 0 ){
			$row = $query->row();
			if($row->Password == $user_pwd){
				
				$this->session->set_userdata('sess_user_slno',$row->ID);
				$this->session->set_userdata('sess_user_name',ucfirst($row->FirstName) . ' ' .  $row->LastName);
				$this->session->set_userdata('sess_user_email',$row->Email);
				$this->session->set_userdata('sess_user_per_ar', $row->NameAr);
				$this->session->set_userdata('sess_user_per_en', $row->NameEn);
				$this->session->set_userdata('sess_admin_login',1);
				$this->session->set_userdata('sess_user_permission_id',$row->PermissionID);
				$this->session->set_userdata('ag_id',$row->ag_id);
				$this->session->set_userdata('ag_can_create',$row->can_create);
				$this->session->set_userdata('ag_can_update',$row->can_update);
				$this->session->set_userdata('ag_can_delete',$row->can_delete);
				$this->session->set_userdata('ag_can_read',$row->can_read);
				$this->session->set_userdata('ag_view_stats',$row->view_stats);
				$this->session->set_userdata('ad_offer',$row->ad_offer);

				$user_permission_arr = array('UsersManagement' => $row->UsersManagement,
											 'CardsManagement' => $row->CardsManagement,
											 'CopunsManagement' => $row->CopunsManagement,
											 'ProvidersManagement' => $row->ProvidersManagement,
											 'MediaManagement' => $row->MediaManagement,
											 'OffersManagement' => $row->OffersManagement,
											 'WithdrawRequestsManagement' => $row->WithdrawRequestsManagement,
											 'OffersRequestsManagement' => $row->OffersRequestsManagement,
											 'MarketManagement' => $row->MarketManagement,
											 'NotificationManagement' => $row->NotificationManagement,
											 'AdminManagement' => $row->AdminManagement,
											 'Reviewer' => $row->Reviewer,
											 'Groups' => $row->Groups,
											 'Reviewwf' => $row->Reviewwf
											 );
				
				$this->session->set_userdata('sess_user_users_permissions', $user_permission_arr);
																
				if($remember_me){
					setcookie('ttttt', md5($row->Email . $row->Password)  , time() + (86400 * 30), "/");
					setcookie('uuuuu', $row->Email, time() + (86400 * 30), "/");	
				}
				
				return true;
			}else{
				return false;	
			}
		}else{
			return false;	
		}
	}
	
	
	public function rememberme(){
		
		$user_email = $_COOKIE['uuuuu'];
		$user_pwd = $_COOKIE['ttttt'];
		$this->db->select("tpu.ID, tpu.FirstName, tpu.LastName, tpu.IDNumber, md5(CONCAT_WS('',tpu.Email,tpu.Password)) as user_pwd, tpu.Email, tpu.Mobile, tpu.SEX, tpu.Password, tpu.PermissionID, tpu.IsActive, tp.NameAr, tp.NameEn, tp.UsersManagement, tp.CardsManagement, tp.CopunsManagement, tp.ProvidersManagement, tp.MediaManagement, tp.OffersManagement, tp.WithdrawRequestsManagement, tp.OffersRequestsManagement, tp.MarketManagement, tp.NotificationManagement, tp.AdminManagement, tp.Reviewer, tp.Groups, tp.Reviewwf");
		$this->db->from('tbl_portal_users AS tpu');
		$this->db->join('tbl_permissions AS tp','tpu.PermissionID = tp.ID');
		$this->db->where(array('tpu.Email' => $user_email, 'tpu.IsActive' => 1));
        $query = $this->db->get();
		
		if($query->num_rows() > 0 ){
			$row = $query->row();
			if($row->user_pwd == $user_pwd){
				
				$this->session->set_userdata('sess_user_slno',$row->ID);
				$this->session->set_userdata('sess_user_name',ucfirst($row->FirstName) . ' ' .  $row->LastName);
				$this->session->set_userdata('sess_user_email',$row->Email);
				$this->session->set_userdata('sess_user_per_ar', $row->NameAr);
				$this->session->set_userdata('sess_user_per_en', $row->NameEn);
				$this->session->set_userdata('sess_admin_login',1);
				$user_permission_arr = array('UsersManagement' => $row->UsersManagement,
											 'CardsManagement' => $row->CardsManagement,
											 'CopunsManagement' => $row->CopunsManagement,
											 'ProvidersManagement' => $row->ProvidersManagement,
											 'MediaManagement' => $row->MediaManagement,
											 'OffersManagement' => $row->OffersManagement,
											 'WithdrawRequestsManagement' => $row->WithdrawRequestsManagement,
											 'OffersRequestsManagement' => $row->OffersRequestsManagement,
											 'MarketManagement' => $row->MarketManagement,
											 'NotificationManagement' => $row->NotificationManagement,
											 'AdminManagement' => $row->AdminManagement,
											 'Reviewer' => $row->Reviewer,
											  'Groups' => $row->Groups,
											 'Reviewwf' => $row->Reviewwf);
				
				$this->session->set_userdata('sess_user_users_permissions', $user_permission_arr);
				
				return true;
			}
		}else{
			return false;	
		}
		
		
	}
	
	// [[ =======  Get details of user by email ======= ]]
	public function getAdminUserDetailsByEmail($adminemail){
		$this->db->select('CONCAT_WS(" ", FirstName, LastName) AS UserName, Email');
		$this->db->from('tbl_portal_users');
		$this->db->where(array('Email' => $adminemail, 'IsActive' => 1));		
		$query = $this->db->get();		
		return $query->row();
	}
	
}