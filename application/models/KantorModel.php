<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class KantorModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function lihat_kantor(){
		$this->db->select('*');
		$this->db->from('kantor');
		$this->db->order_by('kantor_id','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah_kantor($data){
		$this->db->insert('kantor', $data);
		return $this->db->affected_rows();
	}

	public function lihat_satu_kantor($id){
		$this->db->select('*');
		$this->db->from('sigaka_kantor');
		$this->db->where('kantor_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_kantor($id,$data){
		$this->db->where('kantor_id',$id);
		$this->db->update('sigaka_kantor',$data);
		return $this->db->affected_rows();
	}

	public function hapus_kantor($id){
		$this->db->where('kantor_id', $id);
		$this->db->delete('kantor');
		return $this->db->affected_rows();
	}


}
