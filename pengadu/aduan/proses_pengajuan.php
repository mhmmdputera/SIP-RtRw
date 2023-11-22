<div class="panel panel-info">
	<div class="panel-heading">
		<i class="glyphicon glyphicon-book"></i>
		<b>Data Aduan</b>
	</div>
	<div class="panel-body">

		<div class="table-responsive">
			<table class="table table-striped table-bordered table-hover" id="dataTables-example">
				<thead>
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Jenis</th>
						<th>status</th>
						<th>Lihat Riwayat</th>
					</tr>

				</thead>
				<tbody>
					<?php $author=$data_id ?>
					<?php
                        $no = 1;
						$sql = $koneksi->query("select a.id_pengaduan, a.judul, a.foto, a.status, a.tanggapan, j.jenis
						from tb_pengaduan a join tb_jenis j on a.jenis=j.id_jenis  where author='$author'");
                        while ($data= $sql->fetch_assoc()) {
                    ?>
					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['judul']; ?>
						</td>
						<td>
							<?php echo $data['jenis']; ?>
						</td>
						<td>
						<?php $stt = $data['status']  ?>
							<?php if($stt == 'Diajukan'){ ?>
							<span class="label label-warning">Diajukan</span>
							<?php }elseif($stt == 'Periksa'){ ?>
							<span class="label label-success">Diperiksa</span>
							<?php }elseif($stt == 'Kembalikan'){ ?>
							<span class="label label-danger">Dikembalikan</span>
							<?php }elseif($stt == 'Proses'){ ?>
							<span class="label label-success">Diproses</span>
							<?php }elseif($stt == 'Tolak'){ ?>
							<span class="label label-danger">Ditolak</span>
							<?php }else{ ?>
							<span class="label label-finish">Selesai</span>
						</td>
						<?php } ?>

						<td>
							<?php $stt = $data['status']  ?>
							<?php if($stt){ ?>
							<a href="?page=riwayat&kode=<?php echo $data['id_pengaduan']; ?>" title="riwayat"
							 class="btn btn-success btn-sm">
								<i class="glyphicon glyphicon-edit"></i>
							</a>
							<?php }else{ ?>
							-
						</td>
						<?php } ?>

					</tr>

					<?php
                        }
                    ?>
					
					<br>
					<br>
				</tbody>
		</div>
	</div>
</div>