<div class="row-fluid">
					<div class="span12">
						
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Edit Pegawai Service</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
								</div>
							</div>
							<div class="portlet-body form">
								
								<div id="form_sample_2" class="form-horizontal">
								
									<?php echo form_open_multipart('pegawai/pegservice_update/','class="form-horizontal"'); ?>
									<input type="hidden" name='id_peg_service' value="<?php echo $id_peg_service;?>"> 
									<div class="control-group">
										
									<div class="control-group">
										<label class="control-label">Nama Pegawai</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" class="span6 m-wrap" value="<?php echo $nama;?>" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Alamat</label>
										<div class="controls">
											<input type="text" name="alamat" id="alamat" class="span6 m-wrap" value="<?php echo $alamat;?>" />
										</div>
									</div>

									<div class="control-group">
										<label class="control-label">Phone</label>
										<div class="controls">
											<input type="text" name="tlpn" id="tlpn" class="span6 m-wrap" value="<?php echo $tlpn;?>" />
										</div>
									</div>

									

									
									<div class="form-actions">
										<button type="submit" id="simpan" class="btn green"><i class="icon-ok"></i> Update</button>
										<a href="<?php echo base_url();?>pegawai/pegservice" class="btn white"><i class="icon-long-arrow-left"></i> Kembali</a>
										
									</div>
									<?php echo form_close(); ?>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>


