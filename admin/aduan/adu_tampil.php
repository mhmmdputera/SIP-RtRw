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
						<th>Pengadu</th>
						<th>Judul</th>
						<th>Jenis</th>
						<th>Foto</th>
						<th>status</th>
						<th>Aksi</th>

					</tr>

				</thead>
				<tbody>
					<?php
                        $no = 1;
						$sql = $koneksi->query("select a.id_pengaduan, a.judul, a.foto, a.status, j.jenis, p.nama_pengadu, p.no_hp
						from tb_pengaduan a join tb_jenis j on a.jenis=j.id_jenis
						join tb_pengadu p on a.author=p.id_pengadu where status='Diajukan'");
                        while ($data= $sql->fetch_assoc()) {
                    ?>
					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td>
							<?php echo $data['nama_pengadu']; ?>
							/
							<?php echo $data['no_hp']; ?>
						</td>
						<td>
							<?php echo $data['judul']; ?>
						</td>
						<td>
							<?php echo $data['jenis']; ?>
						</td>
						<td>
							<img src="foto/<?php echo $data['foto']; ?>" width="100px" />
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

							<a href="?page=aduan_kelola&kode=<?php echo $data['id_pengaduan']; ?>" title="Tanggapi"
							 class="btn btn-primary btn-sm">
								<i class="glyphicon glyphicon-check"></i>
							</a>

						</td>

					</tr>

					<?php
                        }
                    ?>
				</tbody>
		</div>
	</div>
</div>