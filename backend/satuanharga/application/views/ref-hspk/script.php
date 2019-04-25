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

		

		function isiTable(data, baru = true, table = true, id = null){
			var total = 0;
			let totalUpah = 0, totalbahan = 0, totalSewa = 0;
			var dataUpah = [];
			var dataBahan = [];
			var dataSewa = [];

			if(table)
				var nameTable = 'tableTampil';
			else
				var nameTable = 'tableTampil2';

			if(id != null)
				nameTable = 'tableTampil-'+id;

			//alert(nameTable);

			if(data){
				$('#'+nameTable+' > tbody').empty();
				
				for (let i = 0; i < data.length; i++) {
					
					let kategori = '';
					
					let persen = 0;
					// if(<?=$zona?> == 1){
					// 	persen = 0.03;
					// }else if(<?=$zona?> == 2){
					// 	persen = 0;
					// }else if(<?=$zona?> == 3){
					// 	persen = 0.06;
					// }else if(<?=$zona?> == 4){
					// 	persen = 0.10;
					// }

					//DataHspk[i]
					let nomor = data[i]['Kd_Ssh1']+"."+data[i]['Kd_Ssh2']+"."+data[i]['Kd_Ssh3']+"."+data[i]['Kd_Ssh4']+"."+data[i]['Kd_Ssh5']+"."+data[i]['Kd_Ssh6'];
					let kode = data[i]['Kd_Ssh1']+"-"+data[i]['Kd_Ssh2']+"-"+data[i]['Kd_Ssh3']+"-"+data[i]['Kd_Ssh4']+"-"+data[i]['Kd_Ssh5']+"-"+data[i]['Kd_Ssh6'];
					let kodeHspk = data[i]['Kd_Hspk1']+"-"+data[i]['Kd_Hspk2']+"-"+data[i]['Kd_Hspk3']+"-"+data[i]['Kd_Hspk4'];
					let uraian = data[i]['Nama_Barang'];
					let koefisien = data[i]['Koefisien'];
					let hargaSatuan = data[i]['Jumlah_HargaZona<?=$zona?>'];
					let satuan = data[i]['Uraian'];
					let harga = hargaSatuan*koefisien;
					total += harga;
					let isiTable;

					if(id != null || !table){
						isiTable = '<tr><td></td><td>'+nomor+'</td><td>'+uraian+'</td><td>'+koefisien+'</td><td>'+hargaSatuan+'</td><td>'+satuan+'</td><td>'+harga+'</td></tr>';
					}else{
						isiTable = '<tr><td><a href="javascript:void(0)" data-hspk="'+kodeHspk+'" data-uid="'+kode+'" onclick="deleteInTable(this)"><i class="fa fa-trash" aria-hidden="true"></i></a></td><td>'+nomor+'</td><td>'+uraian+'</td><td>'+koefisien+'</td><td>'+hargaSatuan+'</td><td>'+satuan+'</td><td>'+harga+'</td></tr>';
					}

					if(data[i]['Kategori'] == 1){
						kategori = 'Upah';
						dataUpah.push(isiTable); 
						totalUpah += harga;
					}else if(data[i]['Kategori'] == 2){
						kategori = 'Bahan';
						dataBahan.push(isiTable); 
						totalbahan += harga;
					}else if(data[i]['Kategori'] == 3){
						kategori = 'Sewa Peralatan';
						dataSewa.push(isiTable);
						totalSewa += harga; 
					}


					
				}

					if(dataUpah.length > 0){
						$('#'+nameTable+' > tbody').append('<tr><td></td><td colspan="5">Upah<td></tr>');
						for (var i = 0; i < dataUpah.length; i++) {
							$('#'+nameTable+' > tbody').append(dataUpah[i]);
						}
						$('#'+nameTable+' > tbody').append('<tr><td colspan="5"></td><td>Total Upah</td><td>Rp '+totalUpah+'<td></tr>');
					}
					
					if(dataBahan.length > 0){
						$('#'+nameTable+' > tbody').append('<tr><td></td><td colspan="5">Bahan<td></tr>');
						for (var i = 0; i < dataBahan.length; i++) {
							$('#'+nameTable+' > tbody').append(dataBahan[i]);
						}
						$('#'+nameTable+' > tbody').append('<tr><td colspan="5"></td><td>Total Bahan</td><td>Rp '+totalbahan+'<td></tr>');
					}
					if(dataSewa.length > 0){
						$('#'+nameTable+' > tbody').append('<tr><td></td><td colspan="5">Sewa<td></tr>');
						for (var i = 0; i < dataSewa.length; i++) {
							$('#'+nameTable+' > tbody').append(dataSewa[i]);
						}
						$('#'+nameTable+' > tbody').append('<tr><td colspan="5"></td><td>Total Sewa</td><td>Rp '+totalSewa+'<td></tr>');
					}
					
					


				$("#"+nameTable+" > tfoot th:eq(" + 6 + ")").html('Rp '+total);
			}
			$('#harga-zona-<?=$zona?>').val(total);
			//alert(total);
			
		}

		function deleteInTable(obj){
			var uid= $(obj).attr('data-uid');
			var hspk= $(obj).attr('data-hspk');
			
			// alert(uid);
			// alert(hspk);

			var url = link+'admin/hspk/delete-data-ssh/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idSsh : uid,
	           		idHspk : hspk
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           	//$('#hspkForm').submit();
	           		//isiTable(data['hspkSsh'],  false);
	           		//tampilan(data);
	           		//console.log(data);
	           		loadDataTable(hspk);
	           		//$('#hspkForm').submit();
	           		
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

		function create(obj){
			var uid= $(obj).attr('data-uid');
			//alert(uid);
			//$('#kode-ssh1').attr("disabled", false);
			var id = '-';
			var data = 1;
			get(data, id);
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#hspk-submit').attr('type', 'submit').val('Buat HSPK');


			isiTable(DataHspk);

		}

		function loadDataTable(id, table = false){
			var url = link+'admin/hspk/load-data-hspk/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idHspk : id,
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           		console.log(data);
	           		tampilan(data);
	           		//console.log(data);
	           		if(table){
	           			isiTable(data['hspkSsh'],  false, false, id);
	           		}else{
	           			isiTable(data['hspkSsh'],  false);
	           		}
	           		
	           		dontDataHspk = dontDataHspk.concat(data['hspkSsh']);
	           		//console.log(data);
	           		
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
		}

		function update(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;
			tahapForm(3);
			getSsh(1,'-');

			$('#hspk-submit').attr('type', 'submit').val('Edit HSPK');

			//var form = $('#hspkForm');
			loadDataTable(id);
			
		}

		function tampilan(data){
			$('#kode-hspk').val(data['hspk']['Kd_Hspk1']+"-"+data['hspk']['Kd_Hspk2']+"-"+data['hspk']['Kd_Hspk3']+"-"+data['hspk']['Kd_Hspk4']);
			//$('#kode-ssh').val(data['hspk'][0]['Kd_Ssh1']+"-"+data['hspk'][0]['Kd_Ssh2']+"-"+data['hspk'][0]['Kd_Ssh3']+"-"+data['hspk'][0]['Kd_Ssh4']+"-"+data['hspk'][0]['Kd_Ssh5']+"-"+data['hspk'][0]['Kd_Ssh6']);
			$('#uraian-kegiatan').val(data['hspk']['Uraian_Kegiatan']);
			$('#kode-hspk1').attr('disabled', true);
			$('#kode-hspk2').attr('disabled', true);
			$('#kode-hspk3').attr('disabled', true);
			$('#kode-hspk4').attr('disabled', true);
			
			$('#kode-hspk1').empty().append('<option value="'+data['hspk']['Kd_Hspk1']+'">'+data['hspk']['Nm_Hspk1']+'</option>');
			$('#kode-hspk2').empty().append('<option value="'+data['hspk']['Kd_Hspk2']+'">'+data['hspk']['Nm_Hspk2']+'</option>');
			$('#kode-hspk3').empty().append('<option value="'+data['hspk']['Kd_Hspk3']+'">'+data['hspk']['Nm_Hspk3']+'</option>');
			$('#kode-hspk4').val(data['hspk']['Kd_Hspk4']);
			$('#satuan').val(data['hspk']['Kd_Satuan']);
			//$('#satuan').empty().append('<option value="'+data['hspk']['Kd_Satuan']+'">'+data['hspk']['Uraian']+'</option>');
			$('#harga-zona-<?=$zona?>').val(data['hspk']['HargaZona<?=$zona?>']);
		}

		function view(obj){
			var id= $(obj).attr('data-uid');
			var dataSsh = 7;


			var form = $('#hspkForm');
			var url = link+'admin/hspk/load-data-hspk/<?=$zona?>';
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idHspk : id,
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           		isiTable(data['hspkSsh'],  false, false);
	           		//tampilan(data);
	           		$('#view-kode-hspk').html(": "+data['hspk']['Kd_Hspk1']+"."+data['hspk']['Kd_Hspk2']+"."+data['hspk']['Kd_Hspk3']+"."+data['hspk']['Kd_Hspk4']);
	           		$('#view-kode-hspk1').html(": "+data['hspk']['Kd_Hspk1']);
	           		$('#view-kode-hspk2').html(": "+data['hspk']['Kd_Hspk2']);
	           		$('#view-kode-hspk3').html(": "+data['hspk']['Kd_Hspk3']);
	           		$('#view-kode-hspk4').html(": "+data['hspk']['Kd_Hspk4']);
	           		$('#view-uraian').html(": "+data['hspk']['Uraian_Kegiatan']);
	           		$('#view-satuan').html(": "+data['hspk']['Uraian']);
	           		$('#view-harga').html(": "+data['hspk']['HargaZona<?=$zona?>']);
	           		//console.log(data);
	           		
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

		function deleteHspk(obj){
		
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
                	window.location=link+"admin/hspk/"+id+"?search=<?=$search?>&zona=<?=$zona?>";
                    
                }else{
                	swal(
                        'Batal!',
                        'Datamu batal dihapus',
                        'error'
                    )
                }
            })
        
		}


		function get(dataSsh, id){
			$.ajax({
				type:'GET',
				url:link+"admin/hspk/get-hspk"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					selectDisable(dataSsh);
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
					    html += '" >'+data[i]['Nm_Hspk'+dataSsh]+'</option>';
					    $('#kode-hspk'+dataSsh).append(html);
					    
					}
					if(dataSsh >1){
						//alert((dataSsh-1)+" => "+id);
						//setTimeout(function() {
						  $('#kode-hspk'+(dataSsh-1)).val(id);
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
							// $('#kategori').append('<option value="1">Upah</option>');
							// $('#kategori').append('<option value="2">Bahan</option>');
							// $('#kategori').append('<option value="3">Sewa Peralatan</option>');

							$('#satuan-ssh').val(data[0]['Satuan']);
							$('#id-satuan-ssh').val(data[0]['Kd_Satuan']);
							$('#harga-ssh-zona<?=$zona?>').val(data[0]['harga_zona<?=$zona?>']);
							$('#koefisien').val(0);
							$('#total-harga-ssh').val($('#koefisien').val()*$('#harga-ssh-zona<?=$zona?>').val());
							//$('#harga-zona-<?=$zona?>').val($('#total-harga-ssh').val());
							
							$('#hspk-tambah').attr('disabled', false)
							$('#koefisien').attr('disabled', false)
							$('#kategori').attr('disabled', false)
							$('#hspk-submit').attr('disabled', false)
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
				//$('#kode-ssh6').val('');
				//$('#nama-barang').val('');
				//$('#harga-satuan').val('');
				$('#harga-ssh-zona<?=$zona?>').val('');
				// $('#harga-zona-2').val('');
				// $('#harga-zona-3').val('');
				// $('#harga-zona-4').val('');

				$('#satuan-ssh').val('');

				//$('#nama-barang').attr("disabled", true);
				//$('#harga-satuan').attr("disabled", true);
				$('#harga-ssh-zona<?=$zona?>').attr("disabled", true);
				// $('#harga-zona-2').attr("disabled", true);
				// $('#harga-zona-3').attr("disabled", true);
				// $('#harga-zona-4').attr("disabled", true);
				$('#satuan-ssh').attr("disabled", true);
			}
			// else{
			// 	for(let i=5; i>0;i--){
			// 		$('#kode-ssh'+i).attr("disabled", true);
			// 	}
			// 	$('#nama-barang').attr("disabled", false);
			// 	//$('#harga-satuan').attr("disabled", false);
			// 	$('#harga-zona-<?=$zona?>').attr("disabled", false);
			// 	// $('#harga-zona-2').attr("disabled", false);
			// 	// $('#harga-zona-3').attr("disabled", false);
			// 	// $('#harga-zona-4').attr("disabled", false);
			// 	$('#satuan').attr("disabled", false);
			// }
			
		}


		function selectDisable(ssh, status = false){
			if(!status){
				for(let i=5; i>0;i--){
					if(i>ssh){
						$('#kode-hspk'+i).empty();
						$('#kode-hspk'+i).attr("disabled", true);
					}else{
						$('#kode-hspk'+i).attr("disabled", false);
					}
				}
				$('#kode-hspk4').val('');
				$('#nama-barang').val('');
				$('#harga-zona-<?=$zona?>').val('');

				$('#satuan').val('');

				$('#nama-barang').attr("disabled", true);
				$('#harga-zona-<?=$zona?>').attr("disabled", true);
				$('#satuan').attr("disabled", true);
			}else{
				for(let i=5; i>0;i--){
					$('#kode-ssh'+i).attr("disabled", true);
				}
				$('#nama-barang').attr("disabled", false);
				$('#harga-zona-<?=$zona?>').attr("disabled", false);
				$('#satuan').attr("disabled", false);
			}
			
		}

		$("#kode-hspk1").change( function() {
			var id = $(this).val();
			var dataSsh = 2;
			get(dataSsh, id);
		});

		$("#kode-hspk2").change( function() {
			var id = $(this).val();
			var dataSsh = 3;
			get(dataSsh, id);
		});


		$("#kode-hspk3").change( function() {
			var id = $(this).val();
			var dataSsh = 4;
			$.ajax({
				type:'GET',
				url:link+"admin/hspk/get-hspk"+dataSsh+"/"+id,
				dataType: "JSON",
				success:function(data){
					if(!data){
						$('#kode-hspk'+dataSsh).val('1');
					}else{
						if(!data['Kd_Hspk4']){
							alert(data['Kd_Hspk4']);
							data['Kd_Hspk4'] = 0;

						}

						$('#kode-hspk'+dataSsh).val(parseInt(data['Kd_Hspk4'])+1);
					}
					$('#kode-hspk').val(id+'-'+$('#kode-hspk'+dataSsh).val());
					$('#uraian-kegiatan').attr("disabled", false);
					//$('#harga-zona-<?=$zona?>').attr("disabled", false);
					$('#satuan').attr("disabled", false);
					tahapForm(2);
					
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

		$("#satuan").change( function() {
			var id = $('#kode-hspk').val();
			//alert(id);
			var dataSsh = 5;
			//get(dataSsh, id);
			$.ajax({
				type:'GET',
				url:link+"admin/hspk/get-hspk"+dataSsh+"/"+id,
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
					tahapForm(3);
					getSsh(1,'-');
					
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

		$('#koefisien').change(function() {
			$('#total-harga-ssh').val($(this).val()*$('#harga-ssh-zona<?=$zona?>').val());
		});



		var dataForm = [
			{ 'nama':'kode-hspk', 'data':[], },
			{ 'nama':'kode-hspk1', 'data':[], },
			{ 'nama':'kode-hspk2', 'data':[], },
			{ 'nama':'kode-hspk3', 'data':[], },
			//{ 'nama':'kode-hspk4', 'data':[], },

			{ 'nama':'uraian-kegiatan', 'data':[], },
			{ 'nama':'satuan', 'data':[], },
			//{ 'nama':'harga-zona-<?=$zona?>', 'data':[], },

			//{ 'nama':'kode-ssh', 'data':[], },
			{ 'nama':'kode-ssh1', 'data':[], },
			{ 'nama':'kode-ssh2', 'data':[], },
			{ 'nama':'kode-ssh3', 'data':[], },
			{ 'nama':'kode-ssh4', 'data':[], },
			{ 'nama':'kode-ssh5', 'data':[], },
			{ 'nama':'kode-ssh6', 'data':[], },

			//{ 'nama':'satuan-ssh', 'data':[], },
			//{ 'nama':'harga-ssh', 'data':[], },
			{ 'nama':'koefisien', 'data':[], },
			//{ 'nama':'total-harga-ssh', 'data':[], },
			{ 'nama':'kategori', 'data':[], },

			{ 'nama':'hspk-tambah', 'data':[], },

			{ 'nama':'hspk-submit', 'data':[], },



		];
		
		//tahapForm(2);
		function tahapForm(tahap){
			let batasTahap = [1,3,5,6];
			//alert(batasTahap[tahap]);
			
			for(let i = 0; i < dataForm.length; i++){
				if(i <= batasTahap[tahap]){
					$('#'+dataForm[i]['nama']).attr("disabled", false);
				}else{
					$('#'+dataForm[i]['nama']).attr("disabled", true);
				}
			}
			
			
		}

		function cancelHspk(e){
			var form = $('#hspkForm');
			var url = link+'admin/hspk/set-data-hspk/<?=$zona?>';

			// console.log(tempDataHspk);
	  //       console.log(dontDataHspk);

	  		for(let i = 0; i < tempDataHspk.length; i++){
	  			for (let j = 0; j < dontDataHspk.length; j++) {
	  				if(tempDataHspk[i]['idSsh'] == dontDataHspk[j]['Kd_Ssh1']+'-'+dontDataHspk[j]['Kd_Ssh2']+'-'+dontDataHspk[j]['Kd_Ssh3']+'-'+dontDataHspk[j]['Kd_Ssh4']+'-'+dontDataHspk[j]['Kd_Ssh5']+'-'+dontDataHspk[j]['Kd_Ssh6']){
	  					tempDataHspk[i]['idSsh'] = '0-0-0-0-0-0';
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

		$("#hspk-submit").click(function() {
			if(confirm('Pesan Tersimpan')){
			    window.location.reload();  
			}else{
				cancelHspk();
			}
		});

		$('#modal').on('hidden.bs.modal', function (e) {
		  	cancelHspk();
		})


		$("#hspkForm").submit(function(e) {
		    var form = $(this);
		    e.preventDefault();
		    let isi = {
		    	idSsh: $('#kode-ssh').val(),
		    	idHspk: $('#kode-hspk').val(),
		    }
		    
		    var url = link+'admin/hspk/set-data/<?=$zona?>';

		    //$('#kategori').empty();
		    $.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: form.serialize(), 
	           success: function(data)
	           {
	           		tempDataHspk = tempDataHspk.concat(isi);
	           		isiTable(data);
	           		console.log(tempDataHspk);
	           		console.log(dontDataHspk);
	           		
	                // show response from the php script.
	               
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

		});

		function viewTable(obj){
			var id = $(obj).attr('data-id');
			$('#table-view-'+id).toggle();
			$('#table-view-'+id).attr('colspan', 6);
			loadDataTable(id, true);
			//isiTable(data, false, false, id);
			// if($('#table-view-'+id).css('display') == 'none'){
			// 	$('#table-view-'+id).css('display', 'block');
			// 	$('#table-view-'+id).attr('colspan', 6);
			// }
			// else{
			// 	$('#table-view-'+id).css('display', 'none');
			// }
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

