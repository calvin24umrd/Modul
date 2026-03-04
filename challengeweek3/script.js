/* DARK MODE */
const btnTheme = document.getElementById('btn-theme');

if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
    btnTheme.innerText = "Mode Terang";
}

btnTheme.addEventListener('click', function () {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
        btnTheme.innerText = "Mode Terang";
    } else {
        localStorage.removeItem('theme');
        btnTheme.innerText = "Mode Gelap";
    }
});

/* BELI */
document.querySelectorAll('.btn-detail').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        let card = e.target.closest('.card-body');
        let stokText = card.querySelector('.stok-text');
        let stok = parseInt(stokText.innerText.replace("Stok: ", ""));

        if (stok > 0) {
            stok--;
            stokText.innerText = "Stok: " + stok;
            alert("Berhasil membeli " + card.querySelector('.card-title').innerText);
        } else {
            alert("Stok Habis!");
            btn.disabled = true;
        }
    });
});

/* WISHLIST */
let wishlist = [];

function updateWishlistCount() {
    document.getElementById('wishlist-count').innerText = wishlist.length;
}

function tampilkanWishlist() {
    let daftar = document.getElementById('daftar-wishlist');
    daftar.innerHTML = "";

    wishlist.forEach(function (item) {
        daftar.innerHTML += `<li class="list-group-item">${item}</li>`;
    });
}

function hapusWishlist() {
    wishlist = [];
    updateWishlistCount();
    tampilkanWishlist();
}

document.querySelectorAll('.btn-wishlist').forEach(function (btn) {
    btn.addEventListener('click', function (e) {
        let nama = e.target.closest('.card-body')
                           .querySelector('.card-title').innerText;

        wishlist.push(nama);
        updateWishlistCount();
        alert(nama + " ditambahkan ke Wishlist");
    });
});