<?php
class WilayahModel extends ci_model{


    
    function data()
    {
        $this->db->order_by('id', 'ASC');
        return $query = $this->db->get('wilayah_provinsi');
    }

    public function getDataProv()
    {
        $this->db->order_by('nama_provinsi', 'ASC');
        return $this->db->get('wilayah_provinsi')->result_array();
    }

    public function getDatakabupaten($idprov)
    {
        $this->db->order_by('nama_kabupaten', 'ASC');
        return $this->db->get_where('wilayah_kabupaten', ['provinsi_id' => $idprov])->result();
    }

    public function getDatakecamatan($idkab)
    {
        $this->db->order_by('nama_kecamatan', 'ASC');
        return $this->db->get_where('wilayah_kecamatan', ['kabupaten_id' => $idkab])->result();
    }

    public function getDataDesa($idkec)
    {
        $this->db->order_by('nama_desa', 'ASC');
        return $this->db->get_where('wilayah_desa', ['kecamatan_id' => $idkec])->result();
    }
}
