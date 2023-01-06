<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

    public function get_user_account($user){
		$query = $this->db->get_where('user',$user);
		return $query->row_array();
	}

	public function lihat_user(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('user_id','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah_user($data){
		$this->db->insert('user', $data);
		return $this->db->affected_rows();
	}

	public function lihat_satu_user($id){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update_user($id,$data){
		$this->db->where('user_id',$id);
		$this->db->update('sigaka_user',$data);
		return $this->db->affected_rows();
	}

	public function hapus_user($id){
		$this->db->where('user_id', $id);
		$this->db->delete('sigaka_user');
		return $this->db->affected_rows();
	}


}
