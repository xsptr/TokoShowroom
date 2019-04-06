<?php
// sesuai kan root file mPDF anda
$nama_dokumen=$_POST['tglpenjualanak']; //Beri nama file PDF hasil.
define('_MPDF_PATH','config/MPDF60/'); //sesuaikan dengan root folder anda
include(_MPDF_PATH . "mpdf.php"); //includekan ke file mpdf
$mpdf=new mPDF('utf-8', 'A4'); // Create new mPDF Document
//Beginning Buffer to save PHP variables and HTML tags
ob_start();

//Tuliskan file HTML di bawah sini , sesuai File anda .
?>
<!--sekarang Tinggal Codeing seperti biasanya. HTML, CSS, PHP tidak
masalah.-->
<!--CONTOH Code START-->
<table border='0' align='LEFT'>
<tr>
<th>
<img src="dist/img/avatar56.png"  alt="" width="200" height="140" />
<!--<img src="../../images/kabupaten.gif"  align="left" width='110' height='100px' >-->
</th>
<th width="900px">
<h1>  LAPORAN PENJUALAN  <br> SILVANA 221 MOTOR</h1> </br>

</th>
</tr>
</table>
<hr style="height:3px;" />



<?php

// Koneksi ke database //

error_reporting(0);
include "config/koneksi.php";
include "config/fungsi_indotgl.php";

$tglpenjualanaw = $_POST[tglpenjualanaw];
$tglpenjualanak = $_POST[tglpenjualanak];
?>

<p style="text-align:left;"> Periode (Tanggal <?php echo tgl_indo($tglpenjualanaw)?> S/D  <?php echo tgl_indo($tglpenjualanak) ?>) </p>

<table cellspacing="5" cellpadding="5" border="1">
                        <thead>
                          <tr>
                    <th> No</th>
                    <th> No Penjualan</th>
                    <th> Tanggal Penjualan</th>
                    <th> Nama Pembeli </th>
                    <th> Nama Unit </th>
                    <th> Unit Terjual</th>
                          </tr>
                        </thead>
                        <tbody>
                                          <?php
                    $tampil = mysqli_query($db, "SELECT * FROM tbl_transaksi t
                        JOIN customer c
                          ON (t.id_customer = c.id_customer)
                        JOIN tbl_mobil m
                          ON (t.id_mobil = m.id_mobil)
                        JOIN user u
                          ON (t.id_user = u.id_user) WHERE tgl_penjualan BETWEEN '$_POST[tglpenjualanaw]' AND '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC");
                    $no = 1;
                      while ($r = mysqli_fetch_array($tampil)){

                  ?>
                  <tr>
                    <td><?php echo "$no"?></td>
                    <td><?php echo "$r[nopenjualan]"?></td>

                    <?php
                      $tglpenjualan = tgl_indo($r['tgl_penjualan']);?>

                      <td><?php echo "$tglpenjualan"?></td>
                      <td><?php echo "$r[nama_customer]"?></td>
                      <td><?php echo "$r[nama_tipe]"?></td>
                      <td><?php echo "$r[unit]"?></td>
                  </tr>

                  <?php
                  $no++;
                }
                ?>
                <tr>
                  <td align="center" colspan="5"> <span style="font-weight:bold">TOTAL</span></td>

                  <?php
                  $terjual = mysqli_fetch_array(mysqli_query($db, "SELECT sum(unit) as unit_terjual FROM tbl_transaksi WHERE tgl_penjualan BETWEEN '$_POST[tglpenjualanaw]' AND '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC"));
                  ?>

                  <td align="center">
                  <span style="font-weight: bold">
                    <?php echo"". number_format("$terjual[unit_terjual]",'0','.','.')?>
                  </td>
                </tr>
                </tbody>
              </table>
                      
                      <br> <br>
                      <?php 
                      $tanggal =tgl_indo(date('Y-m-d'));
                      ?>
                      <p style="margin: 50px 8px 5px 460px;"> Tasikmalaya, <?php echo "$tanggal"?>
                      <br><br></p>
                     <p style="margin: 50px 8px 5px 510px;"> MANAGER </p>

<?php
//Batas file sampe sini
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//$stylesheet = file_get_contents('css/zebra.css');
//Here convert the encode for UTF-8, if you prefer the ISO-8859-1 just change for $mpdf->WriteHTML($html);
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>