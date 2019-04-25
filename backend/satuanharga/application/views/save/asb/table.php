
			<div class="min-height-200px">
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					
					

					<div class="row">
						<table class="pd-20 table table-dark">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Kode ASB</th>
									<th colspan='3'>Jenis Pekerjaan</th>
									<th>Satuan</th>
									<th>Harga Zona <?=$zona?></th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($ssh as $data) {
										$data2 = $this->RefAsbModel->loadDataAsb(array( 'idAsb' => $data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']),2);
										
										echo "
								<tr>
									<td class='table-plus'>".$data['Kd_Asb1'].".".$data['Kd_Asb2'].".".$data['Kd_Asb3'].".".$data['Kd_Asb4'].".".$data['Kd_Asb5']."</td>
									<td colspan='3'>".$data['Jenis_Pekerjaan']."</td>
									<td>".$data['Uraian']."</td>
									<td>".$data2['total'][$zona]."</td>
									<td>

										<div class='dropdown'>
											<a class='btn btn-outline-primary dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
												<i class='fa fa-ellipsis-h'></i>
											</a>
											<div class='dropdown-menu dropdown-menu-right'>
												<a class='dropdown-item'  data-uid='".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal-view'  onclick='view(this)'><i class='fa fa-eye'></i> View</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."' href='javascript:void(0)' data-toggle='modal' data-target='#modal'  onclick='update(this)'><i class='fa fa-pencil'></i> Edit</a>
												<a class='dropdown-item' data-uid='".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."' href='javascript:void(0)' onclick='deleteAsb(this)'><i class='fa fa-trash'></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
								<tr  style='background-color: #ffffff;' >
									<td id='table-view-".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."' style='display: none;'>
										<table class='table text-dark' id='tableTampil-".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."'>
											<thead>
												<tr>
													<th></th>
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
									</td>
								</tr>
								<tr style='display: none;'></tr>
										";
									}
								?>
								
							</tbody>
						</table>
				<!-- Export Datatable End -->
			</div>

<!-- modal -->
			<div class="modal fade bs-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered">
					<div class="modal-content">
						<form id="asbForm" method="POST" action="">
							<div class="modal-header">
								<h4 class="modal-title" >ASB</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">

								
								<div id="myError"></div>
								<input type="hidden" id="kode-asb" name="kodeAsb" value="" required autofocus>

								<div class="form-group row">
									<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode ASB 1</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-asb1" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode ASB 2</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-asb2" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode ASB 3</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-asb3" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode ASB 4</label>
										<div class="col-sm-12">
											<select class="form-control" id="kode-asb4" required autofocus>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kode ASB 5</label>
										<div class="col-sm-12">
											<input type="text"  class="form-control" id="kode-asb5" required autofocus>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12 col-lg-6" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Uraian Kegiatan</label>
										<div class="col-sm-12">
											<input class="form-control" type="text" id="jenis-pekerjaan" name="jenisPekerjaan" required autofocus disabled>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Satuan</label>
										<div class="col-sm-12">
											<select class="form-control" id="satuan-asb" name="satuanAsb" required autofocus disabled>
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
									<div class="col-md-12 col-lg-4" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Kategori Pekerjaan</label>
										<div class="col-sm-12">
											<select class="form-control" id="kategori-pekerjaan" name="pekerjaan" required autofocus disabled>
												<option>Pilih Pekerjaan</option>
												<?php foreach ($pekerjaan as $dataSatuan) {
													echo "<option value='".$dataSatuan['Kd_Pekerjaan']."'>".$dataSatuan['Uraian']."</option>";
												} ?>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-lg-4" style="padding: 0px; margin: 0px;">
										<label class="col-sm-12 col-form-label">Asal</label>
										<div class="col-sm-12">
											<select class="form-control" id="asal" name="asal" required autofocus disabled>
												<option>Pilih Asal</option>
												<option value="1">SSH</option>
												<option value="2">HSPK</option>
												<option value="3">ASB</option>
											</select>
										</div>
									</div>
								</div>
								<hr>

								<div id="form-hspk">
									<div class="form-group row">
										<input type="hidden" id="kode-hspk" name="kodeHspk">
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode HSPK 1</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-hspk1">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode HSPK 2</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-hspk2">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode HSPK 3</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-hspk3">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode HSPK 4</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-hspk4">
												</select>
											</div>
										</div>

									</div>
								</div>
								

								<div id="form-ssh">
									<div class="form-group row">
										<input type="hidden" name="kodeSsh" id="kode-ssh">
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 1</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh1">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 2</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh2">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 3</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh3">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 4</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh4">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2"  style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 5</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh5">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode SSH 6</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-ssh6">
												</select>
											</div>
										</div>
									</div>
								</div>
								<div id="form-asb">
									<div class="form-group row">
										<input type="hidden" name="kodeAsb2" id="kode-tambahan-asb">
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode ASB 1</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-tambahan-asb1">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode ASB 2</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-tambahan-asb2">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode ASB 3</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-tambahan-asb3">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode ASB 4</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-tambahan-asb4">
												</select>
											</div>
										</div>
										<div class="col-md-12 col-lg-2"  style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Kode ASB 5</label>
											<div class="col-sm-12">
												<select class="form-control" id="kode-tambahan-asb5">
												</select>
											</div>
										</div>
									</div>
								</div>

								<div id="form-tambahan">
									<div class="form-group row">
										<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Satuan</label>
											<input type="hidden" id="id-satuan"  name="satuanTambahan">
											<div class="col-sm-12">
												<input type="text" class="form-control" id="satuan-tambahan" required autofocus disabled>
											</div>
										</div>
										<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Harga SSH Zona <?=$zona?></label>
											<div class="col-sm-12">
												<input class="form-control" id="harga-tambahan-zona<?=$zona?>" type="text" name="hargaSsh" required autofocus disabled>
											</div>
										</div>
										<div class="col-md-12 col-lg-3"  style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Koefisien</label>
											<div class="col-sm-12">
												<input type="text"  class="form-control" id="koefisien" name="koefisien"  required autofocus>
											</div>
										</div>
										<div class="col-md-12 col-lg-3" style="padding: 0px; margin: 0px;">
											<label class="col-sm-12 col-form-label">Harga</label>
											<div class="col-sm-12">
												<input type="text" class="form-control" id="total-harga-tambahan" name="totalHargaSsh" required autofocus disabled>
											</div>
										</div>
									</div>
								</div>
								
								<hr>
								
								<div class="form-group row">
									<div class="col-md-12 col-lg-4" style="padding: 0px; margin: 0px;"></div>
									<div class="col-md-12 col-lg-4" style="padding: 0px; margin: 0px;">
										<div class="col-sm-12">
											<input class="form-control btn btn-warning" id="data-tambah" type="submit" name="tombol2" value="Tambah">
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
								<div id="wait" style="display:none;width:100%;height:100%;position:absolute;top:0;left:0;padding:2px; background-color: #ffffff;" ><img src='<?=base_url()?>public/img/loading.gif' width="300" height="300" style="position:absolute;top:30%;left:30%;" /></div>
							</div>
							<div class="modal-footer">
								<input class="btn btn-primary" id="asb-submit" type="submit" name="tombol" value="Ssh">
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
								<h4 class="modal-title" >ASB</h4>
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							</div>
							<div class="modal-body" id="sshData">
								
								

								<div class="pd-20 bg-white  mb-30">
									<div class="row">
										<table class="pd-20 table table-striped table-hover">
											
											<tbody>	
												<tr>
													<td>Kode ASB</td>
													<td id="view-kode-asb"></td>
												</tr>
												<tr>
													<td>Kode ASB 1</td>
													<td id="view-kode-asb1"></td>
												</tr>
												<tr>
													<td>Kode ASB 2</td>
													<td id="view-kode-asb2"></td>
												</tr>
												<tr>
													<td>Kode ASB 3</td>
													<td id="view-kode-asb3"></td>
												</tr>
												<tr>
													<td>Kode ASB 4</td>
													<td id="view-kode-asb4"></td>
												</tr>
												<tr>
													<td>Kode ASB 5</td>
													<td id="view-kode-asb5"></td>
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

	


