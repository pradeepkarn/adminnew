<?php if (!defined('BASEPATH')) exit('Direct access allowed');

class LanguageSwitcher extends CI_Controller

{

    public function __construct()
    {

        parent::__construct();
    }

    //    function switchLang() {
    // 		$language = $this->uri->segment(2);
    // 		$language = ($language != "") ? $language : "ar";
    // 		$this->session->set_userdata('ln', $language);
    // 		redirect($_SERVER['HTTP_REFERER']);
    //    }
    function switchLang()
    {
        $language = $this->uri->segment(2);
        $language = ($language != "") ? $language : "ar";
        $this->session->set_userdata('ln', $language);

        // Retrieve the return URL from the query string
        $returnUrl = $this->input->get('returnUrl');

        // Default return URL if not provided
        $returnUrl = ($returnUrl != "") ? $returnUrl : base_url(); // Change base_url() to your default URL

        // Redirect to the specified return URL
        redirect($returnUrl);
    }
}
