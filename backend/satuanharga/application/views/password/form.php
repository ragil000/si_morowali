
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
							<h4 class="text-blue">Ganti Password</h4>
						</div>

					</div>
					<hr>

                    

					<div id="myError"></div>
					<div class="row">
						<form action="" method="POST">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label">Password Lama</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="password" id="password-lama" name="passwordLama" required autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label">Password Baru</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="password" id="password-baru" name="passwordBaru" required autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label">Ulangi Password</label>
                                    <div class="col-sm-12">
                                        <input class="form-control" type="password" id="ulang-password" name="ulangPassword" required autofocus>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-12 col-form-label"></label>
                                    <div class="col-sm-12">
                                        <input class="btn btn-primary" id="data-submit" type="submit" name="tombol" value="Ganti Password">
                                    </div>
                                </div>
							
							</div>
                        </form>
						<!-- include novigator -->

				<!-- Export Datatable End -->
					</div>

