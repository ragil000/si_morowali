<script type="text/javascript">
				
				function getSsh(dataSsh, id){
					$.ajax({
						type:'GET',
						url:"<?=base_url()?>admin/ssh/get-ssh"+dataSsh+"/"+id,
						dataType: "JSON",
						success:function(data){
							//selectDisable(dataSsh);
							$('#kode-ssh'+dataSsh).empty().append('<option> -= Semua SSH '+dataSsh+' =- </option>');
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
							console.log(data);
						},
						error:function(data){
							//console.log(data);
							setTimeout(function() {
								location.reload(true);
							}, 5000);
						}
					});
				}
				$("#kode-ssh1").change( function() {
					var id = $(this).val();
					var dataSsh = 2;
					getSsh(dataSsh, id);
				});
			</script>