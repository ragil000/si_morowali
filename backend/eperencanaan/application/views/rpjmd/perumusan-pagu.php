<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Analisis Keaungan</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Kode</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Program</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Indikator Kinerka (Outcome)</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="22">Capaian Kerja</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Penanggung Jawab</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;" colspan="4">Tahun 1</th>
                <th style="border: 1px solid; padding: 10px;" colspan="4">Tahun 2</th>
                <th style="border: 1px solid; padding: 10px;" colspan="4">Tahun 3</th>
                <th style="border: 1px solid; padding: 10px;" colspan="4">Tahun 4</th>
                <th style="border: 1px solid; padding: 10px;" colspan="4">Tahun 5</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Kondisi Kinerja Akhir Periode</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
            </tr>
            <?php
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?>.<?=$datas['Kd_Bidang']?>.<?=$datas['Kd_Prog']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['kondisi_awal']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_lokasi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_lokasi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_lokasi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_lokasi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_lokasi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['akhir_target']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_harga']+$datas['target2_harga']+$datas['target3_harga']+$datas['target4_harga']+$datas['target5_harga']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Sub_Unit']?></td>
            </tr>
            <?php
                }
            ?>          
        </table>
    </body>
</html>