<!-- menghubukan data base -->
<?php

include 'function.php';
// include 'database.php';
//anda belum login
if( !isset($_SESSION['username'])){
header('Location: login.php');
}
?>

<!-- TABEL -->
<html lang="en" dir="ltr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="icon.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>Hello, world!</title>
  </head>
  <body>
    <div class="wrapper">
      <nav id="sidebar">
        <div class="sidebar-header">
          <h1> HALLO <?php echo $_SESSION['username']; ?>
            <?php if(!cek_status( $_SESSION['username'] )){?>
            <div> ADMIN </div>
            <?php ;}?>
          <a href="logout.php"><h4>keluar</h4></a>
      </div>
      <ul class="list-unstyled components">
        <li class="">
            <a href="index.php" class="a-menu">Home</a>
        </li>
      </ul>
        <ul class="list-unstyled components">
          <li class="">
              <a href="buku.php" class="a-menu">Buku</a>
          </li>
        </ul>
        <ul class="list-unstyled components">
          <li class="active">
              <a href="distributor.php" class="a-menu">Distributor</a>
          </li>
        </ul>
        <ul class="list-unstyled components">
          <li class="active">
              <a href="penjualan.php" class="a-menu">Penjualan</a>
          </li>
        </ul>
        <ul class="list-unstyled components">
          <li class="active">
              <a href="pasok.php" class="a-menu">Pasok</a>
          </li>
        </ul>
        <ul class="list-unstyled components">
          <li class="active">
            <?php if (!cek_status($_SESSION['username'])){ ?>
                <a href="kasir.php" class="a-menu">Kasir</a>
              <?php } ?>
          </li>
        </ul>
        <ul class="list-unstyled components">
          <!-- <li class="active">
            <form class="form-inline my-1 my-lg-0 pr-3">
              <input class="form-control mr-sm-2 col-xs-1" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-1 my-sm-2" type="submit">Search</button>
              </form>
          </li> -->
        </ul>
    </nav>
  <div class="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

          <img src="list.png" class="icon" id="sidebarCollapse">

  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">Hide & Show</a>

    <form class="form-inline my-2 my-lg-0" method="post" action="buku.php">
      <input class="form-control mr-sm-2 col-xs-1" type="text" placeholder="Search" name="cari">
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="tmbl_cari">Search</button>
      </form>
    </div>
  </nav>
    <h1 class="text-center"> Daftar Buku </h1>
    <br>
  <!-- tabel -->
  <div class="container">
  <div class=" col-xl-12">
    <table class="table table-bordered">
        <thead>
    <tr>
      <th scope="col" class="text-center">No</th>
      <th scope="col" class="text-center">Judul</th>
      <th scope="col" class="text-center">Noisbn</th>
      <th scope="col" class="text-center">Penulis</th>
      <th scope="col" class="text-center">Penerbit</th>
      <th scope="col"class="text-center">Tahun</th>
      <th scope="col"class="text-center">Stok</th>
      <th scope="col"class="text-center">Harga Pokok</th>
      <th scope="col"class="text-center">Harga Jual</th>
        <th scope="col"class="text-center">PPN</th>
          <th scope="col"class="text-center">Diskon</th>
            <th scope="col"class="text-center">Aksi</th>
    </tr>
      </thead>
    </tbody>
  </div>
</div>
<?php
//menampalkan data tabel
// serch
      $panggil = false;
      if(isset($_POST['cari'])){
        $panggil = $_POST['cari'];
      }

      if($panggil !=''){
        $view = mysqli_query($conn,"SELECT * FROM buku WHERE judul LIKE '".$panggil."' OR id_buku LIKE '".$panggil."' OR penulis LIKE '".$panggil."' ");
      }else{
        $view = mysqli_query($conn,"SELECT * FROM buku ");
      }
      // $query ="SELECT * FROM distributor";
      $no = 1;
      while ( $data = mysqli_fetch_array ($view) ) {
        echo '<tr>';
        echo '<td>' ."$no".'</td>';
        echo '<td>' .$data['judul'].'</td>';
        echo '<td>' .$data['noisbn'].'</td>';
        echo '<td>' .$data['penulis'].'</td>';
        echo '<td>' .$data['penerbit'].'</td>';
        echo '<td>' .$data['tahun'].'</td>';
        echo '<td>' .$data['stok'].'</td>';
        echo '<td>' .$data['harga_pokok'].'</td>';
        echo '<td>' .$data['harga_jual'].'</td>';
        echo '<td>' .$data['ppn'].'</td>';
        echo '<td>' .$data['diskon'].'</td>';
        echo '<td>' .'<a href="?hapus='.$data['id_buku'].'"><button class="btn btn-danger"> HAPUS</button> </a>' ;
        echo '<a href="?edit='.$data['id_buku'].'"><button class="btn btn-warning">EDIT</button> </a> </td>';
            echo '</tr>';
          $no++;

        }
      ?>
</tr>

      <?php
//edit data
if (isset($_GET['edit'])) {
  $id_edit = $_GET['edit'];

  $query_edit = "SELECT * FROM buku WHERE id_buku = $id_edit";
  $view_edit = mysqli_query( $conn, $query_edit);
  $data_edit = mysqli_fetch_assoc($view_edit);
}
       ?>
      </table>
<br>

<div class="container">
  <div class="jumbotron">
    <div class="text-center padding">
<h3 class="text-center"> Form Buku </h3>
    <form class="" action="" method="post">
      <div class="form-row padding">
        <div class="col-md-4 mb-3">
          <label for="validationTooltip01">Judul</label><br>
            <input type="text" name="judul" class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['judul'];} ?>" placeholder="judul">
        </div>
        <div class="col-md-4 mb-3">
          <label for="validationTooltip02">Noisbn</label>
        <input type="text" name="noisbn" class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['noisbn'];} ?>" placeholder="noisbn">

        </div>
        <div class="col-md-4 mb-3">
          <label for="validationTooltip03">Penulis</label>
          <input type="text" name="penulis"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['penulis'];} ?>" placeholder="penulis">
        </div>

        <div class="col-md-4 mb-3">
          <label for="exampleInputEmail1">Penerbit</label>
          <div class="input-group">
            <input type="text" name="penerbit"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['penerbit'];} ?>" placeholder="penerbit">

          </div>
        </div>

        <div class="col-md-4 mb-3">
          <label for="validationTooltip03">Tahun</label>
          <input type="text" name="tahun"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['tahun'];} ?>" placeholder="tahun">
        </div>

        <div class="col-md-4 mb-3">
          <label for="validationTooltip04">Stok</label>
          <input type="text" name="stok"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['stok'];} ?>" placeholder="stok">
          </div>
      </div>

      <div class="form-row">
        <div class="col-md-4 mb-3">
          <label for="validationTooltip05">Harga Pokok</label>
          <input type="text" name="harga_pokok"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['harga_pokok'];} ?>" placeholder="harga pokok">
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationTooltip05">Harga Jual</label>
        <input type="text" name="harga_jual"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['harga_jual'];} ?>" placeholder="harga jual">
        </div>

        <div class="col-md-4 mb-3">
            <label for="validationTooltip05">PPN</label>
        <input type="text" name="ppn"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['ppn'];} ?>" placeholder="ppn">
    </div>

      <div class="col-md-4 mb-3">
        <label for="validationTooltip05">Diskon</label>
        <input type="text" name="diskon"class="form-control" value="<?php if(isset($_GET['edit'])){echo $data_edit['diskon'];} ?>" placeholder="diskon">
      </div>

    <br>
    <button type="submit" name="tombol" value="tambah DB" class="btn btn-success btn-block">Tambah Data</button>
    <button type="submit" name="tombol_edit" value="edit DB" class="btn btn-primary btn-block">Perbarui Data</button>

    </form>

  </div>
</div>
</div>
</div>

<?php


//menghapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $query = "DELETE FROM buku WHERE id_buku = '$id' ";
    if (mysqli_query($conn, $query)) {
      echo '
      <script>window.location="http://localhost/ukk/buku.php";</script>
      ';
    }

}
//saat menekan tombol
        if(isset($_POST['tombol'])) {
          // $id = $_POST['id_buku'];
          $judul = $_POST['judul'];
          $noisbn = $_POST['noisbn'];
          $penulis = $_POST['penulis'];
          $penerbit = $_POST ['penerbit'];
          $tahun = $_POST ['tahun'];
          $stok = $_POST ['stok'];
          $harga_pokok = $_POST ['harga_pokok'];
          $harga_jual = $_POST ['harga_jual'];
          $ppn = $_POST ['ppn'];
          $diskon = $_POST ['diskon'];

          $query = "INSERT INTO buku (judul,noisbn,penulis,penerbit,tahun,stok,harga_pokok,harga_jual,ppn,diskon) VALUES
          ('$judul','$noisbn','$penulis','$penerbit','$tahun','$stok','$harga_pokok','$harga_jual','$ppn','$diskon')";

          if (mysqli_query($conn, $query)) {
            echo '
            <script>window.location="http://localhost/ukk/buku.php";</script>
            ';

          }else{
                die('ada error'. mysqli_connect_error());
           }

        }
        //saat menekan tombol edit
                  if(isset($_POST['tombol_edit'])) {
                    // $id = $_POST['id_buku'];
                    $judul = $_POST['judul'];
                    $noisbn = $_POST['noisbn'];
                    $penulis = $_POST['penulis'];
                    $penerbit = $_POST ['penerbit'];
                    $tahun = $_POST ['tahun'];
                    $stok = $_POST ['stok'];
                    $harga_pokok = $_POST ['harga_pokok'];
                    $harga_jual = $_POST ['harga_jual'];
                    $ppn = $_POST ['ppn'];
                    $diskon = $_POST ['diskon'];

                    $query = "UPDATE buku SET

                    judul='$judul',
                    noisbn='$noisbn',
                    penulis='$penulis',
                    penerbit='$penerbit',
                    tahun='$tahun',
                    stok='$stok',
                    harga_pokok='$harga_pokok',
                    harga_jual='$harga_jual',
                    ppn='$ppn',
                    diskon='$diskon'
                    WHERE id_buku='".$_GET['edit']."';";

                    if (mysqli_query($conn, $query)) {
                      echo '
                      <script>window.location="http://localhost/ukk/buku.php";</script>
                      ';
                    } else{
                          die('ada error'. mysqli_connect_error());
                     }

                  }

?>


  <br>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
  $(document).ready(function() {
    $('#sidebarCollapse').on('click',function() {
      $('#sidebar').toggleClass('active');
    });
  });
  </script>
</body>
</html>
