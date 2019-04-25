<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Tujuan</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
              <th style="border: 1px solid; padding: 10px;">No</th>
              <th style="border: 1px solid; padding: 10px;">Misi</th>
              <th style="border: 1px solid; padding: 10px;">Tujuan</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_misi_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_tujuan_nama']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>