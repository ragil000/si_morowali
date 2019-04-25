
			<div class="min-height-200px">

				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Export</h4>
						</div>
						<div class="pull-right">
						</div>

					</div>
					<hr>
						<a href="<?=base_url('admin/export')?>/ssh" class="btn btn-primary">Export Data SSH</a>
						<a href="<?=base_url('admin/export')?>/hspk" class="btn btn-primary">Export Data HSPK</a>
						<a href="<?=base_url('admin/export')?>/asb" class="btn btn-primary">Export Data ASB</a>
					</div>
				</div>
				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Import</h4>
						</div>
						<div class="pull-right">
						</div>

					</div>
					<hr>
						<form action="<?=base_url('admin/import')?>" method="POST" enctype="multipart/form-data">
							<div class="form-group row">
								
								
								
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">File SSH</label>
										<input type="checkbox" name="hapusSsh" value="hapus" checked> Hapus SSH<br>
										<div class="col-sm-12">
											<input type="file" name="ssh" class="form-control-file form-control height-auto">
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">File HSPK</label>
										<input type="checkbox" name="hapusHspk" value="hapus" checked> Hapus HSPK<br>
										<div class="col-sm-12">
											<div class="col-sm-12">
											<input type="file" name="hspk" class="form-control-file form-control height-auto">
										</div>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">File ASB</label>
										<input type="checkbox" name="hapusAsb" value="hapus" checked> Hapus ASB<br>
										<div class="col-sm-12">
											<div class="col-sm-12">
											<input type="file" name="asb" class="form-control-file form-control height-auto">
										</div>
										</div>
									</div>
									
									
								</div>
								<input type="submit" name="tombol" class="btn btn-primary" value="Import">
						</form>	
						<div>
							<?php if(@$error) echo "<pre>";print_r($error);echo "</pre>"; ?>
						</div>
					</div>
				<!-- Export Datatable End -->
			</div>


				


			