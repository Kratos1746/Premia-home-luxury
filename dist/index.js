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
        document.getElementById('nav').classList.remove('hidden'); 
        document.getElementById('menu-1024').classList.remove('mt-12');
        document.getElementById('nav-1024').classList.add('p-4');
        nav.classList.add('p-4');
        nav.classList.add('md:px-14');
        document.getElementById('nav').classList.add('bg-neutral-900');
       
        document.getElementById('nav').classList.add('animate-dasopra2');
        document.getElementById('nav-1024').classList.add('bg-neutral-900');
        document.getElementById('nav-1024').classList.add('py-8');
        document.getElementById('nav-1024').classList.add('animate-dasopra2');
        
      } else if(currentScrollPos>80) {
        // Altrimenti, nascondi la barra
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
      }
      if(currentScrollPos < 30){
        
        document.getElementById('nav').classList.remove('bg-neutral-900');
       
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

  function toggleLogin() {
    var button = document.getElementById('toggleLogin');
    var button2 = document.getElementById('Xmini2');
    var button3 = document.getElementById('Xmini3');
    var menu = document.getElementById('login');
    var buttonmini = document.getElementById('toggleLoginMini');
    var buttonmini2 = document.getElementById('toggleMini');
    var button2mini = document.getElementById('Xmini');
    var menumini = document.getElementById('loginMini');
    var menumini2 = document.getElementById('loginMini2');
   

    if (menu.classList.contains('hidden')) {
      // Se la barra è nascosta, mostra la barra e nascondi il bottone
      menu.classList.remove('hidden');
      button2.classList.remove('hidden');
      button3.classList.remove('hidden');
      menumini.classList.remove('hidden');
      menumini2.classList.remove('hidden');
      button2mini.classList.remove('hidden');
   
    
      
    } else {
      // Se la barra è visibile, nascondi la barra e mostra il bottone
      menu.classList.add('hidden');
      button2.classList.add('hidden');
      button.classList.remove('hidden');
      button3.classList.remove('hidden');
      buttonmini.classList.remove('hidden');
      buttonmini2.classList.remove('hidden');
      button2mini.classList.add('hidden');
      menumini.classList.add('hidden');
      menumini2.classList.add('hidden');
    
      
      
    }
  }

  setTimeout(function() {
    var messaggioDiv = document.getElementById('messaggio');
    if (messaggioDiv) {
        messaggioDiv.style.display = 'none';
    }
}, 3000);

function aggiungiImmobile() {
  // Reindirizza l'utente a new_imm.php quando il pulsante viene cliccato
  window.location.href = 'new_imm.php';
}



