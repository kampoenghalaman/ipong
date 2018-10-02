<?php 
$id_nota = $this->uri->segment(3);
$projas = $this->db->get_where('tbl_notadata', 'id_nota ='.$id_nota)->result();
$query = $this->db->query("SELECT sum(jumlah) as jml FROM tbl_notadata WHERE id_nota =".$id_nota."");
foreach($query->result() as $ttljml){
    $total = $ttljml->jml;
}
if ($isservice == '1'){ 
    $jenis = "Servise";
    $header =  "<tr><td width='80'>No. Nota<br><br>Tanggal</td><td width='10'> : <br><br> : </td><td>".$nomor."<br><br>".date('d M Y', strtotime($tanggal))."</td><td width='120'>Penerima Nota<br><br>Nama Teknisi</td><td width='10'> : <br><br> : </td><td>".$penerimanota."<br><br>".$namateknisi."</td></tr>
            <tr><td colspan='6'></td></tr>";
    $ktrg = "<table class='table table-bordered' border='1'><tr><td width='10%''>Keterangan</td><td>".$keterangan."</td></tr></table>";
    $judul = "<th>Servise / Maintenance</th>";
 }else{
    $jenis = "Penjualan";
    $teknisi= "" ;
    $header = "<tr><td width='80'>No. Nota<br><br>Tanggal</td><td width='10'> : <br><br> : </td><td>".$nomor."<br><br>".date('d M Y', strtotime($tanggal))."</td><td width='120'>Penerima Nota</td><td width='10'> : </td><td>".$penerimanota."</td></tr>
            <tr><td colspan='6'></td></tr>";
    $ktrg = "";
    $judul = "<th>Nama Produk</th>";
}
?>
    <body>
        <h2 style="margin-top:0px">Nota <?php echo $jenis." | ".anchor(site_url('nota/updatenew/'.$id_nota),"<input type='button' class='btn btn-primary' value='Update'/>");?> </h2>
        <table class="table">
    	   <?php echo $header;?>
        </table>
        <br>
        <table class="table table-bordered" border="1">
            <thead>
                <th>No</th>
                <?php echo $judul;?>
                <th width="5%">Banyak</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
            <?php 
                $no=1;
                foreach ($projas as $row){
                    echo "<tr>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row->namaprodukjasa."</td>";
                    echo "<td>".$row->qty."</td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->harga,2,',','.')."</td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->jumlah,2,',','.')."</td>";
                    echo "</tr>";
                }
            ?>
            <tr><td colspan="4">Totalbiaya</td><td><?php echo "<p align='right'>Rp " . number_format($total,2,',','.'); ?></td></tr>
            </tbody>
        </table>
        <br>
        <?php echo $ktrg;?>
        <br>
        <br>
        <br>
        <br>
        <table class="table" align="center">
            <tr><td width="600">Tanda Terima,<br><br><br><b><?php echo $penerimanota." / ".$nomortelepon; ?></b></td><td> </td><td></td><td width="600">Hormat Kami,<br><br><br><b><?php echo $namapegawai; ?></b></td><td></td></tr>
    	    <tr><td width="20" colspan="4"></td><td><a href="<?php echo site_url('nota') ?>" class="btn btn-default">Cancel</a></td></tr>
    	</table>
    </body>