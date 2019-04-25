	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';

		function createSsh(obj){
			var uid= $(obj).attr('data-uid');
			//alert(uid);
			//$('#kode-ssh1').attr("disabled", false);
			var id = '-';
			var dataSsh = 1;
			getSsh(dataSsh, id);
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#ssh-submit').attr('type', 'submit').val('Buat SSH');

		}

		function updateSsh(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;

			tampilSsh(dataSsh, id);
			$('#kode-ssh').val(id);
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#ssh-submit').attr('type', 'submit').val('Edit SSH');

		}

		function viewSsh(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;

			tampilSsh(dataSsh, id, false);
			//$('#sshForm').attr('action', '');
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
                	window.location=link+"admin/ssh/"+id;

                }else{
                	swal(
                        'Batal!',
                        'Datamu batal dihapus',
                        'error'
                    )
                }
            })

		}

		function tampilSsh(dataSsh, id, edit = true){
			$.ajax({
				type:'GET',
				url:link+"admin/ssh/get-ssh"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					if(!data){

						alert('Tidak Mendapatkan data');
					}else{
						let delay = 10;
						let speed = 200;
						setTimeout(function() {
							getSsh(1, '-');
						}, delay);
						delay +=speed;
						setTimeout(function() {
							getSsh(2, data['Kd_Ssh1']);
						}, delay);
						delay +=speed;
						setTimeout(function() {
							getSsh(3, ""+data['Kd_Ssh1']+"-"+data['Kd_Ssh2']+"");
						}, delay);
						delay +=speed;
						setTimeout(function() {
							getSsh(4, data['Kd_Ssh1']+"-"+data['Kd_Ssh2']+"-"+data['Kd_Ssh3']);
						}, delay);
						delay +=speed;
						setTimeout(function() {
							getSsh(5, data['Kd_Ssh1']+"-"+data['Kd_Ssh2']+"-"+data['Kd_Ssh3']+"-"+data['Kd_Ssh4']);
						}, delay);
						delay +=speed;
						setTimeout(function() {
							getSsh(6, data['Kd_Ssh1']+"-"+data['Kd_Ssh2']+"-"+data['Kd_Ssh3']+"-"+data['Kd_Ssh4']+"-"+data['Kd_Ssh5']);
						}, delay);
						delay +=speed;
						setTimeout(function() {
							selectDisable(0, true);
							$('#nama-barang').val(data['Nama_Barang']);
							$('#satuan').val(data['Kd_Satuan']);
							//$('#harga-satuan').val(convertToRupiah(data['Harga_Satuan']));
							$('#harga-zona-<?=$zona?>').val(convertToRupiah(data['harga_zona<?=$zona?>']));
							// $('#harga-zona-2').val(convertToRupiah(data['harga_zona2']));
							// $('#harga-zona-3').val(convertToRupiah(data['harga_zona3']));
							// $('#harga-zona-4').val(convertToRupiah(data['harga_zona4']));
							$('#kode-ssh6').val(data['Kd_Ssh6']);
							if(!edit){
								$('#nama-barang').attr("disabled", true);
								$('#satuan').attr("disabled", true);
								//$('#harga-satuan').attr("disabled", true);
								$('#harga-zona-<?=$zona?>').attr("disabled", true);
								// $('#harga-zona-2').attr("disabled", true);
								// $('#harga-zona-3').attr("disabled", true);
								// $('#harga-zona-4').attr("disabled", true);
							}
						}, delay);


					}


					console.log(data);
				},
				error:function(data){
					//console.log(data);
					alert('Terjadi kesalahan sistem.');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
			});
		}

		function getSsh(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/ssh/get-ssh"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					selectDisable(dataSsh);
					$('#kode-ssh'+dataSsh).empty().append('<option>Pilih SSH '+dataSsh+'</option>');
					for (var i = 0; i < data.length; i++){
					    var obj = data[i];
					    let html = '<option value="';
					    for(let j = 1;j<=dataSsh;j++){
					    	html += data[i]['Kd_Ssh'+j];
					    	if(j!=dataSsh){
					    		html +='-';
					    	}
					    }
					    html += '" >'+data[i]['Nm_Ssh'+dataSsh]+'</option>';
					    $('#kode-ssh'+dataSsh).append(html);

					}
					if(dataSsh >1){
						//alert((dataSsh-1)+" => "+id);
						//setTimeout(function() {
						  $('#kode-ssh'+(dataSsh-1)).val(id);
						  //alert((dataSsh-1)+" => "+id);
						//}, 1000);

					}
					//console.log(data);
				},
				error:function(data){
					//console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function selectDisable(ssh, status = false){
			if(!status){
				for(let i=5; i>0;i--){
					if(i>ssh){
						$('#kode-ssh'+i).empty();
						$('#kode-ssh'+i).attr("disabled", true);
					}else{
						$('#kode-ssh'+i).attr("disabled", false);
					}
				}
				$('#kode-ssh6').val('');
				$('#nama-barang').val('');
				//$('#harga-satuan').val('');
				$('#harga-zona-<?=$zona?>').val('');
				// $('#harga-zona-2').val('');
				// $('#harga-zona-3').val('');
				// $('#harga-zona-4').val('');

				$('#satuan').val('');

				$('#nama-barang').attr("disabled", true);
				//$('#harga-satuan').attr("disabled", true);
				$('#harga-zona-<?=$zona?>').attr("disabled", true);
				// $('#harga-zona-2').attr("disabled", true);
				// $('#harga-zona-3').attr("disabled", true);
				// $('#harga-zona-4').attr("disabled", true);
				$('#satuan').attr("disabled", true);
			}else{
				for(let i=5; i>0;i--){
					$('#kode-ssh'+i).attr("disabled", true);
				}
				$('#nama-barang').attr("disabled", false);
				//$('#harga-satuan').attr("disabled", false);
				$('#harga-zona-<?=$zona?>').attr("disabled", false);
				// $('#harga-zona-2').attr("disabled", false);
				// $('#harga-zona-3').attr("disabled", false);
				// $('#harga-zona-4').attr("disabled", false);
				$('#satuan').attr("disabled", false);
			}

		}

		$("#kode-ssh1").change( function() {
			var id = $(this).val();
			var dataSsh = 2;
			getSsh(dataSsh, id);
		});

		$("#kode-ssh2").change( function() {
			var id = $(this).val();
			var dataSsh = 3;
			getSsh(dataSsh, id);
		});

		$("#kode-ssh3").change( function() {
			var id = $(this).val();
			var dataSsh = 4;
			getSsh(dataSsh, id);
		});

		$("#kode-ssh4").change( function() {
			var id = $(this).val();
			var dataSsh = 5;
			getSsh(dataSsh, id);
		});

		$("#kode-ssh5").change( function() {
			var id = $(this).val();
			var dataSsh = 6;
			$.ajax({
				type:'GET',
				url:link+"admin/ssh/get-ssh"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					if(!data){
						$('#kode-ssh'+dataSsh).val(1);
					}else{
						$('#kode-ssh'+dataSsh).val(parseInt(data['Kd_Ssh6'])+1);
					}
					$('#kode-ssh').val(id+'-'+$('#kode-ssh'+dataSsh).val());
					$('#nama-barang').attr("disabled", false);
					//$('#harga-satuan').attr("disabled", false);
					$('#harga-zona-<?=$zona?>').attr("disabled", false);
					// $('#harga-zona-2').attr("disabled", false);
					// $('#harga-zona-3').attr("disabled", false);
					// $('#harga-zona-4').attr("disabled", false);
					$('#satuan').attr("disabled", false);

					//console.log(data);
				},
				error:function(data){
					//console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		});

	</script>
