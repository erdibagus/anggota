<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
		$model = array('WilayahModel', 'AnggotaMasukModel');
		$this->load->model($model);
		$this->load->library('form_validation');
    }

	private function _validasi()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|is_unique[anggota.anggota_id]|min_length[16]');
    }

	public function index()
	{
		$data = array(
			'provinsi' => $this->WilayahModel->getDataProv(),
			'title' => 'Pendaftaran'
		);
		$this->load->view('templates/header_front', $data);
		$this->load->view('frontend/index', $data);
		$this->load->view('templates/footer_front');
    }

	public function tambah()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data = array(
				'provinsi' => $this->WilayahModel->getDataProv(),
				'title' => 'Pendaftaran'
			);
			
			$this->session->set_flashdata('Pesan','
			<script>
			$(document).ready(function() {
				swal.fire({
					title: "NIK Salah atau Sudah Terdaftar",
					icon: "warning",
					confirmButtonColor: "#008080",
				});
			});
			</script>
			');

			$this->load->view('templates/header_front', $data);
			$this->load->view('frontend/index', $data);
			$this->load->view('templates/footer_front');
        } else {
            if (isset($_POST['simpan'])){
				$id = $this->input->post('nik');
				$nama = $this->input->post('nama');
				$jenis_kelamin = $this->input->post('jenis_kelamin');
				$pekerjaan = $this->input->post('pekerjaan');
				$alamat = $this->input->post('alamat');
				$desa = $this->input->post('desa');
				$kecamatan = $this->input->post('kecamatan');
				$kabupaten = $this->input->post('kabupaten');
				$provinsi = $this->input->post('provinsi');
				$tanggal_gabung = date('Y-m-d');
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
					'provinsi' => $provinsi,
					'tanggal_gabung' => $tanggal_gabung,
					'status' => $status
				);
				$save = $this->AnggotaMasukModel->tambah_anggota($data);
				if ($save>0){
					$this->session->set_flashdata('Pesan','
					<script>
					$(document).ready(function() {
						swal.fire({
							title: "Terimakasih",
							text: "Informasi yang Anda masukkan telah berhasil dikirimkan, kami akan segera menghubungi Anda",
							icon: "success",
							confirmButtonColor: "#008080",
						});
					});
					</script>
					');
					redirect('welcome');
				}
				else{
					redirect('welcome');
				}
			}
        }
    }

}
