var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
var currentScrollPos = window.pageYOffset;

// Controlla la direzione dello scorrimento
if (prevScrollpos > currentScrollPos ) {
    // Se si sta risalendo la pagina, mostra le barre
    document.getElementById('hamburger').classList.add('fixed');
    document.getElementById('Logo').classList.add('fixed');
    document.getElementById('nav').classList.add('fixed');
    document.getElementById('menu-1024').classList.remove('hidden');
    document.getElementById('Logo-1024').classList.remove('hidden');
    document.getElementById('nav-1024').classList.remove('hidden');
    document.getElementById('nav').classList.remove('hidden'); 
    document.getElementById('menu-1024').classList.remove('mt-12');
    document.getElementById('nav-1024').classList.add('p-4');
    nav.classList.add('p-4');
    nav.classList.add('md:px-14');
    document.getElementById('nav').classList.add('bg-neutral-900'); 
    document.getElementById('nav').classList.add('animate-dasopra2');
    document.getElementById('nav-1024').classList.add('bg-neutral-900');
    document.getElementById('nav-1024').classList.add('py-16');
    document.getElementById('nav-1024').classList.add('animate-dasopra2');
    

} else if(currentScrollPos > 80) {
    // Altrimenti, nascondi le barre
    document.getElementById('hamburger').classList.remove('fixed');
    document.getElementById('Logo').classList.remove('fixed');
    document.getElementById('nav').classList.remove('fixed');    
    document.getElementById('menu-1024').classList.add('hidden');
    document.getElementById('Logo-1024').classList.add('hidden');
    document.getElementById('nav-1024').classList.add('hidden');
    document.getElementById('nav').classList.add('hidden'); 
    nav.classList.remove('p-4');
    nav.classList.remove('md:px-14');
    document.getElementById('nav').classList.remove('bg-neutral-900');
    document.getElementById('nav').classList.remove('animate-dasopra2');
    document.getElementById('nav-1024').classList.remove('animate-dasopra2');
    document.getElementById('nav-1024').classList.remove('bg-neutral-900');
    document.getElementById('nav').classList.add('py-16');

}

if(currentScrollPos < 30){
    document.getElementById('nav').classList.remove('bg-neutral-900');
    document.getElementById('nav').classList.remove('animate-dasopra2');
    document.getElementById('nav-1024').classList.remove('bg-neutral-900');
    document.getElementById('nav-1024').classList.remove('animate-ritira');
    nav.classList.remove('md:px-14');
    nav.classList.remove('p-4');
    document.getElementById('nav').classList.remove('py-16');

}

prevScrollpos = currentScrollPos;
};
