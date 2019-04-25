<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Strategi Kebijakan</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;">No</th>
                <th style="border: 1px solid; padding: 10px;">Misi</th>
                <th style="border: 1px solid; padding: 10px;">Tujuan</th>
                <th style="border: 1px solid; padding: 10px;">Bidang</th>
                <th style="border: 1px solid; padding: 10px;">Urusan</th>
                <th style="border: 1px solid; padding: 10px;">Sasaran</th>
                <th style="border: 1px solid; padding: 10px;">Indikator</th>
                <th style="border: 1px solid; padding: 10px;">Strategi Pembangunan</th>
                <th style="border: 1px solid; padding: 10px;">Arah Kebijakan</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['misi_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tujuan_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Bidang']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Urusan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['sasaran_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['indikator_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['strategi_pembangunan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['arah_kebijakan']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>