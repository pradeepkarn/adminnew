<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RealEstateOffers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Admin_acess'); // Make sure the library name is correct
        $this->load->model('Realestate_model', 'realestate'); // Make sure the model name is correct
    }
    function search_data($obj)
	{
		switch ($obj->page) {
			case 'realstate-offer-list':
				return $this->realestate->search_data($obj->search);
				break;
			default:
				return [];
				break;
		}
		return [];
	}
	function set_searched_data()
	{
		if (isset($_GET['page']) && isset($_GET['search'])) {
			$obj = new stdClass;
			$obj->page = $_GET['page'];
			$obj->search = $_GET['search'];
			return $this->search_data($obj);
		}
		return [];
	}
    public function add_realestate_offer()
    {
        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'add-realestate-offer';
        // $data['tenants'] = $this->tenants->getAllTenants();

        $this->load->view('admin/header', $data);
        $this->load->view('realstate/add_real_estate_offer', $data);
        $this->load->view('admin/footer', $data);
    }
    public function edit_realestate_offer()
    {
        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'edit-realestate-offer-add';
        $data['id'] = $this->uri->segment(2);
        $data['offerData'] = $this->realestate->getOfferById($this->uri->segment(2));

        $this->load->view('admin/header', $data);
        $this->load->view('realstate/add_real_estate_offer', $data);
        $this->load->view('admin/footer', $data);
    }
    public function realEstateOffersList()
    {
        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'realstate-offer-list';
        $data['reslaestateofferslist'] = $this->realestate->getAllRealEstateOffers();
        $data['searched_data'] = $this->set_searched_data();

        $this->load->view('admin/header', $data);
        $this->load->view('realstate/real_estate_offer_list', $data);
        $this->load->view('admin/footer', $data);
    }
    // Check if the image file was uploaded successfully
    function upload_image($file, $adData, $oldfile = null)
    {
        if ($file['error'] === UPLOAD_ERR_OK && $file['name'] != '') {
            // Define the upload directory and original file name
            $folder = 'attachments/offers/';
            $upload_dir = FCPATH . $folder;
            $file_name = $file['name'];

            // Generate a unique filename using timestamp and the original file extension
            $unique_filename = time() . '_' . uniqid() . '.' . pathinfo($file_name, PATHINFO_EXTENSION);

            // Move the uploaded file to the specified directory with the unique filename
            move_uploaded_file($file['tmp_name'], $upload_dir . $unique_filename);

            // Add the file path with the unique filename to the data array
            $adData['images'] =  json_encode([$folder . $unique_filename]);
            if ($oldfile != null && file_exists(FCPATH . $oldfile)) {
                unlink(file_exists(FCPATH . $oldfile));
            }
        }
        return $adData;
    }
    function upload_multiple_image($files)
    {
        $imgnames = [];

        if (is_array($files)) {
            foreach ($files['name'] as $key => $filename) {
                $file_error = $files['error'][$key];
                $file_tmp_name = $files['tmp_name'][$key];

                if ($file_error === UPLOAD_ERR_OK && !empty($filename)) {
                    $folder = 'attachments/offers/';
                    $upload_dir = FCPATH . $folder;
                    $unique_filename = time() . '_' . uniqid() . '.' . pathinfo($filename, PATHINFO_EXTENSION);

                    if (move_uploaded_file($file_tmp_name, $upload_dir . $unique_filename)) {
                        $imgnames[] = $folder . $unique_filename;
                    }
                }
            }
        }

        return $imgnames;
    }


    public function insertEstate()
    {
        // Load the necessary models and libraries if not already loaded
        $this->load->database(); // Load the database library if not loaded

        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'tenants';
        $action = $this->input->post('action'); // Store action in a variable

        // Create an array with the data to be inserted
        $adData = array(
            'purpose' => $this->input->post('purpose'),
            'title' => $this->input->post('title'),
            'district' => $this->input->post('district'),
            'city' => $this->input->post('city'),
            'site' => $this->input->post('site'),
            'property_type' => $this->input->post('property_type'),
            'property_age' => $this->input->post('property_age'),
            'property_area' => $this->input->post('property_area'),
            'no_of_turns' => $this->input->post('no_of_turns'),
            'no_of_rooms' => $this->input->post('no_of_rooms'),
            'no_of_bathrooms' => $this->input->post('no_of_bathrooms'),
            'furnished' => $this->input->post('furnished'),
            'payment_method' => $this->input->post('payment_method'),
            'licence_no' => $this->input->post('licence_no'),
            'the_value' => $this->input->post('the_value'),
            'details' => $this->input->post('details'),
            'is_active' => 1,
            'created_on' => date("Y-m-d H:i:s")
            // Add more fields as needed
        );
        $newImgArr = [];
        if (isset($_FILES['offer_img'])) {
            // $adData = $this->upload_image($_FILES['offer_img'], $adData);
            $newImgArr = $this->upload_multiple_image($file = $_FILES['offer_img']);
        }
        // Now you can use $adData to insert or process the data in your database

        // Perform the insert operation
        if ($action == 'Edit') {
            $ofr = $this->realestate->getOfferById($this->input->post('offerId'));
            $oldImages = [];
            if ($ofr->images != null) {
                $oldImages = json_decode($ofr->images, true);
            }
            if (count($newImgArr) > 0) {
                $adData['images'] = json_encode(
                    array_merge($newImgArr, $oldImages)
                );
            }
            $this->realestate->updateOffer($adData, $this->input->post('offerId'));
        } else {
            // Insert a new record
            if (count($newImgArr) > 0) {
                $adData['images'] = json_encode($newImgArr);
            }
            $this->realestate->insertEstate($adData);
            // $this->db->insert('tbl_ad', $adData);
        }
        // Check if the insert was successful
        if ($this->db->trans_status() === TRUE) {
            $this->db->trans_commit(); // [[ =======  Commit all the transaction if any fails ======= ]]
            $result[] = array('resSuccess' => 1, 'msg' =>  $this->lang->line('SAVED_SUCCESSFULLY'));
            echo json_encode($result);
            exit();
        } else {
            // Insert failed
            $result = array('resSuccess' => 2, 'msg' => $this->lang->line('UNABLE_TO_SAVE'));
            echo json_encode($result);
            exit();
        }
    }
    public function delete_offer()
    {
        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'realstate-offer-list';
        $data['ID'] = $this->uri->segment(2);

        if (!empty($data['ID'])) {
            $res_del = $this->realestate->delete_offer($data['ID']);

            if (empty($res_del)) {
                $this->session->set_flashdata('errtenants', $this->lang->line('UNABLE_DELETE_OFFERS'));
                redirect('realstate-offer-list');
            } else {
                $this->session->set_flashdata('successtenants', $this->lang->line('OFFERS_DELETED_SUCCESSFULLY'));
                redirect('realstate-offer-list');
            }
        } else {
            $this->session->set_flashdata('errtenants', $this->lang->line('OFFERS_NOT_FOUND'));
            redirect('realstate-offer-list');
        }
    }
    public function delete_offer_img()
    {
        $data['ln'] = $this->session->userdata('ln');
        $data['ln'] = !empty($data['ln']) ? $data['ln'] : 'ar';
        $data['menu'] = 'realstate-offer-list'; 
        // $src = str_replace("|","/",$this->uri->segment(3));
        $src = str_replace('%7C', '/', $this->uri->segment(3));
        $id = $this->uri->segment(2);
        if (!empty($id)) {
            $ad = $this->realestate->getOfferById($id);
            $img_arr = json_decode($ad->images,true);
            $key = array_search($src, $img_arr);
            unset($img_arr[$key]);
            $img_arr = array_values($img_arr);
            // print_r($img_arr);
            $new_imgs = json_encode($img_arr);
            $updatedata['images'] = $new_imgs;
            // echo $new_imgs;
            $this->realestate->updateOffer($updatedata,  $ad->id);
            if ($this->db->trans_status() === TRUE) {
                if (file_exists(FCPATH.$src)) {
                    if ($src!='') {
                        unlink(FCPATH.$src);
                    }
                }
                $this->db->trans_commit(); 
                redirect("edit-realestate-offer/$id");
                exit();
            } else {
                redirect("edit-realestate-offer/$id");
                exit();
            }
        } else {
            $this->session->set_flashdata('errtenants', $this->lang->line('OFFERS_NOT_FOUND'));
            redirect("edit-realestate-offer/$id");
        }
    }
}
