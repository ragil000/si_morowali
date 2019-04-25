	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';

		function createSsh(obj){
			var id= $(obj).attr('data-uid');
			setComponent(true);
			getSsh(id,'ref_kategori_pekerjaan_asb','last record');
		}

		function viewSsh(obj){
			var id= $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#view-kode-ssh1').html(id);							//kd_Ssh1+kd_Ssh2+kd_Ssh3
			$('#view-uraian-ssh1').html(str);  //Nm_Ssh1
			getSsh(id,'ref_ssh2','view');
		}

		function updateSsh(obj){
			var id = $(obj).attr('data-uid');
			var str= $(obj).attr('data-str');
			$('#id-ssh').val(id);		//type hidden old key for update
			setComponent(false);
			$('#kode-ssh1').attr('type', 'text').val(id);
			$('#nm-ssh1').attr('type', 'text').val(str);
		}

		function deleteSsh(obj){
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
								window.location=link+"admin/asb-pekerjaan/"+id;
							}else{
								swal(
											'Batal!',
											'Data batal dihapus',
											'error'
									)
							}
				})
		}

		function getSsh(id,tableName,status){    //display all table with any categories
			$.ajax({
				type:'GET',
				url:link+"admin/asb-pekerjaan/get-pekerjaan/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_ssh2" && status=="view") //view->display table
							 isiTable(data);
					  if (tableName=="ref_ssh1" && status=="last record"){
							 let x=parseInt(data[0]['Kd_Ssh1'])+1;//last rec+1 to insert rec
							 $('#kode-ssh1').attr('type', 'text').val(x);//kd_hspk1
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


		function isiTable(data){
			var total = 0;
			var nameTable = 'tableTampil';
			if(data){
				$('#'+nameTable+' > tbody').empty();

				for (let i = 0; i < data.length; i++) {
					let kode = data[i]['Kd_Ssh1']+'.'+data[i]['Kd_Ssh2'];
					let uraian = data[i]['Nm_Ssh2'];
					$('#'+nameTable+' > tbody').append('<tr><td>'+kode+'</td><td>'+uraian+'</td></tr>');
				}
			}
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
			$('#kode-ssh1').attr("disabled", false);
			$('#nm-ssh1').attr("disabled", false);
			$('#kode-ssh1').attr('type', 'text').val('');
			$('#nm-ssh1').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode SSH 1');
				$('#ssh-submit').attr('type', 'submit').val('Buat SSH');
			}else{  //update
				$('#view-title').html('Edit Kode SSH 1');
				$('#ssh-submit').attr('type', 'submit').val('Edit SSH');
			}
    }






	</script>
