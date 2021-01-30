<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct(){
        parent::__construct();
         $this->load->model('dashboard_model','dashboard');
       
	}

	public function index()
	{
		$data['total_transaction']	= $this->dashboard->getCountTrx();
		$data['total_product']		= $this->dashboard->getCountProduct();
		$data['total_category']		= $this->dashboard->getCountCategory();
		$data['total_user']			= $this->dashboard->getCountUser();
        $this->load->view('template/header2');
        $this->load->view('template/sidebar');
		$this->load->view('dashboard', $data);
        $this->load->view('template/footer2');
	}
}
