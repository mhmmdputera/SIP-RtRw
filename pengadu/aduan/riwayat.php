<?php

if(isset($_GET['kode'])){
    $sql_cek = "SELECT ra.id_riwayat, ra.status, ra.tanggal, ra.tanggapan  
                FROM tb_riwayat ra
                JOIN tb_pengaduan a ON ra.id_pengaduan = a.id_pengaduan
                JOIN tb_jenis j ON a.jenis = j.id_jenis
                WHERE a.id_pengaduan='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
}

?>

<div class="panel panel-info">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-book"></i>
        <b>Riwayat Aduan</b>
    </div>
    <div class="panel-body">

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Tanggal Riwayat</th>
                        <th>Tanggapan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while($data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH)) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <?php 
                                $stt = $data_cek['status'];
                                if($stt == 'Diajukan'){ echo '<span class="label label-warning">Diajukan</span>'; }
                                elseif($stt == 'Periksa'){ echo '<span class="label label-success">Diperiksa</span>'; }
                                elseif($stt == 'Kembalikan'){ echo '<span class="label label-danger">Dikembalikan</span>'; }
                                elseif($stt == 'Proses'){ echo '<span class="label label-success">Diproses</span>'; }
                                elseif($stt == 'Tolak'){ echo '<span class="label label-danger">Ditolak</span>'; }
                                else{ echo '<span class="label label-finish">Selesai</span>'; }
                            ?>
                        </td>
                        <td><?php echo $data_cek['tanggal']; ?></td>
                        <td><?php echo $data_cek['tanggapan']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
