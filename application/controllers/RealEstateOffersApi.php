<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RealEstateOffersApi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('Admin_acess'); // Make sure the library name is correct
        $this->load->model('Realestate_model', 'realestate'); // Make sure the model name is correct
    }
    public function offer_list()
    {
        $offerlist = $this->realestate->getAllRealEstateOffers();
        $list = [];
        foreach ($offerlist as $key => $ofr) {
            if (isset($ofr->images)) {
                $ofr->images = json_decode($ofr->images);
                $imgs = [];
                foreach ($ofr->images as $fullimg) {
                    $imgs[] = base_url($fullimg);
                }
                $ofr->images = $imgs;
            }

            $ofr->view_link = base_url("api/v1/realstate-offer-details/$ofr->id");
            $list[] = $ofr;
        }
        if (count($list) > 0) {
            $data['msg'] = "offer found";
            $data['success'] = true;
            $data['data'] = $list;
            echo json_encode($data);
            return;
        } else {
            $data['msg'] = "offer not found";
            $data['success'] = false;
            $data['data'] = [];
            echo json_encode($data);
            return;
        }
    }
    function offer_search()
    {
        if (isset($_POST['search_prop'])) {
            $search = $_POST;
            $offerlist = $this->realestate->search_offers($search);

            $resoffr = [];
            if ($offerlist) {
                foreach ($offerlist as $key => $offer) {
                    if (isset($offer->images)) {
                        $imgs = [];
                        $offer->images = json_decode($offer->images);
                        foreach ($offer->images as $fullimg) {
                            $imgs[] = base_url($fullimg);
                        }
                        $offer->images = $imgs;
                    }
                    $resoffr[] = $offer;
                }
                if (count($resoffr) > 0) {
                    $data['msg'] = "offer found";
                    $data['success'] = true;
                    $data['data'] = $resoffr;
                } else {
                    $data['msg'] = "offer not found";
                    $data['success'] = false;
                    $data['data'] = null;
                }
                echo json_encode($data);
                return;
            } else {
                $data['msg'] = "offer not found";
                $data['success'] = false;
                $data['data'] = null;
                echo json_encode($data);
                return;
            }
        }
    }
    function offer_search_params()
    {
        $params = $this->realestate->getUniqueValues();
        if ($params) {
            // Initialize an empty array to store the grouped data
            $groupedData = [];

            // Loop through the data and group it by keys
            foreach ($params as $item) {
                foreach ($item as $key => $value) {
                    if (!isset($groupedData[$key])) {
                        $groupedData[$key] = [];
                    }
                    if (!in_array($value, $groupedData[$key])) {
                        $groupedData[$key][] = $value;
                    }
                }
            }

            $data['msg'] = "offer found";
            $data['success'] = true;
            $data['data'] = $groupedData;
            echo json_encode($data);
            return;
        } else {
            $data['msg'] = "offer not found";
            $data['success'] = false;
            $data['data'] = null;
            echo json_encode($data);
            return;
        }
    }
    function offer_details()
    {
        $id = $this->uri->segment(4);
        $offer = $this->realestate->getOfferById($id);
        if ($offer) {
            if (isset($offer->images)) {
                $offer->images = json_decode($offer->images);
                foreach ($offer->images as $fullimg) {
                    $imgs[] = base_url($fullimg);
                }
                $offer->images = $imgs;
            }

            $data['msg'] = "offer found";
            $data['success'] = true;
            $data['data'] = $offer;
            echo json_encode($data);
            return;
        } else {
            $data['msg'] = "offer not found";
            $data['success'] = false;
            $data['data'] = null;
            echo json_encode($data);
            return;
        }
    }
}
