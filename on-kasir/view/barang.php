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
