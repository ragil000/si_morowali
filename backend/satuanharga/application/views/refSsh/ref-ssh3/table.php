
			<div class="min-height-200px">
				<?php if(@$pesan &&  $pesan != ''){ ?>
				<div class="alert alert-success alert-block hide">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=$pesan?></strong>
				 </div>
				 <?php } ?>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Kode SSH 3</h4>
						</div>
					</div>
					<hr>
					<div class="clearfix mb-10">
						<div class="pull-right">
							<form action="<?=base_url()?>admin/ssh3/page-1">
								<div class="form-group has-success">
									<input type="text" class="form-control form-control-success" name="search" placeholder="Pencarian Uraian SSH 3" value="<?=$search?>" size="25">
								</div>
							</form>
						</div>
						<div class="pull-left">
							<a class="btn btn-primary" data-uid="3" href="javascript:void(0)" data-toggle="modal" data-target="#modal-ssh"  onclick="createSsh(this)">
								<i class="fa fa-plus"></i> Tambah
							</a>
						</div>
					</div>

					<div class="row">
						<table class="table table-striped table-hover ">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Kode SSH 1</th>  <?php //=$nomor?>
									<th>Kode SSH 2</th>
									<th>Kode SSH 3</th>
									<th>Uraian SSH 3</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($ssh as $data) {
										echo "
								<tr>
									<td class='table-plus'>".$data['Kd_Ssh1']."</td>
									<td>".$data['Kd_Ssh2']."</td>
									<td>".$data['Kd_Ssh1'].".".$data['Kd_Ssh2'].".".$data['Kd_Ssh3']."</td>
									<td>".$data['Nm_Ssh3']."</td>
									<td>
										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle btn-sm' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											  <div class='dropdown-menu dropdown-menu-right '>
												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1'].".".$data['Kd_Ssh2'].".".$data['Kd_Ssh3']."'
												data-str='".$data['Nm_Ssh1'].":".$data['Nm_Ssh2'].":".$data['Nm_Ssh3']."'
												href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='viewSsh(this)'><i class='fa fa-eye'></i> View</a>

												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1'].":".$data['Kd_Ssh2'].":".$data['Kd_Ssh3']."'
												data-str='".$data['Nm_Ssh1'].":".$data['Nm_Ssh2'].":".$data['Nm_Ssh3']."'
												href='javascript:void(0)' data-toggle='modal' data-target='#modal-ssh'  onclick='updateSsh(this)'><i class='fa fa-pencil'></i> Edit</a>

												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1'].":".$data['Kd_Ssh2'].":".$data['Kd_Ssh3']."' data-str='".$data['Nm_Ssh3']."'
												href='javascript:void(0)' onclick='deleteSsh(this)'><i class='fa fa-trash'></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
										";}
								?>

							</tbody>
						</table>
										<!-- include novigator -->

				<!-- Export Datatable End -->
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
								<div class="form-group row">
									<div class="col-6">
										<input type="hidden" id="id-ssh" name="id_ssh" value="">           <!-- variabel -->
										<label class="col-sm-12 col-form-label">Nama SSH 1</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh1" name="kode_ssh1" required autofocus>  <!-- variabel -->
											</select>
										</div>
									</div>
									<div class="col-6">
										<label class="col-sm-12 col-form-label">Nama SSH 2</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh2" name="kode_ssh2" required autofocus disabled>   <!-- variabel -->
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Kode SSH 3</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="kode-ssh3" name="kode_ssh3" required autofocus disabled> <!-- var -->
											</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Uraian SSH 3</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="nm-ssh3" name="nm_ssh3" required autofocus disabled> <!-- variabel -->
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

<!-- modal view-->
			<div class="modal fade bs-example-modal-lg" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">

						<div class="modal-header">
							<h4 class="modal-title" >Tampil Kode SSH 3</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body" id="sshData">
							<div class="pd-20 bg-white  mb-30">
								<div class="row">
									<table class="pd-20 table table-striped table-hover">
										<tbody>
											<tr>
												<td>Kode SSH </td>
												<td id="view-kode-ssh"></td>
											</tr>
											<tr>
												<td>Uraian SSH 1</td>
												<td id="view-uraian-ssh1"></td>
											</tr>
											<tr>
												<td>Uraian SSH 2</td>
												<td id="view-uraian-ssh2"></td>
											</tr>
											<tr>
												<td>Uraian SSH 3</td>
												<td id="view-uraian-ssh3"></td>
											</tr>
										</tbody>
									</table>
									<hr>
									<table class="pd-20 table table-striped table-hover"  id="tableTampil">
										<thead>
											<tr>
												<th>Kode Ssh 4</th>
												<th>Uraian</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
							<div id="wait" style="display:none;width:100%;height:100%;position:absolute;top:0;left:0;padding:2px; background-color: #ffffff;" ><img src='<?=base_url()?>public/img/loading.gif' width="200" height="200" style="position:absolute;top:0;left:35%;" /></div>
						</div>
						<div class="modal-footer">
							<button type="button" id="submit" class="btn btn-secondary text-white"  data-dismiss="modal">Keluar</button>
						</div>
					</div>
				</div>
			</div>
<!-- ./modal -->
