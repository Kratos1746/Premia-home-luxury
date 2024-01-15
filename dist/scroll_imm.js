var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;

    // Controlla la direzione dello scorrimento
    if (prevScrollpos > currentScrollPos ) {
        // Se si sta risalendo la pagina, mostra le barre
        document.getElementById('hamburger').classList.add('fixed');
        document.getElementById('Logo').classList.add('fixed');
        document.getElementById('nav-imm').classList.add('fixed');
        document.getElementById('menu-1024').classList.remove('hidden');
        document.getElementById('Logo-1024').classList.remove('hidden');

        document.getElementById('nav-1024-imm').classList.remove('hidden');
        document.getElementById('nav-imm').classList.remove('hidden');

        document.getElementById('menu-1024').classList.remove('mt-12');

        document.getElementById('nav-1024-imm').classList.add('p-4');
        document.getElementById('nav-imm').classList.add('bg-neutral-900'); 
        document.getElementById('nav-imm').classList.add('animate-dasopra2');

        document.getElementById('nav-1024-imm').classList.add('bg-neutral-900');
        document.getElementById('nav-1024-imm').classList.add('animate-dasopra2');
        

    } else if(currentScrollPos > 80) {
        // Altrimenti, nascondi le barre
        document.getElementById('hamburger').classList.remove('fixed');
        document.getElementById('Logo').classList.remove('fixed');   
        document.getElementById('nav-imm').classList.remove('fixed');   
        document.getElementById('menu-1024').classList.add('hidden');
        document.getElementById('Logo-1024').classList.add('hidden');

        document.getElementById('nav-1024-imm').classList.add('hidden');

        document.getElementById('nav-imm').classList.add('hidden')

        document.getElementById('nav-imm').classList.remove('bg-neutral-900');
        document.getElementById('nav-imm').classList.remove('animate-dasopra2');

        document.getElementById('nav-1024-imm').classList.remove('animate-dasopra2');
        document.getElementById('nav-1024-imm').classList.remove('bg-neutral-900');

   
    }

    if(currentScrollPos < 30){

        document.getElementById('nav-imm').classList.remove('bg-neutral-900');
        document.getElementById('nav-imm').classList.remove('animate-dasopra2');
        document.getElementById('nav-1024-imm').classList.remove('bg-neutral-900');
        document.getElementById('nav-1024-imm').classList.remove('animate-ritira');

    }

    prevScrollpos = currentScrollPos;
};
