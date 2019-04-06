 <?php
    switch ($_GET['act']) {
      // PROSES VIEW DATA MOBIL //
          case 'view':
        ?>    
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-car"></i> Daftar Mobil</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-car"></i> Daftar Mobil</li>
            </ol>
          </div>
        </div>

        <!-- page start -->
        <div class="row">
          <div class="col-lg-2">
            <a href="?page=barang&act=add" class="btn btn-primary">
              <span class="icon_plus_alt"></span> Tambah Mobil
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
                    <th> Kode Mobil</th>
                    <th> Nama Tipe</th>
                    <th> No.Plat</th>
                    <th> Tahun Pembuatan</th>
                    <th> Isi Silinder</th>
                    <th> No.Rangka</th>
                    <th> No.Mesin</th>
                    <th> Bahan Bakar</th>
                    <th> No.BPKB</th>
                    <th> Harga</th>
                    <th><i class="icon_cogs"></i> Action</th>
                  </tr>
                  <tr>
                  <?php
                    $tampil = "SELECT * FROM tbl_mobil ORDER BY id_mobil ASC";
                    $show = mysqli_query($db, $tampil);
                    $no = 1;
                      while ($r = mysqli_fetch_array($show)) {
                  ?>
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
                    <td><?php echo "Rp.". number_format("$r[harga]",'0','.','.')?></td>
                    <td>
                      <div class="btn-group">
                        <a class="btn btn-primary" href="?page=barang&act=edit&id=<?php echo $r['id_mobil']?>"><i class="fas fa-edit"></i></a>
                        <a class="btn btn-danger" href="?page=barang&act=delete&id=<?php echo $r['id_mobil']?>" onclick="return confirm('Apakah anda yakin akan menghapusnya ?');"><i class="icon_close_alt2"></i></a>
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
      $kodemobil = $_POST['kodemobil'];
      $nama_tipe = $_POST['nama_tipe'];
      $noplat = $_POST['noplat'];
      $thnpembuatan = $_POST['thnpembuatan'];
      $silinder = $_POST['silinder'];
      $norangka = $_POST['norangka'];
      $nomesin = $_POST['nomesin'];
      $bhnbakar = $_POST['bhnbakar'];
      $nobpkb = $_POST['nobpkb'];
      $harga = $_POST['harga'];

      $qry = "INSERT INTO tbl_mobil VALUES ('$kodemobil', '$nama_tipe', '$noplat', '$thnpembuatan', '$silinder', '$norangka', '$nomesin', '$bhnbakar', '$nobpkb', $harga)";
      $tambah = mysqli_query($db, $qry);

      if($tambah) {
        echo "<script>window.alert('Data Berhasil Disimpan')
        window.location='?page=barang&act=view'</script>";
      }else{
        echo "<script>window.alert('Data Gagal Ditambahkan')
        window.location='?page=barang&act=view'</script>";
      }
    }
    ?>

        <!-- Form Tambah Data -->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-car"></i> Daftar Mobil</h3>
            <ol class="breadcrumb">
              <li><i class="fa fa-home"></i><a href="?page=dashboard">Home</a></li>
              <li><i class="fas fa-car"></i> Daftar Mobil</li>
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
                    $sql = mysqli_query($db, "SELECT * FROM tbl_mobil");

                    $num = mysqli_num_rows($sql);

                    if($num <> 0)
                    {
                      $kode = $num + 1;
                    }else
                    {
                      $kode = 1;
                    }

                    // Mulai bikin kode
                    $bikin_kode = str_pad($kode, 4, "0", STR_PAD_LEFT);
                    $tahun = date('Ym');
                    $kode_jadi = "SSM$tahun$bikin_kode";

                    ?>
                      <label for="ckode" class="control-label col-lg-2">Kode Mobil</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cname" name="kodmob" placeholder="Kode Mobil" value="<?php echo $kode_jadi?>" type="text" required data-fv-notempty-message="Tidak boleh kosong" disabled />
                        <input class="form-control" id="cname" name="kodemobil" placeholder="Kode Mobil" value="<?php echo $kode_jadi?>" type="hidden" required data-fv-notempty-message="Tidak boleh kosong"/>
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Tipe</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="nama_tipe" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnoplat" class="control-label col-lg-2">No. Plat</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnoplat" type="text" name="noplat" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ctahun" class="control-label col-lg-2">Tahun Pembuatan</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ctahun" name="thnpembuatan" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="csilinder" class="control-label col-lg-2">Isi Silinder</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="csilinder" name="silinder" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="crangka" class="control-label col-lg-2">No. Rangka</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="crangka" name="norangka" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cmesin" class="control-label col-lg-2">No. Mesin</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cmesin" name="nomesin" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cbbm" class="control-label col-lg-2">Bahan Bakar</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cbbm" name="bhnbakar" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cbpkb" class="control-label col-lg-2">No. BPKB</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cbpkb" name="nobpkb" type="text" required />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="charga" class="control-label col-lg-2">Harga</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="charga" name="harga" type="number" required />
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <div class="col-lg-offset-2 col-lg-10">
                        <button class="btn btn-primary" type="submit" name="add">Save</button>
                        <a href="?page=barang&act=view"><button class="btn btn-default" type="reset">Cancel</button></a>
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
    $d = mysqli_query($db,"SELECT * FROM tbl_mobil WHERE id_mobil='$_GET[id]'");
      $d = mysqli_fetch_array($d);
        if (isset($_POST['update'])) {

          $qry = "UPDATE tbl_mobil SET
            nama_tipe='$_POST[nama_tipe]',
            no_plat='$_POST[noplat]',
            thn_pembuatan='$_POST[thnpembuatan]',
            isi_silinder='$_POST[silinder]',
            no_rangka='$_POST[norangka]',
            no_mesin='$_POST[nomesin]',
            bahan_bakar='$_POST[bhnbakar]',
            no_bpkb='$_POST[nobpkb]',
            harga='$_POST[harga]' WHERE id_mobil='$_POST[id]'
           ";
           $updt = mysqli_query($db,$qry);

           if($updt) {
            echo "<script>window.location='?page=barang&act=view'</script>";
           }else{
            echo "<script>window.alert('Terjadi Kesalahan')
        window.location='?page=barang&act=view'</script>";
           }
        }
        ?>

        <div class="row">
          <div class="col-lg-12">
            <section class="panel">
              <header class="panel-heading">
                Update Barang
              </header>
              <div class="panel-body">
                <div class="form">
                  <form class="form-validate form-horizontal" id="feedback_form" method="POST" action="">
                    <input class="form-control" id="ckode" type="hidden" name="id" required value="<?php echo $d['id_mobil'];?>">
                    <div class="form-group ">
                      <label for="cnama" class="control-label col-lg-2">Nama Tipe</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnama" type="text" name="nama_tipe" required value="<?php echo $d['nama_tipe'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cnoplat" class="control-label col-lg-2">No. Plat</label>
                      <div class="col-lg-10">
                        <input class="form-control " id="cnoplat" type="text" name="noplat" required value="<?php echo $d['no_plat'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="ctahun" class="control-label col-lg-2">Tahun Pembuatan</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="ctahun" name="thnpembuatan" type="text" required value="<?php echo $d['thn_pembuatan'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="csilinder" class="control-label col-lg-2">Isi Silinder</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="csilinder" name="silinder" type="text" required value="<?php echo $d['isi_silinder'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="crangka" class="control-label col-lg-2">No. Rangka</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="crangka" name="norangka" type="text" required value="<?php echo $d['no_rangka'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cmesin" class="control-label col-lg-2">No. Mesin</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cmesin" name="nomesin" type="text" required value="<?php echo $d['no_mesin'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cbbm" class="control-label col-lg-2">Bahan Bakar</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cbbm" name="bhnbakar" type="text" required value="<?php echo $d['bahan_bakar'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="cbpkb" class="control-label col-lg-2">No. BPKB</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="cbpkb" name="nobpkb" type="text" required value="<?php echo $d['no_bpkb'];?>" />
                      </div>
                    </div>
                    <div class="form-group ">
                      <label for="charga" class="control-label col-lg-2">Harga</label>
                      <div class="col-lg-10">
                        <input class="form-control" id="charga" name="harga" type="number" required value="<?php echo $d['harga'];?>" />
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

        // PROSES HAPUS DATA PENGGUNA //
        case 'delete':
          mysqli_query($db, "DELETE FROM tbl_mobil WHERE id_mobil='$_GET[id]'");
          echo "<script>window.location='?page=barang&act=view'</script>";
          break;
        }
        ?>
