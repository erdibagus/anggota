<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->helper('nominal');
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data = array(
			'user' => $this->UserModel->lihat_user(),
			'title' => 'User'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/user/index',$data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
		if (isset($_POST['simpan'])){
			$generate = substr(time(), 5);
			$id = 'JAB-' . $generate;
			$user = $this->input->post('user');
			$gaji = $this->input->post('gaji');
			$data = array(
				'user_id' => $id,
				'user_nama' => $user,
				'user_gaji' => $gaji
			);
			$save = $this->UserModel->tambah_user($data);
			if ($save>0){
				$this->session->set_flashdata('alert', 'tambah_user');
				redirect('user');
			}
			else{
				redirect('user');
			}
		}
	}

	public function updateForm($id){
		$data = $this->UserModel->lihat_satu_user($id);
		echo json_encode($data);
	}

	public function update(){
		if (isset($_POST['update'])){
			$id = $this->input->post('id');
			$user = $this->input->post('user');
			$gaji = $this->input->post('gaji');
			$data = array(
				'user_nama' => $user,
				'user_gaji' => $gaji
			);
			$update = $this->UserModel->update_user($id,$data);
			if ($update > 0){
				$this->session->set_flashdata('alert', 'update_user');
				redirect('user');
			}
			else{
				redirect('user');
			}
		}
	}

	public function hapus($id){
		$hapus = $this->UserModel->hapus_user($id);
		if ($hapus > 0){
			$this->session->set_flashdata('alert', 'hapus_user');
			redirect('user');
		}else{
			redirect('user');
		}
	}
}
