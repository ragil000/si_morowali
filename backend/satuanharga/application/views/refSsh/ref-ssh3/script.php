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

		function createSsh(obj){
			var id= $(obj).attr('data-uid');
			setComponent(true);
			getSsh(id,'ref_ssh1','create');  //display combo ref_ssh2
		}

		function viewSsh(obj){
			var id= $(obj).attr('data-uid');
			str_obj= $(obj).attr('data-str');
			var arr_str = str_obj.split(":");
			$('#view-kode-ssh').html(id);							//kd_Ssh1+kd_Ssh2+kd_Ssh3
			$('#view-uraian-ssh1').html(arr_str[0]);  //Nm_Ssh1
			$('#view-uraian-ssh2').html(arr_str[1]);	//Nm_Ssh2
			$('#view-uraian-ssh3').html(arr_str[2]);	//Nm_Ssh3
			getSsh(id,'ref_ssh4','view');
		}

		function updateSsh(obj){
			id_obj= $(obj).attr('data-uid');
			var arr_id = id_obj.split(":");
			str_obj= $(obj).attr('data-str');
			var arr_str = str_obj.split(":");
			$('#id-ssh').val(id_obj);		//type hidden old key for update
			setComponent(false);
			getSsh(arr_id[0],'ref_ssh1','update');  //set combo1
			getSsh(arr_id[0],'ref_ssh2','update');	//set combo2
			$('#kode-ssh3').attr('type', 'text').val(arr_id[2]);
			$('#nm-ssh3').attr('type', 'text').val(arr_str[2]);
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
								window.location=link+"admin/ssh3/"+id;
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
				url:link+"admin/ssh3/get-ssh/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_ssh4" && status=="view") //view->display table
							 isiTable(data);
						if (tableName=="ref_ssh1" && status=="create") //create->display ssh1 to combo
							 comboTable(data,'#kode-ssh1',status,id);
						if (tableName=="ref_ssh2" && status=="create")  //create->display ssh2 to combo
 							 comboTable(data,'#kode-ssh2',status,id);
						if (tableName=="ref_ssh1" && status=="update") //update->display ssh1 to combo
	 						 comboTable(data,'#kode-ssh1',status,id);
						if (tableName=="ref_ssh2" && status=="update"){  //update->display ssh2 to combo
							 var arr_id = id_obj.split(":");			//use global variabel because parameter limit -> kd_ssh2
							 comboTable(data,'#kode-ssh2',status,arr_id[1]);
						}
						if (tableName=="ref_ssh3" && status=="last record"){ //create->display last record+1 to text
							 let x=parseInt(data[0]['Kd_Ssh3'])+1;
  						 $('#kode-ssh3').attr('type', 'text').val(x);
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


		function comboTable(data,combo,crud,id){
			if (combo=='#kode-ssh1'){  //create->combo name->kode-ssh1; display table ref-ssh1
				 no=1;
			}
			if (combo=='#kode-ssh2'){  //create->combo name->kode-ssh1; display table ref-ssh2
				 no=2;
			}
			if(data){
				$(combo).empty().append('<option value='+''+'>Pilih SSH '+no+' </option>');
				for (var i = 0; i < data.length; i++){
						let kode = data[i]['Kd_Ssh'+no];
						let uraian = toTitleCase(data[i]['Nm_Ssh'+no]);
						if (crud=='update')   //if update
						{
							if (kode==id)   //if user selected item
								$(combo).append('<option value='+kode+' selected>'+uraian+'</option>');
							else
								$(combo).append('<option value='+kode+'>'+uraian+'</option>');
						}
						if (crud=='create')
			    			$(combo).append('<option value='+kode+'>'+uraian+'</option>');
				}
			}
		}

		function isiTable(data){
			var total = 0;
			var nameTable = 'tableTampil';
			if(data){
				$('#'+nameTable+' > tbody').empty();

				for (let i = 0; i < data.length; i++) {
					let kode = data[i]['Kd_Ssh1']+'.'+data[i]['Kd_Ssh2']+'.'+data[i]['Kd_Ssh3']+'.'+data[i]['Kd_Ssh4'];
					let uraian = data[i]['Nm_Ssh4'];
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

		$("#kode-ssh1").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
				  $('#kode-ssh2').attr("disabled", true);
					$('#kode-ssh3').attr("disabled", true);
					$('#nm-ssh3').attr("disabled", true);
			}
			else {
					$('#kode-ssh2').attr("disabled", false);
					getSsh(id,'ref_ssh2','create');  //display text, last kode ref_ssh2
			}
		});


		$("#kode-ssh2").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
					$('#kode-ssh3').attr("disabled", true);
					$('#nm-ssh3').attr("disabled", true);
			}
			else {
					$('#kode-ssh3').attr("disabled", false);
					$('#nm-ssh3').attr("disabled", false);
					let x = $('#kode-ssh1').val()+':'+id;  //concate kd-ssh1 and kd-ssh2
					getSsh(x,'ref_ssh3','last record');
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
			$('#kode-ssh2').attr("disabled", active);
			$('#kode-ssh3').attr("disabled", active);
			$('#nm-ssh3').attr("disabled", active);
			$('#kode-ssh2').attr('type', 'text').val('');
			$('#kode-ssh3').attr('type', 'text').val('');
			$('#nm-ssh3').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode SSH 3');
				$('#ssh-submit').attr('type', 'submit').val('Buat SSH');
			}else{  //create
				$('#view-title').html('Edit Kode SSH 3');
				$('#ssh-submit').attr('type', 'submit').val('Edit SSH');
			}

    }




	</script>
