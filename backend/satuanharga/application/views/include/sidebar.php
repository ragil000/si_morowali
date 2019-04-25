	
	<div class="left-side-bar">
		<div class="brand-logo">
			<a href="<?=base_url()?>admin">
				<img src="<?=base_url()?>public/template/vendors/images/deskapp-logo.png" alt="">
			</a>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li id="menu-home">
						<a href="<?=base_url()?>admin" class="dropdown-toggle no-arrow">
							<span class="fa fa-home"></span><span class="mtext">Home</span>
						</a>
					</li>
					<?php if($this->session->userdata('level') == 1){ ?>
					<li id="menu-laporan" class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fi-clipboard-notes"></span><span class="mtext">Laporan Chart Akun</span>
						</a>
						<ul class="submenu">
							<li><a href="<?=base_url()?>admin/laporan/ssh">Chart Akun SSH</a></li>
							<li><a href="<?=base_url()?>admin/laporan/hspk">Chart Akun HSPK</a></li>
							<li><a href="<?=base_url()?>admin/laporan/asb">Chart Akun ASB</a></li>
							<li><a href="<?=base_url()?>admin/laporan/aset">Chart Akun Aset</a></li>
						</ul>
					</li>
					<?php }
						if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2){
					 ?>
					<li id="menu-ssh" class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fi-clipboard-pencil"></span><span class="mtext">Kode SSH</span>
						</a>
						<ul class="submenu">
							<li><a href="<?=base_url()?>admin/ssh1">Kode SSH 1</a></li>
							<li><a href="<?=base_url()?>admin/ssh2">Kode SSH 2</a></li>
							<li><a href="<?=base_url()?>admin/ssh3">Kode SSH 3</a></li>
							<li><a href="<?=base_url()?>admin/ssh4">Kode SSH 4</a></li>
							<li><a href="<?=base_url()?>admin/ssh5">Kode SSH 5</a></li>
							<li><a href="<?=base_url()?>admin/ssh">Kode SSH 6</a></li>
						</ul>
					</li>
					<?php }
					if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
					<li id="menu-hspk" class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fi-clipboard-pencil"></span><span class="mtext">Kode HSPK</span>
						</a>
						<ul class="submenu">
							<li><a href="<?=base_url()?>admin/hspk1">Kode HSPK 1</a></li>
							<li><a href="<?=base_url()?>admin/hspk2">Kode HSPK 2</a></li>
							<li><a href="<?=base_url()?>admin/hspk3">Kode HSPK 3</a></li>
							<li><a href="<?=base_url()?>admin/hspk">Kode HSPK 4</a></li>
						</ul>
					</li>
					<?php }
					if($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3){ ?>
					<li id="menu-asb" class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="fa fi-clipboard-pencil"></span><span class="mtext">Kode ASB</span>
						</a>
						<ul class="submenu">
							<li><a href="<?=base_url()?>admin/asb1">Kode ASB 1</a></li>
							<li><a href="<?=base_url()?>admin/asb2">Kode ASB 2</a></li>
							<li><a href="<?=base_url()?>admin/asb3">Kode ASB 3</a></li>
							<li><a href="<?=base_url()?>admin/asb4">Kode ASB 4</a></li>
							<li><a href="<?=base_url()?>admin/asb">Kode ASB 5</a></li>
							<li><a href="<?=base_url()?>admin/asb-pekerjaan">Kategori Pekerjaan ASB</a></li>
						</ul>
					</li>
					<?php } 
					if($this->session->userdata('level') == 1){ ?>
					<li id="menu-home">
						<a href="<?=base_url()?>admin/export-import" class="dropdown-toggle no-arrow">
							<span class="fa fa-cloud"></span><span class="mtext">Export / Import</span>
						</a>
					</li>
					<li id="menu-akun">
						<a href="<?=base_url()?>admin/akun" class="dropdown-toggle no-arrow">
							<span class="fa fa-user-o"></span><span class="mtext">Akun</span>
						</a>
					</li>
					<?php } ?>
					<li id="menu-password">
						<a href="<?=base_url()?>admin/password" class="dropdown-toggle no-arrow">
							<span class="fa fa-shield"></span><span class="mtext">Ganti Password</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
