<?php

class cetaknota extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library('pdf');
	}

	function index(){
		#definisi data
		$id_nota = $this->uri->segment(3);
		$data = $this->db->get_where('tbl_nota', 'id_nota ='.$id_nota)->result();
		foreach($data as $rew){
			$nonota = $rew->nomor;
			$penerima = $rew->penerimanota;
			$teknisi = $rew->namateknisi;
			$pegawai = $rew->namapegawai;
			$tanggal = date('d M Y', strtotime($rew->tanggal));
			$totalbiaya = $rew->totalbiaya;
			$keterangan = $rew->keterangan;
			$isservice = $rew->isservice; 	
		}

		$pdf = new FPDF('L','mm','A5');
		$pdf->addpage();
		$pdf->image(base_url('assets/logo.png'),10,10);
		$pdf->setfont('arial','B',16);
		$pdf->cell(190,7,'IM Computer',0,1,'R');
		$pdf->setfont('arial','',12);
		$pdf->cell(190,5,'Jl. Garuda No.55 Kp. Genteng Rt.03/02',0,1,'R');
		$pdf->cell(190,5,'Kec.Baros Kel.Baros Kota Sukabumi',0,1,'R');
		$pdf->cell(190,5,'Telpon : 080989999',0,1,'R');

		#garis
		$pdf->SetLineWidth(1);
		$pdf->Line(10,33,199,33);
		$pdf->SetLineWidth(0);
		$pdf->Line(10,34,199,34);

		#enter
		$pdf->cell(10,5,'',0,1);
		$pdf->setfont('arial','',10);
		#nonota
		$pdf->cell(33,5,'No. Nota',0,0,'L');
		$pdf->cell(80,5,': '.$nonota,0,0,'L');
		#pelanggan
		$pdf->cell(25,5,'Nama Pemilik',0,0,'L');
		$pdf->cell(66,5,': '.$penerima,0,1,'L');
		#tanggal
		$pdf->cell(33,5,'Tempat dan Tanggal',0,0,'L');
		$pdf->cell(80,5,': Sukabumi, '.$tanggal,0,0,'L');
		#pic
		$pdf->cell(25,5,'Teknisi',0,0,'L');
		$pdf->cell(66,5,': '.$teknisi,0,1,'L');
		#enter
		$pdf->cell(0,3,'',0,1);
		// $pdf->cell(190,6,'test',1,0);
		
		#enter
		$pdf->setfont('arial','B',10);
		$pdf->cell(8,6,'No',1,0,'C');
		$pdf->cell(75,6,'Sevice/Maintenance',1,0,'C');
		$pdf->cell(20,6,'Banyak',1,0,'C');
		$pdf->cell(40,6,'Harga',1,0,'C');
		$pdf->cell(47,6,'Jumlah',1,1,'C');

		$projas = $this->db->get_where('tbl_notadata', 'id_nota ='.$id_nota)->result();
		$no=1;
        foreach ($projas as $row){
			$pdf->setfont('arial','',10);
			$pdf->cell(8,6,$no++,1,0,'C');
			$pdf->cell(75,6,$row->namaprodukjasa,1,0,'C');
			$pdf->cell(20,6,$row->qty,1,0,'C');
			$pdf->cell(40,6,$row->harga,1,0,'C');
			$pdf->cell(47,6,$row->jumlah,1,1,'R');
		}

		#total
		$pdf->setfont('arial','B',10);
		$pdf->cell(143,6,'Total',1,0,'R');
		$pdf->cell(47,6,$totalbiaya,1,1,'R');

		#keterangan
		$pdf->cell(10,2,'',0,1);
		$pdf->setfont('arial','B',10);
		$pdf->cell(190,10,'Keterangan : '.$keterangan,1,1,'L');

		#ttd
		// $pdf->cell(10,2,'',0,1);
		$pdf->setY(116);
		$pdf->setfont('arial','B',10);
		$pdf->cell(100,0,'Tanda Terima,',0,0,'C');
		$pdf->cell(100,0,'Hormat Kami,',0,1,'C');
		$pdf->cell(199,12,'',0,1,'C');
		$pdf->cell(100,0,$penerima,0,0,'C');
		$pdf->cell(100,0,$pegawai,0,1,'C');
		$pdf->output();
	}
}