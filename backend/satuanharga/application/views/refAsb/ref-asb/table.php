
			<div class="min-height-200px">
				<?php if($pesan != ''){ ?>
				<div class="alert alert-success alert-block hide">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=$pesan?></strong>
				 </div>
				 <?php } ?>


				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Standard Satuan Harga Zona <?=$zona?></h4>
						</div>


					</div>
					<hr>


					<div class="clearfix mb-10">
						<div class="pull-left btn-group btn-group2">
							<a class=	"<?=($zona == 1) ? 'btn btn-info disabled' : 'btn btn-info';?>"
								href="<?=base_url()?>admin/ssh/page-<?=$page?>?search=<?=$search?>&zona=1">Zona 1</a>
							<a class= "<?=($zona == 2) ? 'btn btn-info disabled' : 'btn btn-info';?>"
							  href="<?=base_url()?>admin/ssh/page-<?=$page?>?search=<?=$search?>&zona=2">Zona 2</a>
							<a class= "<?=($zona == 3) ? 'btn btn-info disabled' : 'btn btn-info';?>"
							  href="<?=base_url()?>admin/ssh/page-<?=$page?>?search=<?=$search?>&zona=3">Zona 3</a>
							<a class= "<?=($zona == 4) ? 'btn btn-info disabled' : 'btn btn-info';?>"
							  href="<?=base_url()?>admin/ssh/page-<?=$page?>?search=<?=$search?>&zona=4">Zona 4</a>
						</div>

						<div class="pull-left">
							&nbsp;
							<a class="btn btn-primary" data-uid="22" href="javascript:void(0)" data-toggle="modal" data-target="#modal-ssh" onclick="createSsh(this)"><i class="fa fa-plus"></i> Tambah
							</a>
						</div>
						<div class="pull-right">
							<form action="<?=base_url()?>admin/ssh/page-1">
								<div class="form-group has-success">
									<input type="text" class="form-control form-control-success" name="search" placeholder="Pencarian Nama Barang" value="<?=$search?>" size="25">
								</div>
								<input type="hidden" class="form-control" name="zona" value="<?=$zona?>">
							</form>
						</div>


					</div>

					<div class="row">

						<table class="pd-20 table table-striped table-hover ">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Kode SSH</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Harga Zona <?=$zona?></th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($ssh as $data) {
										echo "
								<tr>
									<td class='table-plus'>".$data['Kd_Ssh1'].".".$data['Kd_Ssh2'].".".$data['Kd_Ssh3'].".".$data['Kd_Ssh4'].".".$data['Kd_Ssh5'].".".$data['Kd_Ssh6']."</td>
									<td>".$data['Nama_Barang']."</td>
									<td>".$data['Satuan']."</td>
									<td>".$this->fungsi->convert_to_rupiah($data['harga_zona'.$zona])."</td>
									<td>

										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle btn-sm' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right '>
												<a class='dropdown-item'  data-uid='".$data['Kd_Ssh1']."-".$data['Kd_Ssh2']."-".$data['Kd_Ssh3']."-".$data['Kd_Ssh4']."-".$data['Kd_Ssh5']."-".$data['Kd_Ssh6']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='viewSsh(this)'><i class='fa fa-eye'></i> View</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1']."-".$data['Kd_Ssh2']."-".$data['Kd_Ssh3']."-".$data['Kd_Ssh4']."-".$data['Kd_Ssh5']."-".$data['Kd_Ssh6']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-ssh'  onclick='updateSsh(this)'><i class='fa fa-pencil'></i> Edit</a>

												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1']."-".$data['Kd_Ssh2']."-".$data['Kd_Ssh3']."-".$data['Kd_Ssh4']."-".$data['Kd_Ssh5']."-".$data['Kd_Ssh6']."' href='javascript:void(0)' onclick='deleteSsh(this)'><i class='fa fa-trash'></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
										";
									}
								?>

							</tbody>
						</table>

		
</div>




<!-- modal ssh -->
			<div class="modal fade bs-example-modal-lg" id="modal-ssh" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<form id="sshForm" method="POST" action="" enctype="multipart/form-data" >
							<div class="modal-header">
								<h4 class="modal-title" id="view-title"></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								<input type="hidden" id="kode-ssh" name="kodeSsh" value="" required autofocus>
								<div class="form-group row">
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 1</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh1" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 2</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh2" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 3</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh3" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 4</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh4" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 5</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh5" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Kode SSH 6</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="kode-ssh6" required autofocus disabled>
											</select>
										</div>
									</div>

								</div>
								<div class="form-group row">
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Nama Barang</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="nama-barang" name="namaBarang" required autofocus disabled>
										</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Satuan</label>
										<div class="col-sm-12">
											<select class="form-control" id="satuan" name="satuan" required autofocus disabled>
												<option>Pilih Satuan</option>
												<?php foreach ($satuan as $dataSatuan) {
													echo "<option value='".$dataSatuan['Kd_Satuan']."'>".$dataSatuan['Uraian']."</option>";
												} ?>
											</select>
										</div>
									</div>

									<div class="col-12">
										<label class="col-sm-12 col-form-label">Harga Zona <?=$zona?></label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="harga-zona-<?=$zona?>" name="hargaZona<?=$zona?>" onchange="gantiRupiah(this)" required autofocus disabled />
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input class="btn btn-primary" id="ssh-submit" type="submit" name="tombol" value="Ssh">
								<button type="button" id="submit" class="btn btn-secondary text-white" data-dismiss="modal">Keluar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
<!-- ./modal -->

<!-- modal -->
			<div class="modal fade bs-example-modal-lg" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">

							<div class="modal-header">
								<h4 class="modal-title" >Tampil SSH Zona <?=$zona?></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								<div class="pd-20 bg-white  mb-30">
									<div class="row">
										<table class="pd-20 table table-striped table-hover">
											<tbody>
												<tr>
													<td>Kode SSH</td>
													<td id="view-kode-ssh"></td>
												</tr>
												<tr>
													<td>Kode SSH 1</td>
													<td id="view-kode-ssh1"></td>
												</tr>
												<tr>
													<td>Kode SSH 2</td>
													<td id="view-kode-ssh2"></td>
												</tr>
												<tr>
													<td>Kode SSH 3</td>
													<td id="view-kode-ssh3"></td>
												</tr>
												<tr>
													<td>Kode SSH 4</td>
													<td id="view-kode-ssh4"></td>
												</tr>
												<tr>
													<td>Kode SSH 5</td>
													<td id="view-kode-ssh5"></td>
												</tr>
												<tr>
													<td>Kode SSH 6</td>
													<td id="view-kode-ssh6"></td>
												</tr>
												<tr>
													<td>Nama Barang</td>
													<td id="view-barang"></td>
												</tr>
												<tr>
													<td>Satuan</td>
													<td id="view-satuan"></td>
												</tr>
												<tr>
													<td>Harga</td>
													<td id="view-harga"></td>
												</tr>
											</tbody>

										</table>
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" id="submit" class="btn btn-secondary text-white"  data-dismiss="modal">Keluar</button>
							</div>


					</div>
				</div>
			</div>
<!-- ./modal -->
