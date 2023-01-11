<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WilayahController extends CI_Controller{

    public function __construct()
    {
        parent::__construct();
		$model = array('WilayahModel');
		$this->load->model($model);
	}

	public function getKabupaten()
    {
        $kabupatenId = $this->input->post('kabupaten');
        $idprov = $this->input->post('id');
        $data = $this->WilayahModel->getDatakabupaten($idprov);
        $output = '<option value="">--Pilih Kabupaten-- </option>';
        foreach ($data as $row) {
            if ($kabupatenId) { //edit
                if ($kabupatenId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected> ' . $row->nama_kabupaten . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '"> ' . $row->nama_kabupaten . '</option>';
                }
            } else { //tambah
                $output .= '<option value="' . $row->id . '"> ' . $row->nama_kabupaten . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getKecamatan()
    {
        $kecamatanId = $this->input->post('kecamatan');
        $idkabupaten = $this->input->post('id');
        $data = $this->WilayahModel->getDatakecamatan($idkabupaten);
        $output = '<option value="">--Pilih Kecamatan-- </option>';
        foreach ($data as $row) {
            if ($kecamatanId) { //edit
                if ($kecamatanId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected> ' . $row->nama_kecamatan . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '"> ' . $row->nama_kecamatan . '</option>';
                }
            } else { //tambah
                $output .= '<option value="' . $row->id . '"> ' . $row->nama_kecamatan . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getDesa()
    {
        $desaId = $this->input->post('desa');
        $idkecamatan = $this->input->post('id');
        $data = $this->WilayahModel->getDataDesa($idkecamatan);
        $output = '<option value="">--Pilih Desa-- </option>';
        foreach ($data as $row) {
            if ($desaId) { //edit
                if ($desaId == $row->id) {
                    $output .= '<option value="' . $row->id . '" selected> ' . $row->nama_desa . '</option>';
                } else {
                    $output .= '<option value="' . $row->id . '"> ' . $row->nama_desa . '</option>';
                }
            } else { //tambah
                $output .= '<option value="' . $row->id . '"> ' . $row->id . '</option>';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }
}
