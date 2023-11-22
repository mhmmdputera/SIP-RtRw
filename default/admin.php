<?php
	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as diajukan  from tb_pengaduan where status='Diajukan'");
	while ($data= $sql->fetch_assoc()) {
		$diajukan=$data['diajukan'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as periksa  from tb_pengaduan where status='Periksa'");
  	while ($data= $sql->fetch_assoc()) {
		$periksa=$data['periksa'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as kembalikan  from tb_pengaduan where status='Kembalikan'");
  	while ($data= $sql->fetch_assoc()) {
		$kembalikan=$data['kembalikan'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as proses  from tb_pengaduan where status='Proses'");
  	while ($data= $sql->fetch_assoc()) {
		$proses=$data['proses'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as selesai  from tb_pengaduan where status='Selesai'");
  	while ($data= $sql->fetch_assoc()) {
		$sel=$data['selesai'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengaduan) as tolak  from tb_pengaduan where status='Tolak'");
  	while ($data= $sql->fetch_assoc()) {
		$tolak=$data['tolak'];
		}

	$sql = $koneksi->query("SELECT COUNT(id_pengadu) as orang  from tb_pengadu");
  	while ($data= $sql->fetch_assoc()) {
		$or=$data['orang'];
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
			<a href="?page=aduan_admin">Detail
			</a>
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
			<a href="?page=aduan_admin_tanggap">Detail
			</a>
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
			<a href="?page=aduan_admin_kembalikan">Detail
			</a>
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
			<a href="?page=aduan_admin_proses">Detail
			</a>
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
			<a href="?page=aduan_admin_selesai">Detail
			</a>
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
			<a href="?page=aduan_admin_tolak">Detail
			</a>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<div class="panel panel-back noti-box">
		<span class="icon-box bg-color-grey set-icon">
			<i class="fa fa-users"></i>
		</span>
		<div class="text-box">
			<h1>
				<?=  $or; ?>
			</h1>
			<p>Pengadu</p>
			<a href="?page=pengadu_view">Detail
			</a>
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
	<h4>
	<a href="https://instagram.com/kecbjbselatan" target="blank">Copyright @ 2023 - Kecamatan Banjarbaru Selatan</a>
	</h4>
</center>