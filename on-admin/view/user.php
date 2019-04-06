 <?php
    switch ($_GET['act']) {
      // PROSES VIEW DATA user //
          case 'view':
        ?>    
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Daftar User</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> User</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="row">
          <div class="col-lg-2">
            <a href="?page=user&act=add" class="btn btn-primary">
              <span class="icon_plus_alt"></span> Tambah User
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
                    <th> Id User</th>
                    <th> Nama</th>
                    <th> Username</th>
                    <th> Level</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <tr>
                  <?php
                    $tampil = "SELECT * FROM user ORDER BY id_user ASC";
                    $show = mysqli_query($db, $tampil);
                    $no = 1;
                      while ($r = mysqli_fetch_array($show)) {
                  ?>
                    <td><?php echo "$no"?></td>
                    <td><?php echo "$r[id_user]"?></td>
                    <td><?php echo "$r[nama]"?></td>
                    <td><?php echo "$r[username]"?></td>
                    
                    <?php
                      if ($r['lvl_user']=="admin"){
                        $lvl_user = "admin";
                      } else {
                        $lvl_user = "kasir";
                      }
                    ?>

                    <td><?php echo "$lvl_user"?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="?page=user&act=edit&id=<?php echo $r['id_user']?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="?page=pelanggan&act=delete&id=<?php echo $r['id_user']?>" onclick="return confirm('Apakah anda yakin akan menghapusnya ?');"><i class="icon_close_alt2"></i></a>
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
      $iduser = $_POST['iduser'];
      $nama = $_POST['nama'];
      $username = $_POST['username'];
      $password = md5($_POST['password']);
      $lvl_user = $_POST['lvl_user'];

      $qry = "INSERT INTO user VALUES ('$iduser', '$nama', '$username', 
       '$password', '$lvl_user')";
      $tambah = mysqli_query($db, $qry);

      if($tambah) {
        echo "<script>window.alert('Data Berhasil Disimpan')
        window.location='?page=user&act=view'</script>";
      }else{
        echo "<script>window.alert('Data Gagal Ditambahkan')
        window.location='?page=user&act=view'</script>";
      }
    }
    ?>
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-users"></i> Daftar User</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-user"></i> User</li>
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
                    $sql = mysqli_query($db, "SELECT * FROM user");

                    $num = mysqli_num_rows($sql);

                    if($num <> 0)
                    {
                      $kode = $num + 1;
                    }else
                    {
                      $kode = 12;
                    }

                    // Mulai bikin kode
                    $bikin_kode = str_pad($kode, 3, "0", STR_PAD_LEFT);
                    $tahun = date('Ym');
                    $kode_jadi = "KRY$tahun$bikin_kode";

                    ?>
                      <label for="ckode" class="control-label col-lg-2">ID User</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ckode" name="idus" placeholder="ID User" value="<?php echo $kode_jadi?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="ckode" name="iduser" placeholder="ID User" value="<?php echo $kode_jadi?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="nama" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cusername" class="control-label col-lg-2">Username</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cusername" type="text" name="username" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cpass" class="control-label col-lg-2">Password</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cpass" name="password" type="password" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="clevel" class="control-label col-lg-2">Level User</label> <br>
                      <label class="radio-inline">
                        <input  id="clevel" name="lvl_user" type="radio" value="admin" required data-fv-notempty-message="Tidak Boleh Kosong" /> Admin
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="lvl_user" id="clevel" value="kasir" required data-fv-notempty-message="Tidak Boleh Kosong"> Kasir
                      </label>
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
    $d = mysqli_query($db,"SELECT * FROM user WHERE id_user='$_GET[id]'");
      $d = mysqli_fetch_array($d);
        if (isset($_POST['update'])) {

          if (empty($_POST[password])) {

            mysqli_query($db, "UPDATE user SET 
              nama = '$_POST[nama]',
              username = '$_POST[username]',
              lvl_user = '$_POST[lvl_user]'
              WHERE id_user = '$_POST[id]' ");
            echo "<script>window.location='?page=user&act=view'</script>";
          } else {
            mysqli_query($db, "UPDATE user SET
            nama = '$_POST[nama]',
            username = '$_POST[username]',
            password = md5('$_POST[password]'),
            lvl_user = '$_POST[lvl_user]'
            WHERE id_user='$_POST[id]' ");
            echo "<script>window.location='?page=user&act=view'</script>";
          }
        }
        ?>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Update Data User
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <input class="form-control" id="ckode" type="hidden" name="id" required value="<?php echo $d['id_user'];?>">
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Pelanggan</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="nama" required value="<?php echo $d['nama'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cusername" class="control-label col-lg-2">Username</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cusername" type="text" name="username" required value="<?php echo $d['username'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnotelp" class="control-label col-lg-2">Password</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cpass" name="password" type="password" />
                        <p class="text-red">Kosongkan jika tidak diubah</p>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="clevel" class="control-label col-lg-2">Level</label> <br>
                      <?php
                        if ($d['lvl_user'] == 'admin'){  
                      ?>
                      <label class="radio-inline">
                        <input type="radio" name="lvl_user" id="clevel" value="admin" required data-fv-notempty-message="Tidak Boleh Kosong" checked> Admin
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="lvl_user" id="clevel" value="kasir" required data-fv-notempty-message="Tidak Boleh Kosong"> Kasir
                      </label>
                      <?php
                    } elseif ($d['lvl_user'] == 'user') {
                    ?>
                      <label class="radio-inline">
                        <input type="radio" name="lvl_user" id="clevel" value="admin" required data-fv-notempty-message="Tidak Boleh Kosong"> Admin
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="lvl_user" id="clevel" value="kasir" required data-fv-notempty-message="Tidak Boleh Kosong" checked> Kasir
                      </label>
                      <?php
                      }
                      ?>                      
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

        // PROSES HAPUS DATA PENGGUNA //
        case 'delete':
          mysqli_query($db, "DELETE FROM user WHERE id_user='$_GET[id]'");
          echo "<script>window.location='?page=user&act=view'</script>";
          break;
        }
        ?>
