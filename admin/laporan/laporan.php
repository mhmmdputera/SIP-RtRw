<?php
$author = $data_id;


// Inisialisasi total laporan untuk filter
$totalLaporanFiltered = 0;

// Inisialisasi variabel filter
$jenis_id = isset($_POST['jenis']) ? $_POST['jenis'] : "";
$status = isset($_POST['status']) ? $_POST['status'] : "";
$tgl_1 = isset($_POST['tgl_1']) ? $_POST['tgl_1'] : "";
$tgl_2 = isset($_POST['tgl_2']) ? $_POST['tgl_2'] : "";

// Tampilkan hasil query (misalnya dalam tabel) hanya jika formulir sudah dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Buat query SQL untuk mengambil data sesuai dengan filter
    $query = "SELECT tb_pengaduan.*, tb_pengadu.Kelurahan, tb_pengadu.nama_pengadu, tb_jenis.jenis 
              FROM tb_pengaduan 
              INNER JOIN tb_pengadu ON tb_pengaduan.author = tb_pengadu.id_pengadu
              INNER JOIN tb_jenis ON tb_pengaduan.jenis = tb_jenis.id_jenis
              WHERE 1";

    $params = [];
    
    if (isset($_POST['Cetak'])) {
        // Redirect ke file cetak_laporan.php setelah filter terpenuhi
        header("Location: ?page=cetak&jenis_id=$jenis_id&status=$status&tgl_1=$tgl_1&tgl_2=$tgl_2");
        exit;
    }

    if (!empty($tgl_1) && !empty($tgl_2)) {
        $query .= " AND waktu_aduan BETWEEN STR_TO_DATE('$tgl_1', '%Y-%m-%d') AND STR_TO_DATE('$tgl_2', '%Y-%m-%d')";
        $params[] = $tgl_1;
        $params[] = $tgl_2;
    }

    if (!empty($jenis_id)) {
        $query .= " AND tb_jenis.id_jenis='$jenis_id'";
        $params[] = $jenis_id;
    }

    if (!empty($status)) {
        $query .= " AND status='$status'";
        $params[] = $status;
    }

    $hasil = mysqli_query($koneksi, $query);
    // $koneksi adalah koneksi ke database. Pastikan variabel ini sudah ada.

    // Hitung jumlah laporan yang sesuai dengan filter
    if ($hasil) {
        $totalLaporanFiltered = mysqli_num_rows($hasil);
    }

    // Tampilkan hasil query (misalnya dalam tabel)
    if ($hasil) {
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Judul Aduan</th>
                    <th>Jenis Aduan</th>
                    <th>Keterangan</th>
                    <th>Waktu Aduan</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                    <th>Kelurahan</th> <!-- Added -->
                    <th>Nama Pengadu</th> <!-- Added -->
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($hasil)) {
                    echo "<tr>";
                    echo "<td>" . $row['judul'] . "</td>";
                    echo "<td>" . $row['jenis'] . "</td>";
                    echo "<td>" . $row['keterangan'] . "</td>";
                    echo "<td>" . $row['waktu_aduan'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['tanggapan'] . "</td>";
                    echo "<td>" . $row['Kelurahan'] . "</td>"; // Added
                    echo "<td>" . $row['nama_pengadu'] . "</td>"; // Added
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "Query error: " . mysqli_error($koneksi);
    }

}


?>

<div class="panel panel-info">
    <div class="panel-heading">
        <i class="glyphicon glyphicon-print"></i>
        <b>Kelola Laporan</b>
    </div>
    <div class="panel-body">
        <p>Total Laporan: <?php echo $totalLaporanFiltered; ?></p>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="" enctype="multipart/form-data">
                    <!-- Form Filter -->
                    <div class="form-group">
                        <label>Jenis Aduan  - Opsional</label>
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
                        <label>Status Aduan - Opsional</label>
                        <select name="status" class="form-control">
                            <option value="">- Pilih -</option>
                            <option value="Diajukan">Diajukan</option>
                            <option value="Periksa">Diperiksa</option>
                            <option value="Kembalikan">Dikembalikan</option>
                            <option value="Proses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Tolak">Ditolak</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tgl Awal</label>
                        <input type="date" class="form-control" name="tgl_1" required/>
                    </div>

                    <div class="form-group">
                        <label>Tgl Akhir</label>
                        <input type="date" class="form-control" name="tgl_2" required/>
                    </div>

                    <!-- code grafik laporan -->

                    <div>
                        <input type="submit" name="Lihat" value="Lihat" class="btn btn-primary">
                        <input type="submit" name="Cetak" value="Cetak" class="btn btn-success" target="_blank">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
