<?php
session_start();
include './php/db_connection.php';

// Verifica se l'utente è autenticato
if (!isset($_SESSION['ID'])) {
    header("Location: login.php");
    exit();
}

// Inizializza variabili di errore
$errors = array();

// Gestione del submit del modulo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera i dati dal modulo
    $titolo = mysqli_real_escape_string($conn, $_POST['titolo']);
    $prezzo = mysqli_real_escape_string($conn, $_POST['prezzo']);
    $tipo_immobile = mysqli_real_escape_string($conn, $_POST['tipo_immobile']);
    $tipo_vendita = mysqli_real_escape_string($conn, $_POST['tipo_vendita']);
    $vani = mysqli_real_escape_string($conn, $_POST['vani']);
    $camere = mysqli_real_escape_string($conn, $_POST['camere']);
    $bagni = mysqli_real_escape_string($conn, $_POST['bagni']);
    $provincia = mysqli_real_escape_string($conn, $_POST['provincia']);
    $comune = mysqli_real_escape_string($conn, $_POST['comune']);
    $indirizzo = mysqli_real_escape_string($conn, $_POST['indirizzo']);
    $piani = mysqli_real_escape_string($conn, $_POST['piani']);
    $giardino = mysqli_real_escape_string($conn, isset($_POST['giardino']) );
    $balcone = mysqli_real_escape_string($conn, isset($_POST['balcone']) );
    $classe_energetica = mysqli_real_escape_string($conn, $_POST['classe_energetica']);
    $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);
    $metri_quadrati = mysqli_real_escape_string($conn, $_POST['metri_quadrati']);
    $anno_costruzione = mysqli_real_escape_string($conn, $_POST['anno_costruzione']);
    $parcheggio = mysqli_real_escape_string($conn, $_POST['parcheggio']);
    $cucina = mysqli_real_escape_string($conn, $_POST['cucina']);
    $EPI = mysqli_real_escape_string($conn, $_POST['EPI']);
    $riscaldamento = mysqli_real_escape_string($conn, $_POST['riscaldamento']);
    $soggiorno = mysqli_real_escape_string($conn, $_POST['soggiorno']);
    $condizioni = mysqli_real_escape_string($conn, $_POST['condizioni']);
    $inEvidenza = isset($_POST['in_evidenza']) ? 1 : 0;

    // Verifica se il campo 'foto_princ' è stato definito nell'array $_FILES
    if (isset($_FILES['foto_princ']) && $_FILES['foto_princ']['error'] === UPLOAD_ERR_OK) {
        // Gestione dell'upload della foto principale
        $uploadDir = './imgphp/';
        $uploadFile = $uploadDir . basename($_FILES['foto_princ']['name']);

        if (move_uploaded_file($_FILES['foto_princ']['tmp_name'], $uploadFile)) {
            // File caricato con successo, ora puoi memorizzare il percorso nel database o fare altre operazioni necessarie
            $percorsoFotoPrincipale = $uploadFile;
        } else {
            $errors[] = "Errore durante il caricamento della foto principale.";
        }
    } else {
        // L'array $_FILES['foto_princ'] non è impostato o non ci sono file caricati
        $errors[] = "Foto principale non specificata o errore nel caricamento.";
    }

    // Verifica se il campo 'galleria_foto' è stato definito nell'array $_FILES
    if (isset($_FILES['galleria_foto']) && !empty($_FILES['galleria_foto']['name'][0])) {
        // Gestione dell'upload delle immagini della galleria
        $uploadDirGalleria = '/dist/imgphp/';
        $galleriaFiles = array();

        foreach ($_FILES['galleria_foto']['tmp_name'] as $key => $tmp_name) {
            $galleriaFile = $uploadDirGalleria . '/' . basename($_FILES['galleria_foto']['name'][$key]);

            if (move_uploaded_file($tmp_name, $galleriaFile)) {
                $galleriaFiles[] = $galleriaFile;
            } else {
                $errors[] = "Errore durante il caricamento di una foto della galleria.";
            }
        }
    } else {
        // L'array $_FILES['galleria_foto'] non è impostato o non ci sono file caricati
        $errors[] = "Galleria foto non specificata o errore nel caricamento.";
    }

// Verifica se è stato effettuato il submit del modulo

    // Controlla se il file è stato caricato correttamente
    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        // Directory di destinazione per i video caricati
        $uploadDir = '/dist/video/';
        // Crea la directory se non esiste
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Genera un nome univoco per il file
        $videoFileName = uniqid('video_', true) . '.' . pathinfo($_FILES['video']['name'], PATHINFO_EXTENSION);

        // Percorso completo del file
        $videoFilePath = $uploadDir . $videoFileName;

        // Sposta il file dalla directory temporanea a quella di destinazione
        move_uploaded_file($_FILES['video']['tmp_name'], $videoFilePath);

        // Ora puoi salvare il percorso del file nel tuo database
        // Assicurati di utilizzare le funzioni di sicurezza per evitare attacchi SQL injection
        $videoUrl = '/video/' . $videoFileName;

        // Salva $videoUrl nel tuo database
        // ...

        // Esegui altre operazioni necessarie
        // ...

        echo 'Il video è stato caricato con successo.';
    } else {
        echo 'Si è verificato un errore durante il caricamento del video.';
    }

  




    // Inserisci i dati nel database solo se non ci sono errori nell'upload dell'immagine
    if (empty($errors)) {
        // Creazione della stringa JSON per la galleria
        $galleriaFilesJSON = json_encode($galleriaFiles);

        // Query per l'inserimento nel database
        $query = "INSERT INTO immobili (titolo, prezzo, tipo_immobile, tipo_vendita, vani, camere, bagni, provincia, comune, indirizzo, piani, giardino, balcone, classe_energetica, descrizione, metri_quadrati, foto_principale, galleria_foto, video, anno_costruzione, parcheggio, cucina, EPI, riscaldamento, soggiorno, condizioni, in_evidenza) 
                  VALUES ('$titolo', '$prezzo', '$tipo_immobile', '$tipo_vendita', '$vani', '$camere', '$bagni', '$provincia', '$comune', '$indirizzo', '$piani', '$giardino', '$balcone', '$classe_energetica', '$descrizione', '$metri_quadrati', '$percorsoFotoPrincipale', '$galleriaFilesJSON', '$videoUrl', '$anno_costruzione', '$parcheggio', '$cucina', '$EPI', '$riscaldamento', '$soggiorno', '$condizioni', '$in_evidenza')";

        $result = mysqli_query($conn, $query);

 

        // Funzione per ottenere le coordinate da Nominatim
        function getCoordinates($address) {
            $formattedAddress = urlencode($address);
            $nominatimUrl = "https://nominatim.openstreetmap.org/search?format=json&q=$formattedAddress";
        
            $response = file_get_contents($nominatimUrl);
        
            if ($response !== false) {
                $data = json_decode($response, true);
        
                if (!empty($data)) {
                    // Restituisci le coordinate della prima corrispondenza trovata
                    return [
                        'latitude' => $data[0]['lat'],
                        'longitude' => $data[0]['lon']
                    ];
                }
            }
        
            return null;
        }
        
        // Esempio di utilizzo
        $via = $row['indirizzo'];
        $citta = $row['comune'];
        
        $indirizzoCompleto = "$via, $citta";
        
        $coordinate = getCoordinates($indirizzoCompleto);
        
        if ($coordinate !== null) {
            $latitudine = $coordinate['latitude'];
            $longitudine = $coordinate['longitude'];
        
            // Ora puoi utilizzare $latitudine e $longitudine come necessario
            echo "Latitudine: $latitudine, Longitudine: $longitudine";
        } else {
            echo "Errore durante la richiesta di geocoding.";
        }
        

        if ($result) {
            // Inserimento riuscito, reindirizza a una pagina di conferma o altro
            header("Location: immobili.php");
            exit();
        } else {
            // Gestisci errori nell'inserimento
            $errors[] = "Errore nell'inserimento dell'immobile: " . mysqli_error($conn);
        }
    }
} 
?>

<!DOCTYPE html>
<html lang="it">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">


  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="output.css" rel="stylesheet">
  <link href = "/dist/font/style.css" rel = "stylesheet" type = "text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk&display=swap" rel="stylesheet">


    <title>Nuovo Immobile</title>
</head>

<body class=" overflow-x-hidden bg-neutral-900 font-Grotesk">
    <h1 class="text-center font-Ayer text-6xl xl:text-8xl text-white py-8 uppercase tracking-wide">Nuovo Immobile</h1>

    <?php
    // Mostra eventuali errori
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
    ?>
<div class="text-white flex flex-col justify-center items-center">
<form action="new_imm.php" method="post" class="flex flex-col w-1/2 items-center" enctype="multipart/form-data">

        <div class="md:w-full p-4 ">
            <div class="mb-6 flex flex-col ">
                <label for="titolo">Titolo:</label>
                <input type="text" name="titolo" placeholder="Titolo" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="descrizione">Descrizione:</label>
                <textarea name="descrizione" rows="8" placeholder="Descrizione" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2"></textarea>
            </div>
            <div class="flex flex-row gap-10">
            <div class="md:w-1/2  ">
            <div class="mb-6 flex flex-col">
                <label for="prezzo">Prezzo:</label>
                <input type="text" name="prezzo" placeholder="Prezzo" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
            <label for="tipo_immobile">Tipo Immobile:</label>
            <select name="tipo_immobile" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            <option value="" disabled selected hidden>Seleziona il tipo</option>
                <option value="casa">Casa</option>
                <option value="appartamento">Appartamento</option>
                <option value="villa">Villa</option>
        
            </select>
        </div>

            <div class="mb-6 flex flex-col">
                <label for="tipo_vendita">Contratto:</label>
                <select name="tipo_vendita" placeholder="Contratto" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
                <option value="" disabled selected hidden>Seleziona il tipo</option>
                <option value="Vendita">Vendita</option>
                <option value="Affitto">Affitto</option>
                <option value="Vacanza">Vacanza</option>
        
            </select>
            </div>
            <div class="mb-6 flex flex-col">
                <label for="vani">Vani:</label>
                <input type="text" name="vani" placeholder="Numero vani" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col ">
                <label for="balcone">Balcone:</label>
                <input type="text" name="balcone"  placeholder="(Metri quadrati)" class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" >
            </div>
            <div class="mb-6 flex flex-col">
                <label for="camere">Camere:</label>
                <input type="text" name="camere" placeholder="Numero Camere" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="bagni">Bagni:</label>
                <input type="text" name="bagni" placeholder="Numero bagni" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="metri_quadrati">Metri quadrati:</label>
                <input type="text" name="metri_quadrati" placeholder="Metri quadrati" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Condizioni">Condizioni:</label>
                <input type="text" name="condizioni" placeholder="Condizioni"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Soggiorno">Soggiorno:</label>
                <input type="text" name="soggiorno" placeholder="Soggiorno" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="riscaldamento">Riscaldamento:</label>
                <input type="text" name="riscaldamento" placeholder="Riscaldamento"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="EPI">EPI:</label>
                <input type="text" name="EPI" placeholder="EPI"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            </div>

        <div class="md:w-1/2 ">
            <div class="mb-6 flex flex-col ">
                <label for="provincia">Provincia:</label>
                <input type="text" name="provincia" placeholder="Provincia" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="comune">Comune:</label>
                <input type="text" name="comune" placeholder="Comune" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="indirizzo">Indirizzo:</label>
                <input type="text" name="indirizzo" placeholder="Indirizzo" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="piani">Piani:</label>
                <input type="text" name="piani" placeholder="Piani totali" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col ">
                <label for="giardino">Giardino:</label>
                <input type="text" name="giardino"  placeholder="(Metri quadrati)"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" >
            </div>
            
            <div class="mb-6 flex flex-col">
                <label for="classe_energetica">Classe Energetica:</label>
                <input type="text" name="classe_energetica" placeholder="Classe energetica" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Cucina">Cucina:</label>
                <input type="text" name="cucina" placeholder="Cucina" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Parcheggio">Parcheggio:</label>
                <input type="text" name="parcheggio" placeholder="Parcheggio"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Anno di costruzione">Anno di costruzione:</label>
                <input type="text" name="anno_costruzione" placeholder="Anno di costruzione" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="foto_princ">Foto anteprima:</label>
                <input type="file" name="foto_princ" accept="image/*" placeholder="Foto anteprima" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="galleria_foto">Galleria Foto:</label>
                <input type="file" name="galleria_foto[]" accept="image/*" multiple placeholder="Foto" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
           <div class="mb-6 flex flex-col">
                <label for="video">Video:</label>
                <input type="file" name="video" accept="video/*" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6">
            <label for="in_evidenza" class="block text-white text-sm font-medium mb-2">In evidenza</label>
            <input type="checkbox" id="in_evidenza" name="in_evidenza" class="ml-2">
            
        </div>

            
        </div>
        </div>
        
       <!--     
            <div class="mb-6 flex flex-col">
                <label for="mappa">Mappa:</label>
                <input type="text" name="mappa" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>-->
            </div>
            </div>

         <input type="submit" value="Inserisci Immobile" class="bg-white text-black font-medium text-lg py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
 
       </form>    
      
</div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
      AOS.init();
  </script>
  
<script src="index.js"></script>

</body>

</html>
