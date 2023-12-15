var prevScrollpos = window.pageYOffset;
    window.onscroll = function() {
      var currentScrollPos = window.pageYOffset;

      // Controlla la direzione dello scorrimento
      if (prevScrollpos > currentScrollPos ) {
        // Se si sta risalendo la pagina, mostra la barra
        document.getElementById('hamburger').classList.add('fixed');
        document.getElementById('Logo').classList.add('fixed');
        document.getElementById('nav').classList.add('fixed');
        document.getElementById('menu-1024').classList.remove('hidden');
        document.getElementById('Logo-1024').classList.remove('hidden');
        document.getElementById('nav-1024').classList.remove('hidden');
        document.getElementById('menu-1024').classList.remove('mt-12');
        document.getElementById('nav-1024').classList.add('p-4');
        nav.classList.add('p-4');
        nav.classList.add('md:px-14');
        document.getElementById('nav').classList.add('bg-neutral-900');
        document.getElementById('nav').classList.add('py-16');
        document.getElementById('nav').classList.add('animate-dasopra2');
        document.getElementById('nav-1024').classList.add('bg-neutral-900');
        document.getElementById('nav-1024').classList.add('py-8');
        document.getElementById('nav-1024').classList.add('animate-dasopra2');
      } else if(currentScrollPos>100) {
        // Altrimenti, nascondi la barra
        document.getElementById('hamburger').classList.remove('fixed');
        document.getElementById('Logo').classList.remove('fixed');
        document.getElementById('nav').classList.remove('fixed');    
        document.getElementById('menu-1024').classList.add('hidden');
        document.getElementById('Logo-1024').classList.add('hidden');
        document.getElementById('nav-1024').classList.add('hidden');
        
        
        nav.classList.remove('p-4');
        nav.classList.remove('md:px-14');
        document.getElementById('nav').classList.remove('bg-neutral-900');
        document.getElementById('nav').classList.remove('py-16');
        document.getElementById('nav').classList.remove('animate-dasopra2');
        document.getElementById('nav-1024').classList.remove('animate-dasopra2');
      }
      if(currentScrollPos < 30){
        
        document.getElementById('nav').classList.remove('bg-neutral-900');
        document.getElementById('nav').classList.remove('py-16');
        document.getElementById('nav').classList.remove('animate-dasopra2');
        document.getElementById('nav-1024').classList.remove('bg-neutral-900');
        nav.classList.remove('md:px-14');
        nav.classList.remove('p-4');
        

      }

  
      prevScrollpos = currentScrollPos;
    };

  function toggleMenu() {
    var button = document.getElementById('hamburger');
    var button2 = document.getElementById('X');
    var menu = document.getElementById('menu');
    var logo = document.getElementById('Logo');
    var nav = document.getElementById('nav');

    if (menu.classList.contains('hidden')) {
      // Se la barra è nascosta, mostra la barra e nascondi il bottone
      menu.classList.remove('hidden');
      button2.classList.remove('hidden');
      button.classList.add('hidden');
      logo.classList.add('hidden');
      nav.classList.remove('p-4');
      nav.classList.remove('md:px-14');
      document.getElementById('nav').classList.remove('bg-neutral-900');
      document.getElementById('nav').classList.remove('py-16');
      
    } else {
      // Se la barra è visibile, nascondi la barra e mostra il bottone
      menu.classList.add('hidden');
      button2.classList.add('hidden');
      button.classList.remove('hidden');
      logo.classList.remove('hidden');
      nav.classList.add('p-4');
      nav.classList.add('md:px-14');
      
      
    }
  }