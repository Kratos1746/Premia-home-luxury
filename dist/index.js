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
        document.getElementById('nav-1024').classList.add('py-8');
        document.getElementById('nav-1024').classList.add('animate-dasopra2');

        // Aggiungi qui le stesse operazioni per la barra di navigazione mobile (se presente)
        // ...

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

        // Aggiungi qui le stesse operazioni per la barra di navigazione mobile (se presente)
        // ...
    }

    if(currentScrollPos < 30){
        document.getElementById('nav').classList.remove('bg-neutral-900');
        document.getElementById('nav').classList.remove('animate-dasopra2');
        document.getElementById('nav-1024').classList.remove('bg-neutral-900');
        nav.classList.remove('md:px-14');
        nav.classList.remove('p-4');

        // Aggiungi qui le stesse operazioni per la barra di navigazione mobile (se presente)
        // ...
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


$(document).ready(function() {
  // Richiesta API per ottenere l'elenco delle province italiane
  $.ajax({
      url: 'https://provinceitaliane.it/api-province',
      type: 'GET',
      success: function(data) {
          // Aggiungi le province al menu a tendina
          var select = $('#provincia');
          $.each(data, function(index, value) {
              select.append('<option value="' + value.sigla + '">' + value.nome + '</option>');
          });

          // Inizializza il menu a tendina con Select2
          select.select2();
      },
      error: function(error) {
          console.log('Errore nella richiesta API: ' + error.statusText);
      }
  });
});

function eliminaImm() {
  var conferma = confirm("Sei sicuro di voler eliminare questo immobile?");
  if (conferma) {
    
      
      // Utilizza AJAX per inviare una richiesta di eliminazione al server
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "/dist/elimina_immobile.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
          if (xhr.readyState == 4 && xhr.status == 200) {
              // Gestisci la risposta del server
              var response = xhr.responseText;
              if (response == "success") {
                  // Eliminazione avvenuta con successo
                  window.location.href = "/dist/immobili.php";
              } else {
                  // Gestisci altri scenari, ad esempio mostrando un messaggio di errore
                  alert("Errore durante l'eliminazione dell'immobile.");
              }
          }
      };
      xhr.send("id_immobile=" + id_immobile);
  }
}
