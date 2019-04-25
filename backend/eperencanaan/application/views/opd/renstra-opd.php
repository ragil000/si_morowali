<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Indikator</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Tujuan</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Sasaran</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Indikator</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3" colSpan="4">Kode</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Program</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Kegiatan</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2" colSpan="2">Indikator Kinerka (Outcome)</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Kondisi Kinerja pada Awal RPJMD (Tahun 0)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="17">Capaian Kerja</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Lokasi</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="3">Penanggung Jawab</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;" colspan="3">2019</th>
                <th style="border: 1px solid; padding: 10px;" colspan="3">2020</th>
                <th style="border: 1px solid; padding: 10px;" colspan="3">2021</th>
                <th style="border: 1px solid; padding: 10px;" colspan="3">2022</th>
                <th style="border: 1px solid; padding: 10px;" colspan="3">2023</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Kondisi Kinerja Akhir Periode</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;">Program</th>
                <th style="border: 1px solid; padding: 10px;">Kegiatan</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;" colspan="2">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
                <th style="border: 1px solid; padding: 10px;">Target</th>
                <th style="border: 1px solid; padding: 10px;">Rp</th>
            </tr>
            <?php
                foreach ($data as $datas){
                    if($datas['Kd_Keg'] == null || $datas['Kd_Keg'] == ''){
            ?>
                        <tr>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['tujuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['sasaran_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['indikator_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Prog']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Keg']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                            <td style="border: 1px solid; padding: 10px;" colspan="23"><?=$datas['Ket_Kegiatan']?></td>
                        </tr>
            <?php
                    }else{
            ?>
                        <tr>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['tujuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['sasaran_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['indikator_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Bidang']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Prog']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Keg']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Kegiatan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome_kegiatan']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['kondisi_awal']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_tahun']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_satuan_nama']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['akhir_target']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_harga']+$datas['target2_harga']+$datas['target3_harga']+$datas['target4_harga']+$datas['target5_harga']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['lokasi']?></td>
                            <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Sub_Unit']?></td>
                        </tr>
            <?php
                    }
                }
            ?>          
        </table>
    </body>
</html>