<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AnggotaMasukModel extends CI_Model{

    var $table = 'anggota';
    var $column_order = array(null, 'anggota_id', null, null, null, null, null, null, null); //set column field database for datatable orderable
    var $column_search = array('anggota_id'); //set column field database for datatable searchable 
    var $order = array('anggota_id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
    {
      $this->db->from('anggota');
      $this->db->where('status', 0);


      $i = 0;
    
      foreach ($this->column_search as $item) // loop column 
      {
          if($_POST['search']['value']) // if datatable send POST for search
          {
              
              if($i===0) // first loop
              {
                  $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                  $this->db->like($item, $_POST['search']['value']);
              }
              else
              {
                  $this->db->or_like($item, $_POST['search']['value']);
              }

              if(count($this->column_search) - 1 == $i) //last loop
                  $this->db->group_end(); //close bracket
          }
          $i++;
      }
      
      if(isset($_POST['order'])) // here order processing
      {
          $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      } 
      else if(isset($this->order))
      {
          $order = $this->order;
          $this->db->order_by(key($order), $order[key($order)]);
      }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        $this->db->where('status', 0);
        return $this->db->count_all_results();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
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

    public function buat_kode()   {
        $this->db->select('(anggota.no_anggota) as kode', FALSE);
        $this->db->order_by('no_anggota','DESC');
        $this->db->limit(1);
        $query = $this->db->get('anggota');      //cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
         //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
        }
        else {
         //jika kode belum ada
         $kode = 1;
        }
        $kodemax = str_pad($kode, STR_PAD_LEFT); // angka 4 menunjukkan jumlah digit angka 0
        $kodejadi = $kodemax;    // hasilnya ODJ-0001 dst.
        return $kodejadi;
    }
}
