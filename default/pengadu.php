<?php
	$author = $data_id;

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as diajukan  from tb_pengaduan where status='Diajukan' AND author='$author'");
	while ($data= $sql->fetch_assoc()) {
		$diajukan=$data['diajukan'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as periksa  from tb_pengaduan where status='Periksa' AND author='$author'");
  	while ($data= $sql->fetch_assoc()) {
		$periksa=$data['periksa'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as kembalikan  from tb_pengaduan where status='Kembalikan' AND author='$author'");
  	while ($data= $sql->fetch_assoc()) {
		$kembalikan=$data['kembalikan'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as proses  from tb_pengaduan where status='Proses' AND author='$author'");
  	while ($data= $sql->fetch_assoc()) {
		$proses=$data['proses'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as selesai  from tb_pengaduan where status='Selesai'AND author='$author'");
  	while ($data= $sql->fetch_assoc()) {
		$sel=$data['selesai'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as tolak  from tb_pengaduan where status='Tolak'AND author='$author'");
  	while ($data= $sql->fetch_assoc()) {
		$tolak=$data['tolak'];
		}


?>
<hr>
<div>
	<center>
		<h1>Selamat Datang,
			<?= $data_nama ?>-
			<?= $data_level ?>
		</h1>
	</center>
</div>
<hr>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-yellow set-icon">
			<i class="fa fa-bell"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $diajukan; ?>
			</h1>
			<p>Pengaduan Diajukan</p>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-green set-icon">
			<i class="fa fa-envelope"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $periksa; ?>
			</h1>
			<p>Pengaduan Diperiksa</p>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-red set-icon">
			<i class="fa fa-backward"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $kembalikan; ?>
			</h1>
			<p>Pengaduan Dikembalikan</p>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-green set-icon">
			<i class="fa fa-repeat"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $proses; ?>
			</h1>
			<p>Pengaduan Diproses</p>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-blue set-icon">
			<i class="fa fa-check"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $sel; ?>
			</h1>
			<p>Pengaduan Selesai</p>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-red set-icon">
			<i class="fa fa-xmark"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $tolak; ?>
			</h1>
			<p>Pengaduan Ditolak</p>
		</div>
	</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
	<h3>Klik link di bawah ini Untuk info Update di Kec. BBS</h3>
	<style>
		h3 {
			font-family: 'Arial', sans-serif;
		}
	</style>
	<h4>
		<a href="http://kec-bbs.banjarbarukota.go.id/" target="blank">Copyright @ 2023 - Kecamatan Banjarbaru Selatan</a>
	</h4>
</center>