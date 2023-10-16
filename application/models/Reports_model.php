<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reports_model extends CI_Model
{

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function getPendingInstallments($contractStatus=null)
    {
        $this->db->select(
            'tbl_installments.*, 
            tbl_contracts.contractNumber, 
            tbl_contracts.unitNumber, 
            tbl_contracts.tenantId,
            tbl_contracts.propertyId as cpropId,
            tbl_tenants.fullName as tenantName,
            tbl_tenants.mobileNumber as tenantMobile,
            tbl_properties.propertyName'
        );
        $this->db->from('tbl_installments');
        $this->db->join('tbl_contracts', 'tbl_contracts.contractNumber = tbl_installments.contractNumber');
        $this->db->join('tbl_properties', 'tbl_properties.id = tbl_contracts.propertyId');
        $this->db->join('tbl_tenants', 'tbl_tenants.id = tbl_contracts.tenantId');
        if ($contractStatus!='') {
            $this->db->where("tbl_installments.pendingAmount > 0 AND tbl_contracts.contractStatus=$contractStatus");
        }else{
            $this->db->where("tbl_installments.pendingAmount > 0");
        }
        
        $this->db->order_by('tbl_installments.id', 'DESC'); // Assuming 'id' is the correct column name
        $query = $this->db->get();
        return $query->result();
    }
    function contracts_list_expiring_in($days=30,$contractStatus=null)
    {
        $today = date('Y-m-d');
        $this->db->select(
            "tbl_installments.*, 
        tbl_contracts.contractNumber, 
        tbl_contracts.unitNumber, 
        tbl_contracts.expiryDate, 
        tbl_contracts.tenantId,
        tbl_contracts.propertyId as cpropId,
        tbl_tenants.fullName as tenantName,
        tbl_tenants.mobileNumber as tenantMobile,
        tbl_properties.propertyName,
        DATEDIFF(tbl_contracts.expiryDate,NOW()) as days_left"
        );
        $this->db->from('tbl_installments');
        $this->db->join('tbl_contracts', 'tbl_contracts.contractNumber = tbl_installments.contractNumber');
        $this->db->join('tbl_properties', 'tbl_properties.id = tbl_contracts.propertyId');
        $this->db->join('tbl_tenants', 'tbl_tenants.id = tbl_contracts.tenantId');

        // Use DATEDIFF to calculate the date difference in days
        if ($contractStatus!='') {
            $this->db->where("tbl_contracts.contractStatus=$contractStatus");
        }else{
            $this->db->where("(DATEDIFF(tbl_contracts.expiryDate,NOW()) <= $days) AND (DATEDIFF(tbl_contracts.expiryDate,NOW()) >= 0)");
        }
        $this->db->order_by('tbl_contracts.expiryDate', 'DESC'); // Assuming 'id' is the correct column name
        // echo $this->db->get_compiled_select();
        $query = $this->db->get();
        return $query->result();
    }
}
