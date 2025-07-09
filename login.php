<?php
require 'function.php';

// Pastikan sesi hanya dimulai jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa data login
    $cekdatabase = mysqli_query($conn, "SELECT * FROM login WHERE email='$email' AND password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        // Jika login berhasil
        $_SESSION['log'] = 'True';
        header('location:index.php');
    } else {
        // Jika login gagal, tampilkan alert
        echo "<script>
            alert('Akun tidak terdaftar');
            window.location.href = 'login.php';
        </script>";
        exit;
    }
}

// Jika belum login, tetap di halaman login
if (!isset($_SESSION['log'])) {
    // Tidak melakukan apa-apa
} else {
    // Jika sudah login, arahkan ke halaman index
    header('location:index.php');
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="icon" href="images/icon stock barang.png" type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
      body {
        background: url(https://png.pngtree.com/background/20230426/original/pngtree-an-orange-fork-lift-driving-through-a-warehouse-picture-image_2479899.jpg) no-repeat center center fixed;
        background-size: cover;
        height: 100vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .login-card {
        background: rgba(253, 253, 253, 0.53);
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      }

      .form-control {
        border-radius: 10px;
        border: 1px solid #ced4da;
      }

      .btn {
        width: 100%;
        border-radius: 10px;
        font-size: 18px;
        background-color: rgba(243, 243, 243, 0.34);
      }

      h2 {
        color: #2c3e50;
        border-width: 20px;
        font-family: sans-serif;
        font-weight: bold;
      }

      .small-text {
        font-size: 15px;
      }

      .small{
        font-size: medium;
      }

      .btn ::before{
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out; /* Tambahkan smooth untuk transform dan warna */
        background-color:rgba(196, 196, 196, 0.83); /* Warna default */
        color: #fff; /* Warna teks */
      }
      .btn:hover{
        transform: scale(1.1); /* Zoom-in 10% */
        background-color: #0056b3; /* Warna saat hover */
        color: #fff; /* Pastikan teks tetap putih */
      }


    </style>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-5">
          <div class="login-card">
            <h2 class="text-center font-weight-light my-3"><strong> Login</strong></h2>

            <!-- Pesan Error -->
            <?php if (isset($error)) : ?>
              <div class="alert alert-danger text-center" role="alert"><?php echo $error; ?></div>
            <?php endif; ?>

            <!-- Form Login -->
            <form method="post">
              <div class="form-group">
                <label class="small mb-1" for="email">Email</label>
                <input
                  class="form-control py-4"
                  name="email"
                  id="email"
                  type="email"
                  placeholder="Enter your email"
                  required
                />
              </div>
              <div class="form-group">
                <label class="small mb-1" for="password">Password</label>
                <input
                  class="form-control py-4"
                  name="password"
                  id="password"
                  type="password"
                  placeholder="Enter your password"
                  required
                />
              </div>
              <form action="index.php" method="POST">
                <!-- input data login jika ada -->
                <button type="submit" name="login" class="btn">Login</button>
              </form>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>