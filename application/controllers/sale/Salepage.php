<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salepage extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('sale/salepage_model');
        if (!isset($_SESSION['owner_id'])) {
            header("location: " . $this->base_url);
        }
    }

    public function index() {
        $data['tab'] = 'salepage';
        $data['title'] = 'Sale Page';
        $this->deshboardlayout('sale/salepage', $data);
    }

    function Getproductlist() {

        $data = json_decode(file_get_contents("php://input"), true);
        echo $this->salepage_model->Getproductlist($data);
    }

    function Findproduct() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo $this->salepage_model->Findproduct($data);
    }

    function Customer() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo $this->salepage_model->Customer($data);
    }

    function Gettoday() {
        $data = json_decode(file_get_contents("php://input"), true);
        echo $this->salepage_model->Gettoday($data);
    }

    function Updatemoneychange() {
        $this->salepage_model->Updatemoneychange();
    }

    function Savesale() {
        $data = json_decode(file_get_contents("php://input"), true);
        if (!isset($data)) {
            exit();
        }

        $numforcuslast = $this->salepage_model->Getnumforcuslast();
        $numforcusnow = $numforcuslast[0]['number_for_cus'];
        $numforcusplus = $numforcusnow + '1';
        $runnolast = $this->salepage_model->Getrunnolast();
        if ($runnolast) {
            $runnonow = $runnolast[0]['sale_runno'];
            $runnoplus = $runnonow + '1';
            $header_code = str_pad($runnoplus, 10, "0", STR_PAD_LEFT);
        } else {
            $header_code = '0000000001';
        }

        $adddate = time();
        for ($i = 1; $i <= count($data['listsale']); $i++) {
            $data['number_for_cus'] = $numforcusplus;
            $data['sale_runno'] = $header_code;
            $data['adddate'] = $adddate;
            if ($data['listsale'][$i - 1]['product_id'] != '' && $data['listsale'][$i - 1]['product_sale_num'] != '0') {
                $data['listsale'][$i - 1]['sale_runno'] = $header_code;
                $data['listsale'][$i - 1]['adddate'] = $adddate;
                if ($this->salepage_model->Adddetail($data['listsale'][$i - 1])) {
                    $this->salepage_model->Updateproductdeletestock($data['listsale'][$i - 1]);
                }
                if ($i == 1) {
                    $this->salepage_model->Addheader($data);
                    $price_value = $data['sumsale_price'] - $data['discount_last'];
                    $this->salepage_model->Addmoneychange($data['money_changeto_customer'], $data['money_from_customer'], $price_value);
                }
            }
        }
    }
}
