<div style="text-align: center;">Lampiran Musrenbang Desa / Kelurahan</div>
<br>
<table>
    <tr>
        <td>Waktu Pelaksanaan Musrenbang</td>
        <td>:</td>
        <td></td>
    </tr>
    <tr>
        <td>Tempat Pelaksanaan Musrenbang</td>
        <td>:</td>
        <td></td>
    </tr>
</table>
<br>
<table style="border-collapse: collapse; width:100%;">
    <tr>
        <td style="border: 1px solid; padding: 10px;">Nama Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Alasan Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Lokasi Detail</td>
        <td style="border: 1px solid; padding: 10px;">Volume Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Satuan Usulan</td>
        <td style="border: 1px solid; padding: 10px;">Pagu Anggaran</td>
        <td style="border: 1px solid; padding: 10px;">Penerima Manfaat</td>
        <td style="border: 1px solid; padding: 10px;">Nama Pengusul</td>
        <td style="border: 1px solid; padding: 10px;">OPD</td>
        <td style="border: 1px solid; padding: 10px;">Skor</td>
    </tr>
    <?php foreach ($data as $key) { ?>
    <tr>
        <td style="border: 1px solid; padding: 10px;"><?=$key['nama']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['alasan']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['lokasi']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['volume']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['nama_satuan']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['pagu']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['manfaat']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['pengusul']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['Nm_Sub_Unit']?></td>
        <td style="border: 1px solid; padding: 10px;"><?=$key['skor_total']?></td>
    </tr>
    <?php } ?>
    
</table>
<br>
<br>
<table style="width:100%">
    <tr>
        <td style="text-align: center;" colspan="3">Ditetapkan Di <?=ucwords($asal->Nm_Kec)?>, ..................... <?=date("Y")?></td>
    </tr>
    <tr>
        <td style="width:30%; text-align: center;">
        Perwakilan Masyarakat<br><br><br><br><br>
        (...............................................)<br>
        </td>
        <td></td>
        <td style="width:30%; text-align: center;">
        Kepala Lingkungan<br><br><br><br><br>
        (...............................................)<br>
        </td>
    </tr>
    <tr>
        <td style="text-align: center;" colspan="3">Mengetahui</td>
    </tr>
    <tr>
    <td style="width:30%; text-align: center;">
        Lurah<br><br><br><br><br>
        (...............................................)<br>
        </td>
        <td></td>
        <td style="width:30%; text-align: center;">
        Tim Pendamping<br><br><br><br><br>
        (...............................................)<br>
        </td>
    </tr>
</table>