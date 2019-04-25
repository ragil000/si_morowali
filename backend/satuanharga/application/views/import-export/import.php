
			<div class="min-height-200px">

				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Chart Akun</h4>
						</div>
						<div class="pull-right">
						</div>

					</div>
					<hr>
					<div style="text-align: center;font-size: 23px;">
							DAFTAR STANDAR SATUAN HARGA
						</div>
						<div style="text-align: center;font-size: 23px;">
							(SSH)
						</div>
						<a href="" class="btn btn-primary">Export Data SSH</a>
						<form action="<?=base_url('admin/laporan/save/ssh')?>" method="GET">
							<div class="row form-group">
							
								<div class="col-sm-4">
									<select class="form-control" name="kode1" id="kode-ssh1">
										<option value=""> -= Semua SSH 1 =- </option>
										
									</select>
								</div>
								<div class="col-sm-4">
									<select class="form-control" name="kode2" id="kode-ssh2">
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" name="tombol" value="Cetak" class="btn btn-primary">
								</div>
													
							</div>
						</form>	
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>