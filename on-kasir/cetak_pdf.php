<?php
// sesuaikan root file mPDF anda
$nama_dokumen=$_GET['id']; //Beri nama file PDF hasil.
define('_MDPF_PATH', 'config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MDPF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf = new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah ini, sesuai file anda.
?>
<!-- Contoh Kode Start -->
<table border="0" align="LEFT">
	<tr>
		<th>
			<img src="img/avatar56.png" alt="" width="200" height="140"/>
		</th> 
		<th width="900px">
			<h1>TANDA TERIMA PEMBELIAN <br> SILVANA 221 MOTOR</h1>

		</th>
	</tr>
</table>
<hr style="height: 3px;" />



<?php

// Koneksi ke database //


session_start();
include "config/koneksi.php";
include "config/fungsi_indotgl.php";

$nopenjualan = $_GET[nopenjualan];
?>

<h1> Tanda Terima </h1>

<table cellspacing="5" cellpadding="5" border="1">
	
	<tr>
	<thead>
		<th> No</th>
        <th> No Penjualan</th>
        <th> Nama Pembeli</th>
        <th> Nama Tipe</th>
        <th> Unit</th>
        <th> Tanggal Transaksi</th>
	</tr>
	</thead>

	<tbody>
	<?php
		 $tampil = "SELECT * FROM tbl_transaksi t
                       JOIN customer c
                        ON (t.id_customer = c.id_customer)
                       JOIN tbl_mobil m
                        ON (t.id_mobil = m.id_mobil)
                       JOIN user u
                        ON (t.id_user = u.id_user) WHERE u.id_user = '$_SESSION[sess_id]' ORDER BY nopenjualan DESC";
                        $rs = mysqli_query($db, $tampil);
                        $no = 1;
                        while($r = mysqli_fetch_array($rs)) {
	?>
	<tr>
		<td> <?php echo "$no"?></td>
        <td> <?php echo "$r[nopenjualan]"?></td>
        <td> <?php echo "$r[nama_customer]"?></td>
        <td> <?php echo "$r[nama_tipe]"?></td>
        <td> <?php echo "$r[unit]"?></td>
        <?php
        $tglpenjualan=tgl_indo($r['tgl_penjualan']);?>
        <td> <?php echo "$tglpenjualan"?></td>
	</tr>

	<?php
	$no++;
}
?>

	</tbody>


</table>

<h1> Rincian Unit</h1>
<table cellspacing="5" cellpadding="5" border="1">
	
	<tr>
	<thead>
    	<th> No</th>
    	<th> Kode Mobil</th>
    	<th> Nama Tipe</th>
    	<th> No.Plat</th>
    	<th> Tahun Pembuatan</th>
    	<th> Isi Silinder</th>
    	<th> No.Rangka</th>
    	<th> No.Mesin</th>
    	<th> Bahan Bakar</th>
    	<th> No.BPKB</th>
	</thead>

	<tbody>
	<?php
                    $tampil = "SELECT * FROM tbl_transaksi t JOIN tbl_mobil m ON (t.id_mobil = m.id_mobil) WHERE t.nopenjualan = '$_GET[id]'";
                    $show = mysqli_query($db, $tampil);
                    $no = 1;
                      while ($r = mysqli_fetch_array($show)) {
                  ?>
	<tr>
		<td><?php echo "$no"?></td>
                    <td><?php echo "$r[id_mobil]"?></td>
                    <td><?php echo "$r[nama_tipe]"?></td>
                    <td><?php echo "$r[no_plat]"?></td>
                    <td><?php echo "$r[thn_pembuatan]"?></td>
                    <td><?php echo "$r[isi_silinder]"?></td>
                    <td><?php echo "$r[no_rangka]"?></td>
                    <td><?php echo "$r[no_mesin]"?></td>
                    <td><?php echo "$r[bahan_bakar]"?></td>
                    <td><?php echo "$r[no_bpkb]"?></td>
	</tr>

	<?php
	$no++;
}
?>

	</tbody>


</table>

<br><br>
<?php
$tanggal = tgl_indo(date('Y-m-d'));
?>
<p style="margin: 50px 8px 5px 460px;"> Tasikmalaya, <?php echo "$tanggal"?><br><br></p>
<p style="margin: 50px 8px 5px 510px;"> SILVANA 221 MOTOR</p>



<?php

//Batas file
$html = ob_get_contents(); // Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf", 'I');
exit;
?>