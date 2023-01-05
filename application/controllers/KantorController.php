<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KantorController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('KantorModel');
		$this->load->helper('nominal');
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data = array(
			'kantor' => $this->KantorModel->lihat_kantor(),
			'title' => 'Kantor'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/kantor/index',$data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		if (isset($_POST['simpan'])){
			$generate = substr(time(), 5);
			$id = 'KPK-' . $generate;
			$kantor = $this->input->post('kantor');
			$data = array(
				'kantor_id' => $id,
				'kantor_nama' => $kantor
			);
			$save = $this->KantorModel->tambah_kantor($data);
			if ($save>0){
				$this->session->set_flashdata('alert', 'tambah_kantor');
				redirect('kantor');
			}
			else{
				redirect('kantor');
			}
		}
	}

	public function updateForm($id){
		$data = $this->KantorModel->lihat_satu_kantor($id);
		echo json_encode($data);
	}

	public function update(){
		if (isset($_POST['update'])){
			$id = $this->input->post('id');
			$kantor = $this->input->post('kantor');
			$gaji = $this->input->post('gaji');
			$data = array(
				'kantor_nama' => $kantor,
				'kantor_gaji' => $gaji
			);
			$update = $this->kantorModel->update_kantor($id,$data);
			if ($update > 0){
				$this->session->set_flashdata('alert', 'update_kantor');
				redirect('kantor');
			}
			else{
				redirect('kantor');
			}
		}
	}

	public function hapus($id){
		$hapus = $this->KantorModel->hapus_kantor($id);
		if ($hapus > 0){
			$this->session->set_flashdata('alert', 'hapus_kantor');
			redirect('kantor');
		}else{
			redirect('kantor');
		}
	}
}
