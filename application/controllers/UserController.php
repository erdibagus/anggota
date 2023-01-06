<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$model = array('UserModel', 'KantorModel');
		$this->load->model($model);
		$this->load->helper('nominal');
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
	}

	public function index(){
		$data = array(
			'user' => $this->UserModel->lihat_user(),
			'kantor' => $this->KantorModel->lihat_kantor(),
			'title' => 'User'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/user/index',$data);
		$this->load->view('templates/footer');
	}

	public function lihat($id){
		$data = $this->UserModel->lihat_satu_user($id);
		echo json_encode($data);
	}

	public function tambah(){
		if (isset($_POST['simpan'])){
			$generate = substr(time(), 5);
			$id = 'USR-' . $generate;
			$nama = $this->input->post('nama');
			$kantor = $this->input->post('kantor');
			$level = $this->input->post('level');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$data = array(
				'user_id' => $id,
				'user_nama' => $nama,
				'user_kantor' => $kantor,
				'user_hak_akses' => $level,
				'user_username' => $username,
				'user_password' => md5($password)
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
			$nama = $this->input->post('nama');
			$kantor = $this->input->post('kantor');
			$level = $this->input->post('level');
			$data = array(
				'user_id' => $id,
				'user_nama' => $nama,
				'user_kantor' => $kantor,
				'user_hak_akses' => $level
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
