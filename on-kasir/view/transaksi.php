<?php
  switch ($_GET['act']) {
  // PROSES TRANSAKSI //
  case 'add':

//proses

    if(isset($_POST['add'])) {
      $nopenjualan = $_POST['nopenjualan'];
      $kasir = $_POST['idkasir'];
      $pembeli = $_POST['idcustomer'];
      $tipe = $_POST['idmobil'];
      $tgltransaksi = date('Y-m-d');
      $itemterjual = $_POST['itemterjual'];

      $qry = "INSERT INTO tbl_transaksi VALUES ('$nopenjualan', '$kasir', '$pembeli', '$tipe', '$tgltransaksi', '$itemterjual')";
      $tambah = mysqli_query($db, $qry);

      if($tambah) {
        echo "<script>window.alert('Data Berhasil Disimpan')
        window.location='?page=lappt&act=view'</script>";
      }else{
        echo "<script>window.alert('Data Gagal Ditambahkan')
        window.location='?page=transaksi&act=add'</script>";
      }
    }
    ?>

        <!-- Form Tambah Data -->
         <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-car"></i> Transaksi</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> Transaksi</li>
            </ol>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <div class="form-group ">
                    <?php
                    // Memulai Mengambil Data
                    $sql = mysqli_query($db, "SELECT * FROM tbl_transaksi");

                    $num = mysqli_num_rows($sql);

                    if($num <> 0)
                    {
                      $kode = $num + 1;
                    }else
                    {
                      $kode = 1;
                    }

                    // Mulai bikin kode
                    $bikin_kode = str_pad($kode, 3, "0", STR_PAD_LEFT);
                    $tahun = date('Ym');
                    $kode_jadi = "TRNS$tahun$bikin_kode";

                    ?>
                      <label for="ckode" class="control-label col-lg-2">Nomor Penjualan</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ckode" name="nopenj" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="ckode" name="nopenjualan" placeholder="Nomor Penjualan" value="<?php echo $kode_jadi?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Kasir</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ckode" name="idkas" placeholder="ID Kasir" value="<?php echo $_SESSION['sess_id']?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="ckode" name="idkasir" placeholder="ID Kasir" value="<?php echo $_SESSION['sess_id']?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>

                    <div class="form-group ">
                      <label for="cpembeli" class="control-label col-lg-2">Nama Pembeli</label>
                      <div class="col-lg-10">
                        <select class="form-control m-bot15" name="idcustomer">
                          <option value="">--- Nama Pembeli ---</option>
                            <optgroup>
                              <?php
                                $tampil = mysqli_query($db, "SELECT * FROM customer ORDER BY id_customer");
                                while ($r = mysqli_fetch_array($tampil)){
                                  ?>
                              <option value="<?php echo $r['id_customer']?>"><?php echo $r['nama_customer']?></option>
                              <?php
                                }
                              ?>
                            </optgroup>
                        </select>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cmobil" class="control-label col-lg-2">Nama Tipe</label>
                      <div class="col-lg-10">
                        <select class="form-control m-bot15" name="idmobil">
                          <option value="">--- Nama Unit ---</option>
                            <optgroup>
                              <?php
                                $tampil = mysqli_query($db, "SELECT * FROM tbl_mobil ORDER BY id_mobil");
                                while ($r = mysqli_fetch_array($tampil)){
                                  ?>
                              <option value="<?php echo $r['id_mobil']?>"><?php echo $r['nama_tipe']?></option>
                              <?php
                                }
                              ?>
                            </optgroup>
                        </select>
                      </div>
                    </div>
                    <div class="form-group ">
                    <label for="cjumlah" class="control-label col-lg-2">Jumlah Pembelian</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cjumlah" type="number" name="itemterjual" placeholder="Unit" required data-fv-notempty-message= "Tidak Boleh Kosong" />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit" name="add">Save</button>
                        <a href="?page=pelanggan&act=view"><button class="btn btn-default" type="reset">Cancel</button></a>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </section>
          </div>
        </div>
        <!-- ./Form Tambah Data -->


<?php
break;
}
?>