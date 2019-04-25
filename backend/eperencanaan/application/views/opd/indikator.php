<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Indikator</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
              <th style="border: 1px solid; padding: 10px;">No</th>
              <th style="border: 1px solid; padding: 10px;">Sasaran</th>
              <th style="border: 1px solid; padding: 10px;">Indikator</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_sasaran_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_indikator_nama']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>