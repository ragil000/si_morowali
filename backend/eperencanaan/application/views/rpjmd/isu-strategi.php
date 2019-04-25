<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Isu Strategi</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">No</th>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">Misi</th>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">Isu Strategi Urusan</th>
              <th style="border: 1px solid; padding: 10px;" colspan="4">Kajian Kebijakan</th>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">Isu Strategi RPJMD</th>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">Urusan</th>
              <th style="border: 1px solid; padding: 10px;" rowspan="2">Bidang</th>
            </tr>
            <tr>
              <th style="border: 1px solid; padding: 10px;">RPJPD</th>
              <th style="border: 1px solid; padding: 10px;">RTRW</th>
              <th style="border: 1px solid; padding: 10px;">RPJMN/RPJMD PROVINSI</th>
              <th style="border: 1px solid; padding: 10px;">DINAMIKA INTERNASIONAL</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['misi_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_urusan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_rpjpd']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_rtrw']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_rpjmn']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_dinamika']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['isu_strategi_rpjmd']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Urusan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Bidang']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>