<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h3>RENCANA KERJA PEMERINTAH DAERAH TAHUN <?=$dataTambah['tahun']?></h3>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;" rowspan="2" colspan="4">Kode</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2" colspan="4">Urusan / Bidang / Program / Kegiatan</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Indikator Kinerka (Outcome)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="5">Tahun</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">Catatan Penting</th>
                <th style="border: 1px solid; padding: 10px;" colspan="3">Tahun</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">OPD</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;">Program</th>
                <th style="border: 1px solid; padding: 10px;">Kegiatan</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target capaian kinerja</th>
                <th style="border: 1px solid; padding: 10px;">Kebutuhan Dana/ pagu indikatif (Rp)</th>
                <th style="border: 1px solid; padding: 10px;">Sumber Dana</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target capaian kinerja</th>
                <th style="border: 1px solid; padding: 10px;">Kebutuhan Dana/ pagu indikatif (Rp)</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;" colspan="4">(1)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="4">(2)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">(3)</th>
                <th style="border: 1px solid; padding: 10px;">(4)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">(5)</th>
                <th style="border: 1px solid; padding: 10px;">(6)</th>
                <th style="border: 1px solid; padding: 10px;">(7)</th>
                <th style="border: 1px solid; padding: 10px;">(8)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">(9)</th>
                <th style="border: 1px solid; padding: 10px;">(10)</th>
                <th style="border: 1px solid; padding: 10px;">(11)</th>
            </tr>
            <?php
                foreach ($data as $datas){
                    if($datas['Kd_Keg'] == null || $datas['Kd_Keg'] == ''){
            ?>
                        <tr>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Prog']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Keg']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Kegiatan']?></td>
                            <td style="border: 1px solid; padding: 10px;" colspan="12"></td>
                        </tr>
            <?php
                    }else{
            ?>
                        <tr>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Prog']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Keg']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Kegiatan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome_kegiatan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['kondisi_awal']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.$dataTambah['tahun'].'_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.$dataTambah['tahun'].'_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.$dataTambah['tahun'].'_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.$dataTambah['tahun'].'_sumber_dana']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.$dataTambah['tahun'].'_catatan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.($dataTambah['tahun']+1).'_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.($dataTambah['tahun']+1).'_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target'.($dataTambah['tahun']+1).'_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Sub_Unit']?></td>
                        </tr>
            <?php
                    }
                }
            ?>          
        </table>
    </body>
</html>