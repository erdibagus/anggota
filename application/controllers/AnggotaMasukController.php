<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaMAsukController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		$model = array('AnggotaMasukModel');
		$helper = array('tgl_indo_helper');
		$this->load->model($model);
		$this->load->helper($helper);
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
    }

	private function _validasi()
    {
        $this->form_validation->set_rules('anggota_id', 'NIK', 'required|trim|is_unique[anggota.anggota_id]');
    }

	public function index(){
    	$data = array(
    		'anggota' => $this->AnggotaMasukModel->lihat_anggota(),
			'title' => 'Anggota Masuk'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/anggota_masuk/index',$data);
		$this->load->view('templates/footer');
	}

	public function ajax_list()
    {
        $list = $this->AnggotaMasukModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $p) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $p->anggota_id;
            $row[] = $p->nama;
            $row[] = $p->jenis_kelamin;
            $row[] = $p->pekerjaan;
            $row[] = $p->alamat;
            $row[] = $p->desa;
            $row[] = $p->kecamatan;
            $row[] = $p->kabupaten;
            $row[] = $p->tanggal_gabung;
            $row[] = '
			<button
				class="btn btn-success btn-sm  btn-bg-gradient-x-purple-blue box-shadow-2 anggota-lihat"
				data-toggle="modal" data-target="#lihat" href="javascript:void(0)" onclick="lihat('."'".$p->anggota_id."'".')"
				title="Lihat selengkapnya"><i class="ft-eye"></i></button>
			<button
				class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 anggota-hapus"
				data-toggle="modal" data-target="#hapus" href="javascript:void(0)" onclick="konfirmasi('."'".$p->anggota_id."'".')"
				title="Hapus data anggota"><i class="ft-trash"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->AnggotaMasukModel->count_all(),
                        "recordsFiltered" => $this->AnggotaMasukModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	public function lihat($id){
		$data = $this->AnggotaMasukModel->lihat_satu_anggota($id);
		echo json_encode($data);
	}

	public function tambah()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Registrasi";

			$this->load->view('frontend/index',$data);
        } else {
            if (isset($_POST['tambah'])){
				$id = $this->input->post('anggota_id');
				$nama = $this->input->post('nama');
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$pekerjaan = $this->input->post('pekerjaan');
				$alamat = $this->input->post('alamat');
				$desa = $this->input->post('desa');
				$kecamatan = $this->input->post('kecamatan');
				$kabupaten = $this->input->post('kabupaten');
				$tanggal_gabung = $this->input->post('tanggal_gabung');
				$status = 0;
				$data = array(
					'anggota_id' => $id,
					'nama' => $nama,
					'jenis_kelamin' => $jenis_kelamin,
					'pekerjaan' => $pekerjaan,
					'alamat' => $alamat,
					'desa' => $desa,
					'kecamatan' => $kecamatan,
					'kabupaten' => $kabupaten,
					'tanggal_gabung' => $tanggal_gabung,
					'status' => $status
				);
				$save = $this->AnggotaMasukModel->tambah_anggota($data);
				if ($save>0){
					$this->session->set_flashdata('alert', 'tambah_anggota');
					redirect('index');
				}
				else{
					redirect('index');
				}
			}
        }
    }

	public function update(){
		if (isset($_POST['update'])){
			$id = $this->input->post('nik');
			$nama = $this->input->post('nama');
			$no_anggota = $this->AnggotaMasukModel->buat_kode();
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$pekerjaan = $this->input->post('pekerjaan');
			$alamat = $this->input->post('alamat');
			$desa = $this->input->post('desa');
			$kecamatan = $this->input->post('kecamatan');
			$kabupaten = $this->input->post('kabupaten');
			$tanggal_gabung = $this->input->post('tanggal_gabung');
			$status = 1;
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
				'tanggal_gabung' => $tanggal_gabung,
				'status' => $status
			);
			$save = $this->AnggotaMasukModel->update_anggota($id,$data);
			if ($save>0){
				$this->session->set_flashdata('alert', 'update_anggota');
				redirect('anggota_masuk');
			}
			else{
				redirect('anggota_masuk');
			}
		}
	}

	public function hapus($id){
		$hapus = $this->AnggotaMasukModel->hapus_anggota($id);
		if ($hapus > 0){
			$this->session->set_flashdata('alert', 'hapus_anggota');
			redirect('anggota_masuk');
		}else{
			redirect('anggota_masuk');
		}
	}
}
