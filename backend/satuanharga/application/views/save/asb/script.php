	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">

		var link = '<?=base_url()?>';
		var DataHspk = [];
		var tempDataHspk = [];
		var dontDataHspk = [];

        function roundToTwo(num) {    
            return +(Math.round(num + "e+2")  + "e-2");
        }

		function converToRupiah(bilangan){
			var	number_string = bilangan.toString(),
			split	= number_string.split('.'),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
			
			if (ribuan) {
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}


			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return rupiah;
		}

		function isiTable(data, baru = true, table = true, id = null){

			var total = 0;
			let totalKategori = 0;
			if(table)
				var nameTable = 'tableTampil';
			else
				var nameTable = 'tableTampil2';

			if(id != null)
				nameTable = 'tableTampil-'+id;

			//alert(nameTable);

			if(data){
				$('#'+nameTable+' > tbody').empty();
				let tempKategori = 0;
				for (let i = 0; i < data.length; i++) {
					let persen = 0;
					let nomor = data[i]['Kd_Hspk_Ssh1']+"."+data[i]['Kd_Hspk_Ssh2']+"."+data[i]['Kd_Hspk_Ssh3']+"."+data[i]['Kd_Hspk_Ssh4']+"."+data[i]['Kd_Ssh5']+"."+data[i]['Kd_Ssh6'];
					let kode = data[i]['Kd_Hspk_Ssh1']+"-"+data[i]['Kd_Hspk_Ssh2']+"-"+data[i]['Kd_Hspk_Ssh3']+"-"+data[i]['Kd_Hspk_Ssh4']+"-"+data[i]['Kd_Ssh5']+"-"+data[i]['Kd_Ssh6'];
					let kodeAsb = data[i]['Kd_Asb1']+"-"+data[i]['Kd_Asb2']+"-"+data[i]['Kd_Asb3']+"-"+data[i]['Kd_Asb4']+"-"+data[i]['Kd_Asb5'];
					let kategori = data[i]['Nama_Barang'];
					let koefisien = data[i]['Koefisien'];
					let hargaSatuan = data[i]['HargaZona<?=$zona?>'];
					let satuan = data[i]['Uraian'];
					let harga = hargaSatuan*koefisien//parseFloat(data[i]['Jumlah_Harga<?=$zona?>']);//;
					let tulisTotal = false;
					total += harga;
					
					
					if(data[i]['Kategori_Pekerjaan'] != tempKategori ){
						if(tempKategori != 0){
							$('#'+nameTable+' > tbody').append('<tr><td colspan="5"></td><td>Total</td><td>'+roundToTwo(totalKategori)+'</td></tr>');
							totalKategori = 0;	
						}
						$('#'+nameTable+' > tbody').append('<tr><td></td><td colspan="6">'+data[i]['pekerjaan']+'</td></tr>');
					}
					

					if(table)
						$('#'+nameTable+' > tbody').append('<tr><td><a href="javascript:void(0)" data-asb="'+kodeAsb+'" data-uid="'+kode+'" onclick="deleteInTable(this)"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td>'+nomor+'</td><td>'+kategori+'</td><td>'+koefisien+'</td><td>'+converToRupiah(hargaSatuan)+'</td><td>'+satuan+'</td><td>'+converToRupiah(harga)+'</td></tr>');
					else
						$('#'+nameTable+' > tbody').append('<tr><td></td><td>'+nomor+'</td><td>'+kategori+'</td><td>'+koefisien+'</td><td>'+roundToTwo(hargaSatuan)+'</td><td>'+satuan+'</td><td>'+roundToTwo(harga)+'</td></tr>');

					totalKategori +=harga;
					
					// if(i < data.length){
					// 	if(data[i+1]['Kategori_Pekerjaan'] != tempKategori){
					// 		tulisTotal = true;
					// 	}
					// }else{
					// 	tulisTotal = true;
					// }

					if(i+1 === data.length){
						tulisTotal = true;
					}
					//console.log(data.length);

					
					if(tulisTotal){
						$('#'+nameTable+' > tbody').append('<tr><td colspan="5"></td><td>Total</td><td>'+roundToTwo(totalKategori)+'</td></tr>');
						totalKategori = 0;						
					}

					tempKategori = data[i]['Kategori_Pekerjaan'];
				}

				$("#"+nameTable+" > tfoot th:eq(" + 6 + ")").html("Rp. "+roundToTwo(total));
				
				
			}
			$('#harga-zona-<?=$zona?>').val(total);
			
		}

		function deleteInTable(obj){
			var uid= $(obj).attr('data-uid');
			var asb= $(obj).attr('data-asb');
			
			var url = link+'admin/asb/delete-data-ssh/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idSsh : uid,
	           		idAsb : asb
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           		loadDataTable(asb);
	           },
	           error:function(data){
					//console.log(data);
					alert('error');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
		    });
		}

		function create(obj){
			var uid= $(obj).attr('data-uid');
			//alert(uid);
			//$('#kode-ssh1').attr("disabled", false);
			var id = '-';
			var data = 1;
			getAsb(data, id);
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#asb-submit').attr('type', 'submit').val('Buat ASB');

			$('#form-ssh').hide();
			$('#form-hspk').hide();
			$('#form-asb').hide();
			isiTable(DataHspk);

		}

		function loadDataTable(id, table = false){
			var url = link+'admin/asb/load-data-asb/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idAsb : id,
	           },
	           success: function(data)
	           {
	           		
	           		console.log(data)
	           		tampilan(data);
	           		//isiTable(data['AsbHspk'],  false);

	           		if(table){
	           			isiTable(data['AsbHspk'],  false, false, id);
	           		}else{
	           			isiTable(data['AsbHspk'],  false);
	           		}

	           		dontDataHspk = dontDataHspk.concat(data['AsbHspk']);
	           		//console.log(data);
	           		
	           		//alert('s');
	           },
	           error:function(data){
					console.log(data);
					$('#myError').html(data['responseText']);
					alert('error');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
		    });
		}

		function update(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;
			//tahapForm(3);
			//getAsb(1,'-');
			$('#form-ssh').hide();
			$('#form-hspk').hide();
			$('#form-asb').hide();
			$('#asb-submit').attr('type', 'submit').val('Edit ASB');

			//var form = $('#hspkForm');
			loadDataTable(id);
			
		}

		function tampilan(data){
			$('#kode-asb').val(data['asb']['Kd_Asb1']+"-"+data['asb']['Kd_Asb2']+"-"+data['asb']['Kd_Asb3']+"-"+data['asb']['Kd_Asb4']+"-"+data['asb']['Kd_Asb5']);
			//$('#kode-ssh').val(data['hspk'][0]['Kd_Ssh1']+"-"+data['hspk'][0]['Kd_Ssh2']+"-"+data['hspk'][0]['Kd_Ssh3']+"-"+data['hspk'][0]['Kd_Ssh4']+"-"+data['hspk'][0]['Kd_Ssh5']+"-"+data['hspk'][0]['Kd_Ssh6']);
			$('#jenis-pekerjaan').val(data['asb']['Jenis_Pekerjaan']);
			$('#kode-asb1').attr('disabled', true);
			$('#kode-asb2').attr('disabled', true);
			$('#kode-asb3').attr('disabled', true);
			$('#kode-asb4').attr('disabled', true);
			$('#kode-asb5').attr('disabled', true);

			$('#kategori-pekerjaan').attr('disabled', false);
			$('#asal').attr('disabled', false);
			
			$('#kode-asb1').empty().append('<option value="'+data['asb']['Kd_Asb1']+'">'+data['asb']['Nm_Asb1']+'</option>');
			$('#kode-asb2').empty().append('<option value="'+data['asb']['Kd_Asb2']+'">'+data['asb']['Nm_Asb2']+'</option>');
			$('#kode-asb3').empty().append('<option value="'+data['asb']['Kd_Asb3']+'">'+data['asb']['Nm_Asb3']+'</option>');
			$('#kode-asb4').empty().append('<option value="'+data['asb']['Kd_Asb4']+'">'+data['asb']['Nm_Asb4']+'</option>');
			$('#kode-asb5').val(data['asb']['Kd_Asb5']);
			//$('#satuan-asb').empty().append('<option value="'+data['asb']['Kd_Satuan']+'">'+data['asb']['Uraian']+'</option>');
			$('#satuan-asb').attr('disabled', false);
			$('#jenis-pekerjaan').attr('disabled', false);
			$('#satuan-asb').val(data['asb']['Kd_Satuan']);
			$('#jenis-pekerjaan').val(data['asb']['Jenis_Pekerjaan']);
			$('#harga-zona-<?=$zona?>').val(data['asb']['HargaZona<?=$zona?>']);
		}

		function view(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;


			var form = $('#asbForm');
			var url = link+'admin/asb/load-data-asb/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idAsb : id,
	           }, // serializes the form's elements.
	           
	           success: function(data)
	           {

	           		console.log(data)
	           		isiTable(data['AsbHspk'],  false, false);
	           		//tampilan(data);
	           		$('#view-kode-asb').html(": "+data['asb']['Kd_Asb1']+"."+data['asb']['Kd_Asb2']+"."+data['asb']['Kd_Asb3']+"."+data['asb']['Kd_Asb4']+"."+data['asb']['Kd_Asb5']);
	           		$('#view-kode-asb1').html(": "+data['asb']['Nm_Asb1']);
	           		$('#view-kode-asb2').html(": "+data['asb']['Nm_Asb2']);
	           		$('#view-kode-asb3').html(": "+data['asb']['Nm_Asb3']);
	           		$('#view-kode-asb4').html(": "+data['asb']['Nm_Asb4']);
	           		$('#view-kode-asb5').html(": "+data['asb']['Kd_Asb5']);
	           		$('#view-uraian').html(": "+data['asb']['Jenis_Pekerjaan']);
	           		$('#view-satuan').html(": "+data['asb']['Uraian']);
	           		$('#view-harga').html(": "+data['asb']['HargaZona<?=$zona?>']);
	           		// //console.log(data);
	           		
	           		//alert('s');
	           },
	           error:function(data){
					//console.log(data);
					alert('error');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
		    });
			
			
		}

		function deleteAsb(obj){
		
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
                	window.location=link+"admin/asb/"+id+"?search=<?=$search?>&zona=<?=$zona?>";
                    
                }else{
                	swal(
                        'Batal!',
                        'Datamu batal dihapus',
                        'error'
                    )
                }
            })
        
		}

		function getAsb(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/asb/get-asb"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					selectDisableAsb(dataSsh);
					$('#kode-asb'+dataSsh).empty().append('<option>Pilih ASB '+dataSsh+'</option>');
					for (var i = 0; i < data.length; i++){
					    var obj = data[i];
					    let html = '<option value="';
					    for(let j = 1;j<=dataSsh;j++){
					    	html += data[i]['Kd_Asb'+j];
					    	if(j!=dataSsh){
					    		html +='-';
					    	}
					    }
					    html += '" >';
					    
					    html += ' '+data[i]['Nm_Asb'+dataSsh]+'</option>';
					    $('#kode-asb'+dataSsh).append(html);
					    
					}
					if(dataSsh >1){
						//alert((dataSsh-1)+" => "+id);
						//setTimeout(function() {
						  $('#kode-asb'+(dataSsh-1)).val(id);
						  //alert((dataSsh-1)+" => "+id);
						//}, 1000);
						
					}
					//console.log(data);
				},
				error:function(data){
					console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function getAsb2(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/asb/get-asbt"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					//console.log(data);
					
					if(dataSsh <=5){
						selectDisableAsbt(dataSsh);
						$('#kode-tambahan-asb'+dataSsh).empty().append('<option>Pilih ASB '+dataSsh+'</option>');
						for (var i = 0; i < data.length; i++){

						    var obj = data[i];
						    let html = '<option value="';
						    for(let j = 1;j<=dataSsh;j++){
						    	html += data[i]['Kd_Asb'+j];
						    	if(j!=dataSsh){
						    		html +='-';
						    	}
						    }
						    html += '" >';
						    if(dataSsh != 5){
						    	html += ' '+data[i]['Nm_Asb'+dataSsh]+'</option>';
						    }else{
						    	html += ' '+data[i]['Jenis_Pekerjaan']+'</option>';
						    }
						    $('#kode-tambahan-asb'+dataSsh).append(html);
						}

					}else{
						if(data){

							let html = '';

							$('#satuan-tambahan').val(data[0]['Kd_Satuan']);
							$('#id-satuan').val(data[0]['Kd_Satuan']);
							$('#harga-tambahan-zona<?=$zona?>').val(data[0]['HargaZona<?=$zona?>']);
							$('#koefisien').val(0);
							$('#total-harga-tambahan').val($('#koefisien').val()*$('#harga-tambahan-zona<?=$zona?>').val());
							//$('#harga-zona-<?=$zona?>').val($('#total-harga-ssh').val());
							
							$('#data-tambah').attr('disabled', false);
							$('#koefisien').attr('disabled', false);
							$('#asb-submit').attr('disabled', false);
						}
						
						
					}
					
				},
				error:function(data){
					alert('error');
					console.log(data);
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
			});
		}

		function getHspk(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/asb/get-hspk"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					//console.log(data);
					
					if(dataSsh <=4){
						selectDisableHspk(dataSsh);
						$('#kode-hspk'+dataSsh).empty().append('<option>Pilih HSPK '+dataSsh+'</option>');
						for (var i = 0; i < data.length; i++){

						    var obj = data[i];
						    let html = '<option value="';
						    for(let j = 1;j<=dataSsh;j++){
						    	html += data[i]['Kd_Hspk'+j];
						    	if(j!=dataSsh){
						    		html +='-';
						    	}
						    }
						    if(dataSsh != 4){
						    	html += '" >'+data[i]['Nm_Hspk'+dataSsh]+'</option>';
						    }else{
						    	html += '" >'+data[i]['Uraian_Kegiatan']+'</option>';
						    }

						   	 
						    $('#kode-hspk'+dataSsh).append(html);
						    
						}

					}else{
						if(data){

							let html = '';

							$('#satuan-tambahan').val(data[0]['Kd_Satuan']);
							$('#id-satuan').val(data[0]['Kd_Satuan']);
							$('#harga-tambahan-zona<?=$zona?>').val(data[0]['HargaZona<?=$zona?>']);
							$('#koefisien').val(0);
							$('#total-harga-tambahan').val($('#koefisien').val()*$('#harga-tambahan-zona<?=$zona?>').val());
							//$('#harga-zona-<?=$zona?>').val($('#total-harga-ssh').val());
							
							$('#data-tambah').attr('disabled', false);
							$('#koefisien').attr('disabled', false);
							$('#asb-submit').attr('disabled', false);
						}
						
						
					}
					
				},
				error:function(data){
					alert('error');
					console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}

		function getSsh(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/hspk/get-ssh"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					
					if(dataSsh <=6){
						selectDisableSsh(dataSsh);
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
						    if(dataSsh != 6){
						    	html += '" >'+data[i]['Nm_Ssh'+dataSsh]+'</option>';
						    }else{
						    	html += '" >'+data[i]['Nama_Barang']+'</option>';
						    }

						   	 
						    $('#kode-ssh'+dataSsh).append(html);
						    
						}
					}else{
						if(data){

							let html = '';

							$('#satuan-tambahan').val(data[0]['Satuan']);
							$('#id-satuan').val(data[0]['Kd_Satuan']);
							$('#harga-tambahan-zona<?=$zona?>').val(data[0]['harga_zona<?=$zona?>']);
							$('#koefisien').val(0);
							$('#total-harga-tambahan').val($('#koefisien').val()*$('#harga-tambahan-zona<?=$zona?>').val());
							//$('#harga-zona-<?=$zona?>').val($('#total-harga-ssh').val());
							
							$('#data-tambah').attr('disabled', false);
							$('#koefisien').attr('disabled', false);
							$('#asb-submit').attr('disabled', false);
						}
						
						
					}
					
				},
				error:function(data){
					console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
		}
		

		function selectDisableSsh(ssh, status = false){
			if(!status){
				for(let i=6; i>0;i--){
					if(i>ssh){
						$('#kode-ssh'+i).empty();
						$('#kode-ssh'+i).attr("disabled", true);
					}else{
						$('#kode-ssh'+i).attr("disabled", false);
					}
				}
				$('#harga-tambahan-zona<?=$zona?>').val('');

				$('#satuan-tambahan').val('');
				$('#harga-tambahan-zona<?=$zona?>').attr("disabled", true);
				$('#satuan-tambahan').attr("disabled", true);
			}
			
		}

		function selectDisableAsbt(ssh, status = false){
			if(!status){
				for(let i=6; i>0;i--){
					if(i>ssh){
						$('#kode-tambahan-asb'+i).empty();
						$('#kode-tambahan-asb'+i).attr("disabled", true);
					}else{
						$('#kode-tambahan-asb'+i).attr("disabled", false);
					}
				}
				$('#harga-tambahan-zona<?=$zona?>').val('');

				$('#satuan-tambahan').val('');
				$('#harga-tambahan-zona<?=$zona?>').attr("disabled", true);
				$('#satuan-tambahan').attr("disabled", true);
			}
			
		}

		function selectDisableHspk(ssh, status = false){
			if(!status){
				for(let i=6; i>0;i--){
					if(i>ssh){
						$('#kode-hspk'+i).empty();
						$('#kode-hspk'+i).attr("disabled", true);
					}else{
						$('#kode-hspk'+i).attr("disabled", false);
					}
				}
				$('#harga-tambahan-zona<?=$zona?>').val('');

				$('#satuan-tambahan').val('');
				$('#harga-tambahan-zona<?=$zona?>').attr("disabled", true);
				$('#satuan-tambahan').attr("disabled", true);
			}
			
		}


		function selectDisableAsb(ssh, status = false){
			if(!status){
				for(let i=5; i>0;i--){
					if(i>ssh){
						$('#kode-asb'+i).empty();
						$('#kode-asb'+i).attr("disabled", true);
					}else{
						$('#kode-asb'+i).attr("disabled", false);
					}
				}
				$('#kode-asb5').val('');
				$('#jenis-pekerjaan').val('');
				$('#harga-zona-<?=$zona?>').val('');

				$('#satuan-asb').val('');

				$('#jenis-pekerjaan').attr("disabled", true);
				$('#harga-zona-<?=$zona?>').attr("disabled", true);
				$('#satuan-asb').attr("disabled", true);
			}else{
				for(let i=5; i>0;i--){
					$('#kode-asb'+i).attr("disabled", true);
				}
				$('#jenis-pekerjaan').attr("disabled", false);
				$('#harga-zona-<?=$zona?>').attr("disabled", false);
				$('#satuan-asb').attr("disabled", false);
			}
			
		}

		// select form

		$("#kode-asb1").change( function() {
			var id = $(this).val();
			var dataSsh = 2;
			getAsb(dataSsh, id);
		});

		$("#kode-asb2").change( function() {
			var id = $(this).val();
			var dataSsh = 3;
			getAsb(dataSsh, id);
		});

		$("#kode-asb3").change( function() {
			var id = $(this).val();
			var dataSsh = 4;
			getAsb(dataSsh, id);
		});

		$("#kode-asb4").change( function() {
			var id = $(this).val();
			var dataSsh = 5;
			$.ajax({
				type:'GET',
				url:link+"admin/asb/get-asb"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					if(!data){
						$('#kode-asb'+dataSsh).val('1');
					}else{
						if(!data['Kd_Asb5']){
							alert(data['Kd_Asb5']);
							data['Kd_Asb5'] = 0;

						}

						$('#kode-asb'+dataSsh).val(parseInt(data['Kd_Asb5'])+1);
					}
					$('#kode-asb').val(id+'-'+$('#kode-asb'+dataSsh).val());
					$('#jenis-pekerjaan').attr("disabled", false);
					//$('#harga-zona-<?=$zona?>').attr("disabled", false);
					$('#satuan-asb').attr("disabled", false);
					
					
					
					//tahapForm(2);
					
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

		$("#satuan-asb").change( function() {
			var id = $('#kode-asb').val();
			//alert(id);
			var dataSsh = 6;
			//get(dataSsh, id);
			$.ajax({
				type:'GET',
				url:link+"admin/asb/get-asb"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					if(!data){
						$('#harga-zona-<?=$zona?>').val('0');
					}else{
						
						if(!data['HargaZona<?=$zona?>']){
							$('#harga-zona-<?=$zona?>').val('0');

						}else{
							$('#harga-zona-<?=$zona?>').val(data['HargaZona<?=$zona?>']);
						}

					}
					//tahapForm(3);
					getSsh(1,'-');
					getHspk(1,'-');
					getAsb2(1, '-')
					//console.log(data);
				},
				error:function(data){
					//console.log(data);
					setTimeout(function() {
						location.reload(true);
					}, 5000);
				}
			});
			$('#kategori-pekerjaan').attr("disabled", false);
			$('#asal').attr("disabled", false);
		});

		$('#asal').change(function(){
			
			$('#form-ssh').hide();
			$('#form-hspk').hide();
			$('#form-asb').hide();
			if($(this).val()==1){
				$('#form-ssh').show();
				getSsh(1,'-');
			}else if($(this).val()==2){

				$('#form-hspk').show();
				getHspk(1,'-');
			}else if($(this).val()==3){
				$('#form-asb').show();
				getAsb2(1, '-')
			}
		});


		$("#kode-hspk1").change( function() {
			var id = $(this).val();
			var dataSsh = 2;
			getHspk(dataSsh, id);
		});

		$("#kode-hspk2").change( function() {
			var id = $(this).val();
			var dataSsh = 3;
			getHspk(dataSsh, id);
		});


		$("#kode-hspk3").change( function() {
			var id = $(this).val();
			var dataSsh = 4;
			getHspk(dataSsh, id);
		});

		$("#kode-hspk4").change( function() {
			var id = $(this).val();
			var dataSsh = 5;
			getHspk(dataSsh, id);
			$('#kode-hspk').val(id);
		});

		// $("#satuan").change( function() {
		// 	var id = $('#kode-hspk').val();
		// 	//alert(id);
		// 	var dataSsh = 5;
		// 	//get(dataSsh, id);
		// 	$.ajax({
		// 		type:'GET',
		// 		url:link+"admin/hspk/get-hspk"+dataSsh+"/"+id,
		// 		dataType: "JSON",
		// 		success:function(data){
		// 			if(!data){
		// 				$('#harga-zona-<?=$zona?>').val('0');
		// 			}else{
						
		// 				if(!data['HargaZona<?=$zona?>']){
		// 					$('#harga-zona-<?=$zona?>').val('0');

		// 				}else{
		// 					$('#harga-zona-<?=$zona?>').val(data['HargaZona<?=$zona?>']);
		// 				}

		// 			}
		// 			//tahapForm(3);
		// 			getSsh(1,'-');
					
		// 			//console.log(data);
		// 		},
		// 		error:function(data){
		// 			//console.log(data);
		// 			setTimeout(function() {
		// 				location.reload(true);
		// 			}, 5000);
		// 		}
		// 	});
		// });

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
			getSsh(dataSsh, id);
		});

		$("#kode-ssh6").change( function() {
			var id = $(this).val();
			var dataSsh = 7;
			getSsh(dataSsh, id);


			$('#kode-ssh').val(id);


		});

		$("#kode-tambahan-asb1").change( function() {
			var id = $(this).val();
			var dataSsh = 2;
			getAsb2(dataSsh, id);
		});

		$("#kode-tambahan-asb2").change( function() {
			var id = $(this).val();
			var dataSsh = 3;
			getAsb2(dataSsh, id);
		});

		$("#kode-tambahan-asb3").change( function() {
			var id = $(this).val();
			var dataSsh = 4;
			getAsb2(dataSsh, id);
		});

		$("#kode-tambahan-asb4").change( function() {
			var id = $(this).val();
			var dataSsh = 5;
			getAsb2(dataSsh, id);
		});

		$("#kode-tambahan-asb5").change( function() {
			var id = $(this).val();
			var dataSsh = 6;
			getAsb2(dataSsh, id);

			$('#kode-tambahan-asb').val(id);
		});

		$('#koefisien').change(function() {
			$('#total-harga-tambahan').val($(this).val()*$('#harga-tambahan-zona<?=$zona?>').val());
		});



		// var dataForm = [
		// 	{ 'nama':'kode-hspk', 'data':[], },
		// 	{ 'nama':'kode-hspk1', 'data':[], },
		// 	{ 'nama':'kode-hspk2', 'data':[], },
		// 	{ 'nama':'kode-hspk3', 'data':[], },
		// 	//{ 'nama':'kode-hspk4', 'data':[], },

		// 	{ 'nama':'uraian-kegiatan', 'data':[], },
		// 	{ 'nama':'satuan', 'data':[], },
		// 	//{ 'nama':'harga-zona-<?=$zona?>', 'data':[], },

		// 	//{ 'nama':'kode-ssh', 'data':[], },
		// 	{ 'nama':'kode-ssh1', 'data':[], },
		// 	{ 'nama':'kode-ssh2', 'data':[], },
		// 	{ 'nama':'kode-ssh3', 'data':[], },
		// 	{ 'nama':'kode-ssh4', 'data':[], },
		// 	{ 'nama':'kode-ssh5', 'data':[], },
		// 	{ 'nama':'kode-ssh6', 'data':[], },

		// 	//{ 'nama':'satuan-ssh', 'data':[], },
		// 	//{ 'nama':'harga-ssh', 'data':[], },
		// 	{ 'nama':'koefisien', 'data':[], },
		// 	//{ 'nama':'total-harga-ssh', 'data':[], },
		// 	{ 'nama':'kategori', 'data':[], },

		// 	{ 'nama':'hspk-tambah', 'data':[], },

		// 	{ 'nama':'hspk-submit', 'data':[], },



		// ];
		
		//tahapForm(2);
		// function tahapForm(tahap){
		// 	let batasTahap = [1,3,5,6];
		// 	//alert(batasTahap[tahap]);
			
		// 	for(let i = 0; i < dataForm.length; i++){
		// 		if(i <= batasTahap[tahap]){
		// 			$('#'+dataForm[i]['nama']).attr("disabled", false);
		// 		}else{
		// 			$('#'+dataForm[i]['nama']).attr("disabled", true);
		// 		}
		// 	}
			
			
		// }

		function cancelHspk(e){
			var form = $('#asbForm');
			var url = link+'admin/asb/set-data-asb/<?=$zona?>';

			// console.log(tempDataHspk);
	  //       console.log(dontDataHspk);

	  		for(let i = 0; i < tempDataHspk.length; i++){
	  			for (let j = 0; j < dontDataHspk.length; j++) {
	  				if(tempDataHspk[i]['id'] == dontDataHspk[j]['Kd_Hspk_Ssh1']+'-'+dontDataHspk[j]['Kd_Hspk_Ssh2']+'-'+dontDataHspk[j]['Kd_Hspk_Ssh3']+'-'+dontDataHspk[j]['Kd_Hspk_Ssh4']+'-'+dontDataHspk[j]['Kd_Ssh5']+'-'+dontDataHspk[j]['Kd_Ssh6']){
	  					tempDataHspk[i]['id'] = '0-0-0-0-0-0';
	  				}
	  			}
	  		}

			$.ajax({
	           type: "POST",
	           url: url,
	           //dataType: "JSON",
	           data: {
	           		kirim: tempDataHspk
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           		//isiTable(data);
	           		//console.log(data);
	           		if(!data){
	           			alert('Terjadi Kesalahan');
	           		}
	           		$('#modal').modal('hide');
	           		//alert('s');
	           },
	           error:function(data){
					console.log(data);
					alert('error');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
		    });

		   	//e.preventDefault();
		}

		$('#submit').click(function() {
			cancelHspk();
		});

		$("#asb-submit").click(function() {
			if(confirm('Anda yakin ingin menyimpan pesan?')){
			    window.location.reload();  
			}else{
				cancelHspk();
			}
		});

		$('#modal').on('hidden.bs.modal', function (e) {
		  	cancelHspk();
		})



		$("#asbForm").submit(function(e) {
		    var form = $(this);
		    e.preventDefault();
		    let idCek = $('#kode-ssh').val();
		    if($('#asal').val()==1){
		    	idCek = $('#kode-ssh').val();
		    }else if($('#asal').val()==2){
		    	idCek = $('#kode-hspk').val()+"-0-0";
		    }else if($('#asal').val()==3){
		    	idCek = $('#kode-tambahan-asb').val()+"-0";
		    }
		    let isi = {
		    	idAsb :$('#kode-asb').val(),
		    	idSsh: $('#kode-ssh').val(),
		    	idHspk: $('#kode-hspk').val()+"-0-0",
		    	idAsbtambahan : $('#kode-tambahan-asb').val()+"-0",
		    	asal : $('#asal').val(),
		    	id : idCek,
		    }
		    var url = link+'admin/asb/set-data/<?=$zona?>';
		    $.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: form.serialize(), 
	           success: function(data)
	           {
	           	console.log(data);

	           		 tempDataHspk = tempDataHspk.concat(isi);
	           		 isiTable(data);
	           		// console.log(tempDataHspk);
	           		// console.log(dontDataHspk);
	           		
	                // show response from the php script.
	               
	           },
	           error:function(data){
					//console.log(data);
					//$('#myError').html(data['responseText']);
					console.log(data);
					alert('Gagal menyimpan data. Mohon Lengkapi Data');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
				}
		    });

		});

        setTimeout(function() {
            <?php 
                foreach ($ssh as $data){
                    echo "viewTable('".$data['Kd_Asb1']."-".$data['Kd_Asb2']."-".$data['Kd_Asb3']."-".$data['Kd_Asb4']."-".$data['Kd_Asb5']."');";
                }
            ?>
		}, 3000);

		function viewTable(obj){
			// var id = $(obj).attr('data-id');
            var id = obj;
			$('#table-view-'+id).toggle();
			$('#table-view-'+id).attr('colspan', 6);

			loadDataTable(id, true);
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

