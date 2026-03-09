<?php
session_start();

if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}

$usernameCookie = "";

if(isset($_COOKIE['calvin'])){
    $usernameCookie = $_COOKIE['calvin'];
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login - SI Exotic Market</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">

<div class="card shadow p-4" style="width:400px">

<h3 class="text-center mb-3">Login SI Exotic Market</h3>

<?php
if(isset($_GET['error'])){
echo '<div class="alert alert-danger">Username atau Password salah</div>';
}
?>

<form action="proses_login.php" method="POST">

<div class="mb-3">
<label class="form-label">Username</label>
<input type="text" name="username" class="form-control"
value="<?php echo $usernameCookie; ?>" required>
</div>

<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>

<div class="form-check mb-3">
<input type="checkbox" name="remember" class="form-check-input">
<label class="form-check-label">Remember Me</label>
</div>

<button class="btn btn-dark w-100" type="submit">
Login
</button>

</form>

</div>
</div>

</body>
</html>
