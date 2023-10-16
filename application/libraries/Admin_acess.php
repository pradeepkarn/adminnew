<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_acess extends CI_Controller {
	protected $CI;
	 public function __construct(){
			$this->CI =& get_instance();
			$this->CI->load->library('session');
			if (!$this->CI->session->has_userdata('sess_admin_login') &&  !$this->CI->session->userdata('sess_admin_login') == 1) {
				$this->CI->session->set_flashdata('errmsg', $this->CI->lang->line('invalid_login'));
				redirect("/");
			}
        }
}
