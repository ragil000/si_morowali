<div style="text-align: center; font-size: 30px;">DAFTAR STANDAR SATUAN HARGA</div>
<div style="text-align: center; font-size: 30px;">(SSH)</div>
<br>
<br>
<table style="border-collapse: collapse;font-size: 9px;">
	<tr>
		<td  style="border: 1px solid; padding: 10px;">No.</td>
		<td style="border: 1px solid; padding: 10px;">Uraian</td>
		<td style="border: 1px solid; padding: 10px;">Spesifikasi</td>
		<td style="border: 1px solid; padding: 10px;">Satuan</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 1</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 2</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 3</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 4</td>
	</tr>
	<?php 
		//print_r($this->SaveModel->getAsb(1,'1')[0]);
		$ssh1 = $this->SaveModel->getSsh(1,'1', $kode);
		for($i = 0; $i < count($ssh1); $i++) {
			echo '<tr>
					<td style="border: 1px solid; padding: 10px;">'.$ssh1[$i]['Kd_Ssh1'].'</td>
					<td colspan="7" style="border: 1px solid; padding: 10px;">'.$ssh1[$i]['Nm_Ssh1'].'</td>
				</tr>';
			$ssh2 = $this->SaveModel->getSsh(2,$ssh1[$i]['Kd_Ssh1'].'-'.$i, $kode2);
			for($j = 0; $j < count($ssh2); $j++){
				echo '<tr>
						<td style="border: 1px solid; padding: 10px;">'.$ssh2[$j]['Kd_Ssh1'].'.'.$ssh2[$j]['Kd_Ssh2'].'</td>
						<td colspan="7" style="border: 1px solid; padding: 10px;">'.$ssh2[$j]['Nm_Ssh2'].'</td>
					</tr>';
				$ssh3 = $this->SaveModel->getSsh(3,$ssh1[$i]['Kd_Ssh1'].'-'.$ssh2[$j]['Kd_Ssh2'].'-'.$j);
				for ($k=0; $k < count($ssh3); $k++) { 
					echo '<tr>
							<td style="border: 1px solid; padding: 10px;">'.$ssh3[$k]['Kd_Ssh1'].'.'.$ssh3[$k]['Kd_Ssh2'].'.'.$ssh3[$k]['Kd_Ssh3'].'</td>
							<td colspan="7" style="border: 1px solid; padding: 10px;">'.$ssh3[$k]['Nm_Ssh3'].'</td>
						</tr>';
					$ssh4 = $this->SaveModel->getSsh(4,$ssh1[$i]['Kd_Ssh1'].'-'.$ssh2[$j]['Kd_Ssh2'].'-'.$ssh3[$k]['Kd_Ssh3'].'-'.$k);
					for ($l=0; $l < count($ssh4); $l++) { 
						echo '<tr>
								<td style="border: 1px solid; padding: 10px;">'.$ssh4[$l]['Kd_Ssh1'].'.'.$ssh4[$l]['Kd_Ssh2'].'.'.$ssh4[$l]['Kd_Ssh3'].'.'.$ssh4[$l]['Kd_Ssh4'].'</td>
								<td colspan="7" style="border: 1px solid; padding: 10px;">'.$ssh4[$l]['Nm_Ssh4'].'</td>
							</tr>';
						$ssh5 = $this->SaveModel->getSsh(5,$ssh1[$i]['Kd_Ssh1'].'-'.$ssh2[$j]['Kd_Ssh2'].'-'.$ssh3[$k]['Kd_Ssh3'].'-'.$ssh4[$l]['Kd_Ssh4'].'-'.$l);
						
						for ($m=0; $m < count($ssh5); $m++){
							
							$ssh5[$m]['Nm_Ssh5'] = htmlspecialchars($ssh5[$m]['Nm_Ssh5']);
							
							echo '<tr>
									<td style="border: 1px solid; padding: 10px;">'.$ssh5[$m]['Kd_Ssh1'].'.'.$ssh5[$m]['Kd_Ssh2'].'.'.$ssh5[$m]['Kd_Ssh3'].'.'.$ssh5[$m]['Kd_Ssh4'].'.'.$ssh5[$m]['Kd_Ssh5'].'</td>
									<td colspan="7" style="border: 1px solid; padding: 10px;">'.$ssh5[$m]['Nm_Ssh5'].'</td>
								</tr>';
							$ssh6 = $this->SaveModel->getSsh(6,$ssh1[$i]['Kd_Ssh1'].'-'.$ssh2[$j]['Kd_Ssh2'].'-'.$ssh3[$k]['Kd_Ssh3'].'-'.$ssh4[$l]['Kd_Ssh4'].'-'.$ssh5[$m]['Kd_Ssh5'].'-'.$m);
							for ($n=0; $n < count($ssh6); $n++) { 
								echo '<tr>
									<td style="border: 1px solid; padding: 10px;">'.$ssh6[$n]['Kd_Ssh1'].'.'.$ssh6[$n]['Kd_Ssh2'].'.'.$ssh6[$n]['Kd_Ssh3'].'.'.$ssh6[$n]['Kd_Ssh4'].'.'.$ssh6[$n]['Kd_Ssh5'].'.'.$ssh6[$n]['Kd_Ssh6'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$ssh6[$n]['Nama_Barang'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$ssh6[$n]['Spesifikasi'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$ssh6[$n]['Uraian'].'</td>';
									if($ssh6[$n]['Kd_Ssh1'] != 23){
										echo '<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($ssh6[$n]['harga_zona1'],2,",",".").'</td>
										<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($ssh6[$n]['harga_zona2'],2,",",".").'</td>
										<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($ssh6[$n]['harga_zona3'],2,",",".").'</td>
										<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($ssh6[$n]['harga_zona4'],2,",",".").'</td>';
								
									}else{
										echo '<td colspan="4" style="border: 1px solid; padding: 10px;">Rp. '.number_format($ssh6[$n]['harga_zona2'],2,",",".").'</td>';
									}
								
								echo '</tr>';
							}
								
						}
					}
				}
			}
		}

		// <td style="border: 1px solid; padding: 10px;">'.$this->fungsi->convert_to_rupiah($ssh6[$n]['Harga_Satuan']+($ssh6[$n]['Harga_Satuan']*0.03)).'</td>
		// 							<td style="border: 1px solid; padding: 10px;">'.$this->fungsi->convert_to_rupiah($ssh6[$n]['Harga_Satuan']).'</td>
		// 							<td style="border: 1px solid; padding: 10px;">'.$this->fungsi->convert_to_rupiah($ssh6[$n]['Harga_Satuan']+($ssh6[$n]['Harga_Satuan']*0.06)).'</td>
		// 							<td style="border: 1px solid; padding: 10px;">'.$this->fungsi->convert_to_rupiah($ssh6[$n]['Harga_Satuan']+($ssh6[$n]['Harga_Satuan']*0.1)).'</td>
	?>


</table>
