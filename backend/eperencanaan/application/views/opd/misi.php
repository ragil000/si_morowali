<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Misi</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
              <th style="border: 1px solid; padding: 10px;">No</th>
              <th style="border: 1px solid; padding: 10px;">Visi</th>
              <th style="border: 1px solid; padding: 10px;">Misi</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_visi_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_misi_nama']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>