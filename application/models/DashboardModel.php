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
		$query = $this->db->get();
		return $query->num_rows();
	}
}
