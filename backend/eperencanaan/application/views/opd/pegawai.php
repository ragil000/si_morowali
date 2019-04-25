<html>
    <meta charset="utf-8" />
    <head></head>
    <body>
        <h1>Data Indikator</h1>
        <table style="border-collapse: collapse; width:100%;">

            <tr>
                <th style="border: 1px solid; padding: 10px;">No</th>
                <th style="border: 1px solid; padding: 10px;">Nama</th>
                <th style="border: 1px solid; padding: 10px;">Jenis Kelamin</th>
                <th style="border: 1px solid; padding: 10px;">NIP</th>
                <th style="border: 1px solid; padding: 10px;">Golongan</th>
                <th style="border: 1px solid; padding: 10px;">Pangkat</th>
                <th style="border: 1px solid; padding: 10px;">Jabatan</th>
                <th style="border: 1px solid; padding: 10px;">Pendidikan</th>
            </tr>
            <?php
                $nomor = 1;
                foreach ($data as $datas){
            ?>
            <tr>
                <td style="border: 1px solid; padding: 10px; width: 20px;"><?=$nomor?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_nama']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_jk']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_nip']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_golongan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_pangkat']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_jabatan']?></td>
                <td style="border: 1px solid; padding: 10px;"><?=$datas['opd_pegawai_pendidikan']?></td>
            </tr>
            <?php
                $nomor++;
                }
            ?>          
        </table>
    </body>
</html>