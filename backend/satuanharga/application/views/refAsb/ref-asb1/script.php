	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';

		function createAsb(obj){
			var id= $(obj).attr('data-uid');
			setComponent(true);
			getAsb(id,'ref_asb1','last record');
		}

		function viewAsb(obj){
			var id= $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#view-kode-asb1').html(id);	//
			$('#view-uraian-asb1').html(str);  //Nm_Ssh1
			getAsb(id,'ref_asb2','view');
		}

		function updateAsb(obj){
			var id = $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#id-asb').val(id);		//type hidden old key for update
			setComponent(false);
			$('#kode-asb1').attr('type', 'text').val(id);
			$('#nm-asb1').attr('type', 'text').val(str);
		}

		function deleteAsb(obj){
			var id= $(obj).attr('data-uid');
			var uraian= $(obj).attr('data-str');
			var s=  'Data <strong><i>"'+uraian+'"</i></strong> akan dihapus ?';
					swal({
							title: 'Apakah anda yakin',
							html: s,
							type: 'warning',
							showCancelButton: true,
							confirmButtonText: 'Ya!',
							cancelButtonText: 'Batal!',
							confirmButtonClass: 'btn btn-success margin-5',
							cancelButtonClass: 'btn btn-danger margin-5',
							buttonsStyling: false
					}).then(function (dismiss) {
							if (dismiss['value']) {
								swal(
									'Terhapus!',
									'Data telah terhapus.',
									'success'
								)
								window.location=link+"admin/asb1/"+id;
							}else{
								swal(
											'Batal!',
											'Data batal dihapus',
											'error'
									)
							}
				})
		}

		function getAsb(id,tableName,status){    //display all table with any categories
			$.ajax({
				type:'GET',
				url:link+"admin/asb1/get-asb/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_asb1" && status=="last record"){
							 let x=parseInt(data[0]['Kd_Asb1'])+1;//last rec+1 to insert rec
							 $('#kode-asb1').attr('type', 'text').val(x);//kd_hspk1
						}
					}
				},
				error:function(data){
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		$(document).ready(function(){
		    $(document).ajaxStart(function(){
		        $("#wait").css("display", "block");
		    });
		    $(document).ajaxComplete(function(){
		        $("#wait").css("display", "none");
		    });
		});


		$(function() {    //for hide message
			var timeout = 3000;
			$('.hide').delay(timeout).fadeOut(1500);
		});


		function setComponent(active) {
			$('#kode-asb1').attr("disabled", false);
			$('#nm-asb1').attr("disabled", false);
			$('#kode-asb1').attr('type', 'text').val('');
			$('#nm-asb1').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode ASB 1');
				$('#asb-submit').attr('type', 'submit').val('Buat ASB');
			}else{  //update
				$('#view-title').html('Edit Kode ASB 1');
				$('#asb-submit').attr('type', 'submit').val('Edit ASB');
			}
    }






	</script>
