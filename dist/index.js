

  

 

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
      document.getElementById('nav').classList.add('py-16');
      document.getElementById('nav').classList.add('bg-neutral-900');
      
      
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


  function toggleUser() {
    var button = document.getElementById('toggleUser');
    var button2 = document.getElementById('Xuser2');
    var button3 = document.getElementById('Xuser3');
    var menu = document.getElementById('userInfo');
    var buttonmini = document.getElementById('toggleUserMini');
    var buttonmini2 = document.getElementById('toggleUserMini2');
    var button2mini = document.getElementById('Xuser');
    var menumini = document.getElementById('userInfoMini');
    var menumini2 = document.getElementById('userInfoMini2');
   

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

function mostraPoliticaPrivacy() {
  document.getElementById('privacy-box').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

// Funzione per chiudere il riquadro della Politica sulla Privacy
function chiudiPoliticaPrivacy() {
  document.getElementById('privacy-box').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
  document.removeEventListener('click', chiudiPoliticaPrivacyEsterno);

}

function chiudiPoliticaPrivacyEsterno(event) {
  if (!document.getElementById('privacy-box').contains(event.target)) {
      chiudiPoliticaPrivacy();
  }
}

// Funzione per nascondere il banner e il fondo semitrasparente e salvare lo stato del consenso nei cookie
function accettaCookie() {
  document.getElementById('cookie-banner').style.display = 'none';
  document.getElementById('overlay').style.display = 'none';
  setCookie('cookie_consent', 'true', 365); // Imposta il cookie di consenso per 365 giorni
}

// Funzione per impostare un cookie
function setCookie(name, value, days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + value + expires + "; path=/";
}

// Verifica se il consenso è già stato dato, se no, mostra il banner e il fondo semitrasparente
if (!document.cookie.includes('cookie_consent=true')) {
  document.getElementById('cookie-banner').style.display = 'block';
  document.getElementById('overlay').style.display = 'block';
}

