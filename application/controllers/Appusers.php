<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appusers extends CI_Controller {
	
	  public function __construct() {
        parent::__construct();
		
		$this->load->model('AppUser_model', 'appuserModel'); 	  // [[ =======  this is used to load model to use db ======= ]]
		$this->load->library('Admin_acess');			 // [[ ======= this will restrict direct access to users who are not logged in ======= ]]
		$this->load->helper('image_helper'); // this will load Image helper to view image		
	  }
	
	
	// [[ =======  this is used to load all the app user ======= ]]
	public function appuserlist(){
		
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln'])?$data['ln']:'ar';
		
		$data['menu'] = 'appusers';
		$data['users'] = $this->appuserModel->getAppUsersList(); // [[ ======= this will fetch all the records from tbl_portal_users  ======= ]]	
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header',$data);
		$this->load->view('admin/appusers',$data);
		$this->load->view('admin/footer',$data);
		
	}
	
	// [[ =======  this is used to load Add App User ======= ]]
	public function addappuser(){
		
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln'])?$data['ln']:'ar';
		$data['menu'] = 'appusers';
		
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header',$data);
		$this->load->view('admin/add_appuser',$data);
		$this->load->view('admin/footer',$data);
		
	}
	
	// [[ =======  this is used to load Edit App User ======= ]]
	public function editappuser(){ 
		
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln'])?$data['ln']:'ar';
		
		$data['menu'] = 'appusers';
		$data['ID'] = $this->uri->segment('2');
		$data['appuser'] = $this->appuserModel->getAppUserById($data['ID']);// [[ ======= Load user details by ID ======= ]]
	
		// [[ ======= Load view along with hearder and footer ======= ]]
		$this->load->view('admin/header',$data);
		$this->load->view('admin/add_appuser',$data);
		$this->load->view('admin/footer',$data);
		
	}
		
	
	
	// [[ =======  this is used to load Add Edit App User ======= ]]
	public function saveappuser(){
		
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln'])?$data['ln']:'ar';
		$data['menu'] = 'appusers';
		$result = array();
		
		$this->db->trans_strict(TRUE);	// [[ =======  Set The transctional statement to strict if set to false ======= ]]
		$this->db->trans_begin();	// [[ =======  Begin The transctional statement ======= ]]
		
		$FirstName = $this->input->post('FirstName',TRUE);
		$SecondName = $this->input->post('SecondName',TRUE);
		$ThirdName = $this->input->post('ThirdName',TRUE);
		$LastName = $this->input->post('LastName',TRUE);
		$IDNumber = $this->input->post('IDNumber',TRUE);
		$Email = $this->input->post('Email',TRUE);
		$Mobile = $this->input->post('Mobile',TRUE);
		$Age = $this->input->post('Age',TRUE);
		$SEX = $this->input->post('SEX',TRUE);
		$Password = $this->input->post('Password',TRUE);

	


		$IsActive = $this->input->post('IsActive',TRUE);
		$recid = $this->input->post('recid',TRUE);
		$task = $this->input->post('task',TRUE);

		// [[ =======  Check ID Number is not duplicate ======= ]]
		$res_dup_idnum = $this->appuserModel->checkduplicate(array('IDNumber' => $IDNumber),$recid);
		if(!empty($res_dup_idnum)){
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('id_number_cannot_be_duplicate'));
			echo json_encode($result);			
			exit();
		}
		
		
		$data = array('FirstName' => $FirstName,
					  'SecondName' => $SecondName,
					  'ThirdName' => $ThirdName,	
					  'LastName' => $LastName,
					  'IDNumber' => $IDNumber,
					  'Email' => $Email,
					  'Mobile' => $Mobile,
					  'Age' => $Age,
					  'SEX' => $SEX,
					  'Password' => $Password,
					  
					  'IsActive' => !empty($IsActive)?'1':'0');
					  
		
		// [[ =======  If task is one perform Insert else perform update ======= ]]
		if($task == 1){
			
			$insert_id = $this->appuserModel->addAppUser($data);  // [[ ======= Returns the last generated id ======= ]]
			$card_ren_num = mt_rand(10000000, 99999999); // [[ ======= Generate 8 digit random number ======= ]]
			$CardNumber = 1011 . str_pad($insert_id, 4, "0", STR_PAD_LEFT) . $card_ren_num; // [[ ======= Generate 16 digit card number ======= ]]
			$CardCreatedDate = date('Y-m-d');
			$CardExpirationDate = date('Y-m-d',strtotime('+1 year')); // [[ ======= Calculate expiery date from current date ======= ]]
			
			$rasid_cards = array('CardNumber' => $CardNumber,
								 'CardType' => 1,
								 'UserID' => $insert_id,
								 'CardCreatedDate' => $CardCreatedDate,
								 'CardExpirationDate' => $CardExpirationDate,
								 'CouponID' => NULL,
								 'IsActive' => 1);
			
			// [[ =======  Isert one recort to tbl rasid ======= ]]
			$this->appuserModel->addRasidCrad($rasid_cards); 
			
		}else{
			$insert_id = $this->appuserModel->updateAppUser($data,$recid);
		}
		
		
		if($this->db->trans_status() === TRUE){
			$this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('app_user_saved_successfully'));
			echo json_encode($result);
			exit();				
			
		}else{
			 $this->db->trans_rollback(); // [[ =======  Rollback all the transaction if any fails ======= ]]
			$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('unable_to_save_app_user'));
			echo json_encode($result);			
			exit();
		}
		
			
		
	}
	
	// [[ =======  this is used to Delete Portal User ======= ]]
	public function deleteappuser(){
		$data['ln'] = $this->session->userdata('ln');
		$data['ln'] = !empty($data['ln'])?$data['ln']:'ar';
		$data['menu'] = 'appusers';
		$data['ID'] = $this->uri->segment(2);
		if(!empty($data['ID'])){
				$res_del = $this->appuserModel->updateAppUser(array('IsActive'=>'0'),$data['ID']);
				if(empty($res_del)){
					$this->session->set_flashdata('erruser', $this->lang->line('app_user_cannot_be_deleted'));
					redirect('appusers');
				}else{
					$this->session->set_flashdata('successuser', $this->lang->line('app_user_deleted_successfully'));
					redirect('appusers');
				}

		}else{
				$this->session->set_flashdata('erruser',$this->lang->line('app_user_not_found'));
				redirect('users');
		}
	}
	
	
	public function viewcarddetails(){
		$data['ID'] = $this->input->get('ID',TRUE);
		$data['carddetails'] = $this->appuserModel->getRasidCradByID($data['ID']);
		print $this->load->view('admin/carddetails',$data,TRUE);
		
	}
	
	
	public function uploadexcel(){
		
			$result = array();
			$this->load->library('excel'); // [[ =======  Use this library to import php excel class as an when required  ======= ]]
			$data['IDNUMBERS'] = $this->appuserModel->getAllIdNumbers(); // [[ =======  get all the Id Numbers from database to check duplicate  ======= ]]
			$db_idnumbers = array();
			foreach($data['IDNUMBERS'] as $key => $value){
				$db_idnumbers[] = $value->IDNumber;
			}
		
			//move_uploaded_file($_FILES['userexcel']['tmp_name'], "./assets/appuser_excel/");
			$userexcel = time().'-'.$_FILES["userexcel"]['name'];
			$config['upload_path'] = './assets/appuser_excel/';
			$config['allowed_types'] = 'xlsx|xls';
			$config['file_name'] = $userexcel;
			$this->load->library('upload', $config);

			if (!$this->upload->do_upload('userexcel')){
					$result[] = array('resSuccess' => 2, 'msg' =>  $this->upload->display_errors());
					echo json_encode($result);
					exit();				
			}
		
			$inputFileName = FCPATH . 'assets/appuser_excel/'. $userexcel;
		    try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
					$result[] = array('resSuccess' => 2, 'msg' =>  $e->getMessage());
					echo json_encode($result);
					exit();				
		    }
		 
 			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);		 
            $arrayCount = count($allDataInSheet);
            $createArray = array('FirstName', 'SecondName', 'ThirdName', 'LastName', 'IDNumber', 'Email', 'Mobile', 'Age', 'SEX', 'Password', 'IsActive');
            $makeArray   = array('FirstName' => 'FirstName', 'SecondName' => 'SecondName', 'ThirdName' => 'ThirdName', 'LastName' => 'LastName', 'IDNumber' => 'IDNumber', 'Email' => 'Email', 'Mobile' => 'Mobile', 'Age' => 'Age', 'SEX' => 'SEX', 'Password'=> 'Password', 'IsActive' => 'IsActive');
            $SheetDataKey = array();
            $excel_duplicate_err = array();
			$excel_duplicate = array();
			$database_duplicate = array();
			$error_msg_duplicate = array();
			$insert_success_count = 0;
			$insert_fail_count = 0;
			$rasid_cards = array();
			foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $res_key_diff = array_diff_key($makeArray, $SheetDataKey);			
			if (empty($res_key_diff)) {
				// [[ =======  loop through all records index starts from 2 as index one contains header information   ======= ]] 
				   for ($i = 2; $i <= $arrayCount; $i++) {
					   
					
						$FirstName = $SheetDataKey['FirstName'];
						$SecondName = $SheetDataKey['SecondName'];
						$ThirdName = $SheetDataKey['ThirdName'];
						$LastName = $SheetDataKey['LastName'];
						$IDNumber = $SheetDataKey['IDNumber'];
						$Email = $SheetDataKey['Email'];
						$Mobile = $SheetDataKey['Mobile'];
						$Age = $SheetDataKey['Age'];
						$SEX = $SheetDataKey['SEX'];
						$Password = $SheetDataKey['Password'];
						$IsActive = $SheetDataKey['IsActive'];
						
						
						
						$FirstName = filter_var(trim($allDataInSheet[$i][$FirstName]), FILTER_SANITIZE_STRING);
						$SecondName = filter_var(trim($allDataInSheet[$i][$SecondName]), FILTER_SANITIZE_STRING);
						$ThirdName = filter_var(trim($allDataInSheet[$i][$ThirdName]), FILTER_SANITIZE_STRING);
						$LastName = filter_var(trim($allDataInSheet[$i][$LastName]), FILTER_SANITIZE_STRING);
						$IDNumber = filter_var(trim($allDataInSheet[$i][$IDNumber]), FILTER_SANITIZE_STRING);
						$Email = filter_var(trim($allDataInSheet[$i][$Email]), FILTER_SANITIZE_EMAIL);
						$Mobile = filter_var(trim($allDataInSheet[$i][$Mobile]), FILTER_SANITIZE_STRING);
						$Age = filter_var(trim($allDataInSheet[$i][$Age]), FILTER_SANITIZE_STRING);
						$SEX = filter_var(trim($allDataInSheet[$i][$SEX]), FILTER_SANITIZE_STRING);
						$Password = filter_var(trim($allDataInSheet[$i][$Password]), FILTER_SANITIZE_STRING);
						$IsActive = filter_var(trim($allDataInSheet[$i][$IsActive]), FILTER_SANITIZE_STRING);
						
					   if(!empty($FirstName) || !empty($SecondName) || !empty($ThirdName) || !empty($LastName) ||!empty($IDNumber) ||!empty($Email) ||!empty($Mobile) ||!empty($Age) ||!empty($SEX) ||!empty($Password)){

							if($IDNumber != ''  && $Email!='' && $Mobile!=''){	
								
								if(!in_array($IDNumber,$excel_duplicate)){
									$excel_duplicate[] = $IDNumber;
									if(!in_array($IDNumber,$db_idnumbers)){
										
											$insert_success_count++;
									
											$insData[] = array('FirstName' => $FirstName,
																'SecondName' => $SecondName,
																'ThirdName' => $ThirdName,
																'LastName' => $LastName,
																'IDNumber' => $IDNumber,
																'Email' => $Email,
																'Mobile' => $Mobile,
																'Age' => $Age,
																'SEX' => $SEX,
																'Password' => $Password,
																'IsActive' => $IsActive,
																'token' => '',
																'device_id' => '',
																'device_type' => '');
									}else{
										$insert_fail_count++;
										$error_msg_duplicate[] = array('IDNumber' => $IDNumber, 'Email' => $Email,  'Remarks' => $this->lang->line('already_exist_in_the_database')); 
									}
									
								}else{
										$insert_fail_count++;
										$error_msg_duplicate[] =  array('IDNumber' => $IDNumber, 'Email' => $Email, 'Remarks' => $this->lang->line('already_exist_in_the_excel_sheet')); 
								}
								
						   }else{
							   $insert_fail_count++;
							   $msg = $this->lang->line('blank_column_in_excel');
							   $empty_column = array();
							   if(empty($IDNumber)){
								  $empty_column[] = $this->lang->line('id_number');
							   }
							   if(empty($Email)){
								  $empty_column[] = $this->lang->line('email');
							   }
							   
							   if(empty($Mobile)){
								   $empty_column[] = $this->lang->line('mobile');
							   }
							   
							   $msg .= ' ' . implode(',',$empty_column);
							   
							   $error_msg_duplicate[] =  array('IDNumber' => $IDNumber, 'Email' => $Email, 'Remarks' => $msg ); 
						   }
						   
				   		}
						
						
					}
					
					
					//print_r($error_msg_duplicate);
					//print_r($insData); die('---');
					
					$data['success_count'] = $insert_success_count;
					$data['error_count'] = $insert_fail_count;
					$data['errormsgs'] = $error_msg_duplicate;
					
					$error_view = $this->load->view('admin/excel_errors',$data,TRUE);
					
					
					$this->db->trans_strict(TRUE);	// [[ =======  Set The transctional statement to strict if set to false ======= ]]
					$this->db->trans_begin();	// [[ =======  Begin The transctional statement ======= ]]
					
						if(!empty($insData)){
							$first_id = $this->appuserModel->insertAppUserBatch($insData);
						
							for ($i=0; $i<count($insData); $i++) {
								$insert_id = $first_id;
								$card_ren_num = mt_rand(10000000, 99999999); // [[ ======= Generate 8 digit random number ======= ]]
								$CardNumber = 1011 . str_pad($insert_id, 4, "0", STR_PAD_LEFT) . $card_ren_num; // [[ ======= Generate 16 digit card number ======= ]]
								$CardCreatedDate = date('Y-m-d');
								$CardExpirationDate = date('Y-m-d',strtotime('+1 year')); // [[ ======= Calculate expiery date from current date ======= ]]
								
								$rasid_cards[] = array('CardNumber' => $CardNumber,
													 'CardType' => 1,
													 'UserID' => $insert_id,
													 'CardCreatedDate' => $CardCreatedDate,
													 'CardExpirationDate' => $CardExpirationDate,
													 'CouponID' => NULL,
													 'IsActive' => 1);
								
								$first_id++;					 
												 
							}
							
							// [[ =======  Insert to tbl_rasid_cards  ======= ]]
							$this->appuserModel->insertCardsBatch($rasid_cards); 
						
						}
					
					
					@unlink($inputFileName); // [[ =======  Delete the uploaded excel  ======= ]]
					if($this->db->trans_status() === TRUE){
						$this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
						$result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('excel_imported_successfully'), 'error_view' => $error_view );
						echo json_encode($result);
						exit();				
						
					}else{
						 $this->db->trans_rollback(); // [[ =======  Rollback all the transaction if any fails ======= ]]
						$result[] = array('resSuccess' => 2, 'msg' => $this->lang->line('unable_to_import_excel'), 'error_view' => $error_view);
						echo json_encode($result);			
						exit();
					}					
								
					              
            }else{
				$result[] = array('resSuccess' => 2, 'msg' =>  $this->lang->line('please_import_correct_file'));
				echo json_encode($result);
				exit();				
            }
	
	}
	
public function save() {
        $this->load->library('excel');
        
        if ($this->input->post('importfile')) {
            $path = ROOT_UPLOAD_IMPORT_PATH;
 
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            
            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
            
            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('First_Name', 'Last_Name', 'Email', 'DOB', 'Contact_NO');
            $makeArray = array('First_Name' => 'First_Name', 'Last_Name' => 'Last_Name', 'Email' => 'Email', 'DOB' => 'DOB', 'Contact_NO' => 'Contact_NO');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);
           
            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    $addresses = array();
                    $firstName = $SheetDataKey['First_Name'];
                    $lastName = $SheetDataKey['Last_Name'];
                    $email = $SheetDataKey['Email'];
                    $dob = $SheetDataKey['DOB'];
                    $contactNo = $SheetDataKey['Contact_NO'];
                    $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                    $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                    $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
                }              
                $data['employeeInfo'] = $fetchData;
                $this->import->setBatchImport($fetchData);
                $this->import->importData();
            } else {
                echo "Please import correct file";
            }
        }
        $this->load->view('import/display', $data);
        
    }	
	
	
}
