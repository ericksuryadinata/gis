<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index(){
        $this->load->view('main');
    }

    public function pertemuan_pertama(){
        $this->load->view('pertemuan_pertama');
    }

    public function pertemuan_kedua(){
        $this->load->view('pertemuan_kedua');
    }

    public function pertemuan_ketiga(){
        $this->load->view('pertemuan_ketiga');
    }

}