<div style="text-align: center; font-size: 30px;">ANALISA STANDART BELANJA</div>
<div style="text-align: center; font-size: 30px;">(ASB)</div>
<br>
<br>
<table style="border-collapse: collapse;font-size: 9px;">
	<tr>
		<td  style="border: 1px solid; padding: 10px;">No.</td>
		<td style="border: 1px solid; padding: 10px;">Uraian</td>
		<td style="border: 1px solid; padding: 10px;">Satuan</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 1</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 2</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 3</td>
		<td style="border: 1px solid; padding: 10px;">Harga Zona 4</td>
		
	</tr>
	<?php 
		//print_r($this->SaveModel->getAsb(1,'1')[0]);
		$asb1 = $this->SaveModel->getAsb(1,'1', $kode);
		for($i = 0; $i < count($asb1); $i++) {
			echo '<tr>
					<td style="border: 1px solid; padding: 10px;">'.$asb1[$i]['Kd_Asb1'].'</td>
					<td colspan="6" style="border: 1px solid; padding: 10px;">'.$asb1[$i]['Nm_Asb1'].'</td>
				</tr>';
			$asb2 = $this->SaveModel->getAsb(2,$asb1[$i]['Kd_Asb1'].'-'.$i);
			for($j = 0; $j < count($asb2); $j++){
				echo '<tr>
						<td style="border: 1px solid; padding: 10px;">'.$asb2[$j]['Kd_Asb1'].'.'.$asb2[$j]['Kd_Asb2'].'</td>
						<td colspan="6" style="border: 1px solid; padding: 10px;">'.$asb2[$j]['Nm_Asb2'].'</td>
					</tr>';
				$asb3 = $this->SaveModel->getAsb(3,$asb1[$i]['Kd_Asb1'].'-'.$asb2[$j]['Kd_Asb2'].'-'.$j);
				for ($k=0; $k < count($asb3); $k++) { 
					echo '<tr>
							<td style="border: 1px solid; padding: 10px;">'.$asb3[$k]['Kd_Asb1'].'.'.$asb3[$k]['Kd_Asb2'].'.'.$asb3[$k]['Kd_Asb3'].'</td>
							<td colspan="6" style="border: 1px solid; padding: 10px;">'.$asb3[$k]['Nm_Asb3'].'</td>
						</tr>';
					$asb4 = $this->SaveModel->getAsb(4,$asb1[$i]['Kd_Asb1'].'-'.$asb2[$j]['Kd_Asb2'].'-'.$asb3[$k]['Kd_Asb3'].'-'.$k);
					for ($l=0; $l < count($asb4); $l++) { 
						echo '<tr>
								<td style="border: 1px solid; padding: 10px;">'.$asb4[$l]['Kd_Asb1'].'.'.$asb4[$l]['Kd_Asb2'].'.'.$asb4[$l]['Kd_Asb3'].'.'.$asb4[$l]['Kd_Asb4'].'</td>
								<td colspan="6" style="border: 1px solid; padding: 10px;">'.$asb4[$l]['Nm_Asb4'].'</td>
							</tr>';
						$asb5 = $this->SaveModel->getAsb(5,$asb1[$i]['Kd_Asb1'].'-'.$asb2[$j]['Kd_Asb2'].'-'.$asb3[$k]['Kd_Asb3'].'-'.$asb4[$l]['Kd_Asb4'].'-'.$l);

						for ($m=0; $m < count($asb5); $m++){
						
							echo '<tr>
									<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Kd_Asb1'].'.'.$asb5[$m]['Kd_Asb2'].'.'.$asb5[$m]['Kd_Asb3'].'.'.$asb5[$m]['Kd_Asb4'].'.'.$asb5[$m]['Kd_Asb5'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Jenis_Pekerjaan'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Uraian'].'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($asb5[$m]['HargaZona1'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($asb5[$m]['HargaZona2'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($asb5[$m]['HargaZona3'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($asb5[$m]['HargaZona4'],2,",",".").'</td>
									
								</tr>';
						}
					}
				}
			}
		}
	?>


</table>