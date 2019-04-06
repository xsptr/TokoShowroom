 <?php
    switch ($_GET['act']) {
      // PROSES VIEW DATA PELANGGAN //
          case 'view':
        ?>    
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Daftar Pelanggan</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-users"></i> Pelanggan</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="row">
          <div class="col-lg-2">
            <a href="?page=pelanggan&act=add" class="btn btn-primary">
              <span class="icon_plus_alt"></span> Tambah Pelanggan
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th> No</th>
                    <th> Id Pelanggan</th>
                    <th> Nama</th>
                    <th> Alamat</th>
                    <th> No. Telepon</th>
                    <th> Email</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <tr>
                  <?php
                    $tampil = "SELECT * FROM customer ORDER BY id_customer ASC";
                    $show = mysqli_query($db, $tampil);
                    $no = 1;
                      while ($r = mysqli_fetch_array($show)) {
                  ?>
                    <td><?php echo "$no"?></td>
                    <td><?php echo "$r[id_customer]"?></td>
                    <td><?php echo "$r[nama_customer]"?></td>
                    <td><?php echo "$r[alamat]"?></td>
                    <td><?php echo "$r[no_telp]"?></td>
                    <td><?php echo "$r[email]"?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="?page=pelanggan&act=edit&id=<?php echo $r['id_customer']?>"><i class="fas fa-edit"></i></a>
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

  // PROSES TAMBAH DATA //
  case 'add':

//proses

    if(isset($_POST['add'])) {
      $idcust = $_POST['idcust'];
      $namacust = $_POST['namacust'];
      $alamat = $_POST['alamat'];
      $notelp = $_POST['notelp'];
      $email = $_POST['email'];

      $qry = "INSERT INTO customer VALUES ('$idcust', '$namacust', '$alamat', '$notelp', '$email')";
      $tambah = mysqli_query($db, $qry);

      if($tambah) {
        echo "<script>window.alert('Data Berhasil Disimpan')
        window.location='?page=pelanggan&act=view'</script>";
      }else{
        echo "<script>window.alert('Data Gagal Ditambahkan')
        window.location='?page=pelanggan&act=view'</script>";
      }
    }
    ?>

        <!-- Form Tambah Data -->
               <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Daftar Pelanggan</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-users"></i> Pelanggan</li>
              <li><i class="fas fa-users"></i> Tambah Pelanggan</li>
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
                    $sql = mysqli_query($db, "SELECT * FROM customer");

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
                    $kode_jadi = "CUT$tahun$bikin_kode";

                    ?>
                      <label for="ckode" class="control-label col-lg-2">ID Pelanggan</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ckode" name="idcut" placeholder="ID Pelanggan" value="<?php echo $kode_jadi?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="ckode" name="idcust" placeholder="ID Pelanggan" value="<?php echo $kode_jadi?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Pelanggan</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="namacust" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="calamat" class="control-label col-lg-2">Alamat</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="calamat" type="text" name="alamat" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnotelp" class="control-label col-lg-2">Nomor Telepon</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cnotelp" name="notelp" type="number" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cemail" class="control-label col-lg-2">Email</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cemail" name="email" type="email" />
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
    // PROSES EDIT DATA PRODUK //
    case 'edit':
    $d = mysqli_query($db,"SELECT * FROM customer WHERE id_customer='$_GET[id]'");
      $d = mysqli_fetch_array($d);
        if (isset($_POST['update'])) {

          $qry = "UPDATE customer SET
            nama_customer='$_POST[namacust]',
            alamat='$_POST[alamat]',
            no_telp='$_POST[notelp]',
            email='$_POST[email]' WHERE id_customer='$_POST[id]'
           ";
           $updt = mysqli_query($db,$qry);

           if($updt) {
            echo "<script>window.location='?page=pelanggan&act=view'</script>";
           }else{
            echo "<script>window.alert('Terjadi Kesalahan')
        window.location='?page=pelanggan&act=view'</script>";
           }
        }
        ?>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Update Data Pelanggan
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <input class="form-control" id="ckode" type="hidden" name="id" required value="<?php echo $d['id_customer'];?>">
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Pelanggan</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="namacust" required value="<?php echo $d['nama_customer'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="calamat" class="control-label col-lg-2">Alamat</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="calamat" type="text" name="alamat" required value="<?php echo $d['alamat'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnotelp" class="control-label col-lg-2">Nomor Telepon</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cnotelp" name="notelp" type="text" required value="<?php echo $d['no_telp'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cemail" class="control-label col-lg-2">Email</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cemail" name="email" type="email" value="<?php echo $d['email'];?>" />
                      </div>
                    </div>
                 
                    
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit" name="update">Save</button>
                        <button class="btn btn-default" type="reset">Cancel</button>
                      </div>
                    </div>
                  </form>
                </div>

              </div>
            </section>
          </div>
        </div>

        <?php
          break;
        }
        ?>
