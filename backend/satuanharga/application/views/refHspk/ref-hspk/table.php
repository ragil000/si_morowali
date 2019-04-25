
			<div class="min-height-200px">
				<?php if($pesan != ''){ ?>
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>	
					<strong><?=$pesan?></strong>
				 </div>
				 <?php } ?>
				<!-- <div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>DataTable</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">DataTable</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							<div class="dropdown">
								<a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									January 2018
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="#">Export List</a>
									<a class="dropdown-item" href="#">Policies</a>
									<a class="dropdown-item" href="#">View Assets</a>
								</div>
							</div>
						</div>
					</div>
				</div> -->
				
				<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="clearfix mb-1">
						<div class="pull-left">
							<h4 class="text-blue">HSPK Zona <?=$zona?></h4>
						</div>
						<div class="pull-right">
							<form action="<?=base_url()?>admin/hspk/page-1">
								<div class="form-group has-success">
									<input type="text" class="form-control form-control-success" name="search" placeholder="Pencarian Nama Barang" value="<?=$search?>" size="25">
								</div>
								<input type="hidden" class="form-control" name="zona" value="<?=$zona?>">
							</form>
						</div>

					</div>
					<hr>


					<div class="clearfix mb-10">
						<div class="pull-left btn-group btn-group2">
							<a class=	"<?=($zona == 1) ? 'btn btn-primary disabled' : 'btn btn-primary';?>"
								href="<?=base_url()?>admin/hspk/page-<?=$page?>?search=<?=$search?>&zona=1">Zona 1</a>
							<a class= "<?=($zona == 2) ? 'btn btn-primary disabled' : 'btn btn-primary';?>"
							  href="<?=base_url()?>admin/hspk/page-<?=$page?>?search=<?=$search?>&zona=2">Zona 2</a>
							<a class= "<?=($zona == 3) ? 'btn btn-primary disabled' : 'btn btn-primary';?>"
							  href="<?=base_url()?>admin/hspk/page-<?=$page?>?search=<?=$search?>&zona=3">Zona 3</a>
							<a class= "<?=($zona == 4) ? 'btn btn-primary disabled' : 'btn btn-primary';?>"
							  href="<?=base_url()?>admin/hspk/page-<?=$page?>?search=<?=$search?>&zona=4">Zona 4</a>
						</div>
						<div class="pull-right">
							<a class="btn btn-primary" data-uid="22" href="javascript:void(0)" data-toggle="modal" data-target="#modal"  onclick="create(this)">
													<i class="fa fa-plus"> Tambah</i>
												</a>
						</div>


					</div>
					

					<div class="row">
						<table class="pd-20 table table-striped table-hover">
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
									<td class='table-plus'>".$data['Kd_Hspk1'].".".$data['Kd_Hspk2'].".".$data['Kd_Hspk3'].".".$data['Kd_Hspk4']."</td>
									<td>".$data['Uraian_Kegiatan']."</td>
									<td>".$data['Kd_Satuan']."</td>
									<td>".$this->fungsi->convert_to_rupiah($data['HargaZona'.$zona])."</td>
									<td>

										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right'>
												<a class='dropdown-item'  data-uid='".$data['Kd_Hspk1']."-".$data['Kd_Hspk2']."-".$data['Kd_Hspk3']."-".$data['Kd_Hspk4']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='view(this)'><i class='fa fa-eye'></i> View</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Hspk1']."-".$data['Kd_Hspk2']."-".$data['Kd_Hspk3']."-".$data['Kd_Hspk4']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal'  onclick='update(this)'><i class='fa fa-pencil'></i> Edit</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Hspk1']."-".$data['Kd_Hspk2']."-".$data['Kd_Hspk3']."-".$data['Kd_Hspk4']."' href='javascript:void(0)' onclick='deleteHspk(this)'><i class='fa fa-trash'></i> Delete</a>
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
									<a href="<?=base_url()?>admin/hspk/page-<?=($page-1)?>?search=<?=$search?>&zona=<?=$zona?>"
										class="btn btn-outline-primary prev disabled"><i class="fa fa-angle-double-left"></i></a>
									<?php } else {?>
									<a href="<?=base_url()?>admin/hspk/page-<?=($page-1)?>?search=<?=$search?>&zona=<?=$zona?>"
										class="btn btn-outline-primary prev"><i class="fa fa-angle-double-left"></i></a>
									<?php } ?>

								<?php
								  $hal_1=$page+2;
									$hal_2=(ceil($jumlahRec/$jumlahRecInPage))-4;

								  for($i = 1;$i <=ceil($jumlahRec/$jumlahRecInPage); $i++){
									$tulis = false;


									if($i == 1){
										$tulis = true;
									}

									if($i-3 < $page && $i+3 > $page){
										$tulis = true;
									}

									if($i == ceil($jumlahRec/$jumlahRecInPage)){
										$tulis = true;
									}

									if($tulis){
										if ($i==$page) {
											echo '<span class="btn btn-primary current">'.$i.'</span>';
										} else {
											echo '
											<a href="'.base_url().'admin/hspk/page-'.$i.'?search='.$search.'&zona='.$zona.'" class="btn btn-outline-primary">'.$i.'</a>';
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
								<?php if ($page==ceil($jumlahRec/$jumlahRecInPage)) {?>
									<a href="<?=base_url()?>admin/hspk/page-<?=($page+1)?>?search=<?=$search?>&zona=<?=$zona?>" class="btn btn-outline-primary next disabled"><i class="fa fa-angle-double-right"></i></a>
								<?php } else {?>
									<a href="<?=base_url()?>admin/hspk/page-<?=($page+1)?>?search=<?=$search?>&zona=<?=$zona?>" class="btn btn-outline-primary next"><i class="fa fa-angle-double-right"></i></a>
								<?php } ?>

								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- Export Datatable End -->
			</div>

<!-- modal -->
			<div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<form id="hspkForm" method="POST" action="">
							<div class="modal-header">
								<h4 class="modal-title" >SSH</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								
								<input type="hidden" id="kode-hspk" name="kodeHspk" value="" required autofocus>

								<div class="form-group row">
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode HSPK 1</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-hspk1" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode HSPK 2</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-hspk2" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode HSPK 3</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-hspk3" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode HSPK 4</label>
										<div class="col-sm-12">
											<input type="text"  class="form-control" id="kode-hspk4" required autofocus disabled>
										</div>
									</div>

								</div>
								<div class="form-group row">
									<div class="col-md-12 col-lg-6" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Uraian Kegiatan</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="uraian-kegiatan" name="uraianKegiatan" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
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
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Harga Zona <?=$zona?></label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="harga-zona-<?=$zona?>" name="hargaZona<?=$zona?>" onchange="gantiRupiah(this)" required autofocus disabled />
										</div>
									</div>


								</div>
								<hr>

								<div class="form-group row">
									<input type="hidden" name="kodeSsh" id="kode-ssh">
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 1</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh1" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 2</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh2" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 3</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh3" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 4</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh4" required autofocus disabled>
											</select>
										</div>
									</div>

								</div>
								<div class="form-group row">
									<div class="col-md-12 col-lg-3"  style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 5</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh5" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode SSH 6</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-ssh6" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Satuan</label>
										<input type="hidden" id="id-satuan-ssh"  name="satuanSsh">
										<div class="col-sm-12">
											<input type="text" class="form-control" id="satuan-ssh" required autofocus disabled>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Harga SSH Zona <?=$zona?></label>
										<div class="col-sm-12">
											<input class="form-control" id="harga-ssh-zona<?=$zona?>" type="text" name="hargaSsh" required autofocus disabled>
										</div>
									</div>

								</div>
								<div class="form-group row">
									<div class="col-md-12 col-lg-3"  style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Koefisien</label>
										<div class="col-sm-12">
											<input type="number"  class="form-control" id="koefisien" name="koefisien"  required autofocus disabled>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Harga</label>
										<div class="col-sm-12">
											<input type="text" class="form-control" id="total-harga-ssh" name="totalHargaSsh" required autofocus disabled>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kategori</label>
										<div class="col-sm-12">
											<select class="form-control" id="kategori" name="kategori" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode HSPK 4</label>
										<div class="col-sm-12">
											<input class="form-control btn btn-warning" id="hspk-tambah" type="submit" name="tombol2" value="Tambah">
										</div>
									</div>

								</div>

								<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
									<div class="row">
										<table class="pd-20 table table-striped table-hover" id="tableTampil">
											<thead>
												<tr>
													<th>Aksi</th>
													<th>Nomor</th>
													<th>Kategori</th>
													<th>Koefisien</th>
													<th>Harga Satuan</th>
													<th>Satuan</th>
													<th>Harga</th>
												</tr>	
											</thead>
											<tbody>	
											</tbody>
											<tfoot>
												<tr>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th>Total</th>
													<th>0</th>
												</tr>	
											</tfoot>
																			
										</table>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<input class="btn btn-primary" id="hspk-submit" type="submit" name="tombol" value="Ssh">
								<button type="button" id="submit" class="btn btn-secondary text-white">Keluar</button>
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
													<td>Kode HSPK</td>
													<td id="view-kode-hspk"></td>
												</tr>
												<tr>
													<td>Kode HSPK 1</td>
													<td id="view-kode-hspk1"></td>
												</tr>
												<tr>
													<td>Kode HSPK 2</td>
													<td id="view-kode-hspk2"></td>
												</tr>
												<tr>
													<td>Kode HSPK 3</td>
													<td id="view-kode-hspk3"></td>
												</tr>
												<tr>
													<td>Kode HSPK 4</td>
													<td id="view-kode-hspk4"></td>
												</tr>
												<tr>
													<td>Uraian Kegiatan</td>
													<td id="view-uraian"></td>
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

								



								<hr>

									<div class="row">
										<table class="pd-20 table table-striped table-hover" id="tableTampil2">
											<thead>
												<tr>
													<th>Aksi</th>
													<th>Nomor</th>
													<th>Kategori</th>
													<th>Koefisien</th>
													<th>Harga Satuan</th>
													<th>Satuan</th>
													<th>Harga</th>
												</tr>	
											</thead>
											<tbody>	
											</tbody>
											<tfoot>
												<tr>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th></th>
													<th>Total</th>
													<th>0</th>
												</tr>	
											</tfoot>
																			
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

	


