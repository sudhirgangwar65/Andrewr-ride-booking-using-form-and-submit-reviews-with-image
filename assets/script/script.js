// For Header
window.addEventListener('scroll', function() {
    var scrollPosition = window.scrollY;
    var header = document.getElementById('header');

    if (scrollPosition > 150) {
    header.classList.add('scrolled');
    } else {
    header.classList.remove('scrolled');
    }
});
// For Header


// Toogle Navigation
const menubutton = document.getElementById('menubutton');
const header = document.getElementById('header');
menubutton.addEventListener('click' , function(){
    document.body.classList.toggle('overflow-hidden');
    header.classList.toggle('navopened');
});
// Toogle Navigation
