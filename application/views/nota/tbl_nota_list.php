    <body>
        <h2 style="margin-top:0px">Daftar Nota | 
                <div class="btn-group">
                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                    Buat Nota
                    <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a href="<?php echo base_url('nota/create/0');?>">Pembelian Produk</a></li>
                    <li><a href="<?php echo base_url('nota/create/1');?>">Service</a></li>
                  </ul>
                </div>
        </h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('nota/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('nota'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nomor</th>
		<th>Penerima Nota</th>
		<!-- <th>Nama Teknisi</th> -->
		<!-- <th>Namapegawai</th> -->
		<th>Tanggal</th>
		<!-- <th>Totalbiaya</th> -->
		<!-- <th>Keterangan</th> -->
		<th>Jenis Nota</th>
		<th>Action</th>
            </tr><?php
            foreach ($nota_data as $nota)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $nota->nomor ?></td>
			<td><?php echo $nota->penerimanota ?></td>
			<!-- <td><?php echo $nota->namateknisi ?></td> -->
			<!-- <td><?php echo $nota->namapegawai ?></td> -->
			<td><?php echo date('d M Y', strtotime($nota->tanggal)) ?></td>
			<!-- <td><?php echo $nota->totalbiaya ?></td> -->
			<!-- <td><?php echo $nota->keterangan ?></td> -->
			<td><?php if($nota->isservice == 1){echo "Service";}else{echo "Pembelian Produk";}  ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('nota/read/'.$nota->id_nota),'Read'); 
				echo ' | '; 
				// echo anchor(site_url('nota/updatenew/'.$nota->id_nota),'Update'); 
				// echo ' | '; 
				echo anchor(site_url('nota/delete/'.$nota->id_nota),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
                echo ' | '; 
                echo anchor(base_url('cetaknota/index/'.$nota->id_nota),'Cetak','onclick="javasciprt: return confirm(\'Cetak Nota ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
            <div class="row">
                <div class="col-md-6 text-right">
                    <?php echo $pagination; ?>
                </div>
            </div>
        
    </body>
    