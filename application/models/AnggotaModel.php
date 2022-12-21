<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function lihat_anggota(){
		$this->db->select('*');
		$this->db->from('anggota');
		
		$this->db->order_by('no_anggota','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah_anggota($data){
		$this->db->insert('anggota', $data);
		return $this->db->affected_rows();
	}

	public function lihat_satu_anggota($id){
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('sigaka_jabatan', 'sigaka_jabatan.jabatan_id = sigaka_anggota.anggota_jabatan_id');
		$this->db->where('anggota_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_anggota($id,$data){
		$this->db->where('anggota_id',$id);
		$this->db->update('anggota',$data);
		return $this->db->affected_rows();
	}

	public function hapus_anggota($id){
		$this->db->where('anggota_id', $id);
		$this->db->delete('anggota');
		return $this->db->affected_rows();
	}
}
