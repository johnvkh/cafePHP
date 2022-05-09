<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('home_model');
    }

    public function index() {
        $data['title'] = 'INDEE SOFTWARE.WEBSITE Login';
        $data['getlogo'] = $this->home_model->Getlogo();
        $this->weblayout('webbody/login', $data);
    }

}
