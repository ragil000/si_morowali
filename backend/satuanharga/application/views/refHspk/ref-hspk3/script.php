	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';
		var id_obj;
		var str_obj;

		function createHspk(obj){
			var id= $(obj).attr('data-uid');
			setComponent(true);
			getHspk(id,'ref_hspk1','create');  //display combo ref_hspk2
		}

		function viewHspk(obj){
			id_obj= $(obj).attr('data-uid');
			str_obj= $(obj).attr('data-str');
			var arr_str = str_obj.split(":");
			$('#view-kode-hspk1').html(id_obj);	//kd_hspk1
			$('#view-uraian-hspk1').html(arr_str[0]);//Nm_hspk1
			$('#view-uraian-hspk2').html(arr_str[1]);//Nm_hspk2
			$('#view-uraian-hspk3').html(arr_str[2]);//Nm_hspk2
		}

		function updateHspk(obj){
			id_obj = $(obj).attr('data-uid');
			str_obj= $(obj).attr('data-str');
			var arr_id = id_obj.split(":");
			var arr_str = str_obj.split(":");
			$('#id-hspk').val(id_obj); //type hidden for key to update
			setComponent(false);
			$('#kode-hspk3').attr('type', 'text').val(arr_id[2]);
			$('#nm-hspk3').attr('type', 'text').val(arr_str[2]);
			getHspk(arr_id[0],'ref_hspk1','update');
			getHspk(arr_id[0],'ref_hspk2','update');
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
								window.location=link+"admin/hspk3/"+id;
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
			var x='';
			$.ajax({
				type:'GET',
				url:link+"admin/hspk3/get-hspk/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_hspk1" && status=="create")//create->display hspk1 to combo
							 comboTable(data,'#kode-hspk1',status,id);
					  if (tableName=="ref_hspk2" && status=="create")//create->display hspk1 to combo
							 comboTable(data,'#kode-hspk2',status,id);

						if (tableName=="ref_hspk1" && status=="update")//update->display hspk1 to combo
							 comboTable(data,'#kode-hspk1',status,id);
					  if (tableName=="ref_hspk2" && status=="update"){//update->display hspk2 to combo
								var arr_id = id_obj.split(":");	//use global variabel because parameter limit -> kd_ssh2
								comboTable(data,'#kode-hspk2',status,arr_id[1]);
						}
						if (tableName=="ref_hspk3" && status=="last record"){ //create->display last record+1 to text
						   let x=parseInt(data[0]['Kd_Hspk3'])+1;
							 $('#kode-hspk3').attr('type', 'text').val(x);
						}
					}
				},
				error:function(data){
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
			if (x=='' && tableName=="ref_hspk3" && status=="last record")//if data is null, default 1
				 $('#kode-hspk3').attr('type', 'text').val('1');
		}

		function comboTable(data,combo,crud,id){
			if (combo=='#kode-hspk1'){
				 no=1;
			}
			if (combo=='#kode-hspk2'){
				 no=2;
			}
			if(data){
				$(combo).empty().append('<option value='+''+'>Pilih HSPK '+no+' </option>');
				for (var i = 0; i < data.length; i++){
						let kode = data[i]['Kd_Hspk'+no];
						let uraian = toTitleCase(data[i]['Nm_Hspk'+no]);
						if (crud=='update')   //if update
						{
							if (kode==id)   //if user selected item
								$(combo).append('<option value='+kode+' selected>'+uraian+'</option>');
							else
								$(combo).append('<option value='+kode+'>'+uraian+'</option>');
						}
						if (crud=='create'){
								$(combo).append('<option value='+kode+'>'+uraian+'</option>');

						}
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

		$("#kode-hspk1").change(function () {    //change combo ref_hspk1
			var id = $(this).val();
			if (id == ''){
					$('#kode-hspk2').attr("disabled", true);
					$('#kode-hspk3').attr("disabled", true);
					$('#nm-hspk3').attr("disabled", true);
					$('#kode-hspk2').attr('type', 'text').val('');
					$('#kode-hspk3').attr('type', 'text').val('');
					$('#nm-hspk3').attr('type', 'text').val('');
			}
			else {
					$('#kode-hspk2').attr("disabled", false);
					getHspk(id,'ref_hspk2','create');
			}
		});

		$("#kode-hspk2").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
					$('#kode-hspk3').attr("disabled", true);
					$('#nm-hspk3').attr("disabled", true);
					$('#kode-hspk3').attr('type', 'text').val('');
					$('#nm-hspk3').attr('type', 'text').val('');
			}
			else {
					$('#kode-hspk3').attr("disabled", false);
					$('#nm-hspk3').attr("disabled", false);
					let x = $('#kode-hspk1').val()+':'+id;  //concate kd-ssh1 and kd-ssh2
					getHspk(x,'ref_hspk3','last record');
			}
		});



		$(function() {    //for hide message
			var timeout = 3000;
			$('.hide').delay(timeout).fadeOut(1500);
		});

		function toTitleCase(str) {
			return str.replace(
					/\w\S*/g,
					function(txt) {
							return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
					}
			);
		}

		function setComponent(active) {
			$('#kode-hspk1').attr("disabled", false);
			$('#kode-hspk2').attr("disabled", active);
			$('#kode-hspk3').attr("disabled", active);
			$('#nm-hspk3').attr("disabled", active);
			$('#kode-hspk1').attr('type', 'text').val('');
			$('#kode-hspk2').attr('type', 'text').val('');
			$('#kode-hspk3').attr('type', 'text').val('');
			$('#nm-hspk3').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode HSPK 3');
				$('#hspk-submit').attr('type', 'submit').val('Buat HSPK');
			}else{  //update
				$('#view-title').html('Edit Kode HSPK 3');
				$('#hspk-submit').attr('type', 'submit').val('Edit HSPK');
			}
    }


	</script>
