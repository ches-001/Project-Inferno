
let docElem = document.documentElement;
let body  = document.body;
let nav = document.getElementById('MainNav');
let header = document.getElementById('header');
function toggleNav() {
    let Height = Math.max(body.scrollHeight,body.offsetHeight,docElem.clientHeight,docElem.offsetHeight,docElem.scrollHeight);
    if (window.pageYOffset>15){
        nav.classList.add('navFixed');
    }
    else{
        nav.classList.remove('navFixed');
    }
}

window.addEventListener('scroll', function () {
    return toggleNav();
});
