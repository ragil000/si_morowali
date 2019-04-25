
			<div class="min-height-200px">
				<?php if(@$pesan &&  $pesan != ''){ ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong><?=$pesan?></strong>
				 </div>
				 <?php } ?>
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">Standard Satuan Harga 1</h4>
						</div>
						<div class="pull-right">
							<form action="<?=base_url()?>admin/ssh1/page-1">
								<div class="form-group has-success">
									<input type="text" class="form-control form-control-success" name="search" placeholder="Pencarian SSH 1" value="<?=$search?>" size="25">
								</div>
							</form>
						</div>
					</div>
					<hr>
					<div class="clearfix mb-10">
						<div class="pull-right">
							<a class="btn btn-primary" data-uid="22" href="javascript:void(0)" data-toggle="modal" data-target="#modal-ssh"  onclick="createSsh(this)">
								<i class="fa fa-plus"> Tambah</i>
							</a>
						</div>
					</div>

					<div class="row">
						<table class="pd-20 table table-striped table-hover ">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Kode SSH <?=$nomor?></th>
									<th>Nama SSH <?=$nomor?></th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($ssh as $data) {
										echo "
								<tr>
									<td class='table-plus'>".$data['Kd_Ssh1']."</td>
									<td>".$data['Nm_Ssh1']."</td>
									<td>

										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle btn-sm' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right '>
												<a class='dropdown-item'  data-uid='".$data['Kd_Ssh1']."' data-nama='".$data['Nm_Ssh1']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='viewSsh(this)'><i class='fa fa-eye'></i> View</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1']."'  data-nama='".$data['Nm_Ssh1']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-ssh'  onclick='updateSsh(this)'><i class='fa fa-pencil'></i> Edit</a>

												<a class='dropdown-item' data-uid='".$data['Kd_Ssh1']."' href='javascript:void(0)' onclick='deleteSsh(this)'><i class='fa fa-trash'></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
										";
									}
								?>

							</tbody>
						</table>
						<div class="pd-20 pagination mb-30">
							<div class="btn-toolbar justify-content-left mb-15">
								<div class="btn-group">
									<?php if ($page==1) {?>
									<a href="<?=base_url()?>admin/ssh/page-<?=($page-1)?>?search=<?=$search?>"
										class="btn btn-outline-primary prev disabled"><i class="fa fa-angle-double-left"></i></a>
									<?php } else {?>
									<a href="<?=base_url()?>admin/ssh/page-<?=($page-1)?>?search=<?=$search?>"
										class="btn btn-outline-primary prev"><i class="fa fa-angle-double-left"></i></a>
									<?php } ?>

								<?php
								  $hal_1=$page+2;
									$hal_2=(ceil($jumlahSsh/$jumlahSshInPage))-4;

								  for($i = 1;$i <=ceil($jumlahSsh/$jumlahSshInPage); $i++){
									$tulis = false;


									if($i == 1){
										$tulis = true;
									}

									if($i-3 < $page && $i+3 > $page){
										$tulis = true;
									}

									if($i == ceil($jumlahSsh/$jumlahSshInPage)){
										$tulis = true;
									}

									if($tulis){
										if ($i==$page) {
											echo '<span class="btn btn-primary current">'.$i.'</span>';
										} else {
											echo '
											<a href="'.base_url().'admin/ssh/page-'.$i.'?search='.$search.'" class="btn btn-outline-primary">'.$i.'</a>';
										}

										if (($page<=4 && $hal_1==$i)||($page>=5 && $i==1)||
											($page>=5 && $hal_1==$i && $page<=$hal_2))
										 {
											echo '
											<a href="#" class="btn btn-outline-primary disabled">...</a>';
											}
									}
								}
								?>
								<?php if ($page==ceil($jumlahSsh/$jumlahSshInPage)) {?>
									<a href="<?=base_url()?>admin/ssh/page-<?=($page+1)?>?search=<?=$search?>" class="btn btn-outline-primary next disabled"><i class="fa fa-angle-double-right"></i></a>
								<?php } else {?>
									<a href="<?=base_url()?>admin/ssh/page-<?=($page+1)?>?search=<?=$search?>" class="btn btn-outline-primary next"><i class="fa fa-angle-double-right"></i></a>
								<?php } ?>

							</div>
						</div>
					</div>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>

			<!-- modal ssh -->
			<div class="modal fade bs-example-modal-lg" id="modal-ssh" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<form id="sshForm" method="POST" action="" enctype="multipart/form-data" >
							<div class="modal-header">
								<h4 class="modal-title" >Standard Satuan Harga <?=$nomor?></h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								<div class="form-group row">
									<div class="col-3">
										<label class="col-sm-12 col-form-label">Kode SSH <?=$nomor?></label>
										<div class="col-sm-12">
											<input type="hidden" name="kodeSsh" id="kode-ssh-asli">
											<input type="text" class="form-control" id="kode-ssh" required autofocus name="" disabled>
										</div>
									</div>
									<div class="col-9">
										<label class="col-sm-12 col-form-label">Uraian SSH <?=$nomor?></label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="uraian-ssh" name="uraianSsh" required autofocus>
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
							<h4 class="modal-title" >SSH <?=$nomor?></h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						</div>
						<div class="modal-body" id="sshData">
							<div class="pd-20 bg-white  mb-30">
								<div class="row">
									<table class="pd-20 table table-striped table-hover">
										
										<tbody>	
											<tr>
												<td>Kode SSH <?=$nomor?></td>
												<td id="view-kode-ssh"></td>
											</tr>
											<tr>
												<td>Uraian SSH <?=$nomor?></td>
												<td id="view-uraian-ssh"></td>
											</tr>
										</tbody>
																		
									</table>
									<hr>
									<table class="pd-20 table table-striped table-hover"  id="tableTampil">
										<thead>
											<tr>
												<td>Kd_Ssh<?=($nomor+1)?></td>
												<td>Uraian</td>
											</tr>
										</thead>
										<tbody>	
										</tbody>					
									</table>
								</div>
							</div>
							<div id="wait" style="display:none;width:100%;height:100%;position:absolute;top:0;left:0;padding:2px; background-color: #ffffff;" ><img src='<?=base_url()?>public/img/loading.gif' width="300" height="300" style="position:absolute;top:30%;left:30%;" /></div>
						</div>
						<div class="modal-footer">
							<button type="button" id="submit" class="btn btn-secondary text-white"  data-dismiss="modal">Keluar</button>
						</div>
					</div>
				</div>
			</div>
<!-- ./modal -->
