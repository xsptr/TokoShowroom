
        <!--overview start-->
        <div class="row">
          <div class="col-lg-12">
            <h3 class="page-header"><i class="fas fa-laptop"></i> Dashboard</h3>
            <ol class="breadcrumb">
              <li><i class="fas fa-home"></i> Home</li>
              <li><i class="fas fa-laptop"></i> Dashboard</li>
            </ol>
          </div>
        </div>

        <div class="row">

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <?php

              $jumlah = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_supplier"));
              ?>
            <div class="info-box brown-bg">
              <i class="fa fa-shopping-cart"></i>
              <div class="count"><?php echo "$jumlah[total]";?></div>
              <div class="title">Supplier</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <?php

              $jumlah = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM tbl_mobil"));
              ?>
            <div class="info-box dark-bg">
              <i class="fas fa-money-check"></i>
              <div class="count">
              <?php echo "$jumlah[total]";?>
              </div>
              <div class="title">Data Barang</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <?php

              $jumlah = mysqli_fetch_array(mysqli_query($db, "SELECT COUNT(*) as total FROM customer"));
              ?>
            <div class="info-box green-bg">
              <i class="fas fa-users"></i>
              <div class="count"><?php echo "$jumlah[total]";?></div>
              <div class="title">Pelanggan</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <?php

              $jumlah = mysqli_fetch_array(mysqli_query($db, "SELECT SUM(unit) as total FROM tbl_transaksi"));
              ?>
            <div class="info-box green-bg">
              <i class="fas fa-users"></i>
              <div class="count"><?php echo "$jumlah[total]";?></div>
              <div class="title">Unit Terjual</div>
            </div>
            <!--/.info-box-->
          </div>
          <!--/.col-->

        </div>
        <!--/.row-->

        <!-- Today status end -->