<?php 
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

								
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


<body class="overflow-x-hidden">



 
<div class="bg-neutral-900 min-h-screen flex flex-col">
      <nav id="nav-1024" class="max-lg:hidden lg:block  z-10   w-full fixed ">
          <div class="flex items-center justify-between ">
            <div class=" w-1/3 mt-12">
              <img src="/img/logo-ombra.png" alt="Logo" id="Logo-1024" class="h-18 w-60 ml-8 mt-6 z-10 fixed top-0 left-0 ">
              </div>

              <div class=" w-1/3 mt-8">
              <div id="menu-1024" class="  space-x-8  text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2 ">
                  <a href="/dist/index.html" class=" text-white hover:scale-105 transition-all">Home</a>
                  <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all">Immobili</a>
                  <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                  <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
              </div>
              </div>
              
              <div class=" w-1/3 flex justify-center mt-12 gap-10 ">
              <button id="toggleLogin" onclick="toggleLogin()" class=" max-md:hidden flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
               
            </button>
            <?php

            // Controlla se l'utente è autenticato
            if (isset($_SESSION['ID'])) {
                // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all  "><img src="/img/piu.svg" alt="" class="w-10 h-8"></button>';
                header("Location: new_imm.php");
            } 
            ?>
        </div>
         
           
            <form action="./php/login.php" method="POST" id="login" class="hidden bg-neutral-700 py-6 px-6 pt-6 fixed top-16 right-4 rounded-lg shadow-lg shadow-black 2xl:right-32 animate-dasopra2">

            <img src="/img/x.png" alt="Logo" id="X" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer">

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

      <nav id="nav" class=" lg:hidden p-4 z-10   md:px-14 fixed w-full   ">
        <div class="flex items-center justify-between  ">
        <div class=" w-1/3 mt-12">
            <img src="/img/logo-ombra.png" alt="Logo" id="Logo" class="h-18 w-48 ml-8 mt-6 z-10 fixed top-0 left-0 ">
        </div>

            <div class=" w-1/3 flex justify-center mt-8 gap-10 max-md:hidden ">
            <button id="toggleLoginMini" onclick="toggleLogin()" class="  flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
                <?php

                // Controlla se l'utente è autenticato
                if (isset($_SESSION['ID'])) {
                    // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
                    echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all "><img src="/img/piu.svg" alt="" class="w-10 h-8"></button>';
                    header("Location: new_imm.php");
                } 
                ?>

            </button>
            <form action="./php/login.php" method="POST" id="loginMini" class=" hidden bg-neutral-700 py-6 px-8 pt-4 fixed top-40 left-1/5 mx-4 rounded-lg  shadow-lg shadow-black md:top-24 animate-dasopra2">
            
              <img src="/img/x.png" alt="Logo" id="Xmini" onclick="toggleLogin()" class="hidden h-8 w-8 relative float-right z-10 cursor-pointer ">

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
                <a href="/dist/index.html" class="text-white hover:scale-105 transition-all ">Home</a>
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
          
        <button onclick="toggleLogin()" class="  flex items-center hover:scale-105 transition-all">
                <div class=" bg-neutral-800  px-4 py-5 rounded-full shadow-sm shadow-black hover:shadow-md hover:shadow-black">
                <img src="/img/user.svg" alt="" class="w-10 h-8"></div>  
            </button>
            <?php

// Controlla se l'utente è autenticato
if (isset($_SESSION['ID'])) {
    // L'utente è autenticato, mostra il bottone per aggiungere gli immobili
    echo '<button onclick="aggiungiImmobile()" class="bg-green-800 rounded-full p-4 py-5 text-white shadow-sm shadow-black hover:scale-105 hover:shadow-md hover:shadow-black transition-all "><img src="/img/piu.svg" alt="" class="w-10 h-8"></button>';
} 
?>
        
          
</div> 

            <br><br>
            <div class="flex flex-col justify-center items-center md:mt-16">
        <h1 class="text-5xl font-semibold text-center text-neutral-500 opacity-80 tracking-wider font-lora xl:text-6xl">Immobili</h1><br>

  
    
</div>
<br>
    <div class="w-[90%] mx-auto">
    <h1 class="text-5xl text-center py-2 text-white font-Montserrat md:text-6xl lg:text-7xl xl:text-8xl " data-aos="fade-down" data-aos-duration="500" data-aos-once="true" data-aos-delay="300">Scegli il tuo immobile</h1> <br><br>
        <h1 class="text-xl text-white text-center font-Montserrat md:text-2xl xl:text-3xl 2xl:text-4xl" data-aos="fade-down" data-aos-duration="800" data-aos-once="true" data-aos-delay="100">Per il resto ci occuperemo tutto noi</h1> <br><br>
             </div>



             <div class="bg-neutral-950 py-4 px-8 flex md:justify-between absolute bottom-0 w-full  ">
    <div class="flex flex-col">
        <div class="border-b border-red-700">
    <p class="text-white font-semibold">Premia Home S.P.A. - P.IVA: 06024760875 -  Viale jonio 35, Catania</p> <br>
</div> <br>
    <p class="text-white font-semibold">lun-ven: 9-13 / 15-19 <br>sabato: 9-13</p>
</div>
    <br>
    <div class="flex items-end pl-8">
    <p class="text-white text-sm font-semibold ">Website by SDT Copy Sales</p>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
      AOS.init();
  </script>
  
<script src="index.js"></script>

</body>

</html>