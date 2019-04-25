<div style="text-align: center; font-size: 30px;">ASET</div>
<br>
<br>
<table style="border-collapse: collapse;font-size: 9px;">
	<tr>
		<td  style="border: 1px solid; padding: 10px;">No.</td>
		<td style="border: 1px solid; padding: 10px;">Uraian</td>
	</tr>
	<?php 
		//print_r($this->SaveModel->getAsb(1,'1')[0]);
		$asb1 = $this->SaveModel->getAset(1,'1', $kode);
		for($i = 0; $i < count($asb1); $i++) {
			echo '<tr>
					<td style="border: 1px solid; padding: 10px;">'.$asb1[$i]['Kd_Aset1'].'</td>
					<td style="border: 1px solid; padding: 10px;">'.$asb1[$i]['Nm_Aset1'].'</td>
				</tr>';
			$asb2 = $this->SaveModel->getAset(2,$asb1[$i]['Kd_Aset1'].'-'.$i);
			for($j = 0; $j < count($asb2); $j++){
				echo '<tr>
						<td style="border: 1px solid; padding: 10px;">'.$asb2[$j]['Kd_Aset1'].'.'.$asb2[$j]['Kd_Aset2'].'</td>
						<td style="border: 1px solid; padding: 10px;">'.$asb2[$j]['Nm_Aset2'].'</td>
					</tr>';
				$asb3 = $this->SaveModel->getAset(3,$asb1[$i]['Kd_Aset1'].'-'.$asb2[$j]['Kd_Aset2'].'-'.$j);
				for ($k=0; $k < count($asb3); $k++) { 
					echo '<tr>
							<td style="border: 1px solid; padding: 10px;">'.$asb3[$k]['Kd_Aset1'].'.'.$asb3[$k]['Kd_Aset2'].'.'.$asb3[$k]['Kd_Aset3'].'</td>
							<td style="border: 1px solid; padding: 10px;">'.$asb3[$k]['Nm_Aset3'].'</td>
						</tr>';
					$asb4 = $this->SaveModel->getAset(4,$asb1[$i]['Kd_Aset1'].'-'.$asb2[$j]['Kd_Aset2'].'-'.$asb3[$k]['Kd_Aset3'].'-'.$k);
					for ($l=0; $l < count($asb4); $l++) { 
						echo '<tr>
								<td style="border: 1px solid; padding: 10px;">'.$asb4[$l]['Kd_Aset1'].'.'.$asb4[$l]['Kd_Aset2'].'.'.$asb4[$l]['Kd_Aset3'].'.'.$asb4[$l]['Kd_Aset4'].'</td>
								<td style="border: 1px solid; padding: 10px;">'.$asb4[$l]['Nm_Aset4'].'</td>
							</tr>';
						$asb5 = $this->SaveModel->getAset(5,$asb1[$i]['Kd_Aset1'].'-'.$asb2[$j]['Kd_Aset2'].'-'.$asb3[$k]['Kd_Aset3'].'-'.$asb4[$l]['Kd_Aset4'].'-'.$l);

						for ($m=0; $m < count($asb5); $m++){
							echo '<tr>
									<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Kd_Aset1'].'.'.$asb5[$m]['Kd_Asb2'].'.'.$asb5[$m]['Kd_Aset3'].'.'.$asb5[$m]['Kd_Aset4'].'.'.$asb5[$m]['Kd_Aset5'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Nm_Aset5'].'</td>
								</tr>';
						}
					}
				}
			}
		}
	?>


</table>