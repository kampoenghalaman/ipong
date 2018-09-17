<?php 
$id_nota = $this->uri->segment(3);
$projas = $this->db->get_where('tbl_notadata', 'id_nota ='.$id_nota)->result();
if ($isservice == '1'){
    $jenis = "Servise";
    $teknisi= "<td>Namateknisi</td><td> : </td><td>".$namateknisi."</td>" ;
    $ktrng = "<tr><td>Keterangan</td><td>".$keterangan."</td></tr>";
}else{
    $jenis = "Penjualan";
    $teknisi= "" ;
    $ktrng = "";
}
?>
    <body>
        <h2 style="margin-top:0px">Nota <?php echo $jenis;?></h2>
        <table class="table">
    	    <tr><td width="80">No. Nota</td><td width="10"> : </td><td><?php echo $nomor; ?></td><td width="20">Penerimanota</td><td width="10"> : </td><td><?php echo $penerimanota." / ".$nomortelepon; ?></td></tr>
    	    <tr><td>Tanggal</td><td width="10"> : </td><td><?php echo $tanggal; ?></td><?php echo $teknisi;?></tr>
        </table>
        <br>
        <table class="table table-bordered" border="1">
            <thead>
                <th>No</th>
                <th>Servise / Maintenance</th>
                <th>Banyak</th>
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
                    echo "<td>".$row->harga."</td>";
                    echo "<td>".$row->jumlah."</td>";
                    echo "</tr>";
                }
            ?>
            </tbody>
        </table>
        <br>
        <table class="table table-bordered" border="1">
            <tr>
                <td width="10%">Keterangan</td><td><?php echo $keterangan;?></td>
            </tr>
        </table>
        <table class="table" align="center">
            <tr><td width="80">Tanda Terima,</td><td width="10"> </td><td></td><td width="20">Hormat Kami,</td><td width="10"></td><td><?php echo $penerimanota." / ".$nomortelepon; ?></td></tr>
    	    <tr><td >Namapegawai</td><td><?php echo $namapegawai; ?></td></tr>
    	    <tr><td>Totalbiaya</td><td><?php echo $totalbiaya; ?></td></tr>
    	    <?php echo $ktrng;?>
    	    <tr><td></td><td><a href="<?php echo site_url('nota') ?>" class="btn btn-default">Cancel</a></td></tr>
    	</table>
    </body>