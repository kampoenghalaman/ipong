<div class="row-fluid">
					<div class="span12">
						<!-- BEGIN VALIDATION STATES-->
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption"><i class="icon-reorder"></i>Add Pegawai Service</div>
								<div class="tools">
									<a href="javascript:;" class="collapse"></a>
									
								</div>
							</div>
							<div class="portlet-body form">
								<!-- BEGIN FORM-->
								<?php if(validation_errors()) { ?>
								<div class="alert alert-block alert-error">
								  <button type="button" class="close" data-dismiss="alert">×</button>
									<?php echo validation_errors(); ?>
								</div>
								<?php 
								} 
								?>

								<div id="form_sample_2" class="form-horizontal">
								
									<?php echo form_open_multipart('pegawai/pegservice_simpan/','class="form-horizontal"'); ?>
								
									<div class="control-group">
										<label class="control-label">Nama Pegawai service</label>
										<div class="controls">
											<input type="text" name="nama" id="nama" class="span6 m-wrap" placeholder="Nama Admin..." />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Alamat</label>
										<div class="controls">
											<textarea name="alamat">Enter text here...</textarea> 
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Phone</label>
										<div class="controls">
											<input type="text" name="tlpn" id="tlpn" class="span6 m-wrap" placeholder="Phone..." />
										</div>
									</div>
									
									
									
									<div class="form-actions">
										<button type="submit" id="simpan" class="btn green"><i class="icon-ok"></i> Simpan</button>
										<a href="<?php echo base_url();?>pegawai/pegservice" class="btn white"><i class="icon-long-arrow-left"></i> Kembali</a>
										
									</div>
									<?php echo form_close(); ?>
								</div>
								
							</div>
						</div>
						
					</div>
				</div>


