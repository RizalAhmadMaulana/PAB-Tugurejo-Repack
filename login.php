<?php
include 'koneksi.php';
error_reporting(0);
session_start();
if (isset($_SESSION['name'])) {
    header("Location: index.php");
}
 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $pass =$_POST['pass'];
 
    $sql = "SELECT * FROM ruser WHERE name='$name' AND pass='$pass'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['name'] = $row['name'];
        header("Location: index.php");
    } elseif (empty($name)){
        echo "<script>alert('Tolong masukan Username Anda!')</script>";
    } else {
    	echo "<script>alert('Username atau Password Anda salah!')</script>";
    }
}
?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>PAB Tugurejo | Login</title>
  <!--Logo Title-->
  <link rel="icon" type="image/x-icon" href="gambar/logo.png" />
  
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<style>
    h3{
      font-family: noto-sans;
    }
    label{
      padding-top: 15px;
      font-family: Roboto;
    }
    input{
      margin-top: 15px;
    }
    table{
      text-align: right;
    }
    .Gambar{
    position: absolute;
    left: 200px;
    top: 125px;
    text-align: center;
    filter: drop-shadow(0px 4px 4px rgba(0, 0, 0, 0.25));
    }
  #submit-btn {
    background: -webkit-linear-gradient(right, #0000FF , #2dbd6e);
    border: none;
    border-radius: 21px;
    box-shadow: 0px 1px 8px #24c64f;
    cursor: pointer;
    color: white;
    font-family: noto-sans;
    height: 42.3px;
    margin: 0 auto;
    margin-top: 50px;
    transition: 0.25s;
    width: 170px;
  }
  .FormLogin{
    position: absolute;
    width: 450px;
    height: 505px;
    left: 922px;
    top: 115px;
  }
  #submit-btn:hover {
    box-shadow: 0px 1px 18px #24c64f;
  }
</style>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <div class="Gambar">
        <img src="gambar/logo.png" alt="" style="width: 400px; height: 220px;"><br>
        <h3>Selamat Datang di Website <br>Pengelolaan Air Bersih Tugurejo</h3>
    </div>
    <div class="FormLogin">
    <form action="" method="post">
		<table>
            <label for="name"  style="font-size: 20px;"><strong>Username</strong></label><br>
            <input type="text" class="form-control" id="floatingInput" placeholder="name" name="name" autocomplete="off"><br>
            <label for="pass"  style="font-size: 20px;"><strong>Password</strong></label><br>
            <input type="password" class="form-control" id="floatingPassword" placeholder="pass" name="pass" autocomplete="off"><br>
            <button id="submit-btn" type="submit" name="submit"  style="font-size: 20px;">Login</button>
		</table>
	</form>
    </div>
</body>
<script type="text/javascript" src="script.js"></script>
</html>