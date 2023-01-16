<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function jumlah_anggota(){
		$this->db->from('anggota');
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function jumlah_anggota_laki(){
		$this->db->from('anggota');
		$this->db->where('jenis_kelamin', 'L');
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function jumlah_anggota_perempuan(){
		$this->db->from('anggota');
		$this->db->where('jenis_kelamin', 'P');
		$this->db->where('status', 1);
		$query = $this->db->get();
		return $query->num_rows();
	}
}
