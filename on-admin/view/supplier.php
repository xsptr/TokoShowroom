

<?php
  switch ($_GET['act']) {
    // PROSES VIEW DATA SUPPLIER
    case 'view':
?>     

        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-address-card"></i> Supplier</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/TokoShowroom/on-admin/"> Home</a></li>
              <li><i class="fas fa-address-card"></i> Supplier</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="row">
          <div class="col-lg-2">
            <a href="?page=supplier&act=add" class="btn btn-primary">
              <span class="icon_plus_alt"></span> Tambah Supplier
            </a>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <table class="table table-striped table-advance table-hover">
                <tbody>
                  <tr>
                    <th><i class="icon_profile"></i> No</th>
                    <th><i class="icon_profile"></i> Id Supplier</th>
                    <th><i class="icon_profile"></i> Nama Supplier</th>
                    <th><i class="icon_calendar"></i> Alamat</th>
                    <th><i class="icon_mail_alt"></i> No Telepon</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <tr>
                  <?php
                    $tampil = "SELECT * FROM tbl_supplier ORDER BY id_supplier ASC";
                    $show = mysqli_query($db,$tampil);
                    $no = 1;
                      while ($r = mysqli_fetch_array($show)) {
                  ?>
                    <td><?php echo "$no"?></td>
                    <td><?php echo "$r[id_supplier]"?></td>
                    <td><?php echo "$r[nama_supplier]"?></td>
                    <td><?php echo "$r[alamat]"?></td>
                    <td><?php echo "$r[no_tlp]"?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="?page=supplier&act=edit&id=<?php echo $r['id_supplier']?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="?page=supplier&act=delete&id=<?php echo $r['id_supplier']?>" onclick="return confirm('Apakah anda yakin akan menghapusnya ?');"><i class="icon_close_alt2"></i></a>
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
        // PROSES TAMBAH DATA SUPPLIER //
        case 'add':

        //proses

          if (isset($_POST['add'])) {
            $idsupplier = $_POST['idsupplier'];
            $namasup = $_POST['namasup'];
            $alamat = $_POST['alamat'];
            $notelp = $_POST['notelp'];

            $qry = "INSERT INTO tbl_supplier VALUES ('$idsupplier', '$namasup', '$alamat', '$notelp')";
            $tambah = mysqli_query($db, $qry);

            if($tambah){
              echo "<script>window.alert('Data Berhasil Disimpan')
              window.location='?page=supplier&act=view'</script>";
            }else{
              echo "<script>window.alert('Gagal Menambahkan Data')
              window.location='?page=supplier&act=view'</script>";
            }
          }
        ?>

                <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-address-card"></i> Supplier</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="/TokoShowroom/on-admin/"> Home</a></li>
              <li><i class="fas fa-address-card"></i> Supplier</li>
            </ol>
          </div>
        </div>

        <!-- Form Tambah Data -->
        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <div class="form-group ">

                    <?php
                    // Memulai Mengambil Data
                    $sql = mysqli_query($db, "SELECT * FROM tbl_supplier");

                    $num = mysqli_num_rows($sql);

                    if ($num <> 0) 
                    {
                      $kode = $num + 1;
                    }else
                    {
                      $kode = 2;
                    }

                    // Mulai membuat id
                    $bikin_kode = str_pad($kode, 3, "0", STR_PAD_LEFT);
                    $tahun = date('Ym');
                    $kode_jadi = "SUP$tahun$bikin_kode";
                    ?>
                      <label for="ckode" class="control-label col-lg-2">ID Supplier</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ckode" name="idsup" placeholder="ID Supplier" value="<?php echo $kode_jadi?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="ckode" name="idsupplier" placeholder="ID Supplier" value="<?php echo $kode_jadi?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Supplier</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="namasup" required />
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

        // PROSES EDIT DATA //
        case 'edit':
        $d = mysqli_query($db, "SELECT * FROM tbl_supplier WHERE id_supplier='$_GET[id]'");
          $d = mysqli_fetch_array($d);
            if (isset($_POST['update'])) {

              $qry = "UPDATE tbl_supplier SET
                nama_supplier = '$_POST[namasup]',
                alamat = '$_POST[alamat]',
                no_tlp = '$_POST[notelp]' WHERE id_supplier = '$_POST[id]'";

                $updt = mysqli_query($db,$qry);

                if($updt) {
                  echo "<script>window.location='?page=supplier&act=view'</script>";
                }else{
                  echo "<script>window.alert('Terjadi Kesalahan')
                  window.location='?page=supplier&act=view'</script>";
                }
            }
        ?>

                <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Update Data Supplier
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <input class="form-control" id="ckode" type="hidden" name="id" required>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Supplier</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="namasup" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="calamat" class="control-label col-lg-2">Alamat</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="calamat" type="text" name="alamat" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnotelp" class="control-label col-lg-2">Nomor Telepon</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cnotelp" name="notelp" type="text" required />
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

        // PROSES HAPUS DATA //
        case 'delete':
          mysqli_query($db, "DELETE FROM tbl_supplier WHERE id_supplier='$_GET[id]'");
          echo "<script>window.location='?page=supplier&act=view'</script>";

        break;
      }
      ?>