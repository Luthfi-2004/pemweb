<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link ke CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Produk</h1>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Gambar Produk</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require 'config/db.php';

                    $products = mysqli_query($db_connect,"SELECT * FROM products");
                    $no = 1;

                    while($row = mysqli_fetch_assoc($products)) {
                ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$row['name'];?></td>
                        <td><?=$row['price'];?></td>
                        <td><a href="download.php?filename=<?=$row['image'];?>" target="_blank">Unduh</a></td>
                        <td>
                            <a href="edit.php?id=<?=$row['id'];?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete.php?id=<?=$row['id'];?>" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Link ke JS Bootstrap dan jQuery (opsional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>