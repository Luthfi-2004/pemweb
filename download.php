<?php
require 'config/db.php';

if (isset($_GET['filename'])) {
    $filename = basename($_GET['filename']); // Ambil nama file
    $filePath = __DIR__ . 'upload/' . $filename; // Path lengkap ke file

    if (file_exists($filePath)) {
        // Set header untuk mengunduh file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath); // Baca file dan kirim ke output
        exit;
    } else {
        echo "<div class='alert alert-danger'>File tidak ditemukan.</div>";
    }
} else {
    echo "<div class='alert alert-danger'>Tidak ada file yang dipilih untuk diunduh.</div>";
}
?>