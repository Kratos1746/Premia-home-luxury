<?php
session_start();
include './php/db_connection.php';


if (isset($_GET['id'])) {
    $id_immobile = $_GET['id'];

    $query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

      
        
            // Query per estrarre il ruolo dalla tabella users
            $query_ruolo = "SELECT * FROM users ";
            $result_ruolo = mysqli_query($conn, $query_ruolo);
        
            // Se la query ha successo
            if ($result_ruolo) {
                $row_ruolo = mysqli_fetch_assoc($result_ruolo);

                    if (isset($_SESSION['ID'])) {
        
                      $row_ruolo['ID'] = $_SESSION['ID']  ;
                       $row_ruolo['Email'] = $_SESSION['Email'] ; 
                       $row_ruolo['ruolo'] = $_SESSION['ruolo']  ;  
                    }}
        // Verifica se è stata inviata una richiesta di modifica o eliminazione
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['edit'])) {
                // Codice per la modifica dell'immobile
                $id_immobile = $_POST['id_immobile'];
                $nuovi_dati = [
                    'titolo' => $_POST['titolo'],
                    'prezzo' => $_POST['prezzo'],
                    // Aggiungi altri campi che desideri modificare...
                ];
        
                // Esegui la logica di aggiornamento dei dati nel database
                $update_query = "UPDATE immobili SET ";
                foreach ($nuovi_dati as $campo => $valore) {
                    $update_query .= "$campo = '$valore', ";
                }
                // Rimuovi l'ultima virgola e aggiungi la condizione WHERE
                $update_query = rtrim($update_query, ", ") . " WHERE id_immobile = $id_immobile";
        
                $result = mysqli_query($conn, $update_query);
                if ($result) {
                    // Redirect alla pagina dettaglio_immobile.php dopo l'aggiornamento
                    header("Location: /dist/dettaglio_immobile.php?id=$id_immobile");
                    exit();
                } else {
                    echo "Errore nell'aggiornamento dell'immobile: " . mysqli_error($conn);
                }
            } elseif (isset($_POST['delete'])) {
                // Codice per l'eliminazione dell'immobile
                $id_immobile = $_POST['id_immobile'];
            
                // Utilizza un prepared statement per evitare SQL injection
                $delete_query = "DELETE FROM immobili WHERE id_immobile = ?";
                $stmt = mysqli_prepare($conn, $delete_query);
            
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $id_immobile);
                    mysqli_stmt_execute($stmt);
            
                    // Verifica se l'eliminazione ha avuto successo
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        // Redirect alla pagina degli immobili dopo l'eliminazione
                        header("Location: /dist/immobili.php");
                        exit();
                    } else {
                        echo "L'immobile con ID $id_immobile non è stato trovato.";
                    }
            
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Errore nella preparazione della query di eliminazione: " . mysqli_error($conn);
                }
            }
            
        } 
        include 'traduci.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
<!-- FOR MORE PROJECTS visit: codeastro.com -->
<!-- Required meta tags -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Meta Tags -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="shortcut icon" href="images/favicon.ico">



  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Unna&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&display=swap" rel="stylesheet">
  <link href = "/dist/font/style.css" rel = "stylesheet" type = "text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- FancyBox -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<link href="output.css" rel="stylesheet">



</head>

<body class="overflow-x-hidden font-Grotesk">
<div class="bg-neutral-900 min-h-screen flex flex-col">
    <nav id="nav-1024-imm" class="max-lg:hidden z-50 pt-4 fixed w-full">
        <div class="flex items-center justify-between">
            <div class="w-1/3 mt-12">
                <a href="/dist/index_eng.php">
                    <div id="Logo-1024" class="h-[90px] xl:h-[100px] w-60 ml-10 mt-5 z-10 fixed top-0 left-5 xl:left-10">
                        <img src="/img/logo-lux.png" alt="Logo" class="h-full">
                    </div>
                </a>
            </div>

            <div class="w-1/3 mt-8 flex items-center">
                <div id="menu-1024" class="space-x-8 text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2">
                    <a href="/dist/index_eng.php" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Home</a>
                    <a href="#" class="text-orange-300 underline underline-offset-4 hover:scale-105 transition-all">Properties</a>
                    <a href="/dist/about_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">About Us</a>
                    <a href="/dist/contatti_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Contact</a>
                </div>
            </div>

            <div class="w-1/3 flex items-center justify-center mt-6 gap-10">
                <?php if (!isset($_SESSION['ID'])) { ?>
                    <button id="toggleLogin" onclick="toggleLogin()" class="max-md:hidden flex items-center hover:scale-105 transition-all">
                        <div class="bg-neutral-800 px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                            <img src="/img/user.svg" alt="" class="w-10 h-8">
                        </div>
                    </button>
                <?php } ?>

                <?php if (isset($_SESSION['ID'])) { ?>
                    <button id="toggleUser" onclick="toggleUser()" class="max-md:hidden flex items-center hover:scale-105 transition-all">
                        <div class="bg-neutral-800 px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                            <img src="/img/user.svg" alt="" class="w-10 h-8">
                        </div>
                    </button>
                <?php } ?>

                <?php
                // Check if the user is authenticated
                if (isset($_SESSION['ID'])) {
                    if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {
                        // The user is authenticated, show the button to add properties
                        echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                        echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                        echo '</button>';
                    }
                }
                ?>
                <div class=" text-white text-xl flex gap-1 ml-1 mr-8 mt-12 z-10 cursor-pointer fixed top-0 right-5 ">
                        <button id="translateButtonIt" onclick="translateSiteToIta()" ><a href="immobili.php">It</a></button>
                        <p>-</p>
                        <button id="translateButtonEng" onclick="translateSiteToEng()" class="underline underline-offset-4 text-orange-300">En</button>
                        </div><script>saveStateToCookies();</script>  
            </div>

            <?php
            // Check if the user is authenticated
            if (isset($_SESSION['ID'])) {
                ?>
                <!-- This section contains user information -->
                <div id="userInfo" class="hidden text-white bg-neutral-700 py-6 px-6 pt-6 fixed top-16 right-4 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2">

                    <img src="/img/x.png" alt="Logo" id="Xuser" onclick="toggleUser()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">

                    <p class="mb-2 text-sm">Email: <br> <span id="userEmail"></span></p>
                    <p class="mb-2 text-sm">Role: <br><span id="userRole"></span></p>
                    <form action="./php/logout.php" method="POST">
                        <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') { ?>
                            <div class="mb-6">
                                <label class="block text-white text-sm font-medium mb-2">
                                    Want to create an account? <a href="registrazione.php" class="text-green-500 hover:underline">Click here.</a>
                                </label>
                            </div>
                        <?php } ?>
                        <input type="submit" value="Logout" class="bg-white text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
                    </form>
                </div>
            <?php
            } ?>

            <?php
            // Check if the user is not authenticated
            if (!isset($_SESSION['ID'])) {
                // The user is not authenticated, show the login form
                ?>
                <!-- This section contains the login form -->
                <form action="./php/login.php" method="POST" id="login" class="bg-neutral-700 py-6 px-6 pt-6 fixed top-16 right-4 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2 hidden">

                    <img src="/img/x.png" alt="Logo" id="Xmini" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">

                    <div class="my-4">
                        <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 pr-6 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-white text-sm font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-2 pr-6 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
                    </div>

                    <input type="submit" value="Login" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
                </form>
            <?php
            }
            ?>
        </div>
    </nav>

    <nav id="nav-imm" class="lg:hidden z-50 fixed w-full">
        <div class="flex items-center justify-between">
            <div class="w-1/3 mt-12">
                <a href="/dist/index_eng.php">
                    <img src="/img/logo-lux.png" alt="Logo" id="Logo" class="h-20 sm:h-[85px] pb-2 ml-12 mt-4 z-10 fixed top-0 left-0 ">
                </a>
            </div>

            <div class="w-1/3 flex justify-center py-5 gap-10 max-md:hidden">
                <?php if (!isset($_SESSION['ID'])) { ?>
                    <button id="toggleLoginMini" onclick="toggleLogin()" class="flex items-center hover:scale-105 transition-all">
                        <div class="bg-neutral-800 px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                            <img src="/img/user.svg" alt="" class="w-10 h-8">
                        </div>
                    </button>
                <?php } ?>

                <?php if (isset($_SESSION['ID'])) { ?>
                    <button id="toggleUserMini" onclick="toggleUser()" class="flex items-center hover:scale-105 transition-all">
                        <div class="bg-neutral-800 px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                            <img src="/img/user.svg" alt="" class="w-10 h-8">
                        </div>
                    </button>
                <?php } ?>

                <?php
                if (isset($_SESSION['ID'])) {
                    if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {
                        echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                        echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                        echo '</button>';
                    }
                }
                ?>
            </div>

            <?php
            // Check if the user is authenticated
            if (isset($_SESSION['ID'])) {
                ?>
                <div id="userInfoMini" class="hidden text-white bg-neutral-700 py-6 px-6 pt-6 fixed top-32 left-1/5 mx-4 z-10 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2">

                    <img src="/img/x.png" alt="Logo" id="Xuser2" onclick="toggleUser()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">

                    <p class="mb-2 text-sm">Email: <br> <span id="userEmail2"></span></p>
                    <p class="mb-2 text-sm">Role: <br> <span id="userRole2"></span></p>
                    <form action="./php/logout.php" method="POST">
                        <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') { ?>
                            <div class="mb-6">
                                <label class="block text-white text-sm font-medium mb-2">
                                    Want to create an account? <a href="registrazione.php" class="text-green-500 hover:underline">Click here.</a>
                                </label>
                            </div>
                        <?php } ?>
                        <input type="submit" value="Logout" class="bg-green-800 text-white font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 duration-75 md:px-10 xl:text-xl">
                    </form>
                </div>
            <?php
            } ?>

            <?php
            // Check if the user is not authenticated
            if (!isset($_SESSION['ID'])) {
                ?>
                <form action="./php/login.php" method="POST" id="loginMini" class="hidden bg-neutral-700 py-6 px-8 pt-4 fixed top-40 left-1/5 mx-4 rounded-lg shadow-lg shadow-black md:top-24 animate-dasopra2">

                    <img src="/img/x.png" alt="Logo" id="Xmini2" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer ">

                    <div class="my-4">
                        <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-white text-sm font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
                    </div>

                    <button type="submit" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">Submit</button>
                </form>
            <?php
            }
            ?>
        </div>

        <div class="w-1/3 mt-12">
            <button id="toggleButton" class="transition-all" onclick="toggleMenu()">
                <img src="/img/menu-ita.png" alt="Logo" id="hamburger" class="h-14 w-14 ml-1 mr-8 mt-8 z-10 cursor-pointer fixed top-0 right-0">
                <img src="/img/x.png" alt="Logo" id="X" class="hidden h-12 w-12 ml-1 mr-4 mt-8 z-10 cursor-pointer fixed top-0 right-0">
            </button>
        </div>

        <div id="menu" class="bar hidden fixed left-0 top-0 py-10 px-8 text-center bg-neutral-800 w-full z-0">
            <div class="flex flex-col text-xl font-semibold gap-8">
                <a href="/dist/index_eng.php" class="text-white hover:text-orange-300 hover:scale-105 transition-all ">Home</a>
                <div class="border-b mx-12"></div>
                <a href="#" class="text-orange-300 underline underline-offset-4 hover:scale-105 transition-all">Properties</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/about_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">About Us</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/contatti_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Contact</a>
            </div>
        </div>
    </nav>



   
    
    <br><br><br>
        <div class="flex items-center justify-center flex-row gap-10 mt-16 md:hidden "> 
          
        <?php  if (!isset($_SESSION['ID'])) { ?>
              <button id="toggleMini" onclick="toggleLogin()" class=" flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>
            <?php } ?>

            <?php  if (isset($_SESSION['ID'])) { ?>
            <button id="toggleUserMini2" onclick="toggleUser()" class="  flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>

            <?php } ?>
            <?php

            // Controlla se l'utente è autenticato
            if (isset($_SESSION['ID'])) {
                if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                echo '</button>';
                }
            }
            ?>
<?php
if (isset($_SESSION['ID'])) {
    ?>
        <!-- Questa sezione contiene le informazioni dell'utente -->
<div id="userInfoMini2" class="hidden text-white  bg-neutral-700 py-6 px-6 pt-6 fixed top-40 left-1/5 mx-4 rounded-lg z-10 shadow-lg shadow-black 2xl:right-32 animate-dasopra2" >

<img src="/img/x.png" alt="Logo" id="Xuser3" onclick="toggleUser()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">
   
    <p class=" mb-2 text-sm">Email: <br> <span id="userEmail3"></span></p>
    <p class=" mb-2 text-sm">Role: <br> <span id="userRole3"></span></p>
    <form action="./php/logout.php" method="POST">
    <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {?>
            <div class="mb-6">
            <label class="block text-white text-sm font-medium mb-2">
            Want to create an account? <a href="registrazione.php" class="text-green-500 hover:underline">Click here.</a>
            </label>
        </div>
        <?php } ?>
        <input type="submit" value="Logout" class="bg-green-800 text-white font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 duration-75 md:px-10 xl:text-xl">
    </form>
</div>
<?php 
} ?>

<?php
        // Verifica se l'utente è autenticato
        if (!isset($_SESSION['ID'])) {
            // L'utente non è autenticato, mostra il form di login
            ?>
<form action="./php/login.php" method="POST" id="loginMini2" class=" hidden bg-neutral-700 py-6 px-8 pt-4 fixed top-40 left-1/5 mx-4 rounded-lg z-10 shadow-lg shadow-black md:top-24 animate-dasopra2">
            
            <img src="/img/x.png" alt="Logo" id="Xmini3" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer ">

          <div class="my-4">
              <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
              <input type="email" id="email" name="email" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
          </div>
          
          <div class="mb-6">
              <label for="password" class="block text-white text-sm font-medium mb-2">Password</label>
              <input type="password" id="password" name="password" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
          </div>
 
   
          <button type="submit" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10  xl:text-xl">Invia</button>
      </form>
        
      <?php } ?>    
</div> 

<br><br><br>





<!-- Aggiungi questo bottone e menu a tendina nella sezione dove visualizzi i dettagli dell'immobile -->
<div class=" text-white flex  justify-between  w-[90%] mx-auto py-4 ">

        <a href="/dist/immobili_eng.php" class=""  > 
            <button class="   w-fit  hover:scale-105 transition-all  font-semibold ">
                <div class="flex flex-nowrap items-center whitespace-nowrap gap-6 hover:animate-bounce-horizontal-reverse p-4 "> 
                 
                   <img src="/img/freccia-back.png" alt="" class="w-full lg:h-10 h-8 xl:h-10">
                 </div>   
            </button>
        </a>
       
       
        <?php
// Controlla se l'utente è autenticato
if (isset($_SESSION['ID'])) {
    $id_utente = $_SESSION['ID'];

 


  
    // Verifica se la chiave 'ruolo' è definita nella sessione
    if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {
        
        // L'utente è autenticato ed è admin, mostra il bottone delle opzioni
        echo '<button class="w-10 flex" id="opzioniButton" onclick="toggleOpzioniMenu()"><img src="/img/dot.svg" alt=""></button>';
        
        // Mostra il menu delle opzioni
        echo '<div id="opzioniMenu" class="absolute hidden right-10 px-6 bg-neutral-700 shadow-md shadow-black rounded-xl">';
        echo '<a href="#" onclick="modificaImm();" class="flex pt-4 pb-2 hover:text-green-600">Modifica</a>';
        echo '<a href="#" onclick="eliminaImm();" class="flex pb-4 pt-2 hover:text-green-600">Elimina</a>';
        echo '</div>';
    }
}
?>



</div>


<div class="flex flex-col w-full items-center bg-neutral-900 h-screen min-h-[700px] text-white">
    <div class="w-[90%] h-[70%] overflow-hidden p-2 mt-10 rounded-t-xl border-b-0 border border-white ">
        <a data-fancybox="single" href="<?php echo $row['foto_principale']; ?>">
            <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class="w-full h-full object-cover rounded-t-lg shadow-md shadow-black">
        </a>
        <div class="mb-10 absolute left-1/2 transform -translate-x-1/2 -translate-y-10">
            <div class="min-h-[500px] relative flex flex-col mb-4">
                <h1 class="font-Ayer text-7xl uppercase text-center break-normal md:text-[86px] 2xl:text-9xl max-w-lg md:max-w-xl lg:max-w-3xl xl:max-w-6xl">
                    <?php echo $row['titolo']; ?>
                </h1>
                <br>
                <p class="text-2xl md:text-3xl lg:text-4xl text-center tracking-wide">€ <?php echo $row['prezzo']; ?></p>
            </div>
        </div>
    </div>
</div>


        <div class="flex flex-col w-[95%] mx-auto lg:w-full  items-center bg-neutral-900  text-white ">

        <div class="border-b border-white w-[90%] font-Merriweather text-lg  mb-10  mt-24 flex   gap-10 xl:text-2xl">
        
            <p class="pb-4 flex items-center gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8"> <?php echo $tipo_immobileInglese ?></p>
            <p class="pb-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8"> <?php echo $comuneInglese ?></p>
            <p class="pb-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
        </div>
                <div class="flex gap-3 lg:gap-5 mt-6 ">
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-1/3 lg:w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-2 min-[400px]:pl-4  pr-8 min-[400px]:pr-12 lg:pr-20 text-lg lg:text-2xl uppercase font-Grotesk">bedrooms</p>
                    <p class="flex  justify-end pl-8 min-[400px]:pl-12 lg:pl-20 pb-3 pr-2 min-[400px]:pr-4 text-3xl lg:text-4xl font-Ayer tracking-wider"><?php echo $row['camere']; ?></p>
                </div>
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-1/3 lg:w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-2 min-[400px]:pl-4  pr-8 min-[400px]:pr-12 lg:pr-20 text-lg lg:text-2xl uppercase font-Grotesk">bathrooms</p>
                    <p class="flex  justify-end pl-8 min-[400px]:pl-12 lg:pl-20 pb-3 pr-2 min-[400px]:pr-4 text-3xl lg:text-4xl font-Ayer tracking-wider"><?php echo $row['bagni']; ?></p>
                </div>
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-1/3 lg:w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-2 min-[400px]:pl-4  pr-8 min-[400px]:pr-12 lg:pr-20 text-lg lg:text-2xl uppercase font-Grotesk">M²</p>
                    <p class="flex  justify-end pl-8 min-[400px]:pl-12 lg:pl-20 pb-3 pr-2 min-[400px]:pr-4 text-3xl lg:text-4xl font-Ayer tracking-wider"><?php echo $row['metri_quadrati']; ?></p>
                </div>
      </div>
            <br><br><br>
                <div class="flex max-lg:flex-col w-[90%] justify-between mt-16">

                <h1 class="uppercase text-6xl font-Ayer  xl:text-9xl text-neutral-400 mb-4">Description</h1>
                <p class="flex items-end text-xl max-lg:w-full lg:max-w-[50%] break-normal font-Grotesk"><?php echo nl2br($descrizioneInglese); ?></p>
                
                </div>

                <br><br><br>
                <div class="flex max-lg:flex-col  w-[90%] min-lg:justify-between mt-16">
                <div class="flex flex-col max-lg:w-full lg:w-1/3 max-lg:mb-16">
                <h1 class="uppercase text-6xl font-Ayer  xl:text-9xl text-neutral-400">info</h1>
                <div class="flex ">
                
                
                <?php
        // Verifica se è stato passato un ID immobile
        if (isset($_GET['id'])) {
            $id_immobile = $_GET['id'];

            // Query per ottenere i dati dell'immobile specifico
            $query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
            $result = mysqli_query($conn, $query);

            if ($result) {
                // Inizio della lista
                echo '<table class="w-full table-fixed uppercase text-lg">';
                echo '<tbody>';
            
                // Itera sui risultati della query
                while ($row = mysqli_fetch_assoc($result)) {



                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'Contract' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $tipo_venditaInglese . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'rooms' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['vani'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'bedrooms' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['camere'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'bathrooms' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['bagni'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'M²' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['metri_quadrati'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'floors' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['piani'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                //Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'garden' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['giardino'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'parking lot' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['parcheggio'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'kitchen' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $cucinaInglese . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'energy class' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['classe_energetica'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'balcony' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['balcone'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'EPI' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['EPI'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'living room' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $soggiornoInglese . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'heating' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $riscaldamentoInglese . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'conditions' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $condizioniInglese . '</td>';
                echo '</tr>';

                
            } 
        
                    // Fine della tabella
                    echo '</tbody>';
                    echo '</table>';
                
                } else {
                    echo "Errore nella query: " . mysqli_error($conn);
                }
            } else {
                echo "ID immobile non specificato.";
            }
            
        ?>

                </div>
                </div>
  


                <div class="flex flex-col max-lg:w-full max-lg:mt-8 lg:w-2/3 lg:pl-32">
    <div class="flex gap-8">
        <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">Gallery</h1>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 lg:gap-4 gap-3 mt-8">
        <?php
        if (isset($_GET['id'])) {
            $id_immobile = $_GET['id'];
            $query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if (isset($row['galleria_foto']) && !empty($row['galleria_foto'])) {
                    $galleriaFiles = json_decode($row['galleria_foto'], true);

                    if (is_array($galleriaFiles)) {
                        foreach ($galleriaFiles as $index => $foto) {
                            echo '<a data-fancybox="gallery" href="' . $foto . '">';
                            echo '<img src="' . $foto . '" alt="Anteprima" class="w-full h-56 xl:h-64 2xl:h-72 object-cover rounded-lg shadow-md shadow-black cursor-pointer">';
                            echo '</a>';
                        }
                    } else {
                        echo 'Nessuna foto disponibile nella galleria.';
                    }
                } else {
                    echo 'Nessuna foto disponibile nella galleria.';
                }
            } else {
                echo 'Nessun risultato trovato per l\'ID immobile specificato';
            }
        }
        ?>
    </div>
</div>
                    </div>
                    <br><br><br>

<?php
// Assume che $row sia il risultato della tua query
// Assicurati che il campo nel database contenga l'URL del video di YouTube
$youtubeUrl = $row['video'];
?>

<div class="flex flex-col bg-neutral-900 my-16 w-[90%]">
    <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">Video</h1>
    <br>
    <div class="flex justify-center items-center">
        <!-- Utilizza l'iframe di YouTube per incorporare il video -->
        <iframe width="920" height="640" src="<?php echo $youtubeUrl; ?>" frameborder="0" allowfullscreen class="rounded-lg shadow-lg shadow-black"></iframe>
    </div>
</div>


                    <?php
// Assume che $conn sia la tua connessione al database
// $immobileId è l'ID dell'immobile per il quale vuoi ottenere le coordinate
if (isset($_GET['id'])) {
    $id_immobile = $_GET['id']; // Cambia con l'ID effettivo dell'immobile

$query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
$result = mysqli_query($conn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $indirizzo = urlencode($row['indirizzo']);
        $comune = urlencode($row['comune']);

        echo "<script>
                var indirizzo = '$indirizzo';
                var comune = '$comune';
              </script>";

              echo "<script>
                var indirizzo = '$indirizzo, $comune'; // Unisci indirizzo e comune
              </script>";
    } else {
        echo "Nessun risultato trovato per l'ID immobile specificato.";
    }
} else {
    echo "Errore nella query: " . mysqli_error($conn);
}}

?>



<div class="flex flex-col bg-neutral-900  my-12 w-[90%] z-10">
    <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">Map</h1>
    <br>
    <div class="flex justify-center">
        <!-- Aggiungi un elemento div con un id univoco per ogni mappa -->
        <div id="map1" style="height: 600px; width: 100%;" class="rounded-lg shadow-lg shadow-black hover:shadow-orange-300 transition-all duration-400"></div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
var map1 = L.map('map1', {
    scrollWheelZoom: false
});

$.ajax({
    url: `https://nominatim.openstreetmap.org/search?format=json&q=${indirizzo},${comune}`,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        if (data.length > 0) {
            var coords = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
            map1.setView(coords, 17);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map1);

            // Definisci un'icona personalizzata
            var customIcon = L.icon({
                iconUrl: '/img/iconamappa.png',
                iconSize: [60, 60],
                iconAnchor: [25, 50]
            });

            // Aggiungi un segnaposto alla mappa utilizzando l'icona personalizzata
            var marker = L.marker(coords, { icon: customIcon }).addTo(map1);

            // Assegna l'evento click al marker
            marker.on('click', function () {
                // Costruisci l'URL di Google Maps con l'indirizzo
                var googleMapsUrl = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(indirizzo + ', ' + comune);

                // Apri la nuova finestra del browser con l'URL di Google Maps
                window.open(googleMapsUrl, '_blank');
            });

        } else {
            console.error('Coordinate non trovate per l\'indirizzo specificato.');
        }
    },
    error: function () {
        console.error('Errore nella richiesta AJAX per ottenere le coordinate.');
    }
});

</script>


            <?php

            if (isset($_SESSION['ID'])) {
         
        ?>

        <div class="flex  w-[80%] my-5  ">
            <div class="flex relative float-left p-4 items-center gap-5   border border-white rounded-lg hover:text-green-700">
            <img src="/img/pdf.svg" alt="" class="w-full h-10">
        <?php
            echo '<a href="data:' . $row['tipo_contenuto'] . ';base64,' . base64_encode($row['dati']) . '" download="' . $row['nome_file'] . '">Documentazione</a>';
                                        
        ?>
        </div>
        </div>
        <?php
           
                                        }
        ?>

                    <div class="flex flex-col bg-neutral-900  my-16 w-[90%]">
                        <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">contact us</h1>
                        <br>
                        <div class="flex justify-center">

             
                        <form action="./php/send.php" method="post" class="w-full md:w-2/3 lg:w-1/2 md:mr-12 lg:mx-10 lg:mr-16 ">

<div class="mb-4">
    <label for="nome" class="block text-white text-sm font-medium mb-2">Name *</label>
    <input type="text" id="nome" name="nome" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900 focus:border-orange-300 focus:outline-none" required>
</div>
<div class="mb-4">
    <label for="email" class="block text-white text-sm font-medium mb-2">Email *</label>
    <input type="email" id="email" name="email" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900 focus:border-orange-300 focus:outline-none" required>
</div>
<div class="mb-4">
    <label for="telefono" class="block text-white text-sm font-medium mb-2">Phone Number *</label>
    <input type="tel" id="telefono" name="telefono" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900 focus:border-orange-300 focus:outline-none" required>
</div>

<?php echo '<div class="mb-4">
    <label for="messaggio" class="block text-white text-sm font-medium mb-2">Message *</label>
    <textarea id="mex" name="messaggio" rows="4" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900 focus:border-orange-300 focus:outline-none" required>Dear PREMIA HOME S.R.L., I request further information about your listing Ref.' . $id_immobile . '</textarea>
</div>'; ?>

<button type="submit" class=" bg-green-800 lg:bg-white float-right max-lg:w-full text-white lg:text-black font-medium text-lg px-8 py-2 rounded-md shadow-md shadow-neutral-900 lg:hover:bg-green-800 hover:scale-105 lg:hover:text-white duration-75 md:px-10 lg:px-16 xl:px-20 xl:py-3 xl:text-xl">Send</button>

</form>

                        
                    </div>
                    </div>


               </div>
               <div class="bg-neutral-950 pt-16 border-t border-white px-4 lg:px-10 flex flex-col">
                <div class="mx-8">
                    <div class="flex justify-between gap-4 md:gap-0">
                        <div class="flex flex-col items-center md:items-start gap-10 md:gap-6 lg:ml-6 w-1/3">
                            <button onclick="makeCallCell()" class="flex items-center hover:scale-105 transition-all">
                                <div class="bg-green-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
                                    <img src="/img/cellulare.png" alt="" class="w-6 h-6">
                                </div>
                                <div class="flex items-center text-white">
                                    <p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">3289086227</p>
                                </div>
                            </button>
                            
                            <button onclick="makeCall()" class="flex items-center hover:scale-105 transition-all">
                                <div class="bg-white text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
                                    <svg width="24px" height="24px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- Generator: Sketch 52.5 (67469) - http://www.bohemiancoding.com/sketch -->
                                        <title>phone</title>
                                        <desc>Created with Sketch.</desc>
                                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <g id="Rounded" transform="translate(-749.000000, -1263.000000)">
                                                <g id="Communication" transform="translate(100.000000, 1162.000000)">
                                                    <g id="-Round-/-Communication-/-phone" transform="translate(646.000000, 98.000000)">
                                                        <g>
                                                            <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path d="M19.23,15.26 L16.69,14.97 C16.08,14.9 15.48,15.11 15.05,15.54 L13.21,17.38 C10.38,15.94 8.06,13.63 6.62,10.79 L8.47,8.94 C8.9,8.51 9.11,7.91 9.04,7.3 L8.75,4.78 C8.63,3.77 7.78,3.01 6.76,3.01 L5.03,3.01 C3.9,3.01 2.96,3.95 3.03,5.08 C3.56,13.62 10.39,20.44 18.92,20.97 C20.05,21.04 20.99,20.1 20.99,18.97 L20.99,17.24 C21,16.23 20.24,15.38 19.23,15.26 Z" id="🔹Icon-Color" fill="#1D1D1D"></path>
                                                        </g>
                                                    </g>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="flex items-center text-white">
                                    <p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">0952274123</p>
                                </div>
                            </button>
                            
                            <a href="mailto:segreteria@premiahome.it?subject=Subject%20of%20the%20email&body=Message%20text" target="_blank">
                                <button class="flex items-center hover:scale-105 transition-all">
                                    <div class="bg-red-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
                                        <img src="/img/email.png" alt="" class="w-6 h-6">
                                    </div>
                                    <div class="flex items-center text-white">
                                        <p class="hidden ml-4 text-sm md:block lg:text-md xl:ml-8 xl:text-xl">segreteria@premiahome.it</p>
                                    </div>
                                </button>
                            </a>
                        </div>
                        
                        <div class="flex flex-col gap-4 text-left md:text-lg lg:text-xl transition-all uppercase w-fit mx-4 max-xl:text-center">
                            <a href="/dist/index.php" class="text-white mb-2">
                                <p class="">FEATURED PROPERTIES</p>
                            </a>
                            <a href="/dist/immobili.php" class="text-white mb-2">
                                <p class="">find your property</p>
                            </a>
                            <a href="/dist/about.html" class="text-white mb-2">
                                <p class="">discover who we are</p>
                            </a>
                            <a href="/dist/contatti.html" class="text-white">
                                <p class="">talk to us</p>
                            </a>
                        </div>
                        
                        <div class="flex flex-col gap-4 items-center md:items-end lg:mr-6 text-2xl md:text-lg lg:text-xl transition-all w-1/3 max-md:hidden">
                            <a href="https://www.facebook.com/yourpage" target="_blank" class="text-white hover:text-blue-700 hover:scale-105 mb-2">
                                <i class="fab fa-facebook "></i> Facebook
                            </a>
                            <a href="https://www.instagram.com/yourpage" target="_blank" class="text-white hover:text-purple-700 hover:scale-105 mb-2">
                                <i class="fab fa-instagram"></i> Instagram
                            </a>
                            <a href="https://www.youtube.com/yourpage" target="_blank" class="text-white hover:text-red-700 hover:scale-105 mb-2">
                                <i class="fab fa-youtube"></i> YouTube
                            </a>
                            <a href="https://www.linkedin.com/company/yourpage" target="_blank" class="text-white hover:text-blue-900 hover:scale-105">
                                <i class="fab fa-linkedin"></i> LinkedIn
                            </a>
                        </div>
                        
                        <div class="flex flex-col gap-4 items-center md:items-end lg:mr-6 text-2xl md:text-lg lg:text-xl transition-all w-1/3 md:hidden">
                            <a href="https://www.facebook.com/yourpage" target="_blank" class="text-white hover:text-blue-700 hover:scale-105 mb-2">
                                <i class="fab fa-facebook "></i> <p class="hidden ">Facebook</p>
                            </a>
                            <a href="https://www.instagram.com/yourpage" target="_blank" class="text-white hover:text-purple-700 hover:scale-105 mb-2">
                                <i class="fab fa-instagram"></i> <p class="hidden ">Instagram</p>
                            </a>
                            <a href="https://www.youtube.com/yourpage" target="_blank" class="text-white hover:text-red-700 hover:scale-105 mb-2">
                                <i class="fab fa-youtube"></i> <p class="hidden ">YouTube</p>
                            </a>
                            <a href="https://www.linkedin.com/company/yourpage" target="_blank" class="text-white hover:text-blue-900 hover:scale-105">
                                <i class="fab fa-linkedin"></i> <p class="hidden ">LinkedIn</p>
                            </a>
                        </div>
                    </div>
                    
                    <br>
                    
                    <div class="flex gap-8 mt-6 lg:ml-6">
                        <p class="text-white">Mon-Fri: 9-13 / 15-19</p>
                        <div class="border-l border-white"></div>
                        <p class="text-white">Saturday: 9-13</p>
                    </div>
                    
                    <br>
                    
                    <div class="flex justify-between items-end lg:mx-6 pb-8 border-t gap-16 border-red-700 text-sm">
                        <p class="text-white xl:text-lg mt-6">Premia Home S.P.A. - VAT: 06024760875 - Viale Jonio 35, Catania (CT)</p>
                        <p class="text-white font-medium mt-6">Website by SDT Copy Sales</p>
                    </div>
                </div>
            </div>
            </div>

        
       
  

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

        <script>
        AOS.init();
        </script>

<script>
    // JavaScript per gestire l'interazione tra le sezioni
    document.addEventListener('DOMContentLoaded', function () {
        // Ottieni le informazioni dell'utente
        
        var emailUtente = '<?php echo $_SESSION['Email']; ?>';
        var ruoloUtente = '<?php echo $_SESSION['ruolo']; ?>';

        var emailUtente2 = '<?php echo $_SESSION['Email']; ?>';
        var ruoloUtente2 = '<?php echo $_SESSION['ruolo']; ?>';

        var emailUtente3 = '<?php echo $_SESSION['Email']; ?>';
        var ruoloUtente3 = '<?php echo $_SESSION['ruolo']; ?>';

   

        // Mostra le informazioni dell'utente e nascondi il form di login
       
        document.getElementById('userEmail').textContent = emailUtente;
        document.getElementById('userRole').textContent = ruoloUtente;
        document.getElementById('userEmail2').textContent = emailUtente2;
        document.getElementById('userRole2').textContent = ruoloUtente2;
        document.getElementById('userEmail3').textContent = emailUtente3;
        document.getElementById('userRole3').textContent = ruoloUtente3;
        document.getElementById('loginForm').classList.add('hidden');
    });
</script>

        <script src="index.js"></script>
        <script src="scroll_imm.js"></script>

        <script>
   var button = document.getElementById("opzioniButton");
var menu = document.getElementById("opzioniMenu");

function toggleOpzioniMenu() {
    var opzioniMenu = document.getElementById('opzioniMenu');
    opzioniMenu.style.display = opzioniMenu.style.display === 'none' ? 'block' : 'none';
}



document.addEventListener("click", function(event) {
    var isClickInsideButton = button.contains(event.target);
    var isClickInsideMenu = menu.contains(event.target);

    if (!isClickInsideButton && !isClickInsideMenu) {
        menu.style.display = "none";
    }
});


    function modificaImm() {
        var id_immobile = <?php echo $id_immobile; ?>;
        window.location.href = "/dist/modifica.php?action=edit&id=" + id_immobile;
    }

    var id_immobile = <?php echo $id_immobile; ?>;
</script>


        <script>
    function initMap() {
        var immobileLocation = { lat: <?php echo $latitudine; ?>, lng: <?php echo $longitudine; ?> };

        var mapOptions = {
            center: immobileLocation,
            zoom: 15,
        };

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        var marker = new google.maps.Marker({
            position: immobileLocation,
            map: map,
            title: 'Posizione dell\'immobile'
        });
    }

    // Inizializza la mappa quando la pagina è completamente caricata
    document.addEventListener('DOMContentLoaded', function() {
        initMap();
    });
</script>

        
        </body>
<?php
    
    } else {
        echo "Errore nella query: " . mysqli_error($conn);
    }}
?>
</html>
