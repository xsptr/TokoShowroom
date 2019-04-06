    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">

      <?php
        if (!isset($_GET['page'])) {
          include 'dashboard.php';
        } else {
          switch ($_GET['page']) {
            case 'dashboard':
              include 'dashboard.php';
              break;
            case 'barang':
              include 'barang.php';
              break;
            case 'pelanggan':
              include 'pelanggan.php';
              break;
            case 'supplier':
              include 'supplier.php';
              break;
            case 'user':
              include 'user.php';
              break;
            case 'lappt':
              include 'lap_transaksi.php';
              break;
            
            default:
              echo "<label>404 Halaman tidak ditemukan</label>";
              break;
          }
        }
      ?>

      </section>
      <div class="text-right">
        <div class="credits">
          <!--
            All the links in the footer should remain intact.
            You can delete the links only if you purchased the pro version.
            Licensing information: https://bootstrapmade.com/license/
            Purchase the pro version form: https://bootstrapmade.com/buy/?theme=NiceAdmin
          -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
    </section>
    <!--main content end-->