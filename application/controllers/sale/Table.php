<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Table extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('sale/salepage_model');

        if (!isset($_SESSION['owner_id'])) {
            header("location: " . $this->base_url);
        }
    }

    public function index() {
        $data['tab'] = 'openbill';
        $data['title'] = 'Open Bill';
        $this->deshboardlayout('sale/table', $data);
    }

}
