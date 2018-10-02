<script>
 //Inisiasi awal penggunaan jQuery
 $(document).ready(function(){
  //Pertama sembunyikan elemen class gambar
        $('.formnotadata').hide();        

  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('#tampil').click(function(){
   $('.formnotadata').show();
        });

  //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi
        $('#sembunyi').click(function(){
   //Sembunyikan elemen class gambar
   $('.formnotadata').hide();        
        });
 });
 </script>
<?php 
$id_nota = $this->uri->segment(3);
$projas = $this->db->get_where('tbl_notadata', 'id_nota ='.$id_nota)->result();
$query = $this->db->query("SELECT sum(jumlah) as jml FROM tbl_notadata WHERE id_nota =".$id_nota."");
foreach($query->result() as $ttljml){
    $total = $ttljml->jml;
}

if ($isservice == '1'){ 
    $jenis = "Servise";
    $header =  "<tr><td width='80'>No. Nota<br><br>Tanggal</td><td width='10'> : <br><br> : </td><td><input type='text' class='form-control' name='nomor' id='nomor' placeholder='nomor' value=".$nomor." readonly/><br><br><input type='text' class='form-control' name='tanggal' id='tanggalnota' placeholder='Tanggal' value=".date("Y-m-d")." /></td><td width='120'>Penerima Nota<br><br>Nama Teknisi</td><td width='10'> : <br><br> : </td><td>".$penerimanota."<br><br>".$namateknisi."</td></tr>
            <tr><td colspan='6'></td></tr>";
    $ktrg = "<table class='table table-bordered' border='1'><tr><td width='10%''>Keterangan</td><td>".$keterangan."</td></tr></table>";
    $judul = "<th>Servise / Maintenance</th>";
 }else{
    $jenis = "Penjualan";
    $teknisi= "" ;
    $header = "<tr><td width='80'>No. Nota<br><br>Tanggal</td><td width='10'> : <br><br> : </td><td><input type='text' class='form-control' name='nomor' id='nomor' placeholder='nomor' value=".$nomor." readonly/><br><br>".date('d M Y', strtotime($tanggal))."</td><td width='120'>Penerima Nota</td><td width='10'> : </td><td>".$penerimanota."</td></tr>
            <tr><td colspan='6'></td></tr>";
    $ktrg = "";
    $judul = "<th>Nama Produk</th>";
}
?>

    <body>
        <h2 style="margin-top:0px">Nota <?php echo $jenis;?></h2>
        <table class="table" >
            <tr>
                <td>No.Nota</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="nomor" id="nomor" placeholder="nomor" value="<?php echo $nomor; ?>" readonly/></td>
                <td>Penerima Nota</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="penerimanota" id="penerimanota" placeholder="Penerima nota" value="<?php echo $penerimanota; ?>" /></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td><input type="text" class="form-control" name="tanggal" id="tanggalnota" placeholder="Tanggal" value="<?php echo date("Y-m-d"); ?>" /></td>
                <?php if($isservice == 1){ ?>
                <td>Nama Teknisi</td>
                <td>:</td>
                <td>
                    <select name="namateknisi" id="namateknisi">
                    <option value="<?php echo $namateknisi; ?>" selected><?php echo $namateknisi; ?></option>
                      <?php foreach($namapegserv as $row){
                            if($namateknisi != $row->nama){
                                echo "<option value='".$row->nama."'>".$row->nama."</option>";
                            }
                        }?>
                    </select>
                </td>
                <?php }else{ ?>
                    <td></td>
                    <td></td>
                    <td></td>
                <?php }?>
                
                </tr>
        </table>
        <!-- <table class="table" border="1">
           <?php echo $header;?>
        </table> -->
        <br>
        <table class="table table-bordered" border="1">
            <thead>
                <th width='10%'>Aksi Perubahan</th>
                <th>No</th>
                <?php echo $judul;?>
                <th>Banyak</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
            <?php 
                $no=1;
                foreach ($projas as $row){
                    echo "<tr>";
                    echo "<td>".anchor(base_url('Nota/updatedatanota/'.$row->id_notadata),"ubah")." | ".anchor(base_url('Nota/hapusdatanota/'.$row->id_notadata.$row->id_nota),"hapus")."</td>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row->namaprodukjasa."</td>";
                    echo "<td>".$row->qty."</td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->harga,2,',','.')."</p></td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->jumlah,2,',','.')."</p></td>";
                    echo "</tr>";
                }
            ?>
            <tr><td></td><td colspan="4">Totalbiaya</td><td><?php echo "<p align='right'>Rp " . number_format($total,2,',','.'); ?></p></td></tr>
            </tbody>
        </table>
        <br>
        <?php echo $ktrg;?>
        <br>
        <!-- form tambah data nota -->
        <input type="button" class="btn btn-primary" id="tampil" value="Tambah Data"/>
        <div class="formnotadata">
            <form name="notadata" action="<?php echo base_url('nota/simpandatanota/'.$id_nota);?>" method="post">
            <table width='40%' align='center'>
                <tr>
                    <td width="35%"><b>Nama Produk/Service</b></td>
                    <td width="5%">:</td>
                    <td width="60%"><input type="text" class="input-block-level" name="namaprodukjasa" id="namaprodukjasa" placeholder="Produk/Service" value="<?php echo $namaprodukjasa; ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Banyak</b></td>
                    <td>:</td>
                    <td><input type="number" class="input-block-level" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Harga</b></td>
                    <td>:</td>
                    <td><input type="number" class="input-block-level" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Jumlah</b></td>
                    <td>:</td>
                    <td><input type="number" class="input-block-level" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" readonly/></td>
                </tr>
                <tr>
                    <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>" /> 
                    <td colspan="3"><p align="right"><button type="submit" class="btn btn-primary">Simpan Data Nota</button>  <input type="button" class="btn btn-primary" id="sembunyi" value="Cancel"/></p></td>
                </tr>
            </table>
            </form>
        </div>
        <!-- form tambah data nota -->
        <br>
        <br>
        <br>
        <table class="table" align="center">
        <?php $kontak = "<input type='text' class='form-control' name='nomortelepon' id='nomortelepon' placeholder='nomor telepon' value=".$nomortelepon." />";
        $np = "<input type='text' class='form-control' name='namapegawai' id='namapegawai' placeholder='Nama pegawai' value=". strtoupper($this->session->userdata('username'))." readonly/>";
        ?>
            <tr><td width="600">Tanda Terima,<br><br><br><b><?php echo $penerimanota." / ".$kontak; ?></b></td><td> </td><td></td><td width="600">Hormat Kami,<br><br><br><b><?php echo $np; ?></b></td><td></td></tr>
            <tr>
                <td width="20" colspan="4"></td>
                <td width="30%">
                    <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>" /> 
                    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                    <a href="<?php echo site_url('nota') ?>" class="btn btn-default">Cancel</a>
                </td>
            </tr>
        </table>
    </body>

<script src="<?php echo base_url('assets')?>/jquery.min.js"></script>
<script src="<?php echo base_url();?>/jquery.mask.min.js"></script>
<script >
    $("#qty,#harga").keyup(function () {
        $('#jumlah').val($('#qty').val() * $('#harga').val());
    });
</script>