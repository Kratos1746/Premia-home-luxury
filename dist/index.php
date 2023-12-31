<?php 

include './php/db_connection.php';

			
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href = "/dist/font/style.css" rel = "stylesheet" type = "text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Familjen+Grotesk&display=swap" rel="stylesheet">

  <title>PremiaHome-Luxury</title>
</head>



<body class="overflow-x-hidden font-Grotesk tracking-wide">

  
  <div class="bg-neutral-900 min-h-screen flex flex-col">
      <nav id="nav-1024" class="max-lg:hidden lg:block  z-10   w-full fixed py-10 "data-aos="fade-down" data-aos-duration="600" data-aos-once="true">
          <div class="flex items-center justify-between ">
              <img src="/img/logo-ombra.png" alt="Logo" id="Logo-1024" class="h-18 w-60 ml-8 mt-6 z-10 fixed top-0 left-0 ">
              
              <div id="menu-1024" class="  space-x-8  text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2 ">
                  <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all">Home</a>
                  <a href="/dist/immobili.php" class="text-white hover:scale-105 transition-all">Immobili</a>
                  <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                  <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
              </div>
              
              <img src="/img/logo-ombra.png" alt="Logo" class="h-18 w-52 mr-2 opacity-0 pointer-events-none">
          </div>
      </nav>

      <nav id="nav" class=" lg:hidden p-4 z-10  min-[1780px]:py-6 md:px-14 fixed w-full py-16  "data-aos="fade-down" data-aos-duration="600" data-aos-once="true">
        <div class="flex items-center justify-between  ">
            <img src="/img/logo-ombra.png" alt="Logo" id="Logo" class="h-18 w-48 ml-8 mt-6 z-10 fixed top-0 left-0 ">

            <button id="toggleButton" class="transition-all   " onclick="toggleMenu()">
              <img src="/img/menu-ita.png" alt="Logo" id="hamburger" class="h-14 w-14 ml-1 mr-8 mt-8 z-10 cursor-pointer fixed top-0 right-0">
              <img src="/img/x.png" alt="Logo" id="X" class="hidden h-12 w-12 ml-1 mr-4 mt-8 z-10 cursor-pointer fixed top-0 right-0">
            </button>

            <div id="menu" class="bar hidden fixed left-0 top-0 py-10 px-8 text-center bg-neutral-800 w-full z-0">
            <div class=" flex flex-col text-xl font-semibold   gap-8">
                <a href="#" class="text-green-600  underline underline-offset-4 hover:scale-105 transition-all ">Home</a>
                <div class=" border-b mx-12 "></div>
                <a href="/dist/immobili.php" class="text-white hover:scale-105 transition-all">Immobili</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/about.html" class="text-white hover:scale-105 transition-all">Chi Siamo</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/contatti.html" class="text-white hover:scale-105 transition-all">Contatti</a>
            </div>
            </div>
            
        </div>
    </nav>
  
      
          <video src="/img/video-home.mp4" class="absolute h-full w-full object-cover brightness-50 " autoplay loop>
           
          </video>
      <div class="absolute top-0 z-0">
      <div class="relative flex flex-col justify-center items-center min-h-screen text-center font-Ayer mx-4 text-white z-10">  
        <h1 class="text-7xl uppercase md:text-[112px] lg:text-9xl xl:text-[142px]  2xl:text-[160px]">Dai <span class="font-semibold"><span class="text-green-800">va</span>lo<span class="text-red-800">re</span></span> al tuo immobile</h1> <br>
        <p class="text-3xl md:text-4xl lg:text-5xl 2xl:text-6xl tracking-wide ">Premia Home Luxury: agenzia per immobili di lusso</p>
       </div> 

<div class="flex flex-row items-center ">
  <div class="w-1/3 bg-green-800 py-4 shadow-2xl shadow-green-700"></div>
  <div class="w-1/3 bg-white py-4 shadow-2xl shadow-white"></div>
  <div class="w-1/3 bg-red-900 py-4 shadow-2xl shadow-red-800"></div>
</div>

<?php


// Query per ottenere gli immobili in evidenza
$query = "SELECT * FROM immobili WHERE in_evidenza = 1 LIMIT 3";
$result = mysqli_query($conn, $query);

if ($result) {
    // Itera sui risultati della query
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
<div class="bg-neutral-900">
<br>
<br>

<h1 class="text-7xl uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer text-center text-white " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >In evidenza</h1> <br>

       <br><br>  <div class=" mx-auto bg-neutral-800 w-[50%] lg:w-1/3  overflow-hidden flex rounded-sm  text-white shadow-md shadow-black hover:shadow-lg hover:shadow-black transition-all flex-col justify-center ">
        <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class="w-[100%]  rounded-t-sm ">
    
        <div class="flex flex-col justify-between mt-4  gap-10  mx-6 ">
            <h1 class="text-5xl break-normal"><?php echo $row['titolo']; ?></h1>
            <p class="font-Unna text-3xl pt-2">€ <?php echo $row['prezzo']; ?></p>

            <div class="flex   max-sm:justify-center justify-end items-center w-full px-4  gap-8 ">
                
            <p class="flex items-center justify-center gap-4"><img src="/img/camere2.svg" alt="" class="w-8 h-8"><?php echo $row['camere']; ?></p>
            <p class=" flex items-center justify-center gap-4"><img src="/img/bagni2.svg" alt="" class="w-8 h-8"><?php echo $row['bagni']; ?></p>
            <p class=" flex items-center justify-center gap-4"><img src="/img/mq.svg" alt="" class="w-8 h-8"><?php echo $row['metri_quadrati']; ?>M²</p>
            <p class=" flex items-center justify-center gap-4"><img src="/img/piani.svg" alt="" class="w-8 h-8"><?php echo $row['piani']; ?></p>
    
        </div>

        <div class="border-t border-white w-[95%] font-Merriweather text-lg   mb-8 flex   gap-8">
            
            <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8"> <?php echo $row['tipo_immobile']; ?></p>
            <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8"> <?php echo $row['comune']; ?></p>
            <p class="pt-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
        </div>
 

        

            
            <!-- Aggiungi altri dettagli dell'immobile che desideri mostrare -->
        </div>
    </div>
    </a>
  
    <?php }
} else {
    echo "Errore nella query: " . mysqli_error($conn);
}

// Chiudi la connessione al database
mysqli_close($conn);

?>

<br>
<div class="border border-white w-[90%] mt-10 mx-auto"></div>
</div>
       <div class=" px-5 pt-10 flex flex-col justify-center items-center bg-neutral-900 text-white md:px-10 lg:px-12 lg:py-14 xl:px-32"> <br>
        <h1 class="text-7xl uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >Premia Home</h1> <br><br><br>
        <p class="text-base md:text-lg lg:text-xl xl:text-2xl  font-Grotesk tracking-wide ">
          A differenza delle altre agenzie immobiliari, Premia Home è una società di intermediazione immobiliare partecipata a maggioranza dalla Holding del gruppo Premia (<b>S.p.A.</b>). <br><br>

          La nostra società <b>non</b> si occupa solamente di immobiliare, ma offriamo anche servizi <b>finanziari…</b></p> <br><br>

          <button class="p-4 bg-transparent border-4 border-green-800 rounded-md text-lg md:text-2xl lg:text-3xl animate-pulse xl:p-5 hover:bg-green-800 hover:border-white transition-all">Scopri di più</button>
          <br>
          <br>
       </div>
      
       <div class=" flex flex-col justify-center bg-neutral-800 text-white pt-16 pb-10 px-2">
        <div class=" flex flex-row ">
        <div class="w-1/2 px-4 text-center lg:px-16 "data-aos="fade-left" data-aos-duration="600" data-aos-once="true">
        <p class="text-4xl md:text-6xl lg:text-7xl xl:text-7xl 2xl:text-8xl text-center font-medium font-Ayer uppercase">Voglio acquistare casa</p> <br><br>
        <p class="text-base md:text-lg lg:text-xl xl:text-4xl font-Grotesk tracking-wide  ">L’acquisto di un immobile è sempre molto impegnativo. Attraverso le collaborazioni con altre agenzie immobiliari, possiamo offrirti un ampio <b>catalogo</b> di immobili per scegliere la tua casa ideale.</p>
        </div>
        <div class="w-1 bg-white z-10"></div>
        <div class="w-1/2 px-4 text-center lg:px-16  " data-aos="fade-right" data-aos-duration="600" data-aos-once="true">
        <p class="text-4xl md:text-6xl lg:text-7xl xl:text-7xl 2xl:text-8xl text-center font-medium font-Ayer uppercase">Voglio vendere casa</p> <br><br>
        <p class="text-base md:text-lg lg:text-xl xl:text-4xl font-Grotesk tracking-wide ">Mettiamo a disposizione gli strumenti e le competenze per vendere <b>rapidamente</b> casa tua al prezzo più alto di mercato.
          Il nostro team è composto da professionisti del settore che ti seguiranno in ogni aspetto della vendita: analisi dei documenti, studio del mercato e strategia di sponsorizzazione <b>esclusiva</b> per la tua casa</p>
       </div>
      </div>
      <br><br><br>
       <div class="flex justify-center py-8 ">
       <button type="submit" onclick="effettuaChiamata()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black transition-all md:w-[60%] lg:w-[50%] max-w-[550px] ">Voglio un appuntamento</button>
      </div>
    </div>


    <div id="section8" class=" min-h-full flex flex-col w-[100%] justify-center items-center px-4 lg:px-8 py-16 text-white bg-neutral-900">

      <h1 class="text-2xl text-center mt-8 md:text-3xl xl:text-4xl font-medium">Sappiamo quanto sia importante l’acquisto o la vendita di una casa. </h1> <br><br>
      <br>
      <h1 class="text-3xl  text-center">E noi facciamo tutto per darti il meglio.</h1> <br><br>

      <button type="submit" onclick="effettuaChiamata()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black transition-all md:w-[60%] lg:w-[50%] max-w-[550px] ">Voglio un appuntamento</button>
  <br>

  </div>


<div class="bg-neutral-950 py-4 px-8 flex md:justify-between   ">
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



    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

    <script>
      AOS.init();
  </script>

<script src="index.js"></script>

</body>
</html>