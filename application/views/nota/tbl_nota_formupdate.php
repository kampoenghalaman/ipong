    <body>
        <h2 style="margin-top:0px">Nota <?php echo $button ?> | <a href="<?php echo site_url('nota'); ?>" class="btn btn-default">Batal</a></h2>
        <form action="<?php echo $action; ?>" name="ipong" method="post">
        <?php if($button == "Services"){?>
    <div class="row">
        <div class="span3">
        <div class="form-group">
            <label for="int">Nomor Nota<?php echo form_error('nomor') ?></label>
            <input type="text" class="form-control" name="nomor" id="nomor" placeholder="nomor" value="<?php echo $nomor; ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="varchar">Penerima Nota <?php echo form_error('penerimanota') ?></label>
            <input type="text" class="form-control" name="penerimanota" id="penerimanota" placeholder="Penerima nota" value="<?php echo $penerimanota; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nomor Telepon <?php echo form_error('nomortelepon') ?></label>
            <input type="text" class="form-control" name="nomortelepon" id="nomortelepon" placeholder="nomor telepon" value="<?php echo $nomortelepon; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Nama Teknisi <?php echo form_error('namateknisi') ?></label>
            <select name="namateknisi" id="namateknisi">
                <option value="<?php echo $namateknisi; ?>" selected><?php echo $namateknisi; ?></option>
              <?php foreach($namapegserv as $row){
                    if($namateknisi != $row->nama){
                        echo "<option value='".$row->nama."'>".$row->nama."</option>";
                    }
                }?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Nama Pegawai <?php echo form_error('namapegawai') ?></label>
            <input type="text" class="form-control" name="namapegawai" id="namapegawai" placeholder="Nama pegawai" value="<?php echo strtoupper($this->session->userdata('username')); ?>" readonly/>
        </div>
        <div class="form-group">
            <label for="date">Tanggal Nota<?php echo form_error('tanggal') ?></label>
            <input type="text" class="form-control" name="tanggal" id="tanggalnota" placeholder="Tanggal" value="<?php echo date("Y-m-d"); ?>" />
            <input type="hidden" class="form-control" name="isservice" value="1" />
        </div>
        </div> <!--tutup span3-->
        <div class="span10">
            <div class="col-md-10 text-left">
            <div class="control-group input-group after-add-more">
                <h5>Data Nota</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="jasa[]" placeholder="Service/Maintenance" />
                    <input type="number" id="qty" class="form-control prc" name="qty[]" placeholder="QTY" />
                    <input type="number" id="harga" class="form-control prc" name="harga[]" placeholder="Harga" />
                    <input name="jumlah[]" type="text" readonly id="result"></output>
                    <button class="btn add-more" type="button"><i class="icon-plus"></i></button>
                </div>
                
            </div>
            <!-- DUPLIKAT -->
            <div class="copy hide">
                <div class="input-group control-group">
                    <div class="form-group">
                        <input type="text" class="form-control" name="jasa[]" placeholder="Service/Maintenance" />
                        <input type="number" id="qty" class="form-control prc" name="qty[]" placeholder="QTY" />
                        <input type="number" id="harga" class="form-control prc" name="harga[]" placeholder="Harga" />
                        <input name="jumlah[]" type="text"  id="result"></output>
                        <button class="btn btn-danger remove" type="button"><i class="icon-remove"></i></button>
                    </div>
                </div>
            </div> 
            <!-- DUPLIKAT -->
            </div> 
            <div class="col-md-10 text-left">
                <div class="form-group">
                <label for="varchar">Total Biaya</label>
                    <input type="text" class="input-block-level" name="totalbiaya" id="totalbiaya" placeholder="Total biaya" value="<?php echo $totalbiaya; ?>" />
                </div>
                <div class="form-group">
                <label for="varchar">Keterangan</label>
                    <textarea class="input-block-level" rows="3" name="keterangan" id="keterangan" placeholder="Keterangan"><?php echo $keterangan; ?></textarea>
                </div>
            </div>
        </div>
        </div><!--tutup row-->
        <?php }else{?>
        <div class="row">
        <div class="span4">
            <div class="form-group">
                <label for="int">Nomor Nota<?php echo form_error('nomor') ?></label>
                <input type="text" class="form-control" name="nomor" id="nomor" placeholder="Nomor" value="<?php echo $nomor; ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="varchar">Penerima Nota <?php echo form_error('penerimanota') ?></label>
                <input type="text" class="form-control" name="penerimanota" id="penerimanota" placeholder="Penerima nota" value="<?php echo $penerimanota; ?>" />
            </div>
            <div class="form-group">
                <label for="varchar">Nomor Telepon <?php echo form_error('nomortelepon') ?></label>
                <input type="text" class="form-control" name="nomortelepon" id="nomortelepon" placeholder="nomor telepon" value="<?php echo $nomortelepon; ?>" />
            </div>
            <div class="form-group">
                <!-- <label for="varchar">Namateknisi <?php echo form_error('namateknisi') ?></label> -->
                <input type="hidden" class="form-control" name="namateknisi" id="namateknisi" placeholder="Nama teknisi" value="0" />
            </div>
            <div class="form-group">
                <label for="varchar">Nama Pegawai <?php echo form_error('namapegawai') ?></label>
                <input type="text" class="form-control" name="namapegawai" id="namapegawai" placeholder="Nama pegawai" value="<?php echo strtoupper($this->session->userdata('username')); ?>" readonly/>
            </div>
            <div class="form-group">
                <label for="date">Tanggal Nota<?php echo form_error('tanggal') ?></label>
                <input type="text" class="form-control" name="tanggal" id="tanggalnota" placeholder="Tanggal" value="<?php echo date("Y-m-d"); ?>" />
                <input type="hidden" class="form-control" name="isservice" value="0" />
            </div>
        </div> <!--tutup span4-->
        <div class="span10">
            <div class="col-md-10 text-left">
            <div class="control-group input-group after-add-more">
                <h5>Data Nota</h5>
                <div class="form-group">
                    <input type="text" class="form-control" name="jasa[]" placeholder="Produk" />
                    <input type="number" id="qty" class="form-control prc" name="qty[]" placeholder="QTY" />
                    <input type="number" id="harga" class="form-control prc" name="harga[]" placeholder="Harga" />
                    <input name="jumlah[]" type="text" readonly id="result"></output>
                    <button class="btn add-more" type="button"><i class="icon-plus"></i></button>
                </div>
                
            </div>
            <!-- DUPLIKAT -->
            <div class="copy hide">
                <div class="input-group control-group">
                    <div class="form-group">
                        <input type="text" class="form-control" name="jasa[]" placeholder="Produk" />
                        <input type="number" id="qty" class="form-control prc" name="qty[]" placeholder="QTY" />
                        <input type="number" id="harga" class="form-control prc" name="harga[]" placeholder="Harga" />
                        <input name="jumlah[]" type="text"  id="result"></output>
                        <button class="btn btn-danger remove" type="button"><i class="icon-remove"></i></button>
                    </div>
                </div>
            </div> 
            <!-- DUPLIKAT -->
            </div> 
            <div class="col-md-10 text-left">
                <div class="form-group">
                <label for="int">Total Biaya <?php echo form_error('totalbiaya') ?></label>
                    <input type="text" class="input-block-level" name="totalbiaya" id="totalbiaya" placeholder="Total biaya" value="<?php echo $totalbiaya; ?>" />
                </div>
            </div>
        </div>
        </div><!--tutup row-->
        <?php }?>
        <input type="hidden" name="id_nota" value="<?php echo $id_nota; ?>" /> 
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
        <a href="<?php echo site_url('nota') ?>" class="btn btn-default">Cancel</a>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
      $(".add-more").click(function(){ 
          var html = $(".copy").html();
          $(".after-add-more").after(html);
      });
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
    });
</script>
<script src="<?php echo base_url('assets')?>/jquery.min.js"></script>
<script src="<?php echo base_url();?>/jquery.mask.min.js"></script>
<script >
    $("#qty,#harga").keyup(function () {
        $('#result').val($('#qty').val() * $('#harga').val());
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#harga').mask('000.000.000', {reverse: true});
    });
</script>
</body>