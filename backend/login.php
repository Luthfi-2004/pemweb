<?php
session_start();
require './../config/db.php';

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($db_connect, $_POST['email']);
    $password = $_POST['password'];

    $user = mysqli_query($db_connect, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($user) > 0) {
        $data = mysqli_fetch_assoc($user);
        
        if (password_verify($password, $data['password'])) {
            // Otorisasi
            $_SESSION['name'] = $data['name'];
            $_SESSION['role'] = $data['role'];

            if ($_SESSION['role'] === 'admin') {
                header('Location: ./../create.php');
            } else {
                header('Location: ./../profile.php');
            }
            exit;
        } else {
            echo "Password salah";
            die;
        }
    } else {
        echo "Email atau password salah";
        die;
    }
}
?>