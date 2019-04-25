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
			str_obj= $(obj).attr('data-str');
			id_obj= $(obj).attr('data-uid');
			id = id_obj.split(":");
			var idSsh= id[0]+'.'+id[1]+'.'+id[2]+'.'+id[3]+'.'+id[4];
			$('#view-kode-ssh').html(idSsh);
			$('#view-uraian-ssh5').html(str_obj);  //Nm_Ssh1
			getSshView(id[0],'ref_ssh1',1);
			getSshView(id[0]+':'+id[1],'ref_ssh2',2);
			getSshView(id[0]+':'+id[1]+':'+id[2],'ref_ssh3',3);
			getSshView(id[0]+':'+id[1]+':'+id[2]+':'+id[3],'ref_ssh4',4);
			getSsh(id_obj,'ref_ssh','view');
		}

		function getSshView(id,tableName,no){    //display all table with any categories
			$.ajax({
				type:'GET',
				url:link+"admin/ssh5/get-view/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						let uraian = data[0]['Nm_Ssh'+no];
						$('#view-uraian-ssh'+no).html(uraian);
					}
				},
				error:function(data){
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function updateSsh(obj){
			id_obj= $(obj).attr('data-uid');
			var arr_id = id_obj.split(":");
			str_obj= $(obj).attr('data-str');
			$('#id-ssh').val(id_obj);		//type hidden, key for update
			setComponent(false);
			getSsh(arr_id[0],'ref_ssh1','update');
			getSsh(arr_id[0],'ref_ssh2','update');
			getSsh(id_obj,'ref_ssh3','update');
			getSsh(id_obj,'ref_ssh4','update');
			$('#kode-ssh5').attr('type', 'text').val(arr_id[4]);
			$('#nm-ssh5').attr('type', 'text').val(str_obj);
		}

		function deleteSsh(obj){
			var id= $(obj).attr('data-uid');
			var uraian= $(obj).attr('data-str');
			var s= 'Data <strong><i>"'+uraian+'"</i></strong> akan dihapus ?';
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
								window.location=link+"admin/ssh5/"+id;
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
			var x='';
			$.ajax({
				type:'GET',
				url:link+"admin/ssh5/get-ssh/"+id+"/"+tableName,
				dataType: "JSON",
				success:function(data){
					if(data){
						if (tableName=="ref_ssh" && status=="view") //view->display table
							 isiTable(data);
						if (tableName=="ref_ssh1" && status=="create")//create->display ssh1 to combo
							 comboTable(data,'#kode-ssh1',status,id);
						if (tableName=="ref_ssh2" && status=="create")//create->display ssh2 to combo
 							 comboTable(data,'#kode-ssh2',status,id);
						if (tableName=="ref_ssh3" && status=="create")//create->display ssh3 to combo
	  					 comboTable(data,'#kode-ssh3',status,id);
					  if (tableName=="ref_ssh4" && status=="create")//create->display ssh3 to combo
	  					 comboTable(data,'#kode-ssh4',status,id);

						if (tableName=="ref_ssh1" && status=="update") //update->display ssh1 to combo
	 						 comboTable(data,'#kode-ssh1',status,id);
						if (tableName=="ref_ssh2" && status=="update"){  //update->display ssh2 to combo
							 var arr_id = id_obj.split(":");//use global variabel because parameter limit -> kd_ssh2
							 comboTable(data,'#kode-ssh2',status,arr_id[1]);
						}
						if (tableName=="ref_ssh3" && status=="update"){  //update->display ssh2 to combo
							 var arr_id = id_obj.split(":");//use global variabel because parameter limit -> kd_ssh2
							 comboTable(data,'#kode-ssh3',status,arr_id[2]);
						}
						if (tableName=="ref_ssh4" && status=="update"){  //update->display ssh2 to combo
							 var arr_id = id_obj.split(":");//use global variabel because parameter limit -> kd_ssh2
							 comboTable(data,'#kode-ssh4',status,arr_id[3]);
						}
						if (tableName=="ref_ssh5" && status=="last record"){ //create->display last record+1 to text
							 x=parseInt(data[0]['Kd_Ssh5'])+1;
							 $('#kode-ssh5').attr('type', 'text').val(x);
 						}
					}
				},
				error:function(data){
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
			if (x=='' && tableName=="ref_ssh5" && status=="last record")
				 $('#kode-ssh5').attr('type', 'text').val('1');
		}


		function comboTable(data,combo,crud,id){
			if (combo=='#kode-ssh1')  //create->combo name->kode-ssh1; display table ref-ssh1
				 no=1;
			if (combo=='#kode-ssh2')  //create->combo name->kode-ssh1; display table ref-ssh2
				 no=2;
		  if (combo=='#kode-ssh3')  //create->combo name->kode-ssh2; display table ref-ssh3
	 			 no=3;
		  if (combo=='#kode-ssh4')  //create->combo name->kode-ssh2; display table ref-ssh3
	 	 		 no=4;

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
					let kode = data[i]['Kd_Ssh1']+'.'+data[i]['Kd_Ssh2']+'.'+data[i]['Kd_Ssh3'];
					kode=kode+'.'+data[i]['Kd_Ssh4']+'.'+data[i]['Kd_Ssh5']+'.'+data[i]['Kd_Ssh6'];
					let uraian = data[i]['Nama_Barang'];
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
					$('#kode-ssh4').attr("disabled", true);
					$('#kode-ssh5').attr("disabled", true);
					$('#nm-ssh5').attr("disabled", true);
			}
			else {
					$('#kode-ssh2').attr("disabled", false);
					getSsh(id,'ref_ssh2','create');
			}
		});

		$("#kode-ssh2").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
					$('#kode-ssh3').attr("disabled", true);
					$('#kode-ssh4').attr("disabled", true);
					$('#kode-ssh5').attr("disabled", true);
					$('#nm-ssh5').attr("disabled", true);
			}
			else {
					$('#kode-ssh3').attr("disabled", false);
					var idSsh1 = document.getElementById('kode-ssh1').value;
					var kode=idSsh1+':'+id;
					getSsh(kode,'ref_ssh3','create');
			}
		});


		$("#kode-ssh3").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
					$('#kode-ssh4').attr("disabled", true);
					$('#kode-ssh5').attr("disabled", true);
					$('#nm-ssh5').attr("disabled", true);
			}
			else {
					$('#kode-ssh4').attr("disabled", false);
				  var idSsh1 = $('#kode-ssh1').val();
					var idSsh2 = $('#kode-ssh2').val();
					var kode=idSsh1+':'+idSsh2+':'+id;
					getSsh(kode,'ref_ssh4','create');
			}
		});

		$("#kode-ssh4").change(function () {    //change combo ref_ssh1
			var id = $(this).val();
			if (id == ''){
					$('#kode-ssh5').attr("disabled", true);
					$('#nm-ssh5').attr("disabled", true);
			}
			else {
					$('#kode-ssh5').attr("disabled", false);
					$('#nm-ssh5').attr("disabled", false);
				  var idSsh1 = $('#kode-ssh1').val();
					var idSsh2 = $('#kode-ssh2').val();
					var idSsh3 = $('#kode-ssh3').val();
					var kode=idSsh1+':'+idSsh2+':'+idSsh3+':'+id;
					getSsh(kode,'ref_ssh5','last record');
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
			$('#kode-ssh4').attr("disabled", active);
			$('#kode-ssh5').attr("disabled", active);
			$('#nm-ssh5').attr("disabled", active);
			$('#kode-ssh2').attr('type', 'text').val('');
			$('#kode-ssh3').attr('type', 'text').val('');
			$('#kode-ssh4').attr('type', 'text').val('');
			$('#kode-ssh5').attr('type', 'text').val('');
			$('#nm-ssh5').attr('type', 'text').val('');
			if (active) { //create
				$('#view-title').html('Tambah Kode SSH 5');
				$('#ssh-submit').attr('type', 'submit').val('Buat SSH');
			}else{  //create
				$('#view-title').html('Edit Kode SSH 5');
				$('#ssh-submit').attr('type', 'submit').val('Edit SSH');
			}

    }




	</script>
