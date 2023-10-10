<?php
session_start();


include "fungsi/koneksi.php";
include "fungsi/ceklogin.php";


$err="";

if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$level = $_POST['level'];

	$query = "SELECT * FROM user WHERE username='$username' && password='$password'";
	$hasil = mysqli_query($koneksi, $query);
	
	if (!$hasil) {
		echo "ada error";
	} 

	if (mysqli_num_rows($hasil) == 0) {
		$err="
		<div class='row' style='margin-top: 15px';>
		<div class='col-md-12'>
		<div class='box box-solid bg-red'>
		<div class='box-header'>
		<h3 class='box-title'>Login Gagal!</h3>
		</div>
		<div class='box-body'>
		<p>Username atau password yang anda masukan salah.</p>
		</div>
		</div>
		</div>
		</div>
		</div>";
	} else {
		$row = mysqli_fetch_array($hasil);
		$_SESSION['username'] = $row['username'];
		$_SESSION['level'] = $row['level'];
		$_SESSION['jabatan'] = $row['jabatan'];
		

		if($row['level'] == "instansi" && $level == "instansi"  ) {
			$_SESSION['login'] = true;
			header("location:instansi/index");

		} else if ($row['level'] == "bendahara" && $level == "bendahara" ) {
			$_SESSION['login'] = true;
			header("location:bendahara/index");
			
		}  else {
			$err="
			<div class='row' style='margin-top: 15px';>
			<div class='col-md-12'>
			<div class='box box-solid bg-red'>
			<div class='box-header'>
			<h3 class='box-title'>Login Gagal!</h3>
			</div>
			<div class='box-body'>
			<p>Anda salah memilih level login.</p>
			</div>
			</div>
			</div>
			</div>
			</div>";
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Toko Wida</title>
	<!-- Icon  -->
	<link rel="shortcut icon" img="image/download.png">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/bootstrap/css/custom.css" rel="stylesheet">
	<link href="assets/dist/css/AdminLTE.min.css" rel="stylesheet" >
	<link href="assets/dist/css/AdminLTE.css" rel="stylesheet" >
	<link  href="assets/dist/css/skins/_all-skins.min.css" rel="stylesheet">
	<link href="assets/plugins/iCheck/square/blue.css" rel="stylesheet">
	<link href="assets/fa/css/font-awesome.min.css" rel="stylesheet">  
</head>
<style>
body {
    background-color: #f0f0f0;
    font-family: Arial, sans-serif;
}

/* Gaya untuk kotak login */
.login-box {
    max-width: 400px;
   
    background-color: #fff;
  
    border: 1px solid #ddd;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

/* Gaya untuk tombol */
.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

/* Gaya untuk logo */
.login-logo img {
    max-width: 100px;
    height: auto;
    display: block;
    margin: 0 auto;
}
	</style>
<body class="register-page">
	<div class="login-box">
		<div class="login-logo">        
		</div><!-- /.login-logo -->
		<div class="login-box-body">
			<h3 class="text-center">Persediaan Barang</h3>
			<h3 class="text-center">Toko Wida</h3>
			
			<form method="post">
				<div class="form-group">           	
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-user"></i></span>
						<input type="text" class="form-control" placeholder="Username" name="username" required  />	            
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-unlock"></i></span>
						<input  type="password" class="form-control" placeholder="Password" name="password"  required>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group col-md-7">          	
						<span class="input-group-addon"><i class="fa fa-shield"></i></span>
						<select class="form-control" name="level" required>            	
							<option value>[Pilih Level]</option>
							<option value="instansi">Karyawan</option>
							<option value="bendahara">Admin</option>
							<!-- <option value="kepala">Kepala</option> -->
						</select>
					</div>            
				</div>
				<div class="row">
					<div class="col-xs-12">
						<input type="submit" class="btn btn-primary btn-block btn-flat pull-right" value="Login" name="login"/>

					</div><!-- /.col -->
				</div>
			</form>


		</div>
		<?= $err; ?>
      <!-- /.login-box-body 
      <div class="row" style="margin-top: 15px;">
	       <div class="col-md-12">
	        	<div class="box box-solid bg-red">
	        		<div class="box-header">
	        			<h3 class="box-title">Gagal Login</h3>
	        		</div>
	        		<div class="box-body">
	        			<p>Username atau password salah</p>
	        		</div>
	        	</div>
	        </div>
        </div>
    </div>
-->     
<!-- /.login-box -->

<script src="assets/plugins/jQuery/jquery.min.js" type="text/javascript"></script>
<script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
