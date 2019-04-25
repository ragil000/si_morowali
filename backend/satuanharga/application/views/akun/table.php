
			<div class="min-height-200px">
				<?php if($pesan != ''){ ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=$pesan?></strong>
				 </div>
				 <?php } ?>

				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Standard Satuan Harga Zona </h4>
						</div>
						<div class="pull-right">
							<form action="<?=base_url()?>admin/akun/page-1">
								<div class="form-group has-success">
									<input type="text" class="form-control form-control-success" name="search" placeholder="Pencarian Username" value="<?=$search?>" size="25">
								</div>
							</form>
						</div>

					</div>
					<hr>

                    <div class="clearfix mb-10">
						<div class="pull-right">
							<a class="btn btn-primary" data-uid="22" href="javascript:void(0)" data-toggle="modal" data-target="#modal"  onclick="createData(this)">
								<i class="fa fa-plus"> Tambah</i>
							</a>
						</div>


					</div>

					<div id="myError"></div>
					<div class="row">
						<table class="pd-20 table table-striped table-hover ">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">ID</th>
									<th>Username</th>
									<th>Nama Lengkap</th>
									<th>Level</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($ssh as $data) {
										$levelName = '';
										if($data['ssh_level'] == 1)
											$levelName = "Admin";
										else if($data['ssh_level'] == 2){
											$levelName = "User";
										}else if($data['ssh_level'] == 4){
											$levelName = "OPD";
										}
										echo "
								<tr>
									<td class='table-plus'>".$data['id']."</td>
									<td>".$data['username']."</td>
									<td>".$data['nama_lengkap']."</td>
									<td>".$levelName."</td>
									<td>

										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle btn-sm' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right '>
												<a class='dropdown-item'  data-uid='".$data['id']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='viewData(this)'><i class='fa fa-eye'></i> View</a>
												<a class='dropdown-item' data-uid='".$data['id']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal'  onclick='updateData(this)'><i class='fa fa-pencil'></i> Edit</a>
												<a class='dropdown-item' data-uid='".$data['id']."' href='javascript:void(0)' onclick='deleteData(this)'><i class='fa fa-trash'></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
										";
									}
								?>

							</tbody>
						</table>
						<!-- include novigator -->

				<!-- Export Datatable End -->
					</div>
				

<!-- modal ssh -->
			<div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<form id="sshForm" method="POST" action="" enctype="multipart/form-data" >
							<div class="modal-header">
								<h4 class="modal-title" >Standard Satuan Harga Zona </h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
							
								<div class="form-group row">
									<div class="col-12">
										<label class="col-sm-12 col-form-label">ID</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="id" name="id" >
										
										</div>
									</div>

								</div>
								<div class="form-group row">
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Username</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="username" name="username" required autofocus>
										</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Nama Lengkap</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="nama-lengkap" name="namaLengkap" required autofocus>
										</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Email</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="email" name="email" required autofocus>
										</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Level</label>
										<div class="col-sm-12">
											<select class="form-control" id="level" name="level" required autofocus>
												<option value="">Pilih Satuan</option>
												<option value="1">1 - Admin</option>
												<option value="2">2 - User Ssh</option>
												<option value="3">3 - OPD</option>
											</select>
										</div>
									</div>
									<div class="col-12">
										<label class="col-sm-12 col-form-label">Password</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="password" name="password" required autofocus>
										</div>
									</div>

								</div>
							</div>
							<div class="modal-footer">
								<input class="btn btn-primary" id="data-submit" type="submit" name="tombol" value="Ssh">
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
								<h4 class="modal-title" >SSH</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								
								

								<div class="pd-20 bg-white  mb-30">
									<div class="row">
										<table class="pd-20 table table-striped table-hover">
											
											<tbody>	
												<tr>
													<td>ID</td>
													<td id="view-id"></td>
												</tr>
												<tr>
													<td>Username</td>
													<td id="view-username"></td>
												</tr>
												<tr>
													<td>Nama Lengkap</td>
													<td id="view-nama-lengkap"></td>
												</tr>
												<tr>
													<td>Level</td>
													<td id="view-level"></td>
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
