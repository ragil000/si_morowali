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

		function viewAsb(obj){
			var id= $(obj).attr('data-uid');
			str_obj= $(obj).attr('data-str');
			var arr_str = str_obj.split(":");
			$('#view-kode-asb').html(id);							//kd_Asb1+kd_Asb2+kd_Asb3
			$('#view-uraian-asb1').html(arr_str[0]);  //Nm_Asb1
			$('#view-uraian-asb2').html(arr_str[1]);	//Nm_Asb2
			$('#view-uraian-asb3').html(arr_str[2]);	//Nm_Asb3
			$('#view-uraian-asb4').html(arr_str[3]);	//Nm_Asb3
		}

		function updateAsb(obj){
			id_obj= $(obj).attr('data-uid');
			var arr_id = id_obj.split(":");
			str_obj= $(obj).attr('data-str');
			var arr_str = str_obj.split(":");
			$('#id-asb').val(id_obj);		//type hidden, key for update
			setComponent(false);
			getAsb(arr_id[0],'ref_asb1','update');
			getAsb(arr_id[0],'ref_asb2','update');
			getAsb(id_obj,'ref_asb3','update');
			$('#kode-asb4').attr('type', 'text').val(arr_id[3]);
			$('#nm-asb4').attr('type', 'text').val(arr_str[3]);
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
								window.location=link+"admin/asb4/"+id;
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
				url:link+"admin/asb4/get-asb/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_asb1" && status=="create")//create->display asb1 to combo
							 comboTable(data,'#kode-asb1',status,id);
						if (tableName=="ref_asb2" && status=="create")//create->display asb2 to combo
 							 comboTable(data,'#kode-asb2',status,id);
						if (tableName=="ref_asb3" && status=="create")//create->display asb3 to combo
	  					 comboTable(data,'#kode-asb3',status,id);

						if (tableName=="ref_asb1" && status=="update") //update->display asb1 to combo
	 						 comboTable(data,'#kode-asb1',status,id);
						if (tableName=="ref_asb2" && status=="update"){//update->display asb2 to combo
							 var arr_id = id_obj.split(":");//use global variabel because parameter limit->kd_asb2
							 comboTable(data,'#kode-asb2',status,arr_id[1]);
						}
						if (tableName=="ref_asb3" && status=="update"){//update->display asb2 to combo
							 var arr_id = id_obj.split(":");//use global variabel because parameter limit->kd_asb2
							 comboTable(data,'#kode-asb3',status,arr_id[2]);
						}

						if (tableName=="ref_asb4" && status=="last record"){ //create->display last record+1 to text
							 let x=parseInt(data[0]['Kd_Asb4'])+1;
  						 $('#kode-asb4').attr('type', 'text').val(x);
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
			if (combo=='#kode-asb1')//create->combo name->kode-asb1; display table ref-asb1
				 no=1;
			if (combo=='#kode-asb2')//create->combo name->kode-asb1; display table ref-asb2
				 no=2;
		  if (combo=='#kode-asb3')//create->combo name->kode-asb2; display table ref-asb3
	 			 no=3;

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
						if (crud=='create')
			    			$(combo).append('<option value='+kode+'>'+uraian+'</option>');
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
			if (id == ''){
				  $('#kode-asb2').attr("disabled", true);
					$('#kode-asb3').attr("disabled", true);
					$('#kode-asb4').attr("disabled", true);
					$('#nm-asb4').attr("disabled", true);
					$('#kode-asb2').attr('type', 'text').val('');
					$('#kode-asb3').attr('type', 'text').val('');
					$('#kode-asb4').attr('type', 'text').val('');
					$('#nm-asb4').attr('type', 'text').val('');
			}
			else {
					$('#kode-asb2').attr("disabled", false);
					getAsb(id,'ref_asb2','create');
			}
		});

		$("#kode-asb2").change(function () {    //change combo ref_asb1
			var id = $(this).val();
			if (id == ''){
					$('#kode-asb3').attr("disabled", true);
					$('#kode-asb4').attr("disabled", true);
					$('#nm-asb4').attr("disabled", true);
					$('#kode-asb3').attr('type', 'text').val('');
					$('#kode-asb4').attr('type', 'text').val('');
					$('#nm-asb4').attr('type', 'text').val('');

			}
			else {
					$('#kode-asb3').attr("disabled", false);
					var idAsb1 = document.getElementById('kode-asb1').value;
					var kode=idAsb1+':'+id;
					getAsb(kode,'ref_asb3','create');
			}
		});


		$("#kode-asb3").change(function () {    //change combo ref_asb1
			var id = $(this).val();
			if (id == ''){
					$('#kode-asb4').attr("disabled", true);
					$('#nm-asb4').attr("disabled", true);
			}
			else {
					$('#kode-asb4').attr("disabled", false);
					$('#nm-asb4').attr("disabled", false);
				  var idAsb1 = $('#kode-asb1').val();
					var idAsb2 = $('#kode-asb2').val();
					var kode=idAsb1+':'+idAsb2+':'+id;
					getAsb(kode,'ref_asb4','last record');
			}
		});


		$(function() {    //for hide message
			var timeout = 3000;
			$('.hide').delay(timeout).fadeOut(1500);
		});

		function setComponent(active) {
			$('#kode-asb2').attr("disabled", active);
			$('#kode-asb3').attr("disabled", active);
			$('#kode-asb4').attr("disabled", active);
			$('#nm-asb4').attr("disabled", active);
			$('#kode-asb2').attr('type', 'text').val('');
			$('#kode-asb3').attr('type', 'text').val('');
			$('#kode-asb4').attr('type', 'text').val('');
			$('#nm-asb4').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode ASB 4');
				$('#asb-submit').attr('type', 'submit').val('Buat ASB');
			}else{  //create
				$('#view-title').html('Edit Kode ASB 4');
				$('#asb-submit').attr('type', 'submit').val('Edit ASB');
			}
    }
	</script>
