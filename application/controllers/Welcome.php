<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$model = array('WilayahModel', 'KantorModel');
		$this->load->model($model);
    }
	public function index()
	{
		$data = array(
			'provinsi' => $this->KantorModel->lihat_kantor(),
			'title' => 'Anggota'
		);
		$this->load->view('frontend/index');
    }
}
