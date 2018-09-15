<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_nota Read</h2>
        <table class="table">
	    <tr><td>Nomor</td><td><?php echo $nomor; ?></td></tr>
	    <tr><td>Penerimanota</td><td><?php echo $penerimanota; ?></td></tr>
	    <tr><td>Namateknisi</td><td><?php echo $namateknisi; ?></td></tr>
	    <tr><td>Namapegawai</td><td><?php echo $namapegawai; ?></td></tr>
	    <tr><td>Tanggal</td><td><?php echo $tanggal; ?></td></tr>
	    <tr><td>Totalbiaya</td><td><?php echo $totalbiaya; ?></td></tr>
	    <tr><td>Keterangan</td><td><?php echo $keterangan; ?></td></tr>
	    <tr><td>Isservice</td><td><?php echo $isservice; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('nota') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>