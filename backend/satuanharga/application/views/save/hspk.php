<div style="text-align: center; font-size: 30px;">HARGA SATUAN POKOK KEGIATAN</div>
<div style="text-align: center; font-size: 30px;">(HSPK)</div>
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
		$hspk1 = $this->SaveModel->getHspk(1,'1');
		for($i = 0; $i < count($hspk1); $i++) {
			echo '<tr>
					<td style="border: 1px solid; padding: 10px;">'.$hspk1[$i]['Kd_Hspk1'].'</td>
					<td colspan="6" style="border: 1px solid; padding: 10px;">'.$hspk1[$i]['Nm_Hspk1'].'</td>
				</tr>';
			$hspk2 = $this->SaveModel->getHspk(2,$hspk1[$i]['Kd_Hspk1'].'-'.$i);
			for($j = 0; $j < count($hspk2); $j++){
				echo '<tr>
						<td style="border: 1px solid; padding: 10px;">'.$hspk2[$j]['Kd_Hspk1'].'.'.$hspk2[$j]['Kd_Hspk2'].'</td>
						<td colspan="6" style="border: 1px solid; padding: 10px;">'.$hspk2[$j]['Nm_Hspk2'].'</td>
					</tr>';
				$hspk3 = $this->SaveModel->getHspk(3,$hspk1[$i]['Kd_Hspk1'].'-'.$hspk2[$j]['Kd_Hspk2'].'-'.$j);
				for ($k=0; $k < count($hspk3); $k++) { 
					echo '<tr>
							<td style="border: 1px solid; padding: 10px;">'.$hspk3[$k]['Kd_Hspk1'].'.'.$hspk3[$k]['Kd_Hspk2'].'.'.$hspk3[$k]['Kd_Hspk3'].'</td>
							<td colspan="6" style="border: 1px solid; padding: 10px;">'.$hspk3[$k]['Nm_Hspk3'].'</td>
						</tr>';
					$hspk4 = $this->SaveModel->getHspk(4,$hspk1[$i]['Kd_Hspk1'].'-'.$hspk2[$j]['Kd_Hspk2'].'-'.$hspk3[$k]['Kd_Hspk3'].'-'.$k);
					for ($l=0; $l < count($hspk4); $l++) { 
						$this->db->select('*');
        				$this->db->from('ref_hspk');
        				$this->db->join('ref_standard_satuan', 'ref_standard_satuan.Kd_Satuan= ref_hspk.Kd_Satuan', 'left');
        				$this->db->where('Kd_Hspk1', $hspk1[$i]['Kd_Hspk1']);
        				$this->db->where('Kd_Hspk2', $hspk2[$i]['Kd_Hspk2']);
        				$this->db->where('Kd_Hspk3', $hspk3[$i]['Kd_Hspk3']);
        				$this->db->where('Kd_Hspk4', $hspk4[$i]['Kd_Hspk4']);
        				$satuan = $this->db->get()->row()->Uraian;
						echo '<tr>
								<td style="border: 1px solid; padding: 10px;">'.$hspk4[$l]['Kd_Hspk1'].'.'.$hspk4[$l]['Kd_Hspk2'].'.'.$hspk4[$l]['Kd_Hspk3'].'.'.$hspk4[$l]['Kd_Hspk4'].'</td>
								<td style="border: 1px solid; padding: 10px;">'.$hspk4[$l]['Uraian_Kegiatan'].'</td>
									<td style="border: 1px solid; padding: 10px;">'.$satuan.'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($hspk4[$l]['HargaZona1'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($hspk4[$l]['HargaZona2'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($hspk4[$l]['HargaZona3'],2,",",".").'</td>
									<td style="border: 1px solid; padding: 10px;">Rp. '.number_format($hspk4[$l]['HargaZona4'],2,",",".").'</td>

							</tr>';
						// $asb5 = $this->SaveModel->getHspk(5,$asb1[$i]['Kd_Asb1'].'-'.$asb2[$j]['Kd_Asb2'].'-'.$asb3[$k]['Kd_Asb3'].'-'.$asb4[$l]['Kd_Asb4'].'-'.$l);

						// for ($m=0; $m < count($asb5); $m++){
						// 	echo '<tr>
						// 			<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Kd_Asb1'].'.'.$asb5[$m]['Kd_Asb2'].'.'.$asb5[$m]['Kd_Asb3'].'.'.$asb5[$m]['Kd_Asb4'].'.'.$asb5[$m]['Kd_Asb5'].'</td>
						// 			<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Jenis_Pekerjaan'].'</td>
						
						// 			<td style="border: 1px solid; padding: 10px;">'.$asb5[$m]['Uraian'].'</td>
						// 		</tr>';
						// }
					}
				}
			}
		}
	?>


</table>