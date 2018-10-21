<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kn_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_pilihanproduk(){
    	$this->db->select('id_notadata, id_nota, namaprodukjasa');
    	$this->db->group_by('namaprodukjasa', 'ASC');
        return $this->db->get('tbl_notadata')->result();
    }
    function get_listtrxproduk($id){
    	$this->db->select('namaprodukjasa,harga,tbl_nota.tanggal');
        $this->db->like('namaprodukjasa', $id);
        $this->db->or_like('tbl_nota.tanggal', $id);
        $this->db->from('tbl_notadata');
        $this->db->join('tbl_nota', 'tbl_notadata.id_nota = tbl_nota.id_nota', 'right');
        $this->db->order_by('tbl_nota.tanggal', 'ASC');
        return $query = $this->db->get()->result();
    }
    function get_listtrxprodukl($s,$e){
        $query = $this->db->query("SELECT namaprodukjasa, harga, tbl_nota.tanggal FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE (tbl_nota.tanggal BETWEEN '".$s."' AND '".$e."') Order by tbl_nota.tanggal ASC");
        return $query->result();
    }
}