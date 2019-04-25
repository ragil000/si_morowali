<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Analisis Keaungan</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;" rowspan="2" colspan="4">Kode</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">Jenis Belanja / Program Pembangunan</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">Data Tahun Dasar (Rp)</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">Tingkat Pertumbuhan (%)</th>
                <th style="border: 1px solid; padding: 10px;" colspan="5">Prakiraan Pagu Indikatif</th>
            </tr>
            <tr>  
                <th style="border: 1px solid; padding: 10px;">Tahun 1</th>
                <th style="border: 1px solid; padding: 10px;">Tahun 2</th>
                <th style="border: 1px solid; padding: 10px;">Tahun 3</th>
                <th style="border: 1px solid; padding: 10px;">Tahun 4</th>
                <th style="border: 1px solid; padding: 10px;">Tahun 5</th>
            </tr>
            <?php
                $kd_Urusan_old = 0;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Rek_1']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Rek_2']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Rek_3']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Rek_4']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Rek_4']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['data_tahun_dasar']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tingkat_pertumbuhan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun1']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun2']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun3']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun4']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun5']?></td>
            </tr>
            <?php
                }
            ?>          
        </table>
    </body>
</html>