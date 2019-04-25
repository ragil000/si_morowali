
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
					<?php if($menuLevel == 1){ ?>
						<div style="text-align: center;font-size: 23px;">
							DAFTAR STANDAR SATUAN HARGA
						</div>
						<div style="text-align: center;font-size: 23px;">
							(SSH)
						</div>
						<form action="<?=base_url('admin/laporan/save/ssh')?>" method="GET">
							<div class="row form-group">
							
								<div class="col-sm-4">
									<select class="form-control" name="kode1" id="kode-ssh1">
										<option> -= Semua SSH 1 =- </option>
										<?php 
										$ssh1 = $this->SaveModel->getSsh(1,'1');
										foreach ($ssh1 as $key) {?>
										<option value="<?=$key['Kd_Ssh1']?>"><?=$key['Nm_Ssh1']?></option>
										<?php } ?>
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


					<?php }else if($menuLevel == 2){ ?>
						<div style="text-align: center;font-size: 23px;">
							HARGA SATUAN POKOK KEGIATAN
						</div>
						<div style="text-align: center;font-size: 23px;">
							(HSPK)
						</div>
						<form action="<?=base_url('admin/laporan/save/hspk')?>" method="GET">
							<div class="row form-group">
							
								<div class="col-sm-4">
									<select class="form-control" name="kode1" id="kode-ssh1">
										<option> -= Semua HSPK 1 =- </option>
										<?php 
										$ssh1 = $this->SaveModel->getHspk(1,'1');
										foreach ($ssh1 as $key) {?>
										<option value="<?=$key['Kd_Hspk1']?>"><?=$key['Nm_Hspk1']?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" name="tombol" value="Cetak" class="btn btn-primary">
								</div>
													
							</div>
						</form>	


					<?php }else if($menuLevel == 3){ ?>
						<div style="text-align: center;font-size: 23px;">
							ANALISA STANDART BELANJA
						</div>
						<div style="text-align: center;font-size: 23px;">
							(ASB)
						</div>
						<form action="<?=base_url('admin/laporan/save/asb')?>" method="GET">
							<div class="row form-group">
							
								<div class="col-sm-4">
									<select class="form-control" name="kode1" id="kode-ssh1">
										<option> -= Semua ASB 1 =- </option>
										<?php 
										$ssh1 = $this->SaveModel->getAsb(1,'1');
										foreach ($ssh1 as $key) {?>
										<option value="<?=$key['Kd_Asb1']?>"><?=$key['Nm_Asb1']?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" name="tombol" value="Cetak" class="btn btn-primary">
								</div>
													
							</div>
						</form>	


					<?php }else if($menuLevel == 4){ ?>
						<div style="text-align: center;font-size: 23px;">
							ASET
						</div>
						<form action="<?=base_url('admin/laporan/save/aset')?>" method="GET">
							<div class="row form-group">
							
								<div class="col-sm-4">
									<select class="form-control" name="kode1" id="kode-ssh1">
										<option> -= Semua ASET 1 =- </option>
										<?php 
										$ssh1 = $this->SaveModel->getAset(1,'1');
										foreach ($ssh1 as $key) {?>
										<option value="<?=$key['Kd_Aset1']?>"><?=$key['Nm_Aset1']?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-sm-3">
									<input type="submit" name="tombol" value="Cetak" class="btn btn-primary">
								</div>
													
							</div>
						</form>	


					<?php } ?>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>

