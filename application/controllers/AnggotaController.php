<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
		$model = array('AnggotaModel', 'WilayahModel');
		$helper = array('tgl_indo_helper');
		$this->load->model($model);
		$this->load->helper($helper);
		$this->load->library('form_validation');
		if (!$this->session->has_userdata('session_id')) {
			$this->session->set_flashdata('alert', 'belum_login');
			redirect(base_url('login'));
		}
    }

	private function _validasi()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[anggota.anggota_id]|min_length[16]');
    }

    public function index(){
    	$data = array(
			'provinsi' => $this->WilayahModel->getDataProv(),
			'title' => 'Anggota'
		);
		$this->load->view('templates/header',$data);
		$this->load->view('backend/anggota/index',$data);
		$this->load->view('templates/footer');
	}

	public function ajax_list()
    {
        $list = $this->AnggotaModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $p) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $p->anggota_id;
            $row[] = $p->nama;
            $row[] = $p->no_anggota;
            $row[] = $p->jenis_kelamin;
            $row[] = $p->pekerjaan;
            $row[] = $p->alamat;
            $row[] = $p->nama_desa;
            $row[] = $p->nama_kecamatan;
            $row[] = $p->nama_kabupaten;
            $row[] = $p->nama_provinsi;
            $row[] = $p->tanggal_gabung;
            $row[] = '
			<button
				class="btn btn-success btn-sm  btn-bg-gradient-x-purple-blue box-shadow-2 anggota-lihat"
				data-toggle="modal" data-target="#lihat" href="javascript:void(0)" onclick="lihat('."'".$p->anggota_id."'".')"
				title="Lihat selengkapnya"><i class="ft-eye"></i></button>
			<button
				class="btn btn-success btn-sm  btn-bg-gradient-x-blue-green box-shadow-2 anggota-edit"
				data-toggle="modal" data-target="#ubah" href="javascript:void(0)" onclick="edit('."'".$p->anggota_id."'".')"
				title="Update data anggota"><i class="ft-edit"></i></button>
			<button
				class="btn btn-danger btn-sm  btn-bg-gradient-x-red-pink box-shadow-2 anggota-hapus"
				data-toggle="modal" data-target="#hapus" href="javascript:void(0)" onclick="konfirmasi('."'".$p->anggota_id."'".')"
				title="Hapus data anggota"><i class="ft-trash"></i></button>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->AnggotaModel->count_all(),
                        "recordsFiltered" => $this->AnggotaModel->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	public function tambah(){
		$this->_validasi();

        if ($this->form_validation->run() == false) {
            $data = array(
				'provinsi' => $this->WilayahModel->getDataProv(),
				'title' => 'Anggota'
			);
			
			$errors = validation_errors();
           	$this->session->set_flashdata('form_error', $errors);
			$this->load->view('templates/header',$data);
			$this->load->view('backend/anggota/index',$data);
			$this->load->view('templates/footer');
        } else {
			if (isset($_POST['simpan'])){
				$id = $this->input->post('nik');
				$nama = $this->input->post('nama');
				$no_anggota = $this->AnggotaModel->buat_kode();
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$pekerjaan = $this->input->post('pekerjaan');
				$alamat = $this->input->post('alamat');
				$desa = $this->input->post('desa');
				$kecamatan = $this->input->post('kecamatan');
				$kabupaten = $this->input->post('kabupaten');
				$provinsi = $this->input->post('provinsi');
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
					'provinsi' => $provinsi,
					'tanggal_gabung' => $tanggal_gabung,
					'status' => $status
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
			$tanggal_gabung = $this->input->post('tanggal_gabung');
			$data = array(
				'anggota_id' => $id,
				'nama' => $nama,
				'no_anggota' => $no_anggota,
				'jenis_kelamin' => $jenis_kelamin,
				'pekerjaan' => $pekerjaan,
				'alamat' => $alamat,
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
