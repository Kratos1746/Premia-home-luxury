<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();
include './php/db_connection.php';



$query = "SELECT * FROM immobili";
$result = mysqli_query($conn, $query);



    
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
            }
// Verifica se ci sono risultati
if ($result)	{	
    
   
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


  <link href="output.css" rel="stylesheet">
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

<!--	Title
	=========================================================-->
<title>PremiaHome-Luxury</title>
</head>

<?php
// immobili.php

// Controlla se il parametro messaggio è presente nell'URL
if (isset($_GET['messaggio'])) {
    $messaggio = urldecode($_GET['messaggio']);
    echo '<div id="messaggio" style="color: green;" class=" bg-neutral-900 text-lg text-center">' . $messaggio . '</div>';
}
?>


<body class="overflow-x-hidden font-Grotesk tracking-wide">



 
<div class="bg-neutral-900 min-h-screen flex flex-col">
      <nav id="nav-1024" class="max-lg:hidden   z-10 pt-4 fixed  w-full  ">
          <div class="flex items-center justify-between ">
            <div class=" w-1/3 mt-12">
            <a href="/dist/index.php" >
              <img src="/img/logo-ombra.png" alt="Logo" id="Logo-1024" class="h-18 w-60 ml-8 mt-6 z-10 fixed top-0 left-0 "></a>
              </div>

              <div class=" w-1/3 mt-8 flex items-center">
              <div id="menu-1024" class="  space-x-8  text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2 ">
                  <a href="/dist/index.php" class=" text-white hover:scale-105 transition-all">Home</a>
                  <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all">Immobili</a>
                  <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                  <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
              </div>
              </div>
            
              
              <div  class=" w-1/3 flex items-center justify-center mt-6   gap-10 ">
                <?php  if (!isset($_SESSION['ID'])) { ?>
              <button id="toggleLogin" onclick="toggleLogin()" class=" max-md:hidden flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>
            <?php } ?>

            <?php  if (isset($_SESSION['ID'])) { ?>
            <button id="toggleUser" onclick="toggleUser()" class=" max-md:hidden flex items-center hover:scale-105 transition-all">
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

        </div>
         

        <?php

     
        // Controlla se l'utente è autenticato
        if (isset($_SESSION['ID'])) {
            ?>
                <!-- Questa sezione contiene le informazioni dell'utente -->
        <div id="userInfo" class="hidden text-white  bg-neutral-700 py-6 px-6 pt-6 fixed top-16 right-4 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2" >

        <img src="/img/x.png" alt="Logo" id="Xuser" onclick="toggleUser()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">
           
            <p class=" mb-2 text-sm">Email: <br> <span id="userEmail"></span></p>
            <p class=" mb-2 text-sm">Ruolo: <br><span id="userRole"></span></p>
            <form action="./php/logout.php" method="POST">
           <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {?>
            <div class="mb-6">
            <label class="block text-white text-sm font-medium mb-2">
                Vuoi creare un account? <a href="registrazione.php" class="text-green-500 hover:underline">Clicca qui.</a>
            </label>
        </div>
        <?php } ?>
                <input type="submit" value="Logout" class="bg-white text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
            </form>
        </div>
        <?php 
        } ?>

        <?php
        // Verifica se l'utente è autenticato
        if (!isset($_SESSION['ID'])) {
            // L'utente non è autenticato, mostra il form di login
            ?>
    <!-- Questa sezione contiene il form di login -->
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

       

        <input type="submit" value="Accedi" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
    </form>
    <?php
}
?>



      </nav>

      <nav id="nav" class=" lg:hidden  z-10   fixed w-full   ">
        <div class="flex items-center justify-between  ">
        <div class=" w-1/3 mt-12">
        <a href="/dist/index.php" >
            <img src="/img/logo-ombra.png" alt="Logo" id="Logo" class="h-18 w-48 ml-8 mt-6 z-10 fixed top-0 left-0 "></a>
        </div>

            <div class=" w-1/3 flex justify-center py-5  gap-10 max-md:hidden ">
            <?php  if (!isset($_SESSION['ID'])) { ?>
              <button id="toggleLoginMini" onclick="toggleLogin()" class=" flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>
            <?php } ?>

            <?php  if (isset($_SESSION['ID'])) { ?>
            <button id="toggleUserMini" onclick="toggleUser()" class="  flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>

            <?php } ?>
                <?php

           
            if (isset($_SESSION['ID'])) {
                if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                echo '</button>';
                }
            }
                ?>

            </button>

            <?php

     
// Controlla se l'utente è autenticato
if (isset($_SESSION['ID'])) {
    ?>
        <!-- Questa sezione contiene le informazioni dell'utente -->
<div id="userInfoMini" class="hidden text-white  bg-neutral-700 py-6 px-6 pt-6 fixed top-32 left-1/5 mx-4 z-10 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2" >

<img src="/img/x.png" alt="Logo" id="Xuser2" onclick="toggleUser()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">
   
    <p class=" mb-2 text-sm">Email: <br> <span id="userEmail2"></span></p>
    <p class=" mb-2 text-sm">Ruolo: <br> <span id="userRole2"></span></p>
    <form action="./php/logout.php" method="POST">
    <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {?>
            <div class="mb-6">
            <label class="block text-white text-sm font-medium mb-2">
                Vuoi creare un account? <a href="registrazione.php" class="text-green-500 hover:underline">Clicca qui.</a>
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
            <form action="./php/login.php" method="POST" id="loginMini" class=" hidden bg-neutral-700 py-6 px-8 pt-4 fixed top-40 left-1/5 mx-4 rounded-lg  shadow-lg shadow-black md:top-24 animate-dasopra2">
            
              <img src="/img/x.png" alt="Logo" id="Xmini2" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer ">

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
        <?php
}
?>
            </div>

            <div class=" w-1/3 mt-12">
          <button id="toggleButton" class="transition-all   " onclick="toggleMenu()">
            <img src="/img/menu-ita.png" alt="Logo" id="hamburger" class="h-14 w-14 ml-1 mr-8 mt-8 z-10 cursor-pointer fixed top-0 right-0">
            <img src="/img/x.png" alt="Logo" id="X" class="hidden h-12 w-12 ml-1 mr-4 mt-8 z-10 cursor-pointer fixed top-0 right-0">
          </button>

            </div>
            <div id="menu" class="bar hidden fixed left-0 top-0 py-10 px-8 text-center bg-neutral-800 w-full z-0">
            <div class=" flex flex-col text-xl font-semibold   gap-8">
                <a href="/dist/index.php" class="text-white hover:scale-105 transition-all ">Home</a>
                <div class=" border-b mx-12 "></div>
                <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all">Immobili</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
            </div>
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
    <p class=" mb-2 text-sm">Ruolo: <br> <span id="userRole3"></span></p>
    <form action="./php/logout.php" method="POST">
    <?php if (isset($row_ruolo['ruolo']) && $row_ruolo['ruolo'] === 'admin') {?>
            <div class="mb-6">
            <label class="block text-white text-sm font-medium mb-2">
                Vuoi creare un account? <a href="registrazione.php" class="text-green-500 hover:underline">Clicca qui.</a>
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

            <br><br>
            <div class="flex flex-col justify-center items-center md:mt-16">
        <h1 class="text-5xl font-semibold text-center text-neutral-500 opacity-80 tracking-wider font-lora xl:text-6xl">Immobili</h1><br>

  
    
</div>
<br>
    <div class="w-[90%] mx-auto">
    <h1 class="text-7xl text-center py-2 text-white font-Ayer uppercase md:text-7xl lg:text-8xl xl:text-9xl " data-aos="fade-down" data-aos-duration="500" data-aos-once="true" data-aos-delay="100">Scegli il tuo immobile</h1> <br><br>
        <h1 class="text-3xl text-white text-center font-Ayer tracking-wide md:text-4xl xl:text-5xl 2xl:text-6xl" data-aos="fade-down" data-aos-duration="800" data-aos-once="true" data-aos-delay="300">Per il resto ci occuperemo tutto noi</h1> <br><br>
             </div>


             <div class="mx-3 md:mx-8 my-10 ">


             <form method="post" action="immobili.php" class="max-md:hidden">


<div class="flex gap-6 ">
    <div class=" rounded-lg border border-white p-2 xl:p-4">
<label for="filtro_provincia" class="text-white">Provincia:</label>
<select id="filtro_provincia" name="filtro_provincia" class="rounded-md bg-transparent border-none text-white">
<option class='text-black'  value="">Tutte</option>
    <?php
    // Esegui la query per ottenere le province distinte dalla tabella immobili
    $query_province = "SELECT DISTINCT provincia FROM immobili";
    $result_province = mysqli_query($conn, $query_province);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_province)) {
        $selected = (!empty($filtroProvincia) && $row['provincia'] == $filtroProvincia) ? 'selected' : '';


        echo "<option class='text-black' value='{$row['provincia']}'>{$row['provincia']}</option>";
    }
    ?>
</select>
</div>

<div class=" rounded-lg border border-white p-2 xl:p-4">
<label for="filtro_comune" class="text-white">Comune:</label>
<select id="filtro_comune" name="filtro_comune" class="rounded-md bg-transparent border-none text-white">
<option class='text-black'  value="">Tutte</option>
    <?php
    // Esegui la query per ottenere le province distinte dalla tabella immobili
    $query_comune = "SELECT DISTINCT comune FROM immobili";
    $result_comune = mysqli_query($conn, $query_comune);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_comune)) {
        echo "<option class='text-black' value='{$row['comune']}'>{$row['comune']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_comune)) {
        echo "<a href='#' onclick=\"document.getElementById('resetComune').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_comune' value='1'>";
    }
    ?>
</div>

<div class=" rounded-lg border border-white p-2 xl:p-4">
<label for="filtro_tipo_vendita" class="text-white">Contratto:</label>
<select id="filtro_tipo_vendita" name="filtro_tipo_vendita" class="rounded-md bg-transparent border-none text-white">
<option value="">Tutti</option>
    <?php
    // Esegui la query per ottenere i tipi di vendita distinti dalla tabella immobili
    $query_tipo_vendita = "SELECT DISTINCT tipo_vendita FROM immobili";
    $result_tipo_vendita = mysqli_query($conn, $query_tipo_vendita);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_tipo_vendita)) {
        echo "<option class='text-black' value='{$row['tipo_vendita']}'>{$row['tipo_vendita']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_tipo_vendita)) {
        echo "<a href='#' onclick=\"document.getElementById('resetTipoVendita').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_tipo_vendita' value='1'>";
    }
    ?>
</div>

<div class=" rounded-lg border border-white p-2 xl:p-4">
<label for="filtro_tipo_immobile" class="text-white">Tipologia:</label>
<select id="filtro_tipo_immobile" name="filtro_tipo_immobile" class="rounded-md bg-transparent border-none text-white">
    <option value="">Tutti</option> 
    <?php
    // Esegui la query per ottenere i tipi di immobile distinti dalla tabella immobili
    $query_tipo_immobile = "SELECT DISTINCT tipo_immobile FROM immobili";
    $result_tipo_immobile = mysqli_query($conn, $query_tipo_immobile);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_tipo_immobile)) {
        echo "<option class='text-black' value='{$row['tipo_immobile']}'>{$row['tipo_immobile']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_tipo_immobile)) {
        echo "<a href='#' onclick=\"document.getElementById('resetTipoImmobile').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_tipo_immobile' value='1'>";
    }
    ?>
</div>

<input type="submit" value="Cerca" class="text-white px-6 bg-green-700 rounded-lg border-white border hover:scale-105 transition-all">
</div>
</form>

<form id="resetFiltri" method="post" action="immobili.php">
    <input type="hidden" name="reset_filtri" value="1">
</form>

<form method="post" action="immobili.php" class="md:hidden">


<div class="flex gap-2 ">
<div class="w-1/2 flex flex-col gap-4">
    <div class="flex flex-col rounded-lg border border-white max-[500px]:p-1 p-2 xl:p-4">
<label for="filtro_provincia" class="text-white">Provincia:</label>
<select id="filtro_provincia" name="filtro_provincia" class="rounded-md bg-transparent border-none text-white">
<option class='text-black'  value="">Tutte</option>
    <?php
    // Esegui la query per ottenere le province distinte dalla tabella immobili
    $query_province = "SELECT DISTINCT provincia FROM immobili";
    $result_province = mysqli_query($conn, $query_province);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_province)) {
        $selected = (!empty($filtroProvincia) && $row['provincia'] == $filtroProvincia) ? 'selected' : '';


        echo "<option class='text-black' value='{$row['provincia']}'>{$row['provincia']}</option>";
    }
    ?>
</select>
</div>

<div class="flex flex-col rounded-lg border border-white max-[500px]:p-1 p-2 xl:p-4">
<label for="filtro_comune" class="text-white">Comune:</label>
<select id="filtro_comune" name="filtro_comune" class="rounded-md bg-transparent border-none text-white">
<option class='text-black'  value="">Tutte</option>
    <?php
    // Esegui la query per ottenere le province distinte dalla tabella immobili
    $query_comune = "SELECT DISTINCT comune FROM immobili";
    $result_comune = mysqli_query($conn, $query_comune);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_comune)) {
        echo "<option class='text-black' value='{$row['comune']}'>{$row['comune']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_comune)) {
        echo "<a href='#' onclick=\"document.getElementById('resetComune').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_comune' value='1'>";
    }
    ?>
</div>
</div>
<div class="w-1/2 flex flex-col gap-4">
<div class=" flex flex-col rounded-lg border border-white max-[500px]:p-1 p-2 xl:p-4">
<label for="filtro_tipo_vendita" class="text-white">Contratto:</label>
<select id="filtro_tipo_vendita" name="filtro_tipo_vendita" class="rounded-md bg-transparent border-none text-white">
<option value="">Tutti</option>
    <?php
    // Esegui la query per ottenere i tipi di vendita distinti dalla tabella immobili
    $query_tipo_vendita = "SELECT DISTINCT tipo_vendita FROM immobili";
    $result_tipo_vendita = mysqli_query($conn, $query_tipo_vendita);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_tipo_vendita)) {
        echo "<option class='text-black' value='{$row['tipo_vendita']}'>{$row['tipo_vendita']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_tipo_vendita)) {
        echo "<a href='#' onclick=\"document.getElementById('resetTipoVendita').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_tipo_vendita' value='1'>";
    }
    ?>
</div>

<div class="flex flex-col rounded-lg border border-white  max-[500px]:p-1 p-2 xl:p-4">
<label for="filtro_tipo_immobile" class="text-white">Tipologia:</label>
<select id="filtro_tipo_immobile" name="filtro_tipo_immobile" class="rounded-md bg-transparent border-none text-white">
    <option value="">Tutti</option> 
    <?php
    // Esegui la query per ottenere i tipi di immobile distinti dalla tabella immobili
    $query_tipo_immobile = "SELECT DISTINCT tipo_immobile FROM immobili";
    $result_tipo_immobile = mysqli_query($conn, $query_tipo_immobile);

    // Popola le opzioni nel menu a discesa
    while ($row = mysqli_fetch_assoc($result_tipo_immobile)) {
        echo "<option class='text-black' value='{$row['tipo_immobile']}'>{$row['tipo_immobile']}</option>";
    }
    ?>
</select>
<?php
    if (!empty($filtro_tipo_immobile)) {
        echo "<a href='#' onclick=\"document.getElementById('resetTipoImmobile').submit();\">Resetta</a>";
        echo "<input type='hidden' name='reset_tipo_immobile' value='1'>";
    }
    ?>
</div>
</div>
<input type="submit" value="Cerca" class="text-white px-2 bg-green-700 rounded-lg border-white border hover:scale-105 transition-all">
</div>
</form>

<form id="resetFiltri" method="post" action="immobili.php">
    <input type="hidden" name="reset_filtri" value="1">
</form>



<?php
// Verifica se il modulo è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera i valori selezionati
    $filtro_provincia = isset($_POST['filtro_provincia']) ? $_POST['filtro_provincia'] : '';
    $filtro_comune = isset($_POST['filtro_comune']) ? $_POST['filtro_comune'] : '';
    $filtro_tipo_vendita = isset($_POST['filtro_tipo_vendita']) ? $_POST['filtro_tipo_vendita'] : '';
    $filtro_tipo_immobile = isset($_POST['filtro_tipo_immobile']) ? $_POST['filtro_tipo_immobile'] : '';

    // Verifica se ci sono filtri selezionati prima di visualizzarli
    if (!empty($filtro_provincia) || !empty($filtro_comune) || !empty($filtro_tipo_vendita) || !empty($filtro_tipo_immobile)) {
        // Visualizza i filtri selezionati solo se ce ne sono
        echo '<div class=" text-white flex  gap-4 mt-8 max-md:gap-2">';
        echo "<p class='max-md:text-sm'>Filtri selezionati:</p>";
        echo "<ul class='flex gap-4 max-md:gap-2'>";

        echo "<div class='w-1/2 flex flex-col gap-4 max-md:gap-2'>";

        if (!empty($filtro_provincia)) {
            echo "<li class=' rounded-full bg-green-700 px-2 py-1 max-md:text-sm text-center'>Provincia:<br class='md:hidden'> {$filtro_provincia}</li>";
        }

        if (!empty($filtro_comune)) {
            echo "<li class=' rounded-full bg-green-700 px-2 py-1 max-md:text-sm text-center'>Comune:<br class='md:hidden'> {$filtro_comune}</li>";
        }
        echo "</div>";
        echo "<div class='w-1/2 flex flex-col gap-4 max-md:gap-2'>";
        if (!empty($filtro_tipo_vendita)) {
            echo "<li class=' rounded-full bg-green-700 px-2 py-1 max-md:text-sm text-center'>Contratto:<br class='md:hidden'> {$filtro_tipo_vendita}</li>";
        }

        if (!empty($filtro_tipo_immobile)) {
            echo "<li class=' rounded-full bg-green-700 px-2 py-1 max-md:text-sm text-center'>Tipologia:<br class='md:hidden'> {$filtro_tipo_immobile}</li>";
        }
        

        echo "</div>";
echo "<li class=' text-center max-md:text-sm'><a href='#' onclick=\"document.getElementById('resetFiltri').submit();\">Resetta filtri</a></li>";
        echo "</ul>";
        echo "</div>";
    }
}
?>


</div>

<?php
function buildFilterURL() {
    $filterURL = '';

    // Aggiungi i filtri attivi all'URL
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        foreach ($_POST as $key => $value) {
            // Ignora altri campi del modulo e campi vuoti
            if ($key !== 'filtro_provincia' && $key !== 'filtro_comune' && $key !== 'filtro_tipo_vendita' && $key !== 'filtro_tipo_immobile' || empty($value)) {
                continue;
            }

            // Codifica correttamente i valori per l'URL
            $encodedValue = urlencode($value);

            // Aggiungi il filtro all'URL
            $filterURL .= "&$key=$encodedValue";
        }
    }

    return $filterURL;
}

// Numero di risultati per pagina
$limit = 8;

// Pagina corrente, default è la prima pagina
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calcola l'offset per la query
$offset = ($page - 1) * $limit;

// Query per ottenere il numero totale di risultati con filtri
$filterQuery = "SELECT COUNT(*) as total FROM immobili WHERE 1";

// Costruisci la parte di query con i filtri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera i dati dal modulo di ricerca
    $filtroProvincia = isset($_POST['filtro_provincia']) ? mysqli_real_escape_string($conn, $_POST['filtro_provincia']) : '';
    $filtroComune = isset($_POST['filtro_comune']) ? mysqli_real_escape_string($conn, $_POST['filtro_comune']) : '';
    $filtroTipoVendita = isset($_POST['filtro_tipo_vendita']) ? mysqli_real_escape_string($conn, $_POST['filtro_tipo_vendita']) : '';
    $filtroTipoImmobile = isset($_POST['filtro_tipo_immobile']) ? mysqli_real_escape_string($conn, $_POST['filtro_tipo_immobile']) : '';

    // Aggiungi i filtri alla query di conteggio
    if (!empty($filtroProvincia)) {
        $filterQuery .= " AND provincia = '$filtroProvincia'";
    }

    if (!empty($filtroComune)) {
        $filterQuery .= " AND comune = '$filtroComune'";
    }

    if (!empty($filtroTipoVendita)) {
        $filterQuery .= " AND tipo_vendita = '$filtroTipoVendita'";
    }

    if (!empty($filtroTipoImmobile)) {
        $filterQuery .= " AND tipo_immobile = '$filtroTipoImmobile'";
    }
}

// Esegui la query di conteggio
$countResult = mysqli_query($conn, $filterQuery);

// Calcola il numero totale di pagine
if ($countResult) {
    $row = mysqli_fetch_assoc($countResult);
    $totalResults = $row['total'];
    $totalPages = ceil($totalResults / $limit);
} else {
    $totalPages = 0;
}

// Query per ottenere gli immobili con paginazione e filtri
$query = "SELECT * FROM immobili WHERE 1";

// Aggiungi i filtri alla query principale
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($filtroProvincia)) {
        $query .= " AND provincia = '$filtroProvincia'";
    }

    if (!empty($filtroComune)) {
        $query .= " AND comune = '$filtroComune'";
    }

    if (!empty($filtroTipoVendita)) {
        $query .= " AND tipo_vendita = '$filtroTipoVendita'";
    }

    if (!empty($filtroTipoImmobile)) {
        $query .= " AND tipo_immobile = '$filtroTipoImmobile'";
    }
}

// Aggiungi la parte di paginazione alla query principale
$query .= " LIMIT $limit OFFSET $offset";

// Esegui la query principale
$result = mysqli_query($conn, $query);

// Visualizza gli immobili
if ($result && mysqli_num_rows($result) > 0) {
    echo '<div class="risultati-immobili">';
    
    while ($row = mysqli_fetch_assoc($result)) {
   

        echo '<div class="mt-12 bg-neutral-800 w-full min-h-[350px] max-h-[350px] xl:min-h-[450px] xl:max-h-[450px] flex text-white shadow-md shadow-black hover:shadow-lg hover:shadow-green-800 transition-all max-lg:hidden   ">
        <a href="dettaglio_immobile.php?id=' . $row['id_immobile'] . '" class=" flex">

        <div class="relative w-1/3 h-full  overflow-hidden">
            <img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-full  object-cover">
        </div>
            <div class="flex flex-col  justify-between   gap-6  lg:w-2/3 ">
                <h1 class="text-5xl break-normal  font-Grotesk uppercase bg-green-800 px-8 py-4 shadow-md shadow-neutral-900 ">' . $row['titolo'] . '</h1>
                <div class="mx-16  ">
                <p class="font-Unna text-3xl pt-2 mb-6">€ ' . $row['prezzo'] . '</p>    
                <div class="flex justify-between ">
                <div class="flex items-center max-xl:hidden  ">';

        $maxLength = 120; // Imposta la lunghezza massima desiderata
        $description = $row['descrizione'];

        if (strlen($description) > $maxLength) {
        $shortDescription = substr($description, 0, $maxLength) . '...';
        echo '<p class="text-xl break-normal" style="max-width: 90%;">' . nl2br($shortDescription) . '</p>';
        } else {
        echo '<p class="text-xl break-normal" style="max-width: 90%;">' . nl2br($description) . '</p>';
        }

        echo '</div>

        <div class="flex justify-end mx-20 px-8 gap-12 max-xl:hidden text-xl  ">
        <div class="flex-col">
            <p class="py-4 flex gap-4"><img src="/img/camere2.svg" alt="" class="w-12 h-10">' . $row['camere'] . '</p>
            <p class="pt-4 flex gap-4"><img src="/img/bagni2.svg" alt="" class="w-12 h-10">' . $row['bagni'] . '</p>
        </div>
        <div class="flex-col">
            <p class="py-4 flex gap-4"><img src="/img/mq.svg" alt="" class="w-10 h-10">' . $row['metri_quadrati'] . 'M²</p>
            <p class="pt-4 flex gap-4"><img src="/img/piani.svg" alt="" class="w-12 h-10">' . $row['piani'] . '</p>
        </div>
        </div>
        </div>';

        echo '<div class="flex   max-sm:justify-center justify-end items-center w-full px-4  gap-8 xl:hidden text-xl ">
                    
        <p class="flex items-center justify-center gap-4"><img src="/img/camere2.svg" alt="" class="w-8 h-8">' . $row['camere'] . '</p>
        <p class=" flex items-center justify-center gap-4"><img src="/img/bagni2.svg" alt="" class="w-8 h-8">' . $row['bagni'] . '</p>
        <p class=" flex items-center justify-center gap-4"><img src="/img/mq.svg" alt="" class="w-8 h-8">' . $row['metri_quadrati'] . 'M²</p>
        <p class=" flex items-center justify-center gap-4"><img src="/img/piani.svg" alt="" class="w-8 h-8">' . $row['piani'] . '</p>
        </div>';

        echo '<div class="border-t border-green-800 w-[95%]  font-Merriweather text-lg mt-6  mb-8 flex  gap-8 xl:text-xl">
            
        <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8"> ' . $row['tipo_immobile'] . '</p>
        <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8"> ' . $row['comune'] . '</p>
        <p class="pt-4 ml-auto">Rif. ' . $row['id_immobile'] . '</p>
        </div>';

        echo '<!-- Aggiungi altri dettagli dell\'immobile che desideri mostrare -->
        </div>
        </div>
        </div>

        <div class="mx-auto mb-10 bg-neutral-800 w-[80%] max-h-[700px] overflow-hidden flex rounded-sm text-white shadow-md shadow-black hover:shadow-lg hover:shadow-green-800 transition-all flex-col justify-center lg:hidden">

        <div class="relative w-full h-full  overflow-hidden"> <a href="dettaglio_immobile.php?id=' . $row['id_immobile'] . '" class="">
        <img src="' . $row['foto_principale'] . '" alt="Anteprima" class=" w-full h-full  object-cover rounded-t-sm">
        </div>

        <div class="flex flex-col gap-4  min-h-[300px] ">
        <div class="bg-green-800 px-8 py-4 shadow-md shadow-neutral-900">
        <h1 class="text-2xl break-normal uppercase sm:text-3xl md:text-4xl ">' . $row['titolo'] . '</h1>
        </div>
        <div class="mx-8">
        <p class="font-Unna text-2xl sm:text-3xl ">€ ' . $row['prezzo'] . '</p>

        <div class="flex justify-between gap-4">
        <p class="pt-4 flex flex-col justify-end text-sm sm:text-lg items-start gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "> ' . $row['tipo_immobile'] . '</p>

        <div class="flex justify-end px-2 gap-4  text-sm sm:text-lg ">
        <div class="flex-col">
            <p class="py-4 flex gap-2"><img src="/img/camere2.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 ">' . $row['camere'] . '</p>
            <p class="pt-4 flex gap-2"><img src="/img/bagni2.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 ">' . $row['bagni'] . '</p>
        </div>
        <div class="flex-col">
            <p class="py-4 flex gap-2"><img src="/img/mq.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 ">' . $row['metri_quadrati'] . 'M²</p>
            <p class="pt-4 flex gap-2"><img src="/img/piani.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6">' . $row['piani'] . '</p>
        </div>
        </div>
        </div>
        <div class="border-t border-green-700 w-[95%] mt-4 font-Merriweather text-md pb-8 flex gap-8">

        <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6"> ' . $row['comune'] . '</p>
        <p class="pt-4 ml-auto">Rif. ' . $row['id_immobile'] . '</p>
        </div>
        </div>
        </div>
        </div>
        </a>';
    }

    echo '</div>';

    echo '<div class="pagination mt-8 relative float-right">';

    // Numero fisso di pagine da mostrare inizialmente
    $visiblePages = 3;
    
    // Calcola il range di pagine da visualizzare
    $startPage = max(1, $page - $visiblePages + 1);
    $endPage = min($totalPages, $startPage + $visiblePages - 1);
    
    // Aggiungi il link per visualizzare tutte le pagine precedenti
    if ($startPage > 1) {
        // Aggiungi i filtri alla URL
        $filterURL = buildFilterURL();
        echo '<a href="?page=1' . $filterURL . '" class="ml-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">1</a>';
        if ($startPage > 2) {
            echo '<span class="ml-4 px-4 py-2 text-gray-500">...</span>';
        }
    }
    
    // Visualizza i link di navigazione per il range di pagine
    for ($i = $startPage; $i <= $endPage; $i++) {
        // Aggiungi uno sfondo diverso al numero della pagina corrente
        $bgClass = ($i == $page) ? 'bg-green-800' : 'bg-green-700';
    
        // Aggiungi i filtri alla URL
        $filterURL = buildFilterURL();
        echo '<a href="?page=' . $i . $filterURL . '" class="ml-4 px-4 py-2 ' . $bgClass . ' text-white rounded hover:bg-green-800">' . $i . '</a>';
    }
    
    // Aggiungi il link per visualizzare l'ultima pagina
    if ($endPage < $totalPages) {
        if ($endPage < $totalPages - 1) {
            echo '<span class="ml-4 px-4 py-2 text-gray-500">...</span>';
        }
        // Aggiungi i filtri alla URL
        $filterURL = buildFilterURL();
        echo '<a href="?page=' . $totalPages . $filterURL . '" class="ml-4 px-4 py-2 bg-green-700 text-white rounded hover:bg-green-800">' . $totalPages . '</a>';
    }
    
    echo '</div>';
    

} else {
    echo "<p class='text-white mt-6 mx-8'>Nessun risultato trovato.</p>";
}

// Chiudi la connessione al database
mysqli_close($conn);
?>

    


   
<br><br>


    <div class="bg-neutral-950 pt-16 border-t border-white px-4 lg:px-10   flex flex-col   ">
 
 <div class="mx-8">
     <div class="flex justify-between gap-4 md:gap-0">
 <div class=" flex  flex-col items-center md:items-start gap-10 md:gap-6 lg:ml-6 w-1/3">
            
             <button onclick="effettuaChiamatacell()" class="flex items-center hover:scale-105 transition-all">
                 <div class=" bg-green-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
                 <img src="/img/cellulare.png" alt="" class="w-6 h-6"></div> 
                 <div class="flex items-center text-white">
                 <p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">3289086227</p></div>
             </button>
             
             
             <button onclick="effettuaChiamata()" class="flex items-center hover:scale-105 transition-all">
                 <div class=" bg-white text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
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
                 </svg> </div>
                 <div class="flex items-center text-white">
                 <p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">0952274123</p></div>
             </button>
            
             
             <a href="mailto:segreteria@premiahome.it?subject=Oggetto%20della%20mail&body=Testo%20del%20messaggio" target="_blank">
             <button class="flex items-center hover:scale-105 transition-all">
                 <div class=" bg-red-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
                 <img src="/img/email.png" alt="" class="w-6 h-6"></div>
                 <div class="flex items-center text-white">
                 <p class="hidden ml-4 text-sm md:block lg:text-md xl:ml-8 xl:text-xl">segreteria@premiahome.it</p></div>
             </button></a>
             
            
         </div>
 
         <div class="flex flex-col gap-4   text-left md:text-lg lg:text-xl transition-all uppercase w-fit mx-4 max-xl:text-center">
     <a href="/dist/index.php"  class="text-white  mb-2">
     <p class="">IMMOBILI IN EVIDENZA</p> 
     </a>
     <a href="/dist/immobili.php"  class="text-white  mb-2">
     <p class="">cerca il tuo immobile</p> 
     </a>
     <a href="/dist/about.html"  class="text-white  mb-2">
     <p class="">scopri chi siamo</p> 
     </a>
     <a href="/dist/contatti.html"  class="text-white ">
     <p class="">parla con noi</p> 
     </a>
 </div>
 
         <div class="flex flex-col gap-4 items-center md:items-end  lg:mr-6 text-2xl md:text-lg lg:text-xl transition-all w-1/3 max-md:hidden ">
     <a href="https://www.facebook.com/tuapagina" target="_blank" class="text-white hover:text-blue-700 hover:scale-105 mb-2">
         <i class="fab fa-facebook "></i> Facebook
     </a>
     <a href="https://www.instagram.com/tuapagina" target="_blank" class="text-white hover:text-purple-700 hover:scale-105 mb-2">
         <i class="fab fa-instagram"></i> Instagram
     </a>
     <a href="https://www.youtube.com/tuapagina" target="_blank" class="text-white hover:text-red-700 hover:scale-105 mb-2">
         <i class="fab fa-youtube"></i> YouTube
     </a>
     <a href="https://www.linkedin.com/company/tuapagina" target="_blank" class="text-white hover:text-blue-900 hover:scale-105">
         <i class="fab fa-linkedin"></i> LinkedIn
     </a>
 </div>
 
 <div class="flex flex-col gap-4 items-center md:items-end  lg:mr-6 text-2xl md:text-lg lg:text-xl transition-all w-1/3 md:hidden ">
     <a href="https://www.facebook.com/tuapagina" target="_blank" class="text-white hover:text-blue-700 hover:scale-105 mb-2">
         <i class="fab fa-facebook "></i> <p class="hidden  ">Facebook</p>
     </a>
     <a href="https://www.instagram.com/tuapagina" target="_blank" class="text-white hover:text-purple-700 hover:scale-105 mb-2">
         <i class="fab fa-instagram"></i> <p class="hidden ">Instagram</p>
     </a>
     <a href="https://www.youtube.com/tuapagina" target="_blank" class="text-white hover:text-red-700 hover:scale-105 mb-2">
         <i class="fab fa-youtube"></i> <p class="hidden ">YouTube</p>
     </a>
     <a href="https://www.linkedin.com/company/tuapagina" target="_blank" class="text-white hover:text-blue-900 hover:scale-105">
         <i class="fab fa-linkedin"></i> <p class="hidden ">LinkedIn</p>
     </a>
 </div>
 
 </div>
 <br>
 <div class="flex gap-8 mt-6 lg:ml-6">
             <p class="text-white ">Lun-Ven: 9-13 / 15-19</p>
             <div class="border-l border-white"></div>
             <p class="text-white ">Sabato: 9-13</p>
         </div>
     <br>
     <div class="flex  justify-between items-end lg:mx-6 pb-8 border-t gap-16 border-red-700 text-sm">
     <p class="text-white xl:text-lg  mt-6">Premia Home S.P.A. - P.IVA: 06024760875 -  Viale jonio 35, Catania (CT)</p> 
 
     <p class="text-white  font-medium mt-6">Website by SDT Copy Sales</p>
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

</body>

</html>

<?php
} }
?>
