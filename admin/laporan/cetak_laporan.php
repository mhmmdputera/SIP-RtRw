<?php
// Pastikan Anda telah memasukkan logic koneksi ke database di sini
include "inc/koneksi.php";

// Set filter dari $_GET
$jenis_id = isset($_GET['jenis_id']) ? $_GET['jenis_id'] : "";
$status = isset($_GET['status']) ? $_GET['status'] : "";
$tgl_1 = isset($_GET['tgl_1']) ? $_GET['tgl_1'] : "";
$tgl_2 = isset($_GET['tgl_2']) ? $_GET['tgl_2'] : "";

// Buat query untuk mengambil data sesuai dengan filter
$query = "SELECT tb_pengaduan.*, tb_pengadu.Kelurahan, tb_pengadu.nama_pengadu, tb_jenis.jenis 
          FROM tb_pengaduan 
          INNER JOIN tb_pengadu ON tb_pengaduan.author = tb_pengadu.id_pengadu
          INNER JOIN tb_jenis ON tb_pengaduan.jenis = tb_jenis.id_jenis
          WHERE 1";

// Tambahkan kondisi filter ke dalam query
if (!empty($tgl_1) && !empty($tgl_2)) {
    $query .= " AND waktu_aduan BETWEEN STR_TO_DATE(?, '%Y-%m-%d') AND STR_TO_DATE(?, '%Y-%m-%d')";
    $params[] = $tgl_1;
    $params[] = $tgl_2;
}

if (!empty($jenis_id)) {
    $query .= " AND tb_jenis.id_jenis=?";
    $params[] = $jenis_id;
}

if (!empty($status)) {
    $query .= " AND status=?";
    $params[] = $status;
}

// Prepare statement dan bind parameter untuk menghindari SQL Injection
$stmt = mysqli_prepare($koneksi, $query);
if ($stmt === false) {
    die("Query preparation failed: " . mysqli_error($koneksi));
}

if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
}

$execute = mysqli_stmt_execute($stmt);
if ($execute === false) {
    die("Query execution failed: " . mysqli_error($koneksi));
}

$result = mysqli_stmt_get_result($stmt);

// Buat laporan PDF dengan mPDF
// Buat laporan PDF dengan mPDF
require_once(__DIR__ . '/../../vendor/autoload.php');

// Buat laporan PDF
$mpdf = new \Mpdf\Mpdf();

// Konten PDF tanpa campuran dengan tampilan website
$konten_pdf = '
    <style>
        /* CSS */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }

        .kop-surat {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1; 
        }

        table {
            /* Gaya tabel Anda */
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th  {
            background-color: #ccc;
        }
    </style>

    <div class="container">
        <div class="header">
            <img class="kop-surat" src="assets/img/kop-surat.png" alt="Deskripsi Foto">
        </div>
    </div>
        <table border="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul Aduan</th>
                    <th>Jenis Aduan</th>
                    <th>Keterangan</th>
                    <th>Waktu Aduan</th>
                    <th>Status</th>
                    <th>Tanggapan</th>
                    <th>Kelurahan</th>
                    <th>Nama Pengadu</th>
                </tr>
            </thead>
            <tbody>';

// Nomor urut awal
$number = 1;

while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $konten_pdf .= "<tr>";
    $konten_pdf .= "<td>" . $number . "</td>";
    $konten_pdf .= "<td>" . $row['judul'] . "</td>";
    $konten_pdf .= "<td>" . $row['jenis'] . "</td>";
    $konten_pdf .= "<td>" . $row['keterangan'] . "</td>";
    $konten_pdf .= "<td>" . $row['waktu_aduan'] . "</td>";
    $konten_pdf .= "<td>" . $row['status'] . "</td>";
    $konten_pdf .= "<td>" . $row['tanggapan'] . "</td>";
    $konten_pdf .= "<td>" . $row['Kelurahan'] . "</td>";
    $konten_pdf .= "<td>" . $row['nama_pengadu'] . "</td>";
    $konten_pdf .= "</tr>";
    $number++;
}

// Tambahkan baris jumlah total aduan di akhir tabel
$todayDate = date("d F Y");
$konten_pdf .= '
        <tr>
            <td colspan="9" style="text-align: right;"><b>Total Aduan:</b> ' . ($number - 1) . '</td>
        </tr>
    </tbody>
</table>
<style>
    .tanda-tangan {
        float: right;
        width: 35%;
        margin-top: 50px;
        text-align: left;            
    }
</style>
<div class="tanda-tangan">
    <div>Banjarbaru, ' . $todayDate . '</div>
    <div>yang bertanda tangan</div><br><br><br><br>
    <div>Pak Camat</div>
</div>
';

ob_get_clean();
// Mulai penangkapan output
ob_start();

// Output website di sini, termasuk header, navigasi, dan konten

// Mengambil output yang ditangkap
$website_content = ob_get_clean();

// Gabungkan konten website dengan konten PDF
$full_content = $website_content . $konten_pdf;

// Tuliskan konten gabungan ke mPDF
$mpdf->WriteHTML($full_content);


$mpdf->Output();
?>
