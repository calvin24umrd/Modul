<?php
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

/* USER SEDERHANA (HARDCODE UNTUK LATIHAN) */
$user_valid = "admin";
$pass_valid = "12345";

if ($username === $user_valid && $password === $pass_valid) {

    $_SESSION["user"] = $username;

    /* REMEMBER ME */
    if (isset($_POST["remember"])) {
        setcookie("username", $username, time() + (86400 * 7), "/"); // 7 hari
    }

    header("Location: ../index.php");
    exit;

} else {
    echo "<script>
        alert('Username atau Password salah!');
        window.location='../login.php';
    </script>";
}
?>