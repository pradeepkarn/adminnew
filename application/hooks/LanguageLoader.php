<?php
class LanguageLoader
{

	function initialize()
	{

		$ci = &get_instance();

		$ci->load->helper('language');

		if ($ci->session->has_userdata('sess_user_slno')) {

			//	$ci->load->model('Request_model', 'requestModel');

		}


		$ln = $ci->session->userdata('ln');
		$language  = 'arabic';
		if (isset($ln) && $ln == 'ar') {
			$language  = 'arabic';
		} else if (isset($ln) && $ln == 'en') {
			$language  = 'english';
		}

		$ci->config->set_item('language', $language);
		$class = $ci->router->fetch_class();

		switch ($class) {


			case 'admin':
				$ci->lang->load(array('common', 'admin', 'login'), $language);
				break;
			default:
				$ci->lang->load(array('common', 'login'), $language);
		}

		//Access Permission
		$class_arr = $ci->config->item('all_classes_arr');
		$class_access = 0;

		// If permission check neeed to be enabled. Please uncomment below lines.
		// if (array_key_exists($class, $class_arr)) {
		// 	$class_val = $class_arr[$class];
		// 	if (array_key_exists($class_val, $ci->session->sess_user_users_permissions)) {
		// 		$class_access = $ci->session->sess_user_users_permissions[$class_val];
		// 		if ($class_access == 0) {
		// 			redirect('dashboard');
		// 		}
		// 	}
		// }
	}
}
