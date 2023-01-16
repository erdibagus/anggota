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
			'jumlah_anggota_laki' => $this->DashboardModel->jumlah_anggota_laki(),
			'jumlah_anggota_perempuan' => $this->DashboardModel->jumlah_anggota_perempuan(),
			'title' => 'Dashboard'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/index',$data);
		$this->load->view('templates/footer');
	}

	public function getPie()
	{
		$jmlL = $this->DashboardModel->jumlah_anggota_laki();
		$jmlP = $this->DashboardModel->jumlah_anggota_perempuan();

		$data = array('jmll'=>$jmlL, 'jmlp'=>$jmlP);
		echo json_encode($data);
	}
}
