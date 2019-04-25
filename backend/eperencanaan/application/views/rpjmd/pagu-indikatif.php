<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Pagu Indikatif</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;" rowspan="2" colspan="2">Kode</th>
                <th style="border: 1px solid; padding: 10px;" rowspan="2">Urusan Penunjang</th>
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
                    if($datas['Kd_Urusan'] != $kd_Urusan_old){
                        $kd_Urusan_old = $datas['Kd_Urusan'];
            ?>
                        <tr>
                            <td  style="border: 1px solid; padding: 10px;" colspan="2"><?=$datas['Kd_Urusan']?></td>
                            <td  style="border: 1px solid; padding: 10px;" colspan="7"><?=$datas['Nm_Urusan']?></td>
                        </tr>
            <?php
                    }else{
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Urusan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Kd_Bidang']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Bidang']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun1']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun2']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun3']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun4']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['tahun5']?></td>
            </tr>
            <?php
                    }
                }
            ?>          
        </table>
    </body>
</html>