<?php
require 'config/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = mysqli_query($db_connect, "SELECT * FROM products WHERE id = '$id'");
    $data = mysqli_fetch_assoc($product);
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];
        
        // Update produk
        mysqli_query($db_connect, "UPDATE products SET name = '$name', price = '$price' WHERE id = '$id'");
        header('Location: show.php'); // Redirect setelah update
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Produk</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" name="name" id="name" class="form-control" value="<?=$data['name'];?>" required>
            </div>
            <div class="form-group">
                <label for="price">Harga Produk</label>
                <input type="number" name="price" id="price" class="form-control" value="<?=$data['price'];?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>