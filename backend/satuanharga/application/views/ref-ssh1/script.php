	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';

		function createSsh(obj){
			setId(<?=$nomor?>, '-');

			$('#uraian-ssh').val('');
			$('#kode-ssh').attr('disabled', true);
			$('#ssh-submit').attr('type', 'submit').val('Buat SSH');

		}

		function updateSsh(obj){
			var id= $(obj).attr('data-uid');
			var uraian= $(obj).attr('data-nama');
			$('#uraian-ssh').val(uraian);
			$('#kode-ssh').val(id);
			$('#kode-ssh-asli').val(id);
			$('#kode-ssh').attr('disabled', true);
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#ssh-submit').attr('type', 'submit').val('Edit SSH');
			//getDataSsh(id, false);
			
		}

		function viewSsh(obj){
			var id= $(obj).attr('data-uid');
			var uraian= $(obj).attr('data-nama');
			getSsh(2, id);
			$('#view-kode-ssh').html(id);
			$('#view-uraian-ssh').html(uraian);
			$('#ssh-submit').attr('type', 'hidden').val('');
		}

		function deleteSsh(obj){
		
			var id= $(obj).attr('data-uid');
           	swal({
                title: 'Apakah anda yakin?',
                text: "Kamu akan menghapus data ini!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya!',
                cancelButtonText: 'Batal!',
                confirmButtonClass: 'btn btn-success margin-5',
                cancelButtonClass: 'btn btn-danger margin-5',
                buttonsStyling: false
            }).then(function (dismiss) {
            	//alert(JSON.stringify(dismiss));
            	//alert(dismiss['dismiss']);
                if (dismiss['value']) {

                	swal(
                    'Terhapus!',
                    'Datamu telah terhapus.',
                    'success'
                	)
                	window.location=link+"admin/ssh1/"+id+"?search=<?=$search?>";
                    
                }else{
                	swal(
                        'Batal!',
                        'Datamu batal dihapus',
                        'error'
                    )
                }
            })
        
		}

		function getSsh(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/ssh/get-ssh"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					//console.log(data);
					isiTable(data);
				},
				error:function(data){
					//console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function setId(nomor, dataId){
			$.ajax({
				type:'GET',
				url:link+"admin/ssh1/lastIdSsh"+nomor+"/"+dataId,
				dataType: "JSON",
				success:function(data){
					let id = '';
					for(let i = 1; i <= nomor; i++ ){
						id += data['Kd_Ssh'+i];
						if(i!=nomor)
							id += '-';
					}
					$('#kode-ssh-asli').val(parseInt(id)+1);
					$('#kode-ssh').val(parseInt(id)+1);
					//console.log(data);
					//isiTable(data);
				},
				error:function(data){
					//console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function isiTable(data, baru = true, table = true){
			var total = 0;
			var nameTable = 'tableTampil';
			if(data){
				$('#'+nameTable+' > tbody').empty();
				
				for (let i = 0; i < data.length; i++) {
					let kode = data[i]['Kd_Ssh2'];
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

	</script>

