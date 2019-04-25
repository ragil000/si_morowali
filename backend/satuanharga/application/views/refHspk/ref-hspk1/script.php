	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';

		function createHspk(obj){
			var id= $(obj).attr('data-uid');
			setComponent(true);
			getHspk(id,'ref_hspk1','last record');
		}

		function viewHspk(obj){
			var id= $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#view-kode-hspk1').html(id);			//kd_hspk1
			$('#view-uraian-hspk1').html(str);  //Nm_hspk2
		}

		function updateHspk(obj){
			var id = $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#id-hspk').val(id); //type hidden for key to update
			setComponent(false);
			$('#kode-hspk1').attr('type', 'text').val(id);
			$('#nm-hspk1').attr('type', 'text').val(str);
		}

		function deleteHspk(obj){
			var id= $(obj).attr('data-uid');
			var uraian= $(obj).attr('data-str');
			var s='Data <strong><i>"'+uraian+'"</i></strong> akan dihapus ?';
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
								window.location=link+"admin/hspk1/"+id;
							}else{
								swal(
											'Batal!',
											'Data batal dihapus',
											'error'
									)
							}
				})
		}

		function getHspk(id,tableName,status){ //display all table with any categories
			$.ajax({
				type:'GET',
				url:link+"admin/hspk1/get-hspk/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_hspk1" && status=="last record"){
							 let x=parseInt(data[0]['Kd_Hspk1'])+1; //last record+1 to insert rec
							 $('#kode-hspk1').attr('type', 'text').val(x);//kd_hspk1
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
			$('#kode-hspk1').attr("disabled", false);
			$('#nm-hspk1').attr("disabled", false);
			$('#kode-hspk1').attr('type', 'text').val('');
			$('#nm-hspk1').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode HSPK 1');
				$('#hspk-submit').attr('type', 'submit').val('Buat HSPK');
			}else{  //update
				$('#view-title').html('Edit Kode HSPK 1');
				$('#hspk-submit').attr('type', 'submit').val('Edit HSPK');
			}
    }






	</script>
