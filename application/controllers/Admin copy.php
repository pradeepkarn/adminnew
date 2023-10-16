<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->lang->load('login','arabic');
		// [[ =======  this is used to load model to use db ======= ]]	
		$this->load->model('Admin_model', 'adminModel');
		$this->load->model('User_model', 'userModel');
	}
	// [[ =======  default this is called ======= ]]	 
	public function index()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		// [[ ======= if the user is already login ======= ]]	
		// [[ ======= and goes back to login screen this will redirect to dashboard ======= ]]
		$this->load->library('Redirect_access');

		// [[ =======  Load view directly ======= ]]
		$this->load->view('admin/login', $data);
	}


	// [[ ======= this is used to login the user ======= ]]	
	public function login()
	{

		$result = array();

		$this->form_validation->set_rules('user_email', "UserName", 'trim|required|callback__validate_login');
		$this->form_validation->set_rules('user_pwd', 'Password', 'trim|required');
		$this->form_validation->set_error_delimiters('<p style="color:#C91F1F">', '</p>');
		if ($this->form_validation->run() == FALSE) {
			$result[] = array('resSuccess' => 2, 'msg' => 'Error', 'errtype' => 'Validation', 'arrError' => validation_errors());
			echo json_encode($result);
			exit();
		} else {
			$result[] = array('resSuccess' => 1, 'msg' => 'Success');
			echo json_encode($result);
			exit();
		}
	}




	// [[ ======= this is used to when user has checked remember me login the user ======= ]]	
	public function rememberme()
	{

		$res = $this->adminModel->rememberme();
		if ($res) {
			redirect('dashboard');
		} else {
			$this->session->set_flashdata('errmsg', $this->lang->line('invalid_login'));
			redirect('/');
		}
	}





	// [[ ======= calback function to validate login ======= ]]	
	public function _validate_login()
	{

		$user_email = trim($this->input->post("user_email"));
		$user_pwd = trim($this->input->post("user_pwd"));
		$remember_me = $this->input->post("remember_me");
		$remember_me = !empty($remember_me) ? '1' : '0';
		if ($user_pwd == "") {
			return true;
		}

		if ($user_email != "" && $user_pwd != "") {
			if ($this->adminModel->validate_login($user_email, $user_pwd, $remember_me)) {
				return true;
			} else {
				$this->form_validation->set_message('_validate_login', $this->lang->line('invalid_login'));
				return false;
			}
		}
	}



	// [[ ======= this is the dashboard page ======= ]]	
	public function dashboard()
	{
		//echo date('y-m-d H:i:s', strtotime('2020-01-08T07:18:52.189Z'));die();
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer', $data);
	}

	//=== Completed user graph


	//=== Number of withdrawal requests
	public function rentrequest()
	{
		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->getRentRequests($filter);

		$datagraph['stat'][] = "Total Collection";
		$datagraph['cnt'][] = $dgraph[0]->stat;
		$datagraph['bgcolor'][] = "#ffca00";
		$datagraph['stat'][] = "Total Rent";
		$datagraph['cnt'][] = $dgraph[0]->cnt;
		$datagraph['bgcolor'][] = "#ff4d6b";


		if ($datagraph) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}

	public function ownersDuesrequest()
	{
		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->getOwnersDuesRequests($filter);

		$datagraph1['stat'][] = "Unpaid Owners Due";
		$datagraph1['cnt'][] = $dgraph[0]->stat;
		$datagraph1['bgcolor'][] = "#123456";
		$datagraph1['stat'][] = "Paid Owners Due";
		$datagraph1['cnt'][] = $dgraph[0]->cnt;
		$datagraph1['bgcolor'][] = "#97cbff";


		if ($datagraph1) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph1);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}

	public function incomerequest()
	{
		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->getIncomeRequests($filter);

		$datagraph['stat'][] = "Agency Fee";
		$datagraph['cnt'][] = $dgraph[0]->stat;
		$datagraph['bgcolor'][] = "#789de7";
		$datagraph['stat'][] = "Management Fee";
		$datagraph['cnt'][] = $dgraph[0]->cnt;
		$datagraph['bgcolor'][] = "#f0d887";


		if ($datagraph) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}
	public function contract_stats()
	{
		$filter = isset($_GET['filter']) ? strval($_GET['filter']) : null;
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->contract_stats($filter);

		$stat = [];
		$cnt = [];

		foreach ($dgraph as $item) {
			$stat[] = $item['stat'];
			$cnt[] = $item['cnt'];
		}

		$datagraph['stat'][] = "Timeline";
		$datagraph['cnt'][] = $stat;
		$datagraph['bgcolor'][] = "#789de7";
		$datagraph['stat'][] = "Contracts created";
		$datagraph['cnt'][] = $cnt;
		$datagraph['bgcolor'][] = "#f0d887";

		if ($datagraph) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}

	public function unitsrequest()
	{

		// $filter = isset($_GET['filter'])?strval($_GET['filter']):null;
		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->getUnitsRequests();

		$datagraph['stat'][] = $this->lang->line('OCCUPIED_UNITS');
		$datagraph['cnt'][] = $dgraph[0]->stat;
		$datagraph['bgcolor'][] = "#567345";
		$datagraph['stat'][] = $this->lang->line('VACANT_UNITS');
		$datagraph['cnt'][] = $dgraph[0]->cnt;
		$datagraph['bgcolor'][] = "#946456";

		if ($datagraph) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}


	public function contractStatus()
	{

		$this->load->library('Admin_acess'); // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->model('Dashboard_model', 'dashboardModel');

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'dashboard';

		$dgraph = $this->dashboardModel->getContractStatusRequests();
		$datagraph['stat'][] =  $this->lang->line('ACTIVE');
		$datagraph['cnt'][] = $dgraph[0]->stat;
		$datagraph['bgcolor'][] = "#dda792";
		$datagraph['stat'][] = $this->lang->line('INACTIVE');
		$datagraph['cnt'][] = $dgraph[0]->cnt;
		$datagraph['bgcolor'][] = "#929edd";
		$datagraph['stat'][] = $this->lang->line('SUSPENDED');
		$datagraph['cnt'][] = $dgraph[0]->suspended;
		$datagraph['bgcolor'][] = "#949523";

		if ($datagraph) {

			$result[] = array('resSuccess' => 1, 'msg' => 'Success', 'wdrequest' => $datagraph);
			echo json_encode($result);
			exit();
		} else {

			$result[] = array('resSuccess' => 2, 'msg' => 'Sorry unable to display');
			echo json_encode($result);
			exit();
		}
	}



	public function forgot()
	{

		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';

		// [[ ======= Load view directly ======= ]]
		$this->load->view('admin/forgot', $data);
	}


	// [[ ======= this function logout the users =======]]
	public function logout()
	{
		setcookie('ttttt', '', time() - 3600, '/');  // [[ ======= This wille expire the cookies =======]]
		setcookie('uuuuu', '', time() - 3600, '/');  // [[ ======= This wille expire the cookies =======]]
		$this->session->sess_destroy();
		redirect('/');
	}

	// [[ ======= Send mail to forgot password =======]] 
	public function sendForgotPwd()
	{

		$result = array();
		$posted_email = $this->input->post('user_email');
		$admindata["User"] = $this->adminModel->getAdminUserDetailsByEmail(trim($posted_email));

		if (!empty($admindata["User"]->Email)) {

			$resetpwd = $this->createGenerateCode(6, 0);
			//$resetpwd = $this->encryption->encrypt($resetpwd);			
			$data = array("Password" => $resetpwd);

			$this->load->model('forgot_model', 'forgotModel');
			if ($this->forgotModel->resetForgotPassword($posted_email, $data)) {

				$mail_subject = $this->lang->line('forgot_password2');
				$from_email = "";
				$to_email = $posted_email;

				$msg_heading = $this->lang->line('forgot_password2');
				$msg_content = "";
				$msg_content .= $this->lang->line('dear') . " " . $admindata["User"]->UserName . ", <br /><br />";
				$msg_content .= $this->lang->line('your_login_credentials') . ":<br /><br />";
				$msg_content .= $this->lang->line('email') . ": " . $admindata["User"]->Email . "<br />";
				$msg_content .= $this->lang->line('reset_password') . ": " . $resetpwd . "<br /><br />";

				//=== Send Email				
				$this->sendEmail($mail_subject, $from_email, $to_email, $msg_heading, $msg_content);

				$result[] = array('resSuccess' => 1, 'msg' => 'Success');
				echo json_encode($result);
				exit();
			} else {
				$result[] = array('resSuccess' => 2, 'errtype' => 'Validation', 'arrError' => $this->lang->line('error'));
				echo json_encode($result);
				exit();
			}
		} else {
			$result[] = array('resSuccess' => 2, 'errtype' => 'Validation', 'arrError' => $this->lang->line('username_not_recognised'));
			echo json_encode($result);
			exit();
		}
	}

	// [[ ======= Generate Code to reset forgot password =======]] 
	public function createGenerateCode($string_length, $cnt_str)
	{

		$random_string = array();
		//$character_set = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$character_set = '1234567890';

		for ($i = 1; $i <= $string_length; $i++) {
			$rand_character = $character_set[rand(0, strlen($character_set) - 1)];
			$random_string[] = $rand_character;
		}
		shuffle($random_string);
		$final_code = implode('', $random_string);
		return $final_code;
	}

	// [[ ======= Common Email function to call where mailing is required =======]] 
	public function sendEmail($mailsubject, $fromemail, $toemail, $msg_heading, $msgcontent)
	{

		//$fromemail = $this->config->item('support_from_email');
		$fromemail = 'mohimeedai@gmail.com';

		$from_email = trim($fromemail);
		$to_email = trim($toemail);

		$message_content = $msgcontent;
		$image_path = base_url('assets/images/');
		$data = array('msgHeading' => $msg_heading, 'userMessage' => $message_content, 'projectName' => $this->lang->line('project_name'), 'imagePath' => $image_path, 'thankYou' => $this->lang->line('thank_you'), 'langType' => $this->session->userdata('ln'));

		$msg_body = $this->load->view('email_template/common_email.php', $data, TRUE);

		$config = array(
			'mailpath' => '/usr/sbin/sendmail',
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.gmail.com',
			'smtp_port' => 465,
			'smtp_user' => 'mohimeedai@gmail.com',
			'smtp_pass' => '',
			'smtp_crypto' => 'ssl',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->set_mailtype("html");
		$this->email->from($from_email, $this->lang->line('project_name'));
		$this->email->to($to_email);
		$this->email->subject($mailsubject . ': ' . date('d-m-Y h:i:s') . ' ' . $this->lang->line('project_name'));
		$this->email->message($msg_body);

		//Send mail 
		$this->email->send();

		return 1;
	}
	// webartvision
	public function addUsers()
	{
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
		$data['menu'] = 'users';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/add_users', $data);
		$this->load->view('admin/footer', $data);
	}
}
