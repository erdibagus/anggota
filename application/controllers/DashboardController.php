<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$model = array('DashboardModel');
		$this->load->model($model);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data = array(
			'jumlah_anggota' => $this->DashboardModel->jumlah_anggota(),
			'title' => 'Dashboard'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/index',$data);
		$this->load->view('templates/footer');
	}
}
