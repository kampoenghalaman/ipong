<?php $id_nota = $this->uri->segment(3);?>
<script>
 //Inisiasi awal penggunaan jQuery
 $(document).ready(function(){
  //Pertama sembunyikan elemen class gambar
        $('.formnotadata').hide();        

  //Ketika elemen class tampil di klik maka elemen class gambar tampil
        $('#tampil').click(function(){
            $('.formnotadata').show();
            document.getElementById('id_notadata').value = "";
            document.getElementById('namaprodukjasa').value = "";
            document.getElementById('qty').value = "";
            document.getElementById('harga').value = "";
            document.getElementById('jumlah').value = "";
        });

  //Ketika elemen class sembunyi di klik maka elemen class gambar sembunyi
        $('#sembunyi').click(function(){
   //Sembunyikan elemen class gambar
        $('.formnotadata').hide();        
        });

        $('.ubah').click(function(){
            $('.formnotadata').show();
            var id_notadata = $(this).val();
            var att = id_notadata.split(',');
            document.getElementById('id_notadata').value = att[0];
            document.getElementById('namaprodukjasa').value = att[1];
            document.getElementById('qty').value = att[2];
            document.getElementById('harga').value = att[3];
            document.getElementById('jumlah').value = att[4];
            // $isi = $row->id_notadata.",".$row->namaprodukjasa.",".$row->qty.",".$row->harga.",".$row->jumlah;
        });
 });
 </script>
<?php 
$projas = $this->db->get_where('tbl_notadata', 'id_nota ='.$id_nota)->result();
$query = $this->db->query("SELECT sum(jumlah) as jml FROM tbl_notadata WHERE id_nota =".$id_nota."");
foreach($query->result() as $ttljml){
    $total = $ttljml->jml;
}

if ($isservice == '1'){ 
    $jenis = "Service";
    $header =  "<tr><td width='80'>No. Nota<br><br>Tanggal</td><td width='10'> : <br><br> : </td><td><input type='text' class='form-control' name='nomor' id='nomor' placeholder='nomor' value=".$nomor." readonly/><br><br><input type='text' class='form-control' name='tanggal' id='tanggalnota' placeholder='Tanggal' value=".$tanggal." /></td><td width='120'>Penerima Nota<br><br>Nama Teknisi</td><td width='10'> : <br><br> : </td><td>".$penerimanota."<br><br>".$namateknisi."</td></tr>
            <tr><td colspan='6'></td></tr>";
    $ktrg = "<table class='table table-bordered' border='1'><tr><td width='10%''>Keterangan</td><td><textarea name='keterangan' class='input-block-level' rows='3'>".$keterangan."</textarea></td></tr></table>";
    $judul = "<th>Service / Maintenance</th>";
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
        <h2 style="margin-top:0px">Nota <?php echo $jenis." | ".anchor(site_url('notapegawai/'),"<input type='button' class='btn btn-primary' value='Selesai'/>");?></h2>
        <form name="nota" action="<?php echo $action."/".$id_nota;?>" method="post">
        <table class="table">
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
                <td><input type="text" class="form-control" name="tanggal" id="tanggalnota" placeholder="Tanggal" value="<?php echo $tanggal; ?>" /></td>
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
                    <td><input type="hidden" name="namateknisi"  value="0"></td>
                    <td></td>
                    <td></td>
                <?php }?>
            </tr>
        <!-- </table> -->
        <!-- <table class="table" align="center"> -->
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td><input type="text" class="form-control" name="nomortelepon" id="nomortelepon" placeholder="Nomor Telepon" value="<?php echo $nomortelepon; ?>" /></td>
            <td>Nama Pegawai</td>
            <td>:</td>
            <td><input type="text" class="form-control" name="namapegawai" id="namapegawai" placeholder="Nama Pegawai" value="<?php echo $namapegawai; ?>" />
                <input type="hidden" name="totalbiaya"  value="0">
            </td>
        </tr>
        <tr>
            <td width="20" colspan="5"><p align="right"><i>Setelah Melakukan Perubahan Klik Update sebelum Klik Selesai untuk Menyelesaikan Update</i></p></td>
            <td width="30%">
                <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>" /> 
                <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
            </td>
        </tr>
        </table>
        </form>
        <!-- <table class="table" border="1">
           <?php echo $header;?>
        </table> -->
        <br>
        <table class="table table-bordered" border="1">
            <thead>
                <th width='10%'>Aksi Perubahan</th>
                <th>No</th>
                <?php echo $judul;?>
                <th width="5">Banyak</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </thead>
            <tbody>
            <?php 
                $no=1;
                foreach ($projas as $row){
                    $isi = $row->id_notadata.",".$row->namaprodukjasa.",".$row->qty.",".$row->harga.",".$row->jumlah;
                    echo "<tr>";
                    echo "<td><p align='center'><button class='' title='ubah tidak bisa untuk pegawai' value='".$isi."'><i class='icon-pencil'></i></button> | ".anchor(base_url('Notapegawai/updatenew/'.$row->id_nota),"<button><i class='icon-remove'></i></button>", array('title'=>'hapus tidak bisa untuk pegawai'))."</p></td>";
                    echo "<td>".$no++."</td>";
                    echo "<td>".$row->namaprodukjasa."</td>";
                    echo "<td>".$row->qty."</td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->harga,2,',','.')."</p></td>";
                    echo "<td>"."<p align='right'>Rp " . number_format($row->jumlah,2,',','.')."</p></td>";
                    echo "</tr>";
                }
            ?>
            <tr><td></td><td colspan="4">Total Biaya</td><td><?php echo "<p align='right'>Rp " . number_format($total,2,',','.'); ?></p></td></tr>
            </tbody>
        </table>

        <br>
        <?php echo $ktrg;?>
        <br>
        <!-- form tambah data nota -->
        <input type="button" class="btn btn-primary" id="tampil" value="Tambah Data"/>
        <div class="formnotadata">
            <form name="notadata" action="<?php echo base_url('notapegawai/simpandatanota/'.$id_nota);?>" method="post">
            <table width='40%' align='center'>
                <tr>
                    <td width="35%"><b>Nama Produk/Service</b></td>
                    <td width="5%">:</td><input type="hidden" name="id_notadata" id="id_notadata"/>
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
        
    </body>

<script src="<?php echo base_url('assets')?>/jquery.min.js"></script>
<script src="<?php echo base_url();?>/jquery.mask.min.js"></script>
<script >
    $("#qty,#harga").keyup(function () {
        $('#jumlah').val($('#qty').val() * $('#harga').val());
    });
</script>