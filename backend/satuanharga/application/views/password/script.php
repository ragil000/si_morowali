	<!-- sweet-alert -->
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.all.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/template/src/plugins/sweetalert2/sweetalert2.css">
	<script src="<?=base_url()?>public/template/src/plugins/sweetalert2/sweet-alert.init.js"></script>

	<!-- Convert to Rupah -->
	<script src="<?=base_url()?>public/assets/js/rupiah.js"></script>


	<script type="text/javascript">
		var link = '<?=base_url()?>';
	
	
		function createData(obj){
			//$('#sshForm').attr('action', link+'admin/ssh/set');
			$('#data-submit').attr('type', 'submit').val('Buat Akun');
			reset();

		}

		function updateData(obj){
			var id= $(obj).attr('data-uid');
			console.log(id);
			
			$('#id').val(id);
			$('#data-submit').attr('type', 'submit').val('Edit Akun');
			getData(id, false);
			
		}

		function viewData(obj){
			var id= $(obj).attr('data-uid');
			$('#data-submit').attr('type', 'hidden').val('');

			getData(id);
			
			
		}

		function deleteData(obj){
		
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
                	window.location=link+"admin/akun/"+id+"?search=<?=$search?>";
                    
                }else{
                	swal(
                        'Batal!',
                        'Datamu batal dihapus',
                        'error'
                    )
                }
            })
        
		}

		function reset(){
			$('#id').val('');
			$('#username').val('');
			$('#email').val('');
			$('#password').val('');
			$('#nama-lengkap').val('');
			$('#level').val('');
		}

		function getData(id, view = true){
			var url = link+'admin/akun/load-data';
			console.log(url);
			
			$.ajax({
	           type: "POST",
	           url: url,
	           dataType: "JSON",
	           data: {
	           		idKu : id,
	           }, // serializes the form's elements.
	           success: function(data)
	           {
	           		// console.log(data);
	           		//isiTable(data['hspkSsh'],  false, false);
	           		//tampilan(data);
	           		if(view){
	           			$('#view-id').html(": "+data['id']);
		           		$('#view-username').html(": "+data['username']);
		           		$('#view-nama-lengkap').html(": "+data['nama_lengkap']);
		           		$('#view-level').html(": "+data['ssh_level']);
	           		}else{
	           			
	           			$('#id').attr('disabled', false);
	           			$('#id').val(data['id']);
	           			$('#username').attr('disabled', false);
	           			$('#username').val(data['username']);
	           			$('#nama-lengkap').attr('disabled', false);
	           			$('#nama-lengkap').val(data['nama_lengkap']);
	           			$('#email').attr('disabled', false);
	           			$('#email').val(data['email']);
	           			$('#level').attr('disabled', false);
	           			$('#level').val(data['ssh_level']);
	           		}
	           		
	           		//console.log(data);
	           		
	           		//alert('s');
	           },
	           error:function(data){
					console.log(data);
					// $('#myError').html(data['responseText']);
					alert('error');
					// setTimeout(function() {
					// 	location.reload(true);
					// }, 5000);
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
				// $('#harga-zona-2').val('');
				// $('#harga-zona-3').val('');
				// $('#harga-zona-4').val('');

				$('#satuan').val('');

				$('#nama-barang').attr("disabled", true);
				//$('#harga-satuan').attr("disabled", true);
				$('#harga-zona').attr("disabled", true);
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
				// $('#harga-zona-2').attr("disabled", false);
				// $('#harga-zona-3').attr("disabled", false);
				// $('#harga-zona-4').attr("disabled", false);
				$('#satuan').attr("disabled", false);
			}
			
		}

	</script>

