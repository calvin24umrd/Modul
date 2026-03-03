/* =====================
   MODE GELAP
===================== */

const btnTheme = document.getElementById('btn-theme');

if(localStorage.getItem('theme') === 'dark'){
    document.body.classList.add('dark-mode');
    btnTheme.innerText = "Mode Terang";
}

btnTheme.addEventListener('click', function(){
    document.body.classList.toggle('dark-mode');

    if(document.body.classList.contains('dark-mode')){
        localStorage.setItem('theme','dark');
        btnTheme.innerText = "Mode Terang";
    } else {
        localStorage.removeItem('theme');
        btnTheme.innerText = "Mode Gelap";
    }
});


/* =====================
   BELI
===================== */

document.querySelectorAll('.btn-beli').forEach(function(btn){
    btn.addEventListener('click', function(){

        let card = btn.closest('.card');
        let stokElement = card.querySelector('.stok');
        let stok = parseInt(stokElement.innerText.match(/\d+/)[0]);

        if(stok > 0){
            stok--;
            stokElement.innerText = "Stok: " + stok + " ekor";
            alert("Pembelian berhasil!");
        } else {
            alert("Stok habis!");
            btn.disabled = true;
        }
    });
});


/* =====================
   WISHLIST
===================== */

let wishlist = [];

function updateWishlistCount(){
    document.getElementById('wishlist-count').innerText = wishlist.length;
}

function tampilkanWishlist(){
    let daftar = document.getElementById('daftar-wishlist');
    daftar.innerHTML = "";

    wishlist.forEach(function(item){
        daftar.innerHTML += `<li class="list-group-item">${item}</li>`;
    });
}

function hapusWishlist(){
    wishlist = [];
    updateWishlistCount();
    tampilkanWishlist();
}

document.querySelectorAll('.btn-wishlist').forEach(function(btn){
    btn.addEventListener('click', function(){
        let nama = btn.closest('.card').querySelector('.card-title').innerText;
        wishlist.push(nama);
        updateWishlistCount();
        alert(nama + " ditambahkan ke wishlist");
    });
});