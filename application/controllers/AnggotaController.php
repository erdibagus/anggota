<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		$model = array('JabatanModel','AnggotaModel');
		$helper = array('tgl_indo_helper');
		$this->load->model($model);
		$this->load->helper($helper);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
    }

    public function index(){
    	$data = array(
    		'anggota' => $this->AnggotaModel->lihat_anggota(),
			'title' => 'Anggota'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/anggota/index',$data);
		$this->load->view('templates/footer');
	}

	public function tambah(){
    	if (isset($_POST['simpan'])){
			$id = $this->input->post('nik');
			$nama = $this->input->post('nama');
			$no_anggota = $this->input->post('no_anggota');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$pekerjaan = $this->input->post('pekerjaan');
			$alamat = $this->input->post('alamat');
			$desa = $this->input->post('desa');
			$kecamatan = $this->input->post('kecamatan');
			$kabupaten = $this->input->post('kabupaten');
			$tanggal_gabung = $this->input->post('tanggal_gabung');
			$data = array(
				'anggota_id' => $id,
				'nama' => $nama,
				'no_anggota' => $no_anggota,
				'jenis_kelamin' => $jenis_kelamin,
				'pekerjaan' => $pekerjaan,
				'alamat' => $alamat,
				'desa' => $desa,
				'kecamatan' => $kecamatan,
				'kabupaten' => $kabupaten,
				'tanggal_gabung' => $tanggal_gabung
			);
			$save = $this->AnggotaModel->tambah_anggota($data);
			if ($save>0){
				$this->session->set_flashdata('alert', 'tambah_anggota');
				redirect('anggota');
			}
			else{
				redirect('anggota');
			}
		}
	}

	public function lihat($id){
		$data = $this->AnggotaModel->lihat_satu_anggota($id);
		echo json_encode($data);
	}

	public function update(){
		if (isset($_POST['update'])){
			$id = $this->input->post('nik');
			$nama = $this->input->post('nama');
			$no_anggota = $this->input->post('no_anggota');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$pekerjaan = $this->input->post('pekerjaan');
			$alamat = $this->input->post('alamat');
			$desa = $this->input->post('desa');
			$kecamatan = $this->input->post('kecamatan');
			$kabupaten = $this->input->post('kabupaten');
			$tanggal_gabung = $this->input->post('tanggal_gabung');
			$data = array(
				'anggota_id' => $id,
				'nama' => $nama,
				'no_anggota' => $no_anggota,
				'jenis_kelamin' => $jenis_kelamin,
				'pekerjaan' => $pekerjaan,
				'alamat' => $alamat,
				'desa' => $desa,
				'kecamatan' => $kecamatan,
				'kabupaten' => $kabupaten,
				'tanggal_gabung' => $tanggal_gabung
			);
			$save = $this->AnggotaModel->update_anggota($id,$data);
			if ($save>0){
				$this->session->set_flashdata('alert', 'update_anggota');
				redirect('anggota');
			}
			else{
				redirect('anggota');
			}
		}
	}

	public function hapus($id){
		$hapus = $this->AnggotaModel->hapus_anggota($id);
		if ($hapus > 0){
			$this->session->set_flashdata('alert', 'hapus_anggota');
			redirect('anggota');
		}else{
			redirect('anggota');
		}
	}

	public function ajaxIndex(){
		echo json_encode($this->AnggotaModel->lihat_anggota());
	}

}
