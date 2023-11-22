<?php $author=$data_id;

	// Tambahkan query untuk mengambil nama pengadu
	$sql_pengadu = $koneksi->query("SELECT nama_pengadu FROM tb_pengadu WHERE id_pengadu = '$author'");
	$data_pengadu = $sql_pengadu->fetch_assoc();
	$nama_pengadu = $data_pengadu['nama_pengadu'];

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
						<label>Judul Aduan</label>
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
					<label>Tanggal Aduan</label>
					<input type="date" name="tanggal" class="form-control" required/>
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

	$nama_pengadu=$_POST['nama_pengadu'];
	$aduan=$_POST['judul'];
	$tanggal = $_POST['tanggal'];


	$sumber = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
	// Mengecek apakah file yang diunggah adalah gambar
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

    if(in_array($ekstensi, $ekstensi_diperbolehkan)){

        // Memindahkan file
        $pindah = move_uploaded_file($sumber, 'foto/'.$nama_file);

        // Memasukkan data ke database
        $sql_simpan = "INSERT INTO tb_pengaduan (`judul`, `jenis`, `keterangan`, `foto`, `author`, `waktu_aduan`) VALUES (
            '".$_POST['judul']."',
            '".$_POST['jenis']."',
            '".$_POST['keterangan']."',
            '".$nama_file."',
            '$author',
			'$tanggal')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);


        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Sukses',text: '',icon: 'success',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=aduan_view';
                }
			})</script>";

			$aduan = $_POST['judul'];
			$aduan = urlencode($aduan); // Mengonversi karakter spesial untuk digunakan dalam URL
    		$aduan = str_replace("+", "%20", $aduan); // Ganti karakter "+" dengan "%20" untuk spasi

			$nama_pengadu = urlencode($nama_pengadu); 
    		$nama_pengadu = str_replace("+", "%20", $nama_pengadu); 

			$token1 = "5991474482:AAFD-Q_PMkjLsuTSOCZbi52fYvhIFEpVDsk"; // Ganti dengan token pertama Anda
			$id_chat1 = "5858115736"; // Ganti dengan ID chat pertama Anda

			$token2 = "6490409467:AAFjTVCvcS3_tUi6NvoDTKWvax_12jVKcKg"; // Ganti dengan token kedua Anda
			$id_chat2 = "1575374490"; // Ganti dengan ID chat kedua Anda

			// Kirim notifikasi ke akun Telegram pertama
			$url1 = "https://api.telegram.org/bot$token1/sendMessage?chat_id=$id_chat1&parse_mode=HTML&text=INFO%20PENGADUAN%20:%20Aduan%20$aduan%20dari%20$nama_pengadu%20memerlukan%20penanganan.%20Terimakasih";
			$curlHandle1 = curl_init();
			curl_setopt($curlHandle1, CURLOPT_URL, $url1);
			curl_setopt($curlHandle1, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle1, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle1, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle1, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle1, CURLOPT_TIMEOUT, 30);
			curl_setopt($curlHandle1, CURLOPT_POST, 1);
			$results1 = curl_exec($curlHandle1);
			curl_close($curlHandle1);

			// Kirim notifikasi ke akun Telegram kedua
			$url2 = "https://api.telegram.org/bot$token2/sendMessage?chat_id=$id_chat2&parse_mode=HTML&text=INFO%20PENGADUAN%20:%20Aduan%20$aduan%20dari%20$nama_pengadu%20memerlukan%20penanganan.%20Terimakasih";
			$curlHandle2 = curl_init();
			curl_setopt($curlHandle2, CURLOPT_URL, $url2);
			curl_setopt($curlHandle2, CURLOPT_HEADER, 0);
			curl_setopt($curlHandle2, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curlHandle2, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($curlHandle2, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($curlHandle2, CURLOPT_TIMEOUT, 30);
			curl_setopt($curlHandle2, CURLOPT_POST, 1);
			$results2 = curl_exec($curlHandle2);
			curl_close($curlHandle2);

			// Simpan data aduan ke tb_riwayat
    		$id_pengaduan = mysqli_insert_id($koneksi); // Mengambil id_pengaduan yang baru saja disimpan

			// Simpan data aduan ke tb_riwayat
			$sql_riwayat = "INSERT INTO tb_riwayat (id_pengaduan, status, tanggal, tanggapan) VALUES (
				'$id_pengaduan',
				'Diajukan',
				'$tanggal',
				''
			)";
			$query_riwayat = mysqli_query($koneksi, $sql_riwayat);
		
			if (!$query_riwayat) {
				echo "<script>
					Swal.fire({
						title: 'Tambah Gagal',
						text: '',
						icon: 'error',
						confirmButtonText: 'OK'
					}).then((result) => {
						if (result.value) {
							window.location = 'index.php?page=aduan_view';
						}
					})
				</script>";
			}
			
            }else{
            echo "<script>
            Swal.fire({title: 'Tambah Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value)
                {window.location = 'index.php?page=aduan_view';
                }
            })</script>";
		}
        }else{
			// Jika file bukan gambar, tampilkan pesan kesalahan
			echo "<script>
			Swal.fire({title: 'Format File Salah',text: 'Hanya diperbolehkan untuk mengunggah gambar.',icon: 'error',confirmButtonText: 'OK'
			}).then((result) => {if (result.value)
				{window.location = 'index.php?page=aduan_view';
				}
			})</script>";
		}
        }
?>
<!-- end -->