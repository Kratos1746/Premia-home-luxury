<?php

include './php/db_connection.php';

if (isset($_GET['id'])) {
    $id_immobile = $_GET['id'];

    $query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

     
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


</head>

<body class="overflow-x-hidden font-Grotesk">
    
<div class="bg-neutral-900 min-h-screen h-full flex flex-col">
<nav id="nav-1024" class="max-lg:hidden lg:block  z-10 pt-4   w-full fixed ">
          <div class="flex items-center justify-between ">
            <div class=" w-1/3 mt-12">
              <img src="/img/logo-ombra.png" alt="Logo" id="Logo-1024" class="h-18 w-60 ml-8 mt-6 z-10 fixed top-0 left-0 ">
              </div>

              <div class=" w-1/3 mt-8 flex items-center">
              <div id="menu-1024" class="  space-x-8  text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2 ">
                  <a href="/dist/index.php" class=" text-white hover:scale-105 transition-all">Home</a>
                  <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all">Immobili</a>
                  <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                  <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
              </div>
              </div>
              
              <div id="button-login" class=" w-1/3 flex items-center justify-center mt-6   gap-10 ">
              <button id="toggleLogin" onclick="toggleLogin()" class=" max-md:hidden flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>
            <?php

     
            // Controlla se l'utente è autenticato
            if (isset($_SESSION['ID'])) {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                echo '</button>';
        
            }
            ?>

        </div>
         
           
            <form action="./php/login.php" method="POST" id="login" class="hidden bg-neutral-700 py-6 px-6 pt-6 fixed top-16 right-4 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2">

            <img src="/img/x.png" alt="Logo" id="Xmini" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">

            <div class="my-4">
                <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 pr-6 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-white text-sm font-medium mb-2">Password</label>
                <input type="password" id="password" name="password" class="w-full p-2 pr-6 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-6">
                <label class="block text-white text-sm font-medium mb-2">
                    Non hai un account? <a href="registrazione.php" class="text-green-500 hover:underline">Crealo ora.</a>
                </label>
            </div>

           
            <input type="submit" value="Accedi" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 xl:text-xl">
            </form>

            
             <!-- <img src="/img/logo-ombra.png" alt="Logo" class="h-18 w-52 mr-2 opacity-0 pointer-events-none">-->
             
          
      </nav>

      <nav id="nav" class=" lg:hidden  z-10   fixed w-full   ">
        <div class="flex items-center justify-between  ">
        <div class=" w-1/3 mt-12">
            <img src="/img/logo-ombra.png" alt="Logo" id="Logo" class="h-18 w-48 ml-8 mt-6 z-10 fixed top-0 left-0 ">
        </div>

            <div class=" w-1/3 flex justify-center py-5  gap-10 max-md:hidden ">
            <button id="toggleLoginMini" onclick="toggleLogin()" class="  flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
                <?php

           
            if (isset($_SESSION['ID'])) {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                echo '</button>';
        
            }
                ?>

            </button>
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
   
            <div class="mb-6">
    <label class="block text-white text-sm font-medium mb-2">
        Non hai un account? <a href="registrazione.php" class="text-green-500 hover:underline">Crealo ora.</a>
    </label>
</div>
            <button type="submit" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10  xl:text-xl">Invia</button>
        </form>
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
          
        <button id="toggleMini" onclick="toggleLogin()" class="flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
            </button>
            <?php

            // Controlla se l'utente è autenticato
            if (isset($_SESSION['ID'])) {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all">';
                echo '<img src="/img/piu.svg" alt="" class="w-10 h-8">';
                echo '</button>';

            }
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
 
          <div class="mb-6">
  <label class="block text-white text-sm font-medium mb-2">
      Non hai un account? <a href="registrazione.php" class="text-green-500 hover:underline">Crealo ora.</a>
  </label>
</div>
          <button type="submit" class="bg-white float-right text-black font-medium text-lg w-full py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10  xl:text-xl">Invia</button>
      </form>
        
          
</div> 

<br><br><br>


            <div class="flex flex-col w-full  items-center bg-neutral-900 h-screen text-white ">
                <div class="w-[90%] h-[70%] overflow-hidden p-2 mt-10 rounded-t-xl border-b-0 border border-white ">
                    <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class="w-full h-full object-cover rounded-t-lg shadow-md shadow-black">
                    <h1 class="font-Ayer text-6xl uppercase text-center break-normal xl:text-7xl 2xl:text-8xl max-w-xs  xl:max-w-2xl absolute top-full left-1/2 transform -translate-x-1/2 -translate-y-full   ">
                        <?php echo $row['titolo']; ?>
                    </h1>
                    
                
                <div class="my-10 absolute  top-full left-1/2 transform -translate-x-1/2">
                <p class=" text-4xl tracking-wide">€ <?php echo $row['prezzo']; ?></p>
                </div>
            </div>
        </div>

        <div class="flex flex-col w-full  items-center bg-neutral-900 min-h-screen text-white ">

        <div class="border-b border-white w-[90%] font-Merriweather text-lg    mb-8 flex   gap-10 xl:text-2xl">
            
            <p class="pb-4 flex items-center gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8"> <?php echo $row['tipo_immobile']; ?></p>
            <p class="pb-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8"> <?php echo $row['comune']; ?></p>
            <p class="pb-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
        </div>
                <div class="flex gap-5 mt-6 ">
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-4 pr-20 text-2xl uppercase font-Grotesk">Camere</p>
                    <p class="flex  justify-end pl-20 pb-3 pr-4 text-4xl font-Ayer tracking-wider"><?php echo $row['camere']; ?></p>
                </div>
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-4 pr-20 text-2xl uppercase font-Grotesk">bagni</p>
                    <p class="flex  justify-end pl-20 pb-3 pr-4 text-4xl font-Ayer tracking-wider"><?php echo $row['bagni']; ?></p>
                </div>
                <div class="flex flex-col justify-center border border-white rounded-xl gap-3 w-[185px] ">  
                    <p class="flex justify-start pt-3 pl-4 pr-20 text-2xl uppercase font-Grotesk">M²</p>
                    <p class="flex  justify-end pl-20 pb-3 pr-4 text-4xl font-Ayer tracking-wider"><?php echo $row['metri_quadrati']; ?></p>
                </div>
      </div>
            <br><br><br>
                <div class="flex w-[90%] justify-between mt-16">

                <h1 class="uppercase text-6xl font-Ayer  xl:text-9xl text-neutral-400">Descrizione</h1>
                <p class="flex items-end text-xl max-w-[50%] break-normal font-Grotesk"><?php echo nl2br($row['descrizione']); ?></p>
                
                </div>

                <br><br><br>
                <div class="flex  w-[90%] justify-between mt-16">
                <div class="flex flex-col w-1/3">
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
                echo '<td class="pb-2 pt-6  font-bold">'.'vani' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['vani'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'camere' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['camere'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'bagni' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['bagni'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'M²' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['metri_quadrati'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'piani' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['piani'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                //Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'giardino' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['giardino'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'parcheggio' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['parcheggio'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'cucina' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['cucina'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'classe energetica' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['classe_energetica'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'balcone' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['balcone'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'EPI' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['EPI'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'soggiorno' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['soggiorno'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'riscaldamento' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['riscaldamento'] . '</td>';
                echo '</tr>';

                echo '<tr class="border-b border-white">';
                // Modifica i nomi dei campi e i valori in base al tuo schema del database
                echo '<td class="pb-2 pt-6  font-bold">'.'condizioni' . '</td>';
                echo '<td class="pb-2 pt-6 pl-4 border-l border-white mx-4 ">' . $row['condizioni'] . '</td>';
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
  


                        <div class="flex flex-col w-2/3 pl-32">
                            <h1 class="uppercase text-6xl font-Ayer  xl:text-9xl text-neutral-400">Galleria</h1>
                                            <div class="grid grid-cols-3 gap-3 mt-4">
                                            <?php
// Verifica se è stato passato un ID immobile
if (isset($_GET['id'])) {
    $id_immobile = $_GET['id'];

    // Query per ottenere i dati dell'immobile specifico
    $query = "SELECT * FROM immobili WHERE id_immobile = $id_immobile";
    $result = mysqli_query($conn, $query);

    // Verifica se ci sono risultati nella query
    if ($result && mysqli_num_rows($result) > 0) {
        // Ottieni i dati dell'immobile
        $row = mysqli_fetch_assoc($result);

        // Verifica se l'immobile ha una foto principale
        if ($row && isset($row['foto_principale'])) {
            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';
            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';

            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';
            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';
            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';
            echo '<img src="' . $row['foto_principale'] . '" alt="Anteprima" class="w-full h-auto object-cover rounded-t-lg shadow-md shadow-black">';

            // Continua con il codice per le altre foto o dati
        } else {
            echo 'Foto non disponibile';
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
                    // Assicurati che il campo nel database contenga l'URL del video
                    $videoUrl = $row['video'];
                    
                    ?>

                    <div class="flex flex-col bg-neutral-900 h-screen mt-12 w-[90%]">
                        <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">video</h1>
                        <div class="flex justify-center items-center">
                        <video controls  class=" max-w-[80%] max-h-[80%] rounded-md">
                            <source src="<?php echo $videoUrl; ?>" type="video/mp4" >
                            <!-- Aggiungi altri formati video supportati se necessario -->
                            Il tuo browser non supporta il tag video.
                        </video>
                    </div>
                    </div>

                    
                    <div class="flex flex-col bg-neutral-900 h-screen mt-12 w-[90%]">
                        <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">mappa</h1>
                        <div class="flex justify-center">
                        
                    </div>
                    </div>

                    <div class="flex flex-col bg-neutral-900 h-screen mt-12 w-[90%]">
                        <h1 class="uppercase text-6xl font-Ayer xl:text-9xl text-neutral-400">contattaci</h1>
                        <div class="flex justify-center">

                        <form action="#" method="post" class="md:w-1/2 md:mr-12 lg:mx-10 lg:mr-16 ">
            <div class="mb-4">
                <label for="nome" class="block text-white text-sm font-medium mb-2">Nome</label>
                <input type="text" id="nome" name="nome" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-4">
                <label for="cognome" class="block text-white text-sm font-medium mb-2">Cognome</label>
                <input type="text" id="cognome" name="cognome" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <?php echo '<div class="mb-4">
    <label for="messaggio" class="block text-white text-sm font-medium mb-2">Messaggio</label>
    <textarea id="mex" name="messaggio" rows="4" class="w-full p-2 border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>Spett.le PREMIA HOME S.R.L., Vi chiedo ulteriori informazioni sul Vostro annuncio Rif.' . $id_immobile . '</textarea>
</div>'; ?>



            <button type="submit" class="bg-white float-right text-black font-medium text-lg px-8 py-2 rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75 md:px-10 lg:px-16 xl:px-20 xl:py-3 xl:text-xl">Invia</button>
        </form>
                        
                    </div>
                    </div>


               </div>
            </div>

        
       
  

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

        <script>
        AOS.init();
        </script>

        <script src="index.js"></script>

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

</html>
<?php
    
    } else {
        echo "Errore nella query: " . mysqli_error($conn);
    }
} else {
    echo "ID immobile non valido";
}
?>