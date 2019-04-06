 <?php
    switch ($_GET['act']) {
      // PROSES VIEW LAPORAN TRANSAKSI //
          case 'view':
        ?>    
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Laporan Penjualan</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> Laporan Penjualan</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="panel-body">
          <form class="form-inline" action="?page=lappt&act=cek" method="POST">
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Awal</label>
              <input id="date" type="text" placeholder="Tanggal Penjualan Awal" size="20" class="form-control" name="tglpenjualanaw" required />
            </div>
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Awal</label>
              <input id="date" type="text" placeholder="Tanggal Penjualan Akhir" size="20" class="form-control" name="tglpenjualanak">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
          </form>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th> No</th>
                    <th> No Penjualan</th>
                    <th> Tanggal Penjualan</th>
                    <th> Nama Pembeli </th>
                    <th> Nama Unit </th>
                    <th> Unit Terjual</th>
                  </tr>
                </tbody>
              </table>
            </section>
          </div>
        </div>
        <!-- ./page end -->

<?php
break;

  case 'cek':
  // menampilkan penyataan pertama
      $sqlp = "SELECT * FROM tbl_transaksi t
                JOIN customer c
                  ON (t.id_customer = c.id_customer)
                JOIN tbl_mobil m
                  ON (t.id_mobil = m.id_mobil)
                JOIN user u
                  ON (t.id_user = u.id_user) WHERE tgl_penjualan BETWEEN '$_POST[tglpenjualanaw]' AND '$_POST[tglpenjualanak]' ORDER BY nopenjualan ASC";
      

      $rs = mysqli_query($db, $sqlp);
      $data = mysqli_fetch_array($rs);

      if (!(empty($data))) {
        ?>
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Laporan Penjualan</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> Laporan Penjualan</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="panel-body">
          <form class="form-inline" action="?page=lappt&act=cek" method="POST">
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Awal</label>
              <input id="dp1" type="text" placeholder="Tanggal Penjualan Awal" size="20" class="form-control" name="tglpenjualanaw" required />
            </div>
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Akhir</label>
              <input id="dp1" type="text" placeholder="Tanggal Penjualan Akhir" size="20" class="form-control" name="tglpenjualanak">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
          </form>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th> No</th>
                    <th> No Penjualan</th>
                    <th> Tanggal Penjualan</th>
                    <th> Nama Pembeli </th>
                    <th> Nama Unit </th>
                    <th> Unit Terjual</th>
                  </tr>
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
            </section>
          </div>
        </div>
        <!-- ./page end -->

        <div class="row">
          <div class="col-md-4 col-md-offset-8">
          <form role="form" action="cetak_pdf.php" method="POST" target="_blank">
          <div class="box-body">
            <div class="form-group">
              <button type="submit" class="btn btn-warning"><i class="fas fa-file-pdf"></i> Simpan ke PDF</button>
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" id="tglpenjualanaw" name="tglpenjualanaw" placeholder="Nama Konsumen" value="<?php echo $_POST['tglpenjualanaw']?>">
               <input type="hidden" class="form-control" id="tglpenjualanak" name="tglpenjualanak" placeholder="Nama Konsumen" value="<?php echo $_POST['tglpenjualanak']?>">
            </div>
          </div>
            
          </form>
            
          </div>
        </div>

    <?php
  } else {
    ?>
    <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Laporan Penjualan</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> Laporan Penjualan</li>
            </ol>
          </div>
        </div>


    <div class="panel-body">
      <div class="form-group">
        <?php
        echo " <p> Maaf untuk pencarian yang anda cari tidak tersedia. <br>
        Silahkan coba lakukan pencarian ulang. Terima Kasih</p>"
        ;

        ?>
      </div>
    </div>

    <?php
  }
  ?>

  <?php
  break;
}
?>