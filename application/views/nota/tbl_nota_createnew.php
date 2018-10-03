<div class="row-fluid">
                    <div class="span12">
                        <!-- BEGIN VALIDATION STATES-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption"><i class="icon-reorder"></i>Buat Nota <?php echo $button;?></div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse"></a>
                                    
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <!-- BEGIN FORM-->
                                <?php echo form_open_multipart($action,'class="form-horizontal"'); ?>
                                <div id="form_sample_2" class="form-horizontal">
                                <input type="hidden" name="id_nota" id="id_nota" value="">
                                <input type="hidden" name="totalbiaya"  value="0">
                                <input type="hidden" name="keterangan"  value="">
                                <table class="table" >
                                    <tr>
                                        <td>Nomor Nota</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="nomor" id="nomor" placeholder="nomor" value="<?php echo $nomor; ?>" readonly/></td>
                                        <td>No Telepon</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="nomortelepon" id="nomortelepon" placeholder="Nomor Telepon" value="<?php echo $nomortelepon; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="tanggal" id="tanggalnota" placeholder="Tanggal" value="<?php echo date("Y-m-d"); ?>" /></td>
                                        <?php if($this->uri->segment(3) == 1){ ?>
                                        <td>Nama Teknisi</td>
                                        <td>:</td>
                                        <td>
                                            <select name="namateknisi" id="namateknisi" value="<?php echo $namateknisi; ?>">
                                                <option value="" selected>Pilih Teknisi</option>
                                              <?php foreach($namapegserv as $row){
                                                    echo "<option value='".$row->nama."'>".$row->nama."</option>";
                                                }?>
                                            </select>
                                        </td>

                                    <?php }else{ ?>
                                        <td><input type="hidden" name="namateknisi"  value="0"></td>
                                        <td></td>
                                        <td></td>
                                    <?php }?>
                                    </tr>
                                    <tr>
                                        <td>Penerima Nota</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="penerimanota" id="penerimanota" placeholder="Penerima nota" value="<?php echo $penerimanota; ?>" /></td>
                                        <td>Nama Pegawai</td>
                                        <td>:</td>
                                        <td><input type="text" class="form-control" name="namapegawai" id="namapegawai" placeholder="Nama pegawai" value="<?php echo strtoupper($this->session->userdata('username')); ?>" readonly/></td>
                                    </tr>
                                </table>
                                    
                                    

                                    

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary btn green" onclick="return confirm('Setelah Berhasil, Lanjutkan dengan Read Nota Kemudian Update untuk mengisi data nota !')"><?php echo $button ?></button> 
                                        <a href="<?php echo site_url('nota') ?>" class="btn btn-default btn green">Cancel</a>
                                    </div>
                                </div><?php echo form_close(); ?>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END VALIDATION STATES-->
                    </div>
                </div>


<script type="text/javascript">
    
    $(document).ready(function(){

        $("#update").click(function(){

            

            var id_sosial_media = $("#id_sosial_media").val();
            var tw = $("#tw").val();
            var fb = $("#fb").val();
            var gp = $("#gp").val();
            
                    $.ajax({
                    type:"POST",
                    url:"<?php echo base_url();?>adminweb/sosial_media_simpan",
                    data:"id_sosial_media="+id_sosial_media+"&tw="+tw+"&fb="+fb+"&gp="+gp,
                    success:function(data) {
                        $("#box").show();
                        

                    }
                });
            

            
        });

    });
</script>