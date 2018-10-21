<!DOCTYPE html>
<html>
<head>
	<title>Keuangan Madrasah</title>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#harian').hide();
			$('#ranget').hide();
			$('#prd').click(function() {
			    $('#produk').show();
			    $('#harian').hide();
				$('#ranget').hide();
			});
			$('#hrn').click(function() {
			    $('#harian').show();
			    $('#produk').hide();
				$('#ranget').hide();
			});
			$('#range').click(function() {
			    $('#ranget').show();
			    $('#produk').hide();
				$('#harian').hide();
			});

        	$('#tampil').click(function(){
            $('.formpembayaran').show();
            $('#tutup').show();
            document.getElementById('pembayaranbulan').value = "";
            document.getElementById('besaran').value = "";
            
        	});

        	$('#tutup').click(function(){
            	$('.formpembayaran').hide();
            	$('#tutup').hide();
        	});
        }); 

       
	</script>

</head>
<body>
<br><br>
<h1 style="margin-top:0px">Laporan Transaksi Keuangan</h1>
<form method="POST" action="<?php echo base_url('Kn/index/')?>">
	<table  width=100%>
	<tr><td width='40%'><h4>Laporan Berdasarkan </h4></td>
	<td>:</td>
	<td><input type="radio" id="prd" name="pilih"> Produk / Service  <input type="radio" id="hrn" name="pilih"> Harian  <input type="radio" id="range" name="pilih"> Range Tanggal</td></tr>
	<tr id="produk"><td><h4>Produk / Service</h4></td>
	<td>:</td>
	<td>
	<select class="form-control" id="" name="produk">
	<option value="" disabled selected>Pilih Produk / Service</option>
	<?php foreach($produk as $row){
		echo "<option value='".$row->namaprodukjasa."'>".$row->namaprodukjasa."</option>";
		}?>
	</select></td></tr>
	<tr id='harian'><td><h4>Harian</h4></td>
	<td>:</td>
	<td>
	<input type="text" class="form-control" name="tanggal" id="tanggal" placeholder="Pilih Tanggal" value="" /></td></tr>
	<tr id='ranget'><td><h4>Range Tanggal</h4></td>
	<td>:</td>
	<td>
	<input type="text" class="form-control" name="stanggal" id="stanggal"  value="<?php echo date('Y-m-d');?>" /> 
	Sampai 
	<input type="text" class="form-control" name="etanggal" id="etanggal"  value="<?php echo date('Y-m-d');?>" /></td></tr>
	<tr>
	<td colspan="3"><p align="right"><button type="submit" class="btn btn-primary">Cek</button> </p></td>
	</tr>
	</table>
</form>
<?php 
	if($status != 0 ){
		if($status == 3){
			$query = $this->db->query("SELECT sum(harga) as jml FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE (tbl_nota.tanggal BETWEEN '".$s."' AND '".$e."')");
				$id =$s.$e; 
		}else{
			$query = $this->db->query("SELECT sum(harga) as jml FROM tbl_notadata JOIN tbl_nota ON tbl_notadata.id_nota = tbl_nota.id_nota WHERE namaprodukjasa like '%".$id."%' OR tbl_nota.tanggal like '%".$id."%'");		
		}
		foreach($query->result() as $ttljml){
		    $total = $ttljml->jml;
	}?>
		<table width='100%' class="table table-bordered" style="margin-bottom: 10px">
        	<tr>
        		<th><p align='center'>No</p></th>
        		<th><p align='center'>Tanggal Transaksi</p></th>
        		<th><p align='center'>Nama Produk</p></th>
        		<th><p align='center'>Harga</p></th>
        	</tr>
        	<?php $i=1;foreach($trx as $row){?>
        	<tr>
        		<td><?php echo $i++;?></td>
        		<td><?php echo date('d M Y', strtotime($row->tanggal));?></td>
        		<td><?php echo $row->namaprodukjasa;?></td>
        		<td><p align="right"><?php echo "Rp. ".number_format($row->harga,2,',','.');?></p></td>
        	</tr>
        	<?php }?>
        	<tr>
        		<td colspan='3'><p align='right'>Total Transaksi</p></td>
        		<td><p align="right"><?php echo "Rp. ".number_format($total,2,',','.');?></p></td>
        	</tr>
        </table>
        <table width="100%" >
        	<tr>
        		<td colspan='4'><p align='center'><?php echo anchor("Kn/cetaklaporan/".$status."/".$id,"<button class='btn btn-primary'>CETAK LAPORAN</button>");?></p></td>
        	</tr>
        </table>
    <?php }?>
</body>
</html>
<script type="text/javascript">
    $(document).ready(function () {
        $("#siswa").chained("#kelas");
    });
</script>