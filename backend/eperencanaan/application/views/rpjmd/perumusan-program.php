<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Perumusan Program</h1>
        <table style="border-collapse: collapse; width:100%;">
            <tr>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">No</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Sasaran</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Strategi Pembangunan</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Arah Kebijakan</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Indikator</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Program</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Indikator Kinerja (Outcome)</th>
                <th style="border: 1px solid; padding: 10px;" colSpan="2">Capaian Kinerja</th>
                <th style="border: 1px solid; padding: 10px;" rowSpan="2">Lokasi</th>
            </tr> 
            <tr>
              <th style="border: 1px solid; padding: 10px;">Kondisi Awal</th>
              <th style="border: 1px solid; padding: 10px;">Kondisi Akhir</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['sasaran_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['strategi_pembangunan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['arah_kebijakan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['indikator_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['Ket_Program']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['outcome']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['kondisi_awal']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['kondisi_akhir']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['lokasi']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>