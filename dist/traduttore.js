var itaActive = false;
var engActive = false;

function translateSiteToIta() {
    // Verifica lo stato attuale
    if (!itaActive) {
        // Attiva lo stato Ita
        itaActive = true;
        engActive = false;

        // Stampa le variabili di stato nella console
        console.log('itaActive:', itaActive);
        console.log('engActive:', engActive);

        // Aggiungi il codice per gestire l'attivazione di Ita
        // Ad esempio, cambia il colore del pulsante, esegui la traduzione, ecc.

        // Esempio: Cambia il colore del pulsante
        document.getElementById("translateButtonIt").classList.add('text-orange-300');
        document.getElementById("translateButtonIt").classList.add('underline');
        document.getElementById("translateButtonIt").classList.add('underline-offset-4');
        document.getElementById("translateButtonEng").classList.remove('text-orange-300');
        document.getElementById("translateButtonEng").classList.remove('underline');
        document.getElementById("translateButtonEng").classList.remove('underline-offset-4');
    }
}

function translateSiteToEng() {
    // Verifica lo stato attuale
    if (!engActive) {
        // Attiva lo stato Eng
        engActive = true;
        itaActive = false;

        // Stampa le variabili di stato nella console
        console.log('itaActive:', itaActive);
        console.log('engActive:', engActive);

        // Aggiungi il codice per gestire l'attivazione di Eng
        // Ad esempio, cambia il colore del pulsante, esegui la traduzione, ecc.

        // Esempio: Cambia il colore del pulsante
        document.getElementById("translateButtonIt").classList.remove('text-orange-300');
        document.getElementById("translateButtonIt").classList.remove('underline');
        document.getElementById("translateButtonIt").classList.remove('underline-offset-4');
        document.getElementById("translateButtonEng").classList.add('text-orange-300');
        document.getElementById("translateButtonEng").classList.add('underline');
        document.getElementById("translateButtonEng").classList.add('underline-offset-4');
    }
}
// Salva lo stato Ita e Eng nei cookie
function saveStateToCookies() {
    document.cookie = "itaActive=" + itaActive;
    document.cookie = "engActive=" + engActive;
}

// Carica lo stato Ita e Eng dai cookie
function loadStateFromCookies() {
    var cookies = document.cookie.split(';');
    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i].trim().split('=');
        if (cookie[0] === 'itaActive') {
            itaActive = cookie[1] === 'true';
        } else if (cookie[0] === 'engActive') {
            engActive = cookie[1] === 'true';
        }
    }
}
