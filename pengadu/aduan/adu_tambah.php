<?php $author=$data_id;

	$sql = $koneksi->query("SELECT * from tb_telegram");
  	while ($data= $sql->fetch_assoc()) {
    $id_chat=$data['id_chat'];
  }
?>
<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-plus"></i>
		<b>Tambah Aduan</b>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" enctype="multipart/form-data">

					<div class="form-group">
						<label>Nama Pengguna</label>
						<input class="form-control" name="judul" placeholder="Judul Aduan" required/>
					</div>

					<div class="form-group">
						<label>Jenis Aduan</label>
						<select name="jenis" class="form-control">
							<option value="">- Pilih -</option>
							<?php
							// ambil data dari database
							$query = "select * from tb_jenis";
							$hasil = mysqli_query($koneksi, $query);
							while ($row = mysqli_fetch_array($hasil)) {
							?>
							<option value="<?php echo $row['id_jenis'] ?>">
								<?php echo $row['jenis'];  ?>
							</option>
							<?php
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Foto</label>
						<input type="file" name="foto" required/>
					</div>

					<div class="form-group">
						<label>Keterangan</label>
						<textarea class="form-control" name="keterangan" rows="5" placeholder="Keterangan Aduan" required></textarea>
					</div>

					<div>
						<input type="submit" name="Simpan" value="Simpan" class="btn btn-primary">
						<a href="?page=aduan_view" title="Kembali" class="btn btn-default">Batal</a>
					</div>
			</div>
			</form>
		</div>
	</div>
</div>

<?php

	
	
    if (isset ($_POST['Simpan'])){

	$aduan=$_POST['judul'];

	$sumber = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
	$pindah = move_uploaded_file($sumber, 'foto/'.$nama_file);
        
        $sql_simpan = "INSERT INTO tb_pengaduan (`judul`, `jenis`, `keterangan`, `foto`, `author`) VALUES (
			'".$_POST['judul']."',
			'".$_POST['jenis']."',
			'".$_POST['keterangan']."',
			'".$nama_file."',
			'$author')";
		$query_simpan = mysqli_query($koneksi, $sql_simpan);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=aduan_view';
                }
			})</script>";

			$token="_";
			$url="https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$id_chat."&parse_mode=HTML&text=INFO PENGADUAN : Aduan ".$aduan." dari ".$data_nama.", memerlukan penanganan. Terimakasih";
			$curlHandle=curl_init();
			curl_setopt($curlHandle, CURLOPT_URL, $url);
			curl_setopt($curlHandle, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
			curl_setopt($curlHandle, CURLOPT_POST, 1);
			$results = curl_exec($curlHandle);
			curl_close($curlHandle);
			
            }else{
            echo "<script>
            Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=aduan_view';
                }
            })</script>";
        }
        }
?>
<!-- end -->