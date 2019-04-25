	<!-- js -->
	<script src="<?=base_url()?>public/template/vendors/scripts/script.js"></script>
	<script type="text/javascript">
		
		//var menuLevel = <?=$menuLevel?>;

		
			$("#menu-<?=$menu?>").addClass("show");
			//$("#menu-<?=$menu?> > a").attr('class', 'dropdown-toggle');
			$("#menu-<?=$menu?> > a").attr('data-option', 'on');
			$("#menu-<?=$menu?> > ul").attr('style', 'display: block;');
			$("#menu-<?=$menu?> > ul li:eq(<?=($menuLevel-1)?>) a").attr('class', 'active');

		

		//console.log('sd');
		//console.log($("#menu-ssh > ul li:eq(1) a").html());

	</script>