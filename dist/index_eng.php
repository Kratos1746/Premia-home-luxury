<?php 
session_start();
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
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="loading.js"></script>
<script src="traduttore.js"></script>

<link rel = "icon" href = 
        "img/logo-luxury.png" 
        type = "image/x-icon">
        
  <title>PremiaHome-Luxury</title>
</head>



<body class="overflow-x-hidden font-Grotesk tracking-wide" >

<div id="loading-overlay" class="fixed top-0 left-0 w-full h-full bg-neutral-900  flex justify-center items-center z-50 transition-all ease-in-out duration-1000">
        <div id="loading-spinner" class=" animate-ritira"><img src="/img/logo-lux.png" alt="Logo" id="Logo-1024" class="w-[80%] xl:w-[120%] mx-auto z-10 "></div>
    </div>

<div id="overlay" class="fixed inset-0 bg-black opacity-50 z-50 hidden"></div>

  <div class="bg-neutral-900 min-h-screen flex flex-col">
      <nav id="nav-1024" class="max-lg:hidden  z-10    w-full fixed py-16 "data-aos="fade-down" data-aos-duration="600" data-aos-once="true">
          <div class="flex items-center justify-between ">
            <div id="Logo-1024" class=" h-[90px] xl:h-[100px] w-60 ml-10 mt-5 z-10 fixed top-0 left-5 xl:left-10" >
              <img src="/img/logo-lux.png" alt="Logo"  class=" h-full ">
              </div>
              <div id="menu-1024" class="space-x-8 text-lg font-semibold xl:text-xl fixed left-1/2 -translate-x-1/2">
    <a href="#" class="text-orange-300 underline underline-offset-4 hover:scale-105 transition-all">Home</a>
    <a href="/dist/immobili_eng.php" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Properties</a>
    <a href="/dist/about_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">About Us</a>
    <a href="/dist/contatti_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Contact</a>
</div>

<div class=" text-white text-xl flex gap-1 ml-1 mr-8 mt-12 z-10 cursor-pointer fixed top-0 right-5 ">
                    <button id="translateButtonIt" onclick="translateSiteToIta()" ><a href="index.php">It</a></button>
                    <p>-</p>
                    <button id="translateButtonEng" onclick="translateSiteToEng()" class="underline underline-offset-4 text-orange-300">En</button>
                    </div>
                    <script>saveStateToCookies();</script>  
</div>
</nav>

<nav id="nav" class="lg:hidden p-4 z-10 md:px-14 fixed w-full py-16" data-aos="fade-down" data-aos-duration="600" data-aos-once="true">
    <div class="flex items-center justify-between">
        <img src="/img/logo-lux.png" alt="Logo" id="Logo" class="h-20 sm:h-[90px] ml-12 mt-6 z-10 fixed top-0 left-0">

        <button id="toggleButton" class="transition-all" onclick="toggleMenu()">
            <img src="/img/menu-ita.png" alt="Logo" id="hamburger" class="h-14 w-14 ml-1 mr-8 mt-8 z-10 cursor-pointer fixed top-0 right-0">
            <img src="/img/x.png" alt="Logo" id="X" class="hidden h-12 w-12 ml-1 mr-4 mt-8 z-10 cursor-pointer fixed top-0 right-0">
        </button>

        <div id="menu" class="bar hidden fixed left-0 top-0 py-10 px-8 text-center bg-neutral-800 w-full z-0">
            <div class="flex flex-col text-xl font-semibold gap-8">
                <a href="#" class="text-orange-300 underline underline-offset-4 hover:scale-105 transition-all">Home</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/immobili_eng.php" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Properties</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/about_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">About Us</a>
                <div class="border-b mx-12"></div>
                <a href="/dist/contatti_eng.html" class="text-white hover:text-orange-300 hover:scale-105 transition-all">Contact</a>
            </div>
        </div>

    </div>
</nav>

<video src="/img/video-home.mp4" class="absolute h-full w-full object-cover brightness-50" autoplay loop muted playsinline></video>

<div id="cookie-banner" class="fixed bottom-3 lg:left-3 max-lg:left-1/2 transform max-lg:-translate-x-1/2 w-2/3 lg:w-1/3 bg-neutral-300 shadow-xl rounded-lg shadow-black p-6 hidden z-50">
    <img src="/img/cookie.svg" alt="" class="w-full lg:h-36 h-32 xl:h-40">
    <p class="text-center">
        This site uses cookies to improve user experience. <a href="#" onclick="showPrivacyPolicy()" class="text-green-700 hover:text-green-800">Read our Privacy Policy</a>.
    </p>
    <button onclick="acceptCookies()" class="relative bg-green-700 hover:bg-green-800 mx-auto lg:float-right rounded-lg text-white px-5 py-3 max-lg:w-full mt-4">Accept</button>
</div>

<div id="privacy-box" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-8 shadow-lg rounded-xl z-50 hidden overflow-y-auto max-h-[80%]">
    <h2 class="text-2xl font-semibold mb-4">Cookies Policy</h2>
    <p>
        This website collects data from users interested in the services accessible through the site. It may also collect some personal data from individuals who have expressly accepted profiling cookies.
        <br><br>
        <b>Processing of Personal Data</b><br>
        The personal data (including identification, contact, navigation, and choices made through the site) provided by the user or collected automatically by this website, even through automated systems, are processed for the purposes and according to the methods described below.
        <br><br>
        <b>Types of Processed Data</b><br>
        <span class="text-md">Navigation Data</span><br>
        The computer systems and software procedures used to operate this site acquire some personal data during their normal operation, and the transmission of such data is implicit in the use of Internet communication protocols. These are anonymous information used only for statistical purposes and to check the correct functioning of the site.
        <br><br>
        <span class="text-md">Voluntarily Provided Data by the User</span><br>
        The optional, explicit, and voluntary sending of emails to the addresses indicated on this site, also through precompiled forms, entails the subsequent acquisition of the sender's address, necessary to respond to requests, as well as any other personal data entered in the message. Specific summary information is reported or displayed in the relevant forms.
        <br><br>
        <b>Cookies</b><br>
        <span class="text-md">Use of Cookies</span><br>
        In order to make its services as efficient and user-friendly as possible, this site may use cookies. When a visitor accesses and visits the site, a minimal amount of information is inserted into the user's device, such as small text files called "cookies" that are saved on the user's computer to store data related to a specific site.
        <br><br>
        All browsers have the option to prevent sites from saving and using cookies. However, this may prevent the site from functioning completely or correctly.
        <br><br>
        The cookies used have statistical or content-sharing functions (such as on platforms like Facebook, Google+, etc.). However, at the discretion of the agency, profiling cookies may be installed. For more information, read the next section.
        <br><br>
        <span class="text-md">Types of Cookies</span><br>
        The law recognizes 3 types of cookies that can be installed on the user's browser:
        <br><br>
        <b>TECHNICAL</b><br>
        These are essential for remembering authentication credentials without having to re-enter them or for tracking customer visits (e.g., using Google Analytics or similar).
        <br><br>
        Technical cookies allow monitoring how users use the Site through anonymous statistics on the number of people who visit the Site, where they come from, which pages they visit, and with what hardware and software.
        <br><br>
        <b>PROFILING</b><br>
        These are the ones targeted by this law as they save purchase preferences, monitoring and profiling users during navigation. They allow studying the habits of those who browse and can be read by external sites to create targeted campaigns based on previous purchases.
        <br><br>
        <b>THIRD-PARTY</b><br>
        These are cookies created by other parties and therefore installed directly by them through specific procedures. Third-party cookies include those involving "social" parts and therefore sharing on Facebook, X, Google, etc.
        <br><br>
        <b>Cookie Management</b><br>
        The choice of which cookies to activate and which to prevent will appear in the form of a banner on the first visit; however, the user can change their consent by clicking on a specific button that will appear on subsequent visits.
    </p>
    <button onclick="closePrivacyPolicy()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 cursor-pointer">X</button>
</div>


    <div class="absolute top-0 z-0" id="content">
    <div class="relative flex flex-col justify-center items-center min-h-screen text-center font-Ayer mx-4 text-white z-10">  
        <h1 class="text-7xl uppercase md:text-[112px] lg:text-9xl xl:text-[142px] 2xl:text-[160px]">INCREASE YOUR PROPERTY'S <span class='font-bold '><span class='text-green-800 '>VA</span>L<span class='text-red-800'>UE</span></span></h1> <br>
        <p class="text-3xl md:text-4xl lg:text-5xl 2xl:text-6xl tracking-wide">Premia Home Luxury: agency for luxury real estate</p>
    </div> 

    <div class="flex flex-row items-center ">
        <div class="w-1/3 bg-green-800 py-4 shadow-2xl shadow-green-700"></div>
        <div class="w-1/3 bg-white py-4 shadow-2xl shadow-white"></div>
        <div class="w-1/3 bg-red-900 py-4 shadow-2xl shadow-red-800"></div>
    </div>

    <div class="bg-neutral-900">
        <a href="/dist/immobili_eng.php" class=""> 
            <div class="relative float-right mr-12 xl:mr-24 pt-6 md:pt-20 h-24 w-fit hover:scale-105 transition-all text-green-600 font-semibold z-20">
                <div class="flex flex-nowrap items-center whitespace-nowrap gap-6 animate-bounce-horizontal"> 
                    <p class="flex text-md lg:text-2xl">Discover properties</p>
                    <img src="/img/freccia.svg" alt="" class="w-full lg:h-14 h-12 xl:h-16">
                </div>   
            </div>
        </a>

        <div class="w-[90%] mx-auto text-center flex justify-center">
            <h1 class="text-7xl uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer text-center text-white " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >Featured</h1> <br>
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

        include 'traduci.php';
      ?>
  <div class="mx-auto mb-10 bg-neutral-800 w-[31%] max-h-[700px] overflow-hidden flex rounded-sm text-white shadow-md shadow-black hover:shadow-lg hover:shadow-orange-300 transition-all flex-col justify-center max-lg:hidden">

<div class="relative w-full h-full  overflow-hidden"> <a href="dettaglio_immobile.php?id=<?php echo $row['id_immobile']; ?>" class="image-hover-scale">
       <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class=" w-full h-full  object-cover rounded-t-sm">
   </div>

   <div class="flex flex-col gap-4  min-h-[300px] ">
    <div class="bg-green-800 px-8 py-4 shadow-md shadow-neutral-900">
       <h1 class="text-2xl break-normal uppercase sm:text-3xl md:text-4xl "><?php echo $row['titolo']; ?></h1>
    </div>
    <div class="mx-8">
       <p class="font-Unna text-3xl ">€ <?php echo $row['prezzo']; ?></p>

      
       <div class="flex justify-between gap-4">
       <p class="pt-4 flex flex-col justify-end max-xl:text-sm  items-start gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "> <?php echo $tipo_immobileInglese; ?></p>
   
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
       <div class="border-t border-orange-400 w-[95%] mt-4 font-Merriweather text-md pb-8 flex gap-8">
         
           <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6"> <?php echo $comuneInglese; ?></p>
           <p class="pt-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
       </div>
   </div>
</div>
</div>
<?php 
}
} else {
    echo "Errore nella query: " . mysqli_error($conn);

};


?>

</div>
<?php


// Query per ottenere gli immobili in evidenza
$query = "SELECT * FROM immobili WHERE in_evidenza = 1 LIMIT 3";
$result = mysqli_query($conn, $query);

if ($result) {
    // Itera sui risultati della query
    while ($row = mysqli_fetch_assoc($result)) {
      ?>
   <div class="mx-auto mb-10 bg-neutral-800 w-[90%] max-w-2xl max-h-[700px] overflow-hidden flex rounded-sm text-white shadow-md shadow-black hover:shadow-lg hover:shadow-green-800 transition-all flex-col justify-center lg:hidden">

<div class="relative w-full h-full  overflow-hidden"> 
    <a href="dettaglio_immobile.php?id=<?php echo $row['id_immobile']; ?>" class="image-hover-scale">
       <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class=" w-full max-sm:h-[300px] h-[400px]  object-cover rounded-t-sm">
   </div>

   <div class="flex flex-col gap-4  min-h-[300px] ">
    <div class="bg-green-800 px-8 py-4 shadow-md shadow-neutral-900">
       <h1 class="text-2xl break-normal uppercase sm:text-3xl md:text-4xl "><?php echo $row['titolo']; ?></h1>
    </div>
    <div class="max-[425px]:mx-6 mx-8">
       <p class="font-Unna text-2xl ">€ <?php echo $row['prezzo']; ?></p>

      
       <div class="flex justify-between gap-4">
       <p class="pt-4 flex flex-col justify-end max-[425px]:text-sm  items-start gap-4 uppercase"><img src="/img/casa.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6 "> <?php echo $tipo_immobileInglese; ?></p>
   
       <div class="flex justify-end px-2 gap-4  text-sm sm:text-lg ">
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
       <div class="border-t border-orange-500 w-[95%] mt-4 font-Merriweather text-md pb-8 flex gap-8">
         
           <p class="pt-4 flex items-center gap-4 uppercase"><img src="/img/posizione.svg" alt="" class="w-8 h-8 max-[475px]:w-6 max-[475px]:h-6"> <?php echo $comuneInglese; ?></p>
           <p class="pt-4 ml-auto">Rif. <?php echo $row['id_immobile']; ?></p>
       </div>
   </div>
</div>
</div>
    </a>
<?php 
    }
} else {
    echo "Errore nella query: " . mysqli_error($conn);

};


?>

 


   
  
    <?php 

// Chiudi la connessione al database
mysqli_close($conn);

?>



 
<br>
<div class="border border-white w-[90%] mt-10 mx-auto"></div>

<!-- About Premia Home -->
<div class="px-5 pt-10 flex flex-col justify-center items-center bg-neutral-900 text-white md:px-10 lg:px-12 lg:py-14 xl:px-32"> <br>
    <h1 class="text-7xl uppercase md:text-8xl lg:text-9xl xl:text-[142px] font-Ayer text-center " data-aos="fade-down" data-aos-duration="600" data-aos-once="true" >Premia Home</h1> <br><br><br>
    <p class="text-base md:text-lg lg:text-xl xl:text-2xl font-Grotesk tracking-wide ">
        Unlike other real estate agencies, Premia Home is a majority-owned real estate brokerage company by the Premia group's holding company (<b>S.p.A.</b>). <br><br>
        Our company does not only deal with real estate but also offers financial services...</p> <br><br>
    <a href="/dist/about.html">
        <button class="p-4 bg-transparent border-4 border-green-800 rounded-md text-lg md:text-2xl lg:text-3xl animate-pulse xl:p-5 hover:bg-green-800 hover:border-white transition-all">Learn more</button>
    </a>
    <br><br>
</div>
      
       <div class=" flex flex-col justify-center bg-neutral-800 text-white pt-16 pb-10 px-2">
        <div class=" flex flex-row ">
        <div class="w-1/2 px-4 text-center lg:px-16 "data-aos="fade-left" data-aos-duration="600" data-aos-once="true">
        <div class="text-4xl md:text-6xl lg:text-7xl xl:text-7xl 2xl:text-8xl text-center font-medium font-Ayer uppercase">I want to buy a house</div> <br><br>
<div class="text-base md:text-lg lg:text-xl xl:text-4xl font-Grotesk tracking-wide">Buying a property is always very challenging. Through collaborations with other real estate agencies, we can offer you an extensive catalog of properties to choose your ideal home.</div>
</div>
<div class="w-1 bg-white z-10"></div>
<div class="w-1/2 px-4 text-center lg:px-16" data-aos="fade-right" data-aos-duration="600" data-aos-once="true">
<div class="text-4xl md:text-6xl lg:text-7xl xl:text-7xl 2xl:text-8xl text-center font-medium font-Ayer uppercase">I want to sell a house</div> <br><br>
<div class="text-base md:text-lg lg:text-xl xl:text-4xl font-Grotesk tracking-wide">We sell your house at the highest market price. Our team will guide you in every aspect of the sale: document analysis, market study, and an exclusive sponsorship strategy for your home.</div>
</div>
</div>
<br><br><br>
<div class="flex justify-center py-8">
<button type="submit" onclick="makeAppointment()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black hover:border-white hover:bg-orange-400 transition-all duration-200 md:w-[60%] lg:w-[50%] max-w-[550px]">I want an appointment</button>
</div>
</div>

<div id="section8" class="min-h-full flex flex-col w-[100%] justify-center items-center px-4 lg:px-8 py-16 text-white bg-neutral-900">
<h1 class="text-2xl text-center mt-8 md:text-3xl xl:text-4xl font-medium">We know how important buying or selling a house is.</h1> <br><br>
<br>
<h1 class="text-3xl text-center">And we do everything to give you the best.</h1> <br><br>
<button type="submit" onclick="makeAppointment()" class="w-[80%] bg-red-700 text-white font-semibold text-lg xl:text-xl 2xl:text-2xl p-4 shadow-md shadow-black border-2 border-neutral-500 hover:scale-105 hover:shadow-lg hover:shadow-black hover:border-white  hover:bg-orange-400 transition-all duration-200 md:w-[60%] lg:w-[50%] max-w-[550px]">I want an appointment</button>
<br>
</div>

<div class="bg-neutral-950 pt-16 border-t border-white px-4 lg:px-10 flex flex-col">
<div class="mx-8">
<div class="flex justify-between gap-4 md:gap-0">
<div class="flex flex-col items-center md:items-start gap-10 md:gap-6 lg:ml-6 w-1/3">
<button onclick="makeMobileCall()" class="flex items-center hover:scale-105 transition-all">
<div class="bg-green-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
<img src="/img/cellulare.png" alt="" class="w-6 h-6"></div>
<div class="flex items-center text-white">
<p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">3289086227</p></div>
</button>
<button onclick="makeCall()" class="flex items-center hover:scale-105 transition-all">
<div class="bg-white text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
<svg width="24px" height="24px" viewBox="0 0 18 18" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
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
</g>
</g>
</svg> </div>
<div class="flex items-center text-white">
<p class="hidden ml-4 md:block lg:text-md xl:ml-8 xl:text-xl">0952274123</p></div>
</button>
<a href="mailto:segreteria@premiahome.it?subject=Subject%20of%20the%20email&body=Email%20body" target="_blank">
<button class="flex items-center hover:scale-105 transition-all">
<div class="bg-red-700 text-white px-2 py-2 rounded-full lg:px-3 lg:py-3">
<img src="/img/email.png" alt="" class="w-6 h-6"></div>
<div class="flex items-center text-white">
<p class="hidden ml-4 text-sm md:block lg:text-md xl:ml-8 xl:text-xl">segreteria@premiahome.it</p></div>
</button></a>
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
<div class="flex flex-col gap-4 items-center md:items-end lg:mr-6 text-2xl md:text-lg lg:text-xl transition-all w-1/3 md:hidden">
<a href="https://www.facebook.com/tuapagina" target="_blank" class="text-white hover:text-blue-700 hover:scale-105 mb-2">
<i class="fab fa-facebook "></i> <p class="hidden ">Facebook</p>
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
<p class="text-white ">Mon-Fri: 9-13 / 15-19</p>
<div class="border-l border-white"></div>
<p class="text-white ">Saturday: 9-13</p>
</div>
<br>
<div class="flex justify-between items-end lg:mx-6 pb-8 border-t gap-16 border-red-700 text-sm">
<p class="text-white xl:text-lg mt-6">Premia Home S.P.A. - VAT: 06024760875 - Viale jonio 35, Catania (CT)</p>
<p class="text-white font-medium mt-6">Website by SDT Copy Sales</p>
</div>

</div>
</div>
</div>
</div>



    </div>
  </div>
 <script src="index.js"></script>
 <script src="scroll.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Aggiungi questi script alla fine del tuo body -->



    <script>
      AOS.init();
  </script>






</body>
</html>