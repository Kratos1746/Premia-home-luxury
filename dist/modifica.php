<?php
session_start();
include './php/db_connection.php';

$errors = [];

// Funzione per eliminare le foto della galleria esistenti

// Ottieni i dettagli dell'immobile
if (isset($_GET['id'])) {
    $id_immobile = $_GET['id'];

    $query = "SELECT * FROM immobili WHERE id_immobile = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $id_immobile);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $immobile = $result->fetch_assoc();
        } else {
            echo "Immagine non trovata.";
        }

        $stmt->close();
    } else {
        echo "Errore nella preparazione della query: " . $conn->error;
    }
}

// Modifica dell'immobile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_immobile'])) {
        $id_immobile = $_POST['id_immobile'];

        // Altri campi del modulo
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
        $youtubeUrl = mysqli_real_escape_string($conn, $_POST['video']);
        $inEvidenza = isset($_POST['in_evidenza']) ? 1 : 0;
        // Altri campi del modulo

        // Caricamento foto principale
        if (isset($_FILES['foto_princ']) && $_FILES['foto_princ']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = './imgphp/';
            $uploadFile = $uploadDir . basename($_FILES['foto_princ']['name']);

            if (move_uploaded_file($_FILES['foto_princ']['tmp_name'], $uploadFile)) {
                $percorsoFotoPrincipale = $uploadFile;
            } else {
                $errors[] = "Errore durante il caricamento della foto principale.";
            }
        } else {
            $errors[] = "Foto principale non specificata o errore nel caricamento.";
        }

        // Caricamento galleria foto
        if (isset($_FILES['galleria_foto']) && is_array($_FILES['galleria_foto']['name'])) {
            $uploadDir = './imgphp/';
            $uploadedFiles = [];

            // Recupera le foto esistenti dalla galleria
            $galleriaFiles = json_decode($immobile['galleria_foto'], true);

            // Verifica se ci sono già foto nella galleria
            if (is_array($galleriaFiles)) {
                $uploadedFiles = $galleriaFiles;
            }

            foreach ($_FILES['galleria_foto']['name'] as $key => $fileName) {
                // Verifica se è stato effettuato l'upload senza errori
                if ($_FILES['galleria_foto']['error'][$key] === UPLOAD_ERR_OK) {
                    $uploadFile = $uploadDir . basename($fileName);

                    // Move_uploaded_file restituisce true se l'upload è avvenuto con successo
                    if (move_uploaded_file($_FILES['galleria_foto']['tmp_name'][$key], $uploadFile)) {
                        $uploadedFiles[] = $uploadFile;
                    } else {
                        $errors[] = "Errore durante il caricamento di una foto.";
                    }
                } else {
                    $errors[] = "Errore durante l'upload di una foto. Codice errore: " . $_FILES['galleria_foto']['error'][$key];
                }
            }

            // Ora $uploadedFiles contiene i percorsi delle immagini caricate con successo
            // Aggiorna il campo galleria_foto nel database
            $galleriaFilesJSON = json_encode($uploadedFiles);
        } else {
            $errors[] = "Nessuna foto specificata o errore nel caricamento.";
        }

      // Caricamento file PDF
if ($_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    $pdfFileName = $_FILES['pdf_file']['name'];
    $pdfTmpName = $_FILES['pdf_file']['tmp_name'];
    $pdfType = $_FILES['pdf_file']['type'];

    // Controlla se è un file PDF
    if ($pdfType === 'application/pdf') {
        // Leggi il contenuto del file PDF
        $pdfContent = file_get_contents($pdfTmpName);

        // Escapa il contenuto del file per evitare SQL injection
        $escapedContent = mysqli_real_escape_string($conn, $pdfContent);
    } else {
        $errors[] = "Il file caricato non è un PDF.";
    }
} else {
    // Se non è stato caricato un nuovo PDF, mantieni il valore esistente
    $escapedContent = $immobile['dati']; // Sostituisci con il nome del campo del tuo database
}

// Esegui la query di aggiornamento utilizzando un prepared statement
$query = "UPDATE immobili 
    SET titolo = ?, 
        descrizione = ?, 
        prezzo = ?, 
        tipo_immobile = ?, 
        tipo_vendita = ?, 
        vani = ?, 
        camere = ?, 
        bagni = ?, 
        provincia = ?, 
        comune = ?, 
        indirizzo = ?, 
        piani = ?, 
        giardino = ?, 
        balcone = ?, 
        classe_energetica = ?, 
        metri_quadrati = ?, 
        anno_costruzione = ?, 
        parcheggio = ?, 
        cucina = ?, 
        EPI = ?, 
        riscaldamento = ?, 
        soggiorno = ?, 
        condizioni = ?, 
        in_evidenza = ?, 
        foto_principale = ?,
        video = ?, 
        nome_file = ?, 
        tipo_contenuto = ?, 
        dati = ?,
        galleria_foto = ?
    WHERE id_immobile = ?";

$stmt = $conn->prepare($query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "ssdssiiisssisssdissssssissssbsi", 
        $titolo, $descrizione, $prezzo, $tipo_immobile, $tipo_vendita, $vani, $camere, 
        $bagni, $provincia, $comune, $indirizzo, $piani, $giardino, $balcone, 
        $classe_energetica, $metri_quadrati, $anno_costruzione, $parcheggio, $cucina, 
        $EPI, $riscaldamento, $soggiorno, $condizioni, $inEvidenza, $percorsoFotoPrincipale, 
        $youtubeUrl, $pdfFileName, $pdfType, $escapedContent, $galleriaFilesJSON, $id_immobile);
    
    $result = $stmt->execute();

    if ($result) {
        echo "Modifica effettuata con successo.";
        header("Location: /dist/dettaglio_immobile.php?id=$id_immobile");
    } else {
        echo "Errore nella modifica: " . $conn->error;
    }

    $stmt->close();
} else {
    // Gestisci gli errori nella preparazione della query
    echo "Errore nella preparazione della query di aggiornamento: " . $conn->error;
}}}
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" integrity="sha512-bUJ8tyLx1n5jjbkF8fL4gJBtuvq8xm6OSVfRnMa+MpDM5v8A1I6A2BRb1/ULXqfuk+G3GJZzsVmp1+3RkZCvLQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha512-oQvF5Rb3ZRZZc7zEBVdLzj/df4s80N67P5P8WP6HG5F4383tY6YqECV1N3z1uDLjOFC8D5lufoS6cKCbThRQbEw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js" integrity="sha512-omM7I9j2J8i3gsr3ZATvTQ7iaV+0x50Gf5kMEmlUmA/qpExMgtz55NRIteqHVwlJ/i5GOLAE6e7/OPh8/Zxblw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- FancyBox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <!-- Metatag e link CSS -->
    <title>Modifica Immobile</title>
</head>

<body class=" overflow-x-hidden bg-neutral-900 font-Grotesk">
    <h1 class="text-center font-Ayer text-6xl xl:text-8xl text-white py-8 uppercase tracking-wide">Modifica</h1>

    <?php
    // Mostra eventuali errori
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
    ?>
<div class="text-white flex flex-col justify-center items-center">
<form action="modifica.php" method="post" class="flex flex-col w-1/2 items-center" enctype="multipart/form-data">

        <div class="md:w-full p-4 ">
            <div class="mb-6 flex flex-col ">
            <input type="hidden" name="id_immobile" value="<?php echo $immobile['id_immobile']; ?>">

                <label for="titolo">Titolo:</label>
                <input type="text" name="titolo" placeholder="Titolo" value="<?php echo nl2br(str_replace('\r\n', "\r\n", str_replace("\\'", "'", $immobile['titolo']))); ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="descrizione">Descrizione:</label>
                <textarea name="descrizione" rows="8" placeholder="Descrizione"  required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2"><?php echo nl2br(str_replace('\r\n', "\r\n", str_replace("\\'", "'", $immobile['descrizione']))); ?>

</textarea>
            </div>
            <div class="flex flex-row gap-10">
            <div class="md:w-1/2  ">
            <div class="mb-6 flex flex-col">
                <label for="prezzo">Prezzo:</label>
                <input type="text" name="prezzo" placeholder="Prezzo" value="<?php echo $immobile['prezzo']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
            <label for="tipo_immobile">Tipo Immobile:</label>
            <input type="text" name="tipo_immobile" placeholder="Tipologia" value="<?php echo $immobile['tipo_immobile']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>

            <div class="mb-6 flex flex-col">
                <label for="tipo_vendita">Contratto:</label>
                <select name="tipo_vendita" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
    <option value="" disabled hidden>Seleziona il tipo</option>
    <option value="Vendita" <?php echo ($immobile['tipo_vendita'] == 'Vendita') ? 'selected' : ''; ?>>Vendita</option>
    <option value="Affitto" <?php echo ($immobile['tipo_vendita'] == 'Affitto') ? 'selected' : ''; ?>>Affitto</option>
    <option value="Vacanza" <?php echo ($immobile['tipo_vendita'] == 'Vacanza') ? 'selected' : ''; ?>>Vacanza</option>
</select>

            </div>
            <div class="mb-6 flex flex-col">
                <label for="vani">Vani:</label>
                <input type="text" name="vani" placeholder="Numero vani" value="<?php echo $immobile['vani']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col ">
                <label for="balcone">Balcone:</label>
                <input type="text" name="balcone"  placeholder="(Metri quadrati)" value="<?php echo $immobile['balcone']; ?>" class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" >
            </div>
            <div class="mb-6 flex flex-col">
                <label for="camere">Camere:</label>
                <input type="text" name="camere" placeholder="Numero Camere" value="<?php echo $immobile['camere']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="bagni">Bagni:</label>
                <input type="text" name="bagni" placeholder="Numero bagni" value="<?php echo $immobile['bagni']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="metri_quadrati">Metri quadrati:</label>
                <input type="text" name="metri_quadrati" placeholder="Metri quadrati" value="<?php echo $immobile['metri_quadrati']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Condizioni">Condizioni:</label>
                <input type="text" name="condizioni" placeholder="Condizioni" value="<?php echo $immobile['condizioni']; ?>"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Soggiorno">Soggiorno:</label>
                <input type="text" name="soggiorno" placeholder="Soggiorno" value="<?php echo $immobile['soggiorno']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="riscaldamento">Riscaldamento:</label>
                <input type="text" name="riscaldamento" placeholder="Riscaldamento" value="<?php echo $immobile['riscaldamento']; ?>"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="EPI">EPI:</label>
                <input type="text" name="EPI" placeholder="EPI" value="<?php echo $immobile['EPI']; ?>"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6">
            <label for="in_evidenza" class="block text-white text-sm font-medium mb-2">In evidenza</label>
            <input type="checkbox" id="in_evidenza" name="in_evidenza" class="ml-2" <?php echo $immobile['in_evidenza'] == 1 ? 'checked' : ''; ?>>

            
        </div>
            </div>

        <div class="md:w-1/2 ">
     
<div class="mb-6 flex flex-col">
    <label for="provincia">Provincia:</label>
    <select id="provincia" name="provincia" value="<?php echo $immobile['provincia']; ?>" class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" style="width: 100%;">
    <option value="" disabled hidden>Seleziona la provincia</option>
    <option value="Agrigento" <?php echo ($immobile['provincia'] == 'Agrigento') ? 'selected' : ''; ?>>Agrigento</option>
    <option value="Alessandria" <?php echo ($immobile['provincia'] == 'Alessandria') ? 'selected' : ''; ?>>Alessandria</option>
    <option value="Ancona" <?php echo ($immobile['provincia'] == 'Ancona') ? 'selected' : ''; ?>>Ancona</option>
    <option value="Aosta" <?php echo ($immobile['provincia'] == 'Aosta') ? 'selected' : ''; ?>>Aosta</option>
    <option value="Arezzo" <?php echo ($immobile['provincia'] == 'Arezzo') ? 'selected' : ''; ?>>Arezzo</option>
    <option value="Ascoli Piceno" <?php echo ($immobile['provincia'] == 'Ascoli Piceno') ? 'selected' : ''; ?>>Ascoli Piceno</option>
    <option value="Asti" <?php echo ($immobile['provincia'] == 'Asti') ? 'selected' : ''; ?>>Asti</option>
    <option value="Avellino" <?php echo ($immobile['provincia'] == 'Avellino') ? 'selected' : ''; ?>>Avellino</option>
    <option value="Bari" <?php echo ($immobile['provincia'] == 'Bari') ? 'selected' : ''; ?>>Bari</option>
    <option value="Barletta-Andria-Trani" <?php echo ($immobile['provincia'] == 'Barletta-Andria-Trani') ? 'selected' : ''; ?>>Barletta-Andria-Trani</option>
    <option value="Belluno" <?php echo ($immobile['provincia'] == 'Belluno') ? 'selected' : ''; ?>>Belluno</option>
    <option value="Benevento" <?php echo ($immobile['provincia'] == 'Benevento') ? 'selected' : ''; ?>>Benevento</option>
    <option value="Bergamo" <?php echo ($immobile['provincia'] == 'Bergamo') ? 'selected' : ''; ?>>Bergamo</option>
    <option value="Biella" <?php echo ($immobile['provincia'] == 'Biella') ? 'selected' : ''; ?>>Biella</option>
    <option value="Bologna" <?php echo ($immobile['provincia'] == 'Bologna') ? 'selected' : ''; ?>>Bologna</option>
    <option value="Bolzano" <?php echo ($immobile['provincia'] == 'Bolzano') ? 'selected' : ''; ?>>Bolzano</option>
    <option value="Brescia" <?php echo ($immobile['provincia'] == 'Brescia') ? 'selected' : ''; ?>>Brescia</option>
    <option value="Brindisi" <?php echo ($immobile['provincia'] == 'Brindisi') ? 'selected' : ''; ?>>Brindisi</option>
    <option value="Cagliari" <?php echo ($immobile['provincia'] == 'Cagliari') ? 'selected' : ''; ?>>Cagliari</option>
    <option value="Caltanissetta" <?php echo ($immobile['provincia'] == 'Caltanissetta') ? 'selected' : ''; ?>>Caltanissetta</option>
    <option value="Campobasso" <?php echo ($immobile['provincia'] == 'Campobasso') ? 'selected' : ''; ?>>Campobasso</option>
    <option value="Carbonia-Iglesias" <?php echo ($immobile['provincia'] == 'Carbonia-Iglesias') ? 'selected' : ''; ?>>Carbonia-Iglesias</option>
    <option value="Caserta" <?php echo ($immobile['provincia'] == 'Caserta') ? 'selected' : ''; ?>>Caserta</option>
    <option value="Catania" <?php echo ($immobile['provincia'] == 'Catania') ? 'selected' : ''; ?>>Catania</option>
    <option value="Catanzaro" <?php echo ($immobile['provincia'] == 'Catanzaro') ? 'selected' : ''; ?>>Catanzaro</option>
    <option value="Chieti" <?php echo ($immobile['provincia'] == 'Chieti') ? 'selected' : ''; ?>>Chieti</option>
    <option value="Como" <?php echo ($immobile['provincia'] == 'Como') ? 'selected' : ''; ?>>Como</option>
    <option value="Cosenza" <?php echo ($immobile['provincia'] == 'Cosenza') ? 'selected' : ''; ?>>Cosenza</option>
    <option value="Cremona" <?php echo ($immobile['provincia'] == 'Cremona') ? 'selected' : ''; ?>>Cremona</option>
    <option value="Crotone" <?php echo ($immobile['provincia'] == 'Crotone') ? 'selected' : ''; ?>>Crotone</option>
    <option value="Cuneo" <?php echo ($immobile['provincia'] == 'Cuneo') ? 'selected' : ''; ?>>Cuneo</option>
    <option value="Enna" <?php echo ($immobile['provincia'] == 'Enna') ? 'selected' : ''; ?>>Enna</option>
    <option value="Fermo" <?php echo ($immobile['provincia'] == 'Fermo') ? 'selected' : ''; ?>>Fermo</option>
    <option value="Ferrara" <?php echo ($immobile['provincia'] == 'Ferrara') ? 'selected' : ''; ?>>Ferrara</option>
    <option value="Firenze" <?php echo ($immobile['provincia'] == 'Firenze') ? 'selected' : ''; ?>>Firenze</option>
    <option value="Foggia" <?php echo ($immobile['provincia'] == 'Foggia') ? 'selected' : ''; ?>>Foggia</option>
    <option value="Forlì-Cesena" <?php echo ($immobile['provincia'] == 'Forlì-Cesena') ? 'selected' : ''; ?>>Forlì-Cesena</option>
    <option value="Frosinone" <?php echo ($immobile['provincia'] == 'Frosinone') ? 'selected' : ''; ?>>Frosinone</option>
    <option value="Genova" <?php echo ($immobile['provincia'] == 'Genova') ? 'selected' : ''; ?>>Genova</option>
    <option value="Gorizia" <?php echo ($immobile['provincia'] == 'Gorizia') ? 'selected' : ''; ?>>Gorizia</option>
    <option value="Grosseto" <?php echo ($immobile['provincia'] == 'Grosseto') ? 'selected' : ''; ?>>Grosseto</option>
    <option value="Imperia" <?php echo ($immobile['provincia'] == 'Imperia') ? 'selected' : ''; ?>>Imperia</option>
    <option value="Isernia" <?php echo ($immobile['provincia'] == 'Isernia') ? 'selected' : ''; ?>>Isernia</option>
    <option value="La Spezia" <?php echo ($immobile['provincia'] == 'La Spezia') ? 'selected' : ''; ?>>La Spezia</option>
    <option value="Latina" <?php echo ($immobile['provincia'] == 'Latina') ? 'selected' : ''; ?>>Latina</option>
    <option value="Lecce" <?php echo ($immobile['provincia'] == 'Lecce') ? 'selected' : ''; ?>>Lecce</option>
    <option value="Lecco" <?php echo ($immobile['provincia'] == 'Lecco') ? 'selected' : ''; ?>>Lecco</option>
    <option value="Livorno" <?php echo ($immobile['provincia'] == 'Livorno') ? 'selected' : ''; ?>>Livorno</option>
    <option value="Lodi" <?php echo ($immobile['provincia'] == 'Lodi') ? 'selected' : ''; ?>>Lodi</option>
    <option value="Lucca" <?php echo ($immobile['provincia'] == 'Lucca') ? 'selected' : ''; ?>>Lucca</option>
    <option value="Macerata" <?php echo ($immobile['provincia'] == 'Macerata') ? 'selected' : ''; ?>>Macerata</option>
    <option value="Mantova" <?php echo ($immobile['provincia'] == 'Mantova') ? 'selected' : ''; ?>>Mantova</option>
    <option value="Massa-Carrara" <?php echo ($immobile['provincia'] == 'Massa-Carrara') ? 'selected' : ''; ?>>Massa-Carrara</option>
    <option value="Matera" <?php echo ($immobile['provincia'] == 'Matera') ? 'selected' : ''; ?>>Matera</option>
    <option value="Messina" <?php echo ($immobile['provincia'] == 'Messina') ? 'selected' : ''; ?>>Messina</option>
    <option value="Milano" <?php echo ($immobile['provincia'] == 'Milano') ? 'selected' : ''; ?>>Milano</option>
    <option value="Modena" <?php echo ($immobile['provincia'] == 'Modena') ? 'selected' : ''; ?>>Modena</option>
    <option value="Monza e della Brianza" <?php echo ($immobile['provincia'] == 'Monza e della Brianza') ? 'selected' : ''; ?>>Monza e della Brianza</option>
    <option value="Napoli" <?php echo ($immobile['provincia'] == 'Napoli') ? 'selected' : ''; ?>>Napoli</option>
    <option value="Novara" <?php echo ($immobile['provincia'] == 'Novara') ? 'selected' : ''; ?>>Novara</option>
    <option value="Nuoro" <?php echo ($immobile['provincia'] == 'Nuoro') ? 'selected' : ''; ?>>Nuoro</option>
    <option value="Ogliastra" <?php echo ($immobile['provincia'] == 'Ogliastra') ? 'selected' : ''; ?>>Ogliastra</option>
    <option value="Olbia-Tempio" <?php echo ($immobile['provincia'] == 'Olbia-Tempio') ? 'selected' : ''; ?>>Olbia-Tempio</option>
    <option value="Oristano" <?php echo ($immobile['provincia'] == 'Oristano') ? 'selected' : ''; ?>>Oristano</option>
    <option value="Padova" <?php echo ($immobile['provincia'] == 'Padova') ? 'selected' : ''; ?>>Padova</option>
    <option value="Palermo" <?php echo ($immobile['provincia'] == 'Palermo') ? 'selected' : ''; ?>>Palermo</option>
    <option value="Parma" <?php echo ($immobile['provincia'] == 'Parma') ? 'selected' : ''; ?>>Parma</option>
    <option value="Pavia" <?php echo ($immobile['provincia'] == 'Pavia') ? 'selected' : ''; ?>>Pavia</option>
    <option value="Perugia" <?php echo ($immobile['provincia'] == 'Perugia') ? 'selected' : ''; ?>>Perugia</option>
        <option value="Pesaro e Urbino" <?php echo ($immobile['provincia'] == 'Pesaro e Urbino') ? 'selected' : ''; ?>>Pesaro e Urbino</option>
        <option value="Pescara" <?php echo ($immobile['provincia'] == 'Pescara') ? 'selected' : ''; ?>>Pescara</option>
        <option value="Piacenza" <?php echo ($immobile['provincia'] == 'Piacenza') ? 'selected' : ''; ?>>Piacenza</option>
        <option value="Pisa" <?php echo ($immobile['provincia'] == 'Pisa') ? 'selected' : ''; ?>>Pisa</option>
        <option value="Pistoia" <?php echo ($immobile['provincia'] == 'Pistoia') ? 'selected' : ''; ?>>Pistoia</option>
        <option value="Pordenone" <?php echo ($immobile['provincia'] == 'Pordenone') ? 'selected' : ''; ?>>Pordenone</option>
        <option value="Potenza" <?php echo ($immobile['provincia'] == 'Potenza') ? 'selected' : ''; ?>>Potenza</option>
        <option value="Prato" <?php echo ($immobile['provincia'] == 'Prato') ? 'selected' : ''; ?>>Prato</option>
        <option value="Ragusa" <?php echo ($immobile['provincia'] == 'Ragusa') ? 'selected' : ''; ?>>Ragusa</option>
        <option value="Ravenna" <?php echo ($immobile['provincia'] == 'Ravenna') ? 'selected' : ''; ?>>Ravenna</option>
        <option value="Reggio Calabria" <?php echo ($immobile['provincia'] == 'Reggio Calabria') ? 'selected' : ''; ?>>Reggio Calabria</option>
        <option value="Reggio Emilia" <?php echo ($immobile['provincia'] == 'Reggio Emilia') ? 'selected' : ''; ?>>Reggio Emilia</option>
        <option value="Rieti" <?php echo ($immobile['provincia'] == 'Rieti') ? 'selected' : ''; ?>>Rieti</option>
        <option value="Rimini" <?php echo ($immobile['provincia'] == 'Rimini') ? 'selected' : ''; ?>>Rimini</option>
        <option value="Roma" <?php echo ($immobile['provincia'] == 'Roma') ? 'selected' : ''; ?>>Roma</option>
        <option value="Rovigo" <?php echo ($immobile['provincia'] == 'Rovigo') ? 'selected' : ''; ?>>Rovigo</option>
        <option value="Salerno" <?php echo ($immobile['provincia'] == 'Salerno') ? 'selected' : ''; ?>>Salerno</option>
        <option value="Medio Campidano" <?php echo ($immobile['provincia'] == 'Medio Campidano') ? 'selected' : ''; ?>>Medio Campidano</option>
        <option value="Sassari" <?php echo ($immobile['provincia'] == 'Sassari') ? 'selected' : ''; ?>>Sassari</option>
        <option value="Savona" <?php echo ($immobile['provincia'] == 'Savona') ? 'selected' : ''; ?>>Savona</option>
        <option value="Siena" <?php echo ($immobile['provincia'] == 'Siena') ? 'selected' : ''; ?>>Siena</option>
        <option value="Siracusa" <?php echo ($immobile['provincia'] == 'Siracusa') ? 'selected' : ''; ?>>Siracusa</option>
        <option value="Sondrio" <?php echo ($immobile['provincia'] == 'Sondrio') ? 'selected' : ''; ?>>Sondrio</option>
        <option value="Taranto" <?php echo ($immobile['provincia'] == 'Taranto') ? 'selected' : ''; ?>>Taranto</option>
        <option value="Teramo" <?php echo ($immobile['provincia'] == 'Teramo') ? 'selected' : ''; ?>>Teramo</option>
        <option value="Terni" <?php echo ($immobile['provincia'] == 'Terni') ? 'selected' : ''; ?>>Terni</option>
        <option value="Torino" <?php echo ($immobile['provincia'] == 'Torino') ? 'selected' : ''; ?>>Torino</option>
        <option value="Trapani" <?php echo ($immobile['provincia'] == 'Trapani') ? 'selected' : ''; ?>>Trapani</option>
        <option value="Trento" <?php echo ($immobile['provincia'] == 'Trento') ? 'selected' : ''; ?>>Trento</option>
        <option value="Treviso" <?php echo ($immobile['provincia'] == 'Treviso') ? 'selected' : ''; ?>>Treviso</option>
        <option value="Trieste" <?php echo ($immobile['provincia'] == 'Trieste') ? 'selected' : ''; ?>>Trieste</option>
        <option value="Udine" <?php echo ($immobile['provincia'] == 'Udine') ? 'selected' : ''; ?>>Udine</option>
        <option value="Varese" <?php echo ($immobile['provincia'] == 'Varese') ? 'selected' : ''; ?>>Varese</option>
        <option value="Venezia" <?php echo ($immobile['provincia'] == 'Venezia') ? 'selected' : ''; ?>>Venezia</option>
        <option value="Verbano-Cusio-Ossola" <?php echo ($immobile['provincia'] == 'Verbano-Cusio-Ossola') ? 'selected' : ''; ?>>Verbano-Cusio-Ossola</option>
        <option value="Vercelli" <?php echo ($immobile['provincia'] == 'Vercelli') ? 'selected' : ''; ?>>Vercelli</option>
        <option value="Verona" <?php echo ($immobile['provincia'] == 'Verona') ? 'selected' : ''; ?>>Verona</option>
        <option value="Vibo Valentia" <?php echo ($immobile['provincia'] == 'Vibo Valentia') ? 'selected' : ''; ?>>Vibo Valentia</option>
        <option value="Vicenza" <?php echo ($immobile['provincia'] == 'Vicenza') ? 'selected' : ''; ?>>Vicenza</option>
        <option value="Viterbo" <?php echo ($immobile['provincia'] == 'Viterbo') ? 'selected' : ''; ?>>Viterbo</option>
</select>

</div>




            <div class="mb-6 flex flex-col">
                <label for="comune">Comune:</label>
                <input type="text" name="comune" placeholder="Comune" value="<?php echo $immobile['comune']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="indirizzo">Indirizzo:</label>
                <input type="text" name="indirizzo" placeholder="Indirizzo" value="<?php echo $immobile['indirizzo']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="piani">Piani:</label>
                <input type="text" name="piani" placeholder="Piani totali" value="<?php echo $immobile['piani']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col ">
                <label for="giardino">Giardino:</label>
                <input type="text" name="giardino"  placeholder="(Metri quadrati)" value="<?php echo $immobile['giardino']; ?>"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" >
            </div>
            
            <div class="mb-6 flex flex-col">
                <label for="classe_energetica">Classe Energetica:</label>
                <input type="text" name="classe_energetica" placeholder="Classe energetica" value="<?php echo $immobile['classe_energetica']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Cucina">Cucina:</label>
                <input type="text" name="cucina" placeholder="Cucina" value="<?php echo $immobile['cucina']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Parcheggio">Parcheggio:</label>
                <input type="text" name="parcheggio" placeholder="Parcheggio" value="<?php echo $immobile['parcheggio']; ?>"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="Anno di costruzione">Anno di costruzione:</label>
                <input type="text" name="anno_costruzione" placeholder="Anno di costruzione" value="<?php echo $immobile['anno_costruzione']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
                <label for="foto_princ">Foto anteprima:</label>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 lg:gap-4 gap-3 mt-3">
                <a data-fancybox="single" href="<?php echo $immobile['foto_principale']; ?>">
            <img src="<?php echo $immobile['foto_principale']; ?>" alt="Anteprima" class="w-full h-28 mb-3 object-cover rounded-lg ">
        </a></div>
                <input type="file" name="foto_princ" accept="image/*" placeholder="Foto anteprima"   class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
            <label for="galleria_foto">Seleziona le foto:</label>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 lg:gap-4 gap-3 mt-3">
          <?php  
          $galleriaFiles = json_decode($immobile['galleria_foto'], true);
          if (is_array($galleriaFiles)) {
                        foreach ($galleriaFiles as $index => $foto) {
                            echo '<a data-fancybox="gallery" href="' . $foto . '">';
                            echo '<img src="' . $foto . '" alt="Anteprima" width="100" class=" mb-3 w-full h-28 object-cover rounded-lg">';
                            echo '</a>';
                        }
                    }?></div>
            <input type="file" id="galleria_foto" name="galleria_foto[]" multiple accept="image/*"  class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
         </div>
            <div class="mb-6 flex flex-col">
                <label for="video">URL del Video (YouTube):</label>
                <input type="text" name="video" placeholder="Inserisci l'URL del video di YouTube" value="<?php echo $immobile['video']; ?>" required class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2">
            </div>
            <div class="mb-6 flex flex-col">
            <label for="pdf" class="block text-white text-sm font-medium mb-2">PDF:</label>
            <input type="file" name="pdf_file" accept=".pdf" placeholder="Inserisci PDF" class="border border-white bg-neutral-800 rounded-md py-3 text-white px-2" >
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
</body>
</html>





