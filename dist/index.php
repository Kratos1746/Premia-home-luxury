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
<!-- Aggiungi questi link nell'head del tuo HTML -->
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />


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



<div class="bg-neutral-900  ">

<a href="/dist/immobili.php" class=""  > 
            <div class="relative float-right mr-16 xl:mr-24 pt-6 md:pt-20 h-24 w-fit  hover:scale-105 transition-all text-green-700 font-semibold z-20">
                <div class="flex flex-nowrap items-center whitespace-nowrap gap-6 animate-bounce-horizontal"> 
                  <p class="flex text-md lg:text-lg">Scopri immobili</p>
                   <img src="/img/freccia.svg" alt="" class="w-full lg:h-14 h-12 xl:h-16">
                 </div>   
            </div></a>

<div class="w-[90%] mx-auto text-center flex justify-center">
                    

        <h1 class="text-7xl  uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer text-center text-white " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >In evidenza</h1> <br>
               </div>  
                 
<br><br>
 <div class="flex">   
<?php


// Query per ottenere gli immobili in evidenza
$query = "SELECT * FROM immobili WHERE in_evidenza = 1 LIMIT 3";
$result = mysqli_query($conn, $query);

if ($result) {
    // Itera sui risultati della query
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
 <br><br> <div class="mx-auto mb-10 bg-neutral-800 w-[31%] max-h-[700px] overflow-hidden flex rounded-sm text-white shadow-md shadow-black hover:shadow-lg hover:shadow-green-800 transition-all flex-col justify-center max-lg:hidden">

<div class="relative w-full h-full  overflow-hidden"> <a href="dettaglio_immobile.php?id=<?php echo $row['id_immobile']; ?>" class="">
       <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class=" w-full h-full  object-cover rounded-t-sm">
   </div>

   <div class="flex flex-col gap-4  min-h-[300px] ">
    <div class="bg-green-800 px-8 py-4 shadow-md shadow-neutral-900">
       <h1 class="text-2xl break-normal uppercase sm:text-3xl md:text-4xl "><?php echo $row['titolo']; ?></h1>
    </div>
    <div class="mx-8">
       <p class="font-Unna text-3xl ">€ <?php echo $row['prezzo']; ?></p>

      
       <div class="flex justify-between gap-4">
       <p class="pt-4 flex flex-col justify-end  items-start gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "> <?php echo $row['tipo_immobile']; ?></p>
   
       <div class="flex justify-end px-2 gap-4  text-md  ">
       <div class="flex-col">
           <p class="py-4 flex gap-2"><img src="/img/camere2.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "><?php echo $row['camere']; ?></p>
           <p class="pt-4 flex gap-2"><img src="/img/bagni2.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "><?php echo $row['bagni']; ?></p>
       </div>
       <div class="flex-col">
           <p class="py-4 flex gap-2"><img src="/img/mq.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "><?php echo $row['metri_quadrati']; ?>M²</p>
           <p class="pt-4 flex gap-2"><img src="/img/piani.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6"><?php echo $row['piani']; ?></p>
       </div>
   </div>
         </div>
       <div class="border-t border-green-700 w-[95%] mt-4 font-Merriweather text-md pb-8 flex gap-8">
         
           <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6"> <?php echo $row['comune']; ?></p>
           <p class="pt-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
       </div>
   </div>
</div>
</div>


<div class="mx-auto bg-neutral-800 w-[31%] max-h-[700px] overflow-hidden flex rounded-sm text-white shadow-md shadow-black hover:shadow-lg hover:shadow-green-800 transition-all flex-col justify-center lg:hidden">

<div class="relative w-full h-full  overflow-hidden"> 
    <a href="dettaglio_immobile.php?id=<?php echo $row['id_immobile']; ?>" class="">
       <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class=" w-full h-full  object-cover rounded-t-sm">
   </div>

   <div class="flex flex-col justify-between mt-4  mx-8 min-h-[400px] ">
       <h1 class="text-2xl break-normal lg:text-3xl"><?php echo $row['titolo']; ?></h1>
       <p class="font-Unna text-2xl ">€ <?php echo $row['prezzo']; ?></p>

       <div class="flex justify-between gap-4">
       <p class="pt-4 flex flex-col justify-end  items-start gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"> <?php echo $row['tipo_immobile']; ?></p>
   
       <div class="flex justify-end px-2 gap-4  text-md  ">
       <div class="flex-col">
           <p class="py-4 flex gap-2"><img src="/img/camere2.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"><?php echo $row['camere']; ?></p>
           <p class="pt-4 flex gap-2"><img src="/img/bagni2.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"><?php echo $row['bagni']; ?></p>
       </div>
       <div class="flex-col">
           <p class="py-4 flex gap-2"><img src="/img/mq.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"><?php echo $row['metri_quadrati']; ?>M²</p>
           <p class="pt-4 flex gap-2"><img src="/img/piani.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"><?php echo $row['piani']; ?></p>
       </div>
   </div>
         </div>
       <div class="border-t border-green-700 w-[95%] font-Merriweather text-md pb-8 flex gap-8">
         
           <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8 max-lg:w-6 max-lg:h-6"> <?php echo $row['comune']; ?></p>
           <p class="pt-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
       </div>
   </div>
</div>



<?php }
} else {
    echo "Errore nella query: " . mysqli_error($conn);

};


?></div> 

      
 


  
    <?php 

// Chiudi la connessione al database
mysqli_close($conn);

?>



 
<br>
<div class="border border-white w-[90%] mt-10 mx-auto"></div>
</div>
       <div class=" px-5 pt-10 flex flex-col justify-center items-center bg-neutral-900 text-white md:px-10 lg:px-12 lg:py-14 xl:px-32"> <br>
        <h1 class="text-7xl uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer text-center " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >Premia Home</h1> <br><br><br>
        <p class="text-base md:text-lg lg:text-xl xl:text-2xl  font-Grotesk tracking-wide ">
          A differenza delle altre agenzie immobiliari, Premia Home è una società di intermediazione immobiliare partecipata a maggioranza dalla Holding del gruppo Premia (<b>S.p.A.</b>). <br><br>

          La nostra società <b>non</b> si occupa solamente di immobiliare, ma offriamo anche servizi <b>finanziari…</b></p> <br><br>

          <a href="/dist/about.html"><button class="p-4 bg-transparent border-4 border-green-800 rounded-md text-lg md:text-2xl lg:text-3xl animate-pulse xl:p-5 hover:bg-green-800 hover:border-white transition-all">Scopri di più</button></a>
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
       <button type="submit" onclick="effettuaChiamata()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black hover:border-white transition-all md:w-[60%] lg:w-[50%] max-w-[550px] ">Voglio un appuntamento</button>
      </div>
    </div>


    <div id="section8" class=" min-h-full flex flex-col w-[100%] justify-center items-center px-4 lg:px-8 py-16 text-white bg-neutral-900">

      <h1 class="text-2xl text-center mt-8 md:text-3xl xl:text-4xl font-medium">Sappiamo quanto sia importante l’acquisto o la vendita di una casa. </h1> <br><br>
      <br>
      <h1 class="text-3xl  text-center">E noi facciamo tutto per darti il meglio.</h1> <br><br>

      <button type="submit" onclick="effettuaChiamata()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black hover:border-white transition-all md:w-[60%] lg:w-[50%] max-w-[550px] ">Voglio un appuntamento</button>
  <br>

  </div>


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



    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Aggiungi questi script alla fine del tuo body -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script>
      AOS.init();
  </script>

<script>
    $(document).ready(function(){
        $('.carousel').slick({
            dots: true, // Aggiungi i puntini di navigazione
            infinite: true,
            speed: 300,
            slidesToShow: 1, // Mostra un solo immobile alla volta
            adaptiveHeight: true,
        });
    });
</script>


<script src="index.js"></script>

</body>
</html>