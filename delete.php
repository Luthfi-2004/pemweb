<?php
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Hapus produk
    mysqli_query($db_connect, "DELETE FROM products WHERE id = '$id'");
    header('Location: show.php'); // Redirect setelah hapus
    exit;
}
?>