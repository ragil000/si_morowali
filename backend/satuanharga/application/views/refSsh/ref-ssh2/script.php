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
		$('#view-title').html('Tambah Kode SSH 2');
		$('#ssh-submit').attr('type', 'submit').val('Buat SSH');
		$('#kode-ssh-01').attr('type', 'text').val('');
		$('#kode-ssh2').attr('type', 'text').val('');
		$('#kode-ssh3').attr('type', 'text').val('');
		$('#nm-ssh2').attr('type', 'text').val('');
		$('#kode-ssh2').attr("disabled", true);
		$('#nm-ssh2').attr("disabled", true);
		getSsh(id,'ref_ssh1');  //display combo ref_ssh1
	}

	function updateSsh(obj){
		var id= $(obj).attr('data-uid');
		var uraian= $(obj).attr('data-nama');
		var arr_id = id.split(":");
		$('#kode-ssh1').val(arr_id[0]);
		$('#kode-ssh-01').val(arr_id[0]);
		$('#kode-ssh2').val(arr_id[1]);
		$('#id-ssh').val(id);		//type hidden old key for update
		$('#nm-ssh2').val(uraian);
		$('#kode-ssh2').attr('disabled', false);
		$('#nm-ssh2').attr('disabled', false);
		$('#ssh-submit').attr('type', 'submit').val('Edit SSH');
		$('#view-title').html('Edit Kode SSH 2');
		getSsh(arr_id[0],'ref_ssh1');
	}

	function viewSsh(obj){
		var id= $(obj).attr('data-uid');
		var str= $(obj).attr('data-nama');
		var arr_str = str.split(":");
		var arr_id = id.split(":");
		$('#view-kode-ssh').html(arr_id[0]+'.'+arr_id[1]);
		$('#view-uraian-ssh1').html(arr_str[0]);
		$('#view-uraian-ssh2').html(arr_str[1]);
		getSsh(id,'ref_ssh3');//view -> display ref_ssh3 into table
	}

	function getSsh(id,tableName){    //display all table with any categories
		$.ajax({
			type:'GET',
			url:link+"admin/ssh2/get-ssh/"+id+"/"+tableName,
			dataType: "JSON",
			success:function(data){
				if(data){
					if (tableName=="ref_ssh3")  //view -> display table
						 isiTable(data);
					if (tableName=="ref_ssh1")  //create-> display table ssh1 to combo
	 					 comboTable(data,id);
 				  if (tableName=="ref_ssh2"){ //create-> display last record + 1 to text
								let x=parseInt(data[0]['Kd_Ssh2'])+1;
								$('#kode-ssh2').attr('type', 'text').val(x);
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
				let kode = data[i]['Kd_Ssh1']+'.'+data[i]['Kd_Ssh2']+'.'+data[i]['Kd_Ssh3'];
				let uraian = data[i]['Nm_Ssh3'];
				$('#'+nameTable+' > tbody').append('<tr><td>'+kode+'</td><td>'+uraian+'</td></tr>');
			}
		}
	}

	function deleteSsh(obj){
		var id= $(obj).attr('data-uid');
		var uraian= $(obj).attr('data-nama');
		var s=  'Data <strong>"'+uraian+'"</strong> akan dihapus ?';
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
							window.location=link+"admin/ssh2/"+id;
						}else{
							swal(
										'Batal!',
										'Data batal dihapus',
										'error'
								)
						}
			})
	}


	function comboTable(data,id){
		if(data){
			let create_update = $('#view-title').html();   //for update or create see title
			let active=true;
			if (create_update=="Tambah Kode SSH 2")    //option if update else create
			     active=true;
			else active=false;
			$('#kode-ssh1').empty().append('<option value='+''+'>Pilih SSH 1 </option>');
			for (var i = 0; i < data.length; i++){
					let kode = data[i]['Kd_Ssh1'];
					let uraian = toTitleCase(data[i]['Nm_Ssh1']);
					if (active==false)   //if update
					{
						if (kode==id)   //if user selected item
							$('#kode-ssh1').append('<option value='+kode+' selected>'+uraian+'</option>');
						else
							$('#kode-ssh1').append('<option value='+kode+'>'+uraian+'</option>');
					}
					else  //else create
					{
						$('#kode-ssh1').append('<option value='+kode+'>'+uraian+'</option>');
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

	$("#kode-ssh1").change(function () {    //change combo ref_ssh1
		var id = $(this).val();
		$('#kode-ssh-01').attr('type', 'text').val(id);
		if (id == ''){
				$('#kode-ssh-01').attr("disabled", true);
				$('#kode-ssh2').attr('type', 'text').val('');
				$('#kode-ssh2').attr("disabled", true);
				$('#nm-ssh2').attr("disabled", true);
		}
		else {
				$('#kode-ssh2').attr("disabled", false);
				$('#nm-ssh2').attr("disabled", false);
				$('#kode-ssh-01').attr("disabled", true);
				let create_update = $('#view-title').html();   //for update or create see title
				getSsh(id,'ref_ssh2');  //display text, last kode ref_ssh2
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


</script>
