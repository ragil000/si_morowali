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

	function createAsb(obj){
		var id= $(obj).attr('data-uid');
		setComponent(true);
		getAsb(id,'ref_asb1','create');  //display combo ref_asb2
	}

	function updateAsb(obj){
		id_obj = $(obj).attr('data-uid');
		str_obj= $(obj).attr('data-str');
		var arr_id = id_obj.split(":");
		var arr_str = str_obj.split(":");
		$('#id-asb').val(id_obj); //type hidden for key to update
		setComponent(false);
		$('#kode-asb-01').attr('type', 'text').val(arr_id[0]);
		$('#kode-asb2').attr('type', 'text').val(arr_id[1]);
		$('#nm-asb2').attr('type', 'text').val(arr_str[1]);
		getAsb(arr_id[0],'ref_asb1','update');
	}

	function viewAsb(obj){
		id_obj= $(obj).attr('data-uid');
		str_obj= $(obj).attr('data-str');
		var arr_str = str_obj.split(":");
		$('#view-kode-asb1').html(id_obj);	//kd_hspk1
		$('#view-uraian-asb1').html(arr_str[0]);//Nm_hspk1
		$('#view-uraian-asb2').html(arr_str[1]);//Nm_hspk2
	}

	function getAsb(id,tableName,status){    //display all table with any categories
		$.ajax({
			type:'GET',
			url:link+"admin/asb2/get-asb/"+id+"/"+tableName,
			dataType: "JSON",
			success:function(data){
				if(data){

					if (tableName=="ref_asb1" && status=="create")//create->display table asb1 to combo
						 comboTable(data,'#kode-asb1',status,id);
					if (tableName=="ref_asb1" && status=="update") //update->display hspk1 to combo
						 comboTable(data,'#kode-asb1',status,id);
 				  if (tableName=="ref_asb2" && status=="last record"){//create->display last rec+1 to text
						 let x=parseInt(data[0]['Kd_Asb2'])+1;
						 $('#kode-asb2').attr('type', 'text').val(x);
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


	function deleteAsb(obj){
		var id= $(obj).attr('data-uid');
		var uraian= $(obj).attr('data-str');
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
							window.location=link+"admin/asb2/"+id;
						}else{
							swal(
										'Batal!',
										'Data batal dihapus',
										'error'
								)
						}
			})
	}


	function comboTable(data,combo,crud,id){
		if (combo=='#kode-asb1'){
			 no=1;
		}
		if(data){
			$(combo).empty().append('<option value='+''+'>Pilih ASB '+no+' </option>');
			for (var i = 0; i < data.length; i++){
					let kode = data[i]['Kd_Asb'+no];
					let uraian = data[i]['Nm_Asb'+no];
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

	$("#kode-asb1").change(function () {    //change combo ref_asb1
		var id = $(this).val();
		$('#kode-asb-01').attr('type', 'text').val(id);
		if (id == ''){
				$('#kode-asb-01').attr("disabled", true);
				$('#kode-asb2').attr('type', 'text').val('');
				$('#kode-asb2').attr("disabled", true);
				$('#nm-asb2').attr("disabled", true);
		}
		else {
				$('#kode-asb2').attr("disabled", false);
				$('#nm-asb2').attr("disabled", false);
				$('#kode-asb-01').attr("disabled", true);
				getAsb(id,'ref_asb2','last record');  //display text, last kode ref_asb2
		}
	});

	$(function() {    //for hide message
		var timeout = 3000;
		$('.hide').delay(timeout).fadeOut(1500);
	});

	function setComponent(active) {
		$('#kode-asb1').attr("disabled", false);
		$('#kode-asb2').attr("disabled", active);
		$('#nm-asb2').attr("disabled", active);
		$('#kode-asb1').attr('type', 'text').val('');
		$('#kode-asb2').attr('type', 'text').val('');
		$('#nm-asb2').attr('type', 'text').val('');
		if (active) { //create
			$('#view-title').html('Tambah Kode ASB 2');
			$('#asb-submit').attr('type', 'submit').val('Buat ASB');
		}else{  //update
			$('#view-title').html('Edit Kode ASB 2');
			$('#asb-submit').attr('type', 'submit').val('Edit ASB');
		}
	}


</script>
