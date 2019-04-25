<div style="text-align: center;">Lampiran Usulan Musrenbang</div>
<br>
<?php
// echo "<pre>";
// print_r($data[0]);
// echo "</pre>";
// function getNamaAsal2($Kd_Kel, $Nm_Kel, $Nm_Kec){
//     $kel = 'Kelurahan ';
//     if($Kd_Kel == 2){
//         $kel = 'Desa ';
//     }
//     $asal = $Nm_Kel;
//     if($asal == null){
//       $asal = "Kecamatan ".$Nm_Kec;
//     }else{
//       $asal = $kel.$Nm_Kel.", Kecamatan ".$Nm_Kec;
//     }
//     return $asal;
// }



    
?>
<table style="border-collapse: collapse; width:100%;">
    <tr>
        <?php if(@$pokir) { ?>
        <td style="border: 1px solid; padding: 10px;">Penulis</td>
        <?php } ?>
        <td style="border: 1px solid; padding: 10px;">Nama Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Alasan Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Asal Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Lokasi Detail</td>
        <td style="border: 1px solid; padding: 10px;">Volume Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Satuan Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Pagu Anggaran</td>
        <td style="border: 1px solid; padding: 10px;">Penerima Manfaat</td>
        <td style="border: 1px solid; padding: 10px;">Nama Pengusul</td>
        <td style="border: 1px solid; padding: 10px;">Kategori</td>
        <td style="border: 1px solid; padding: 10px;">OPD</td>
        <td style="border: 1px solid; padding: 10px;">Skor</td>
    </tr>
    <?php foreach ($data as $key) { 
        if(@$pokir){
            $kd_asal = explode('-', $key['kd_asal']); 
            $dataAsal = $this->DataModel->findKec($kd_asal[0]);
            $key['Nm_Kec'] = $dataAsal[0]['Nm_Kec'];
    
            $dataAsal = $this->DataModel->findKel($kd_asal[1],$kd_asal[2]);
            $key['Kd_Kel'] = $dataAsal[0]['Kd_Kel'];
            $key['Nm_Kel'] = $dataAsal[0]['Nm_Kel'];
            
        }
        $Kd_Kel = $key['Kd_Kel'];
            $Nm_Kel =  $key['Nm_Kel'];
            $Nm_Kec = $key['Nm_Kec'];
            $kel = 'Kelurahan ';
            if($Kd_Kel == 2){
                $kel = 'Desa ';
            }
            $asal = $Nm_Kel;
            if($asal == null){
                $asal = "Kecamatan ".$Nm_Kec;
            }else{
                $asal = $kel.$Nm_Kel.", Kecamatan ".$Nm_Kec;
            }
        
        ?>
    <tr>
        <?php if(@$pokir) { ?>
        <td style="border: 1px solid; padding: 10px;"><?=$key['Nm_Dewan']?></td>
        <?php } ?>
        <td style="border: 1px solid; padding: 10px;"><?=$key['nama']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['alasan']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$asal?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['lokasi']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['volume']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['Uraian']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['pagu']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['manfaat']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['pengusul']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['kategori']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['Nm_Sub_Unit']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['skor_total']?></td>
        
    </tr>
    <?php } ?>
    
</table>
<br>

