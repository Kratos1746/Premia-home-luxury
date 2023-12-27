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
    $id_immobile = mysqli_real_escape_string($conn, $_POST['id_immobile']);
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
    $giardino = mysqli_real_escape_string($conn, isset($_POST['giardino']) ? $_POST['giardino'] : 0);
    $balcone = mysqli_real_escape_string($conn, isset($_POST['balcone']) ? $_POST['balcone'] : 0);
    $classe_energetica = mysqli_real_escape_string($conn, $_POST['classe_energetica']);
    $descrizione = mysqli_real_escape_string($conn, $_POST['descrizione']);
    $metri_quadrati = mysqli_real_escape_string($conn, $_POST['metri_quadrati']);
    $galleria_foto = mysqli_real_escape_string($conn, $_POST['galleria_foto']);
    $video = mysqli_real_escape_string($conn, $_POST['video']);
    $mappa = mysqli_real_escape_string($conn, $_POST['mappa']);

    // Esegui la validazione dei campi (puoi aggiungere ulteriori verifiche a seconda dei tuoi requisiti)

    // Inserisci i dati nel database
    $uploadDir = "uploads/"; // La directory dove salvare le immagini
    $uploadFile = $uploadDir . basename($_FILES['foto_principale']['name']);

    if (move_uploaded_file($_FILES['foto_principale']['tmp_name'], $uploadFile)) {
        // Inserisci il percorso dell'immagine nel database
        $foto_principale = mysqli_real_escape_string($conn, $uploadFile);
    } else {
        // Gestisci errori nell'upload dell'immagine
        $errors[] = "Errore nell'upload dell'immagine.";
    }

    // Inserisci i dati nel database solo se non ci sono errori nell'upload dell'immagine
    if (empty($errors)) {
        $query = "INSERT INTO immobili (id_immobile, titolo, prezzo, tipo_immobile, tipo_vendita, vani, camere, bagni, provincia, comune, indirizzo, piani, giardino, balcone, classe_energetica, descrizione, metri_quadrati, galleria_foto, video, mappa, foto_principale) 
                  VALUES ('$id_immobile', '$titolo', '$prezzo', '$tipo_immobile', '$tipo_vendita', '$vani', '$camere', '$bagni', '$provincia', '$comune', '$indirizzo', '$piani', '$giardino', '$balcone', '$classe_energetica', '$descrizione', '$metri_quadrati', '$galleria_foto', '$video', '$mappa', '$foto_principale')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            // Inserimento riuscito, reindirizza a una pagina di conferma o altro
            header("Location: conferma_inserimento.php");
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

    <title>Nuovo Immobile</title>
</head>

<body class=" overflow-x-hidden bg-neutral-900">
    <h1>Nuovo Immobile</h1>

    <?php
    // Mostra eventuali errori
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
    ?>
<div class="text-white flex flex-col justify-center items-center">
    <form action="new_imm.php" method="post" class="flex flex-col md:flex-row w-1/2 gap-10 items-center">
        <!-- Prima colonna -->
        <div class="md:w-1/2 p-4">
            <div class="mb-6 flex flex-col">
                <label for="titolo">Titolo:</label>
                <input type="text" name="titolo" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="prezzo">Prezzo:</label>
                <input type="text" name="prezzo" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="tipo_immobile">Tipo Immobile:</label>
                <input type="text" name="tipo_immobile" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="tipo_vendita">Tipo Vendita:</label>
                <input type="text" name="tipo_vendita" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="vani">Vani:</label>
                <input type="text" name="vani" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="camere">Camere:</label>
                <input type="text" name="camere" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="bagni">Bagni:</label>
                <input type="text" name="bagni" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="metri_quadrati">Metri Quadrati:</label>
                <input type="text" name="metri_quadrati" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="foto_princ">Foto principale:</label>
                <input type="text" name="foto_princ" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="galleria_foto">Galleria Foto:</label>
                <input type="text" name="galleria_foto" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
        </div>

        <!-- Seconda colonna -->
        <div class="md:w-1/2 p-4">
            <div class="mb-6 flex flex-col ">
                <label for="provincia">Provincia:</label>
                <input type="text" name="provincia" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="comune">Comune:</label>
                <input type="text" name="comune" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="indirizzo">Indirizzo:</label>
                <input type="text" name="indirizzo" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="piani">Piani:</label>
                <input type="text" name="piani" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="giardino">Giardino:</label>
                <input type="checkbox" name="giardino" value="1">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="balcone">Balcone:</label>
                <input type="checkbox" name="balcone" value="1">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="classe_energetica">Classe Energetica:</label>
                <input type="text" name="classe_energetica" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="descrizione">Descrizione:</label>
                <textarea name="descrizione" rows="4" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2"></textarea>
            </div>
        
        
            <div class="mb-6 flex flex-col">
                <label for="video">Video:</label>
                <input type="text" name="video" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="mappa">Mappa:</label>
                <input type="text" name="mappa" required class="border border-white bg-neutral-800 rounded-md py-2 text-white px-2">
            </div>
            </div>

        <!-- Pulsante Submit -->
       </form>    
       <input type="submit" value="Inserisci Immobile" class="bg-white text-black font-medium text-lg py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
 
</div>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
      AOS.init();
  </script>
  
<script src="index.js"></script>

</body>

</html>
