<?php
     include "inc/koneksi.php"; 
	 
	 session_start();
    if(isset($_COOKIE['ses_id']) && isset($_COOKIE['ses_nama']) && isset($_COOKIE['ses_level']) && isset($_COOKIE['ses_grup'])) {
        $_SESSION["ses_id"] = $_COOKIE['ses_id'];
        $_SESSION["ses_nama"] = $_COOKIE['ses_nama'];
        $_SESSION["ses_level"] = $_COOKIE['ses_level'];
        $_SESSION["ses_grup"] = $_COOKIE['ses_grup'];
    }
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Masuk | SI-MASKOT</title>
	<!-- BOOTSTRAP STYLES-->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!-- FONTAWESOME STYLES-->
	<link href="assets/css/font-awesome.css" rel="stylesheet" />
	<!-- CUSTOM STYLES-->
	<link href="assets/css/custom.css" rel="stylesheet" />
	<!-- GOOGLE FONTS-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

	<link rel="stylesheet" href="dist/swal/sweetalert2.min.css">
	<style>
		.swal2-popup {
			font-size: 1.6rem !important;
		}
	</style>

</head>

<body>
	<div class="container">
		<div class="row ">
			<br>
			<br>
			<br>
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
				<div class="panel panel-primary">
					<div class="panel-body">
						<img src="assets/img/sip.jpg" class="user-image img-responsive" />
						<center>
							<h2>
								<b>SI-MASKOT</b>
							</h2>
						</center>
						<CENTER>Sistem Informasi Pengaduan Masyarakat Kota Banjarbaru Selatan</CENTER>
						<form action="" method="POST" enctype="multipart/form-data">
							<br />
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-tag"></i>
								</span>
								<input type="text" class="form-control" placeholder="Masukkan Username " name="username" required autofocus/>
							</div>
							<div class="form-group input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>
								</span>
								<input type="password" class="form-control" placeholder="Masukkan Password" name="password" required/>
							</div>

							<button type="submit" class="btn btn-primary form-control" name="btnLogin" title="Masuk Sistem" />MASUK</button>
							<br>
							<br>
							<CENTER>Kecamatan</CENTER>			
							<CENTER>Banjarbaru Selatan</CENTER>
						</form>
					</div>
				</div>
			</div>


		</div>
	</div>

	<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
	<!-- JQUERY SCRIPTS -->
	<script src="assets/js/jquery-1.10.2.js"></script>
	<!-- BOOTSTRAP SCRIPTS -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- METISMENU SCRIPTS -->
	<script src="assets/js/jquery.metisMenu.js"></script>
	<!-- CUSTOM SCRIPTS -->
	<script src="assets/js/custom.js"></script>
	<!-- SWAL -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

</body>

</html>

<?php 
		if (isset($_POST['btnLogin'])) {  
            $sql_login = "SELECT * FROM tb_pengguna WHERE username='".$_POST['username']."' AND password='".$_POST['password']."'";
			$query_login = mysqli_query($koneksi, $sql_login);
			$data_login = mysqli_fetch_array($query_login,MYSQLI_BOTH);
            $jumlah_login = mysqli_num_rows($query_login);
        

            if ($jumlah_login==1 ){
                session_start();
                $_SESSION["ses_id"]=$data_login["id_pengguna"];
                $_SESSION["ses_nama"]=$data_login["nama_pengguna"];
                $_SESSION["ses_level"]=$data_login["level"];
                $_SESSION["ses_grup"]=$data_login["grup"];

				// Set cookie
				setcookie("ses_id", $_SESSION["ses_id"], time() + 3600); // Cookie akan kadaluwarsa dalam 1 jam
				setcookie("ses_nama", $_SESSION["ses_nama"], time() + 3600);
				setcookie("ses_level", $_SESSION["ses_level"], time() + 3600);
				setcookie("ses_grup", $_SESSION["ses_grup"], time() + 3600);

            echo "<script>
                    Swal.fire({title: 'SUKSES',text: '',icon: 'success',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php';
                        }
                    })</script>";
			}else{
            echo "<script>
                    Swal.fire({title: 'GAGAL',text: '',icon: 'error',confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'login.php';
                        }
                    })</script>";
            }
        }
?>

<!-- END -->