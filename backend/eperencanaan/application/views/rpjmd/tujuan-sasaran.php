<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Tujuan Sasaran</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">No</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Misi</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Isu Strategi RPJMD</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Tujuan RPJMD</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Sasaran RPJMD</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Indikator</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Kondisi Awal</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="10">Tujuan</th>
            </tr>
            <tr>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Tahun 1</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Tahun 2</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Tahun 3</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Tahun 4</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Tahun 5</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['misi_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_rpjmd']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tujuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['sasaran_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['indikator_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tujuan_sasaran_kondisi_awal']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target1_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target2_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target3_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target4_satuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_tahun']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['target5_satuan_nama']?></td>
                
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>