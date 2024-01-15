
document.addEventListener('DOMContentLoaded', function() {
    // Controlla se l'animazione è già stata visualizzata utilizzando un cookie
    if (document.cookie.includes('loading_animation_shown=true')) {
        // Se è già stata visualizzata, nascondi l'overlay immediatamente
        document.getElementById('loading-overlay').style.display = 'none';
    } else {
        // Se l'animazione non è stata visualizzata, mostra l'overlay di caricamento
        setTimeout(function() {
          document.getElementById('loading-overlay').classList.add('animate-ritira2');
          document.getElementById('loading-spinner').classList.add('animate-ritira2');
            setTimeout(function() {
                document.getElementById('loading-overlay').style.display = 'none';
                // Imposta un cookie per indicare che l'animazione è stata visualizzata
                document.cookie = 'loading_animation_shown=true; path=/'; // Cookie valido per la sessione
            }, 500); // Dopo che l'animazione di dissolvenza è completa
        }, 2000); // Imposta la durata del caricamento simulato (2 secondi nell'esempio)
    }
  });