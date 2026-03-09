<?php
session_start();

if(!isset($_SESSION['login'])){
header("Location: login.php");
exit;
}
?>

<!DOCTYPE html>

<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SI Exotic Market</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
<div class="container">

<a class="navbar-brand fw-bold" href="#">SI EXOTIC MARKET</a>

<div class="ms-auto d-flex gap-2">

<button class="btn btn-outline-light btn-sm"
data-bs-toggle="modal"
data-bs-target="#wishlistModal"
onclick="tampilkanWishlist()">
Wishlist (<span id="wishlist-count">0</span>) </button>

<a href="logout.php" class="btn btn-danger btn-sm">
Logout
</a>

<button id="btn-theme" class="btn btn-outline-warning btn-sm">
Mode Gelap
</button>

</div>
</div>
</nav>

<header class="hero-section text-white d-flex align-items-center justify-content-center text-center">
<div>
<h1 class="display-4 fw-bold">Manajemen Hewan Eksotis</h1>
<p>Kelola data reptil, amfibi, burung, dan mamalia eksotis dengan aman dan mudah.</p>
</div>
</header>

<section class="container mt-5">

<h2 class="mb-4">Katalog Hewan Eksotis</h2>

<div class="row g-4">

<div class="col-md-4">
<div class="card h-100">
<img src="assets/green-iguana2.jpg" class="card-img-top">
<div class="card-body">

<h5 class="card-title">Iguana Hijau (Green Iguana)</h5>

<p class="text-danger fw-bold">Rp 850.000</p>

<p class="stok text-muted">Stok: 15 ekor</p>

<div class="mt-2">
<button class="btn btn-warning btn-beli">Beli</button>
<button class="btn btn-danger btn-wishlist">Wishlist</button>
</div>

</div>
</div>
</div>

<div class="col-md-4">
<div class="card h-100">
<img src="assets/jenis-sugar-glider-1-Sugar-Glider-Daily.jpg" class="card-img-top">

<div class="card-body">

<h5 class="card-title">Sugar Glider Classic Grey</h5>

<p class="text-danger fw-bold">Rp 450.000</p>

<p class="stok text-muted">Stok: 8 ekor</p>

<div class="mt-2">
<button class="btn btn-warning btn-beli">Beli</button>
<button class="btn btn-danger btn-wishlist">Wishlist</button>
</div>

</div>
</div>
</div>

<div class="col-md-4">
<div class="card h-100">

<img src="assets/Barn_Owl,_Lancashire.jpg" class="card-img-top">

<div class="card-body">

<h5 class="card-title">Barn Owl (Burung Hantu)</h5>

<p class="text-danger fw-bold">Rp 1.200.000</p>

<p class="stok text-muted">Stok: 3 ekor</p>

<div class="mt-2">
<button class="btn btn-warning btn-beli">Beli</button>
<button class="btn btn-danger btn-wishlist">Wishlist</button>
</div>

</div>
</div>
</div>

</div>
</section>

<footer class="bg-dark text-white text-center py-3 mt-5">
© 2026 Sistem Manajemen Hewan Eksotis
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="script.js"></script>

</body>
</html>
