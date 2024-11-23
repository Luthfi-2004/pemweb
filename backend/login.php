<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Periksa email dan password yang valid
    if ($email == 'admin@admin.com' && $password == 'admin') {
        header('Location: ./../dashboard.php');
        exit(); 
    } else {
        echo "Email atau password salah";
    }
}
?>
