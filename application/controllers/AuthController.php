<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$model = array('UserModel');
		$this->load->model($model);
	}

	public function index()
	{
		$this->load->view('backend/auth/login');
	}

	public function login()
	{
		if ($this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'sudah_login');
			redirect(base_url('dashboard'));
		}
		if (isset($_POST['login'])) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$data = array(
				'user_username' => $username,
				'user_password' => md5($password)
			);
			$user = $this->UserModel->get_user_account($data);
			if ($user != null) {
				$session = array(
					'session_id' => $user['user_id'],
					'session_username' => $user['user_username'],
					'session_nama' => $user['user_nama'],
					'session_foto' => $user['user_foto'],
					'session_hak_akses' => $user['user_hak_akses']
				);
				$this->session->set_flashdata('alert', 'login_sukses');
				$this->session->set_userdata($session);
				redirect(base_url('dashboard'));
			} else {
				$this->session->set_flashdata('alert', 'login_gagal');
				redirect(base_url('login'));
			}
		} else {
			$data = array(
				'title' => 'Login'
			);
			$this->load->view('backend/auth/login',$data);
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}
