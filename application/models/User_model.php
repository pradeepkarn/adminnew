<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{



	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
	}


	public function search_data($keyword)
	{

		$this->db->select('tbl_portal_users.ID, tbl_portal_users.FirstName, 
        tbl_portal_users.LastName, tbl_portal_users.IDNumber, tbl_portal_users.Email, 
        tbl_portal_users.Mobile, tbl_portal_users.SEX, tbl_portal_users.Password, 
        tbl_portal_users.PermissionID, tbl_portal_users.IsActive, tbl_permissions.NameEn, 
        tbl_permissions.NameAr, admin_group.name_ar as admin_group_ar,
        admin_group.name_en as admin_group_en, admin_group.id as admin_group_id');
		$this->db->from('tbl_portal_users');
		$this->db->join('tbl_permissions', 'tbl_portal_users.PermissionID = tbl_permissions.ID', 'left');
		$this->db->join('admin_group', 'tbl_portal_users.admin_group = admin_group.id', 'left');
		$this->db->order_by('ID', 'ASC');

		if (!empty($keyword)) {
			$this->db->group_start();
			$this->db->like('tbl_portal_users.FirstName', $keyword);
			$this->db->or_like('tbl_portal_users.LastName', $keyword);
			$this->db->or_like('tbl_portal_users.IDNumber', $keyword);
			$this->db->or_like('tbl_portal_users.Email', $keyword);
			$this->db->or_like('tbl_portal_users.Mobile', $keyword);
			$this->db->or_like('tbl_permissions.NameEn', $keyword);
			$this->db->or_like('tbl_permissions.NameAr', $keyword);
			$this->db->or_like('admin_group.name_ar', $keyword);
			$this->db->or_like('admin_group.name_en', $keyword);
			$this->db->group_end();
		}

		$query = $this->db->get();

		return $query->result();
	}

	// [[ =======  This is used to load all Portal Users ======= ]]
	public function getUsersList()
	{
		$this->db->select('tbl_portal_users.ID, tbl_portal_users.FirstName, 
		tbl_portal_users.LastName, tbl_portal_users.IDNumber, tbl_portal_users.Email, 
		tbl_portal_users.Mobile, tbl_portal_users.SEX, tbl_portal_users.Password, 
		tbl_portal_users.PermissionID, tbl_portal_users.IsActive, tbl_permissions.NameEn, 
		tbl_permissions.NameAr, admin_group.name_ar as admin_group_ar,
		admin_group.name_en as admin_group_en, admin_group.id as admin_group_id');
		$this->db->from('tbl_portal_users');
		$this->db->join('tbl_permissions', 'tbl_portal_users.PermissionID = tbl_permissions.ID', 'left');
		$this->db->join('admin_group', 'tbl_portal_users.admin_group = admin_group.id', 'left');
		$this->db->order_by('ID', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// [[ =======  This is used to load all active permission in ADD/EDIT Portal Permision ======= ]]
	public function getPermission()
	{
		$this->db->select('ID,NameAr,NameEn');
		$this->db->from('tbl_permissions');
		$this->db->where('IsActive', '1');
		$this->db->order_by('ID', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	// [[ =======  This is used to load all active admin auth group ======= ]]
	public function getAdminGroups()
	{
		$this->db->select('*');
		$this->db->from('admin_group');
		$this->db->where('is_active', '1');
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function getAdminGroupByGroupId($id)
	{
		$this->db->select('*');
		$this->db->from('admin_group');
		$this->db->where('is_active', '1');
		$this->db->where('admin_group,id', $id);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		return $query->row();
	}

	// [[ =======  This is used to CREATE Portal User By ID ======= ]]
	public function getUserById($ID)
	{
		$this->db->select('tbl_portal_users.ID, tbl_portal_users.FirstName, 
		tbl_portal_users.LastName, tbl_portal_users.IDNumber, 
		tbl_portal_users.Email, tbl_portal_users.Mobile, 
		tbl_portal_users.SEX, tbl_portal_users.Password, 
		tbl_portal_users.PermissionID, 
		tbl_portal_users.IsActive, admin_group.name_ar as admin_group_ar, 
		admin_group.id as admin_group_id, admin_group.name_en as admin_group_en');
		$this->db->from('tbl_portal_users');
		$this->db->join('admin_group', 'tbl_portal_users.admin_group = admin_group.id', 'left');
		$this->db->where('tbl_portal_users.ID', $ID);
		$this->db->order_by('ID', 'ASC');
		$query = $this->db->get();
		return $query->row();
	}

	// [[ =======  This is used to CREATE Portal User ======= ]]
	public function addUser($data)
	{
		$this->db->insert('tbl_portal_users', $data);
		return $this->db->insert_id();
	}

	// [[ =======  This is used to UPDATE Portal User ======= ]]
	public function updateUser($data, $ID)
	{
		$this->db->where("ID", $ID);
		$this->db->update('tbl_portal_users', $data);
		return $this->db->affected_rows();
	}



	// [[ =======  Used to delete the Portal User By ID ======= ]]	 
	public function deleteUsernByID($ID)
	{
		$this->db->where("ID", $ID);
		$this->db->delete('tbl_portal_users');
		return $this->db->affected_rows();
	}

	//  =======  This is get All Managers ------------
	public function getAllManager()
	{
		$this->db->select('b.FirstName,b.ID as managerid');
		$this->db->from('tbl_permissions as a');
		$this->db->join('tbl_portal_users as b', 'a.ID = b.permissionID', 'left');
		$this->db->where('a.NameEn', 'Account Manager');
		$this->db->where('a.IsActive', '1');
		$this->db->where('b.IsActive', '1');
		$this->db->order_by('b.ID', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// [[ =======  This is used to load mapping between manager and supervisor ]]
	public function getMappingList()
	{
		$this->db->select('a.ID as mappingid,b.FirstName as managername,c.FirstName as supervisorname');
		$this->db->from('tbl_managersupervisor as a');
		$this->db->join('tbl_portal_users as b', 'b.ID = a.managerID', 'left');
		$this->db->join('tbl_portal_users as c', 'c.ID = a.supervisorID', 'left');
		$this->db->order_by('a.ID', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// [[ =======  This is get All Manager without supervisor------------
	public function getManagerwithoutsupervisor()
	{

		$sql = "select b.FirstName,b.ID as managerid from tbl_permissions a, tbl_portal_users b where a.NameEn='Account Manager' and a.ID=b.PermissionID and b.ID not in(select c.managerID from tbl_managersupervisor c where IsActive='1')";
		$query = $this->db->query($sql);
		return $query->result();
	}


	//----------------- Get manager with mapping id --------------------
	public function getManager($id)
	{

		$this->db->select('b.FirstName,b.ID as managerid,c.FirstName as supervisorname,c.ID as supervisorid');
		$this->db->from('tbl_managersupervisor as a');
		$this->db->join('tbl_portal_users as b', 'a.managerID = b.ID', 'left');
		$this->db->join('tbl_portal_users as c', 'a.supervisorID = c.ID', 'left');
		$this->db->where('a.IsActive', '1');
		$this->db->where('a.ID', $id);
		$this->db->where('b.IsActive', '1');
		//$this->db->where('c.IsActive','1');

		$query = $this->db->get();
		return $query->result();
	}


	// [[ =======  This is get All Supervisor ------------
	public function getAllSupervisor()
	{
		$this->db->select('b.FirstName,b.ID as supervisorid');
		$this->db->from('tbl_permissions as a');
		$this->db->join('tbl_portal_users as b', 'a.ID = b.permissionID', 'left');
		$this->db->where('a.NameEn', 'Account Manager Supervisor');
		$this->db->where('a.IsActive', '1');
		$this->db->where('b.IsActive', '1');
		$this->db->order_by('b.ID', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// [[ =======  This is used to CREATE New Mapping ======= ]]
	public function addmappinginfo($data)
	{
		$this->db->insert('tbl_managersupervisor', $data);
		return $this->db->insert_id();
	}

	// [[ =======  This is used to UPDATE Mapping ======= ]]
	public function updatemapping($data, $ID)
	{
		$this->db->where("ID", $ID);
		$this->db->update('tbl_managersupervisor', $data);
		return $this->db->affected_rows();
	}

	// [[ =======  Used to delete Mappig By ID ======= ]]	 
	public function deleteMapping($ID)
	{
		$this->db->where("ID", $ID);
		$this->db->delete('tbl_managersupervisor');
		return $this->db->affected_rows();
	}
}
