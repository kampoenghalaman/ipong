<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kn extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        $this->load->model('kn_model');
    }

    function index(){ 
        $data['produk'] = $this->kn_model->get_pilihanproduk();
        $data['status'] = 0;
        if(!empty($_POST['produk'] )){
            $data['id'] = $_POST['produk'];
            $data['status'] = 1;
            $data['trx'] = $this->kn_model->get_listtrxproduk($data['id']);
            
        }elseif(!empty($_POST['tanggal'] )){
            $data['id'] = $_POST['tanggal'];
            $data['status'] = 2;
            $data['trx'] = $this->kn_model->get_listtrxproduk($data['id']);
            
        }elseif(!empty($_POST['stanggal'] )){
            $data['s'] = $_POST['stanggal'];
            $data['e'] = $_POST['etanggal'];
            $data['status'] = 3;
            $data['trx'] = $this->kn_model->get_listtrxprodukl($data['s'],$data['e']);
        }
        $this->template->load('template','kn/kn_form', $data);
    }

    function cetaklaporan(){
        
    	$ptk = $this->uri->segment(3);
        $isi = $this->uri->segment(4);
        if($ptk == 1){
            $ket = 'Produk / Service : ' .strtoupper($isi);
            $query = $this->kn_model->get_listtrxproduk($isi);
            $total = $this->db->query("SELECT sum(harga) as jml FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE namaprodukjasa like '%".$isi."%' OR tbl_nota.tanggal like '%".$isi."%'");
        }elseif($ptk == 2){
            $ket = 'Tanggal : '.date('d M Y', strtotime($isi));
            $query = $this->kn_model->get_listtrxproduk($isi);
            $total = $this->db->query("SELECT sum(harga) as jml FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE namaprodukjasa like '%".$isi."%' OR tbl_nota.tanggal like '%".$isi."%'");
        }elseif($ptk == 3){
            $tgl = substr($isi,0,10);
            $tgl1 = substr($isi,10,10);
            $ket = 'Range Tanggal dari '.date('d M Y', strtotime($tgl)).' Sampai '.date('d M Y', strtotime($tgl1));
            $query = $this->kn_model->get_listtrxprodukl($tgl,$tgl1);
            $total = $this->db->query("SELECT sum(harga) as jml FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE (tbl_nota.tanggal BETWEEN '".$tgl."' AND '".$tgl1."')");
        }
        #cetaktotaltransaksi
        foreach($total->result() as $ttljml){
                $ttl = $ttljml->jml;
            }

        $pdf = new FPDF('L','mm','A4');
        $pdf->addpage();
        $pdf->image(base_url('assets/logo.png'),10,10);
        $pdf->setfont('arial','B',16);
        $pdf->cell(270,7,'',0,1,'R');
        $pdf->setfont('arial','',12);
        $pdf->cell(280,5,'Jl. Garuda No.55 Kp. Genteng Rt.03/02',0,1,'R');
        $pdf->cell(280,5,'Kec.Baros Kel.Baros Kota Sukabumi',0,1,'R');
        $pdf->cell(280,5,'Telpon : 080989999',0,1,'R');

        #garis
        $pdf->SetLineWidth(1);
        $pdf->Line(10,33,289,33);
        $pdf->SetLineWidth(0);
        $pdf->Line(10,34,289,34);

        #enter
        $pdf->cell(10,5,'',0,1);
        $pdf->setfont('arial','B',12);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(280,7,'LAPORAN TRANSAKSI',0,1,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(280,7,'Berdasarkan '.$ket,0,1,'C');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15,6,'',0,0,'C');
        $pdf->Cell(20,6,'No',1,0,'C');
        $pdf->Cell(80,6,'Tanggal Transaksi',1,0,'C');
        $pdf->Cell(100,6,'Nama Produk',1,0,'C');
        $pdf->Cell(50,6,'Harga',1,0,'C');
        $pdf->Cell(15,6,'',0,1,'C');
        
        $pdf->SetFont('Arial','',10);
        $no=1;
        foreach ($query as $row){
            $pdf->Cell(15,6,'',0,0,'C');
            $pdf->Cell(20,6,$no++,1,0,'C');
            $pdf->Cell(80,6,date('d M Y', strtotime($row->tanggal)),1,0,'C');
            $pdf->Cell(100,6,$row->namaprodukjasa,1,0,'C');
            $pdf->Cell(50,6,"Rp. ".number_format($row->harga,2,',','.'),1,0,'R');
            $pdf->Cell(15,6,'',0,1,'C');
        }
        $pdf->Cell(15,6,'',0,0,'C');
        $pdf->Cell(200,6,'Total Transaksi',1,0,'R');
        $pdf->Cell(50,6,"Rp. ".number_format($ttl,2,',','.'),1,0,'R');
        $pdf->Cell(15,6,'',0,1,'C');
        $pdf->Output();
    }
}