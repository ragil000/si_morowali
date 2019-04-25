<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Rumusan Masalah</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <td style="border: 1px solid; padding: 10px;">Nomor</td>
                <td style="border: 1px solid; padding: 10px;">Rumusan Masalah</td>
                <td style="border: 1px solid; padding: 10px;">Akar Permasalahan</td>
                <td style="border: 1px solid; padding: 10px;">Bukti</td>
                <td style="border: 1px solid; padding: 10px;">Asumsi</td>
                <td style="border: 1px solid; padding: 10px;">OPD</td>
                <td style="border: 1px solid; padding: 10px;">Lokasi</td>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['rumusan_masalah_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['rumusan_masalah_akar']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['rumusan_masalah_bukti']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['rumusan_masalah_asumsi']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Nm_Sub_Unit']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['rumusan_masalah_lokasi']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>