 <?php
    switch ($_GET['act']) {
      // PROSES VIEW LAPORAN TRANSAKSI //
          case 'view':
        ?>    
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Laporan Transaksi</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> Laporan Transaksi</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
      <!--  <div class="panel-body">
          <form class="form-inline" role="form">
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Awal</label>
              <input id="dp1" type="text" placeholder="Tanggal Penjualan Awal" size="20" class="form-control" name="tglpenjualanaw" required />
            </div>
            <div class="form-group">
              <label class="sr-only">Tanggal Penjualan Awal</label>
              <input id="dp1" type="text" placeholder="Tanggal Penjualan Akhir" size="20" class="form-control" name="tglpenjualanak">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
          </form>
        </div> -->

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th> No</th>
                    <th> No Penjualan</th>
                    <th> Nama Pembeli</th>
                    <th> Nama Tipe</th>
                    <th> Unit</th>
                    <th> Tanggal Transaksi</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                    <?php  
                      $sqlp = "SELECT * FROM tbl_transaksi t
                                JOIN customer c
                                  ON (t.id_customer = c.id_customer)
                                JOIN tbl_mobil m
                                  ON (t.id_mobil = m.id_mobil)
                                JOIN user u
                                  ON (t.id_user = u.id_user) WHERE u.id_user = '$_SESSION[sess_id]' ORDER BY nopenjualan DESC";
                        $rs = mysqli_query($db, $sqlp);
                        $no = 1;
                        while($r = mysqli_fetch_array($rs)) {
                    ?>
                  <tr>

                    <td> <?php echo "$no"?></td>
                    <td> <?php echo "$r[nopenjualan]"?></td>
                    <td> <?php echo "$r[nama_customer]"?></td>
                    <td> <?php echo "$r[nama_tipe]"?></td>
                    <td> <?php echo "$r[unit]"?></td>
                    <td> <?php echo "$r[tgl_penjualan]"?></td>
                    <td>
                      <div class="btn-group">
                          <a class="btn btn-primary" href="cetak_pdf.php?id=<?php echo $r['nopenjualan']?>"><i class="fas fa-print"></i> Print</a>
                      </div>
                    </td>
                  </tr>

                  <?php
                  $no++;
                }
                ?>
                </tbody>
              </table>
            </section>
          </div>
        </div>

<?php
break;
}
?>