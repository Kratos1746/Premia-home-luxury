<?php
// Includi il file di connessione al database
include './php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recupera l'input dell'utent
    // Convalida e sanifica l'input (ad esempio, usa mysqli_real_escape_string)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);


    // Esegui l'hash della password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM users where email='$email'";
	$result=mysqli_query($conn, $query);
	$num=mysqli_num_rows($result);
	
	if($num == 1)
	{
		$error = "<p class='alert alert-warning'>Email Id already Exist</p> ";
	}
    
    else{


    // Query per inserire l'utente nel database
    $query = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

    // Esegui la query e gestisci il risultato
    if (mysqli_query($conn, $query)) {
        // Registrazione riuscita
        $messaggio = "Registrazione avvenuta con successo";
        header("Location: immobili.php?messaggio=" . urlencode($messaggio));
        exit();
    } else {
        // Gestisci il fallimento della registrazione
        echo "Errore durante la registrazione: " . mysqli_error($conn);
    }
}
}

// Chiudi la connessione al database
mysqli_close($conn);
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

    <title>Registrazione</title>
</head>
<body>




<div class="bg-neutral-900 flex flex-col justify-center items-center min-h-screen">

<br><br><br>


<div class=" w-1/2   rounded-md flex flex-row justify-center items-center xl:bg-neutral-700 xl:shadow-lg xl:shadow-black xl:w-2/3 max-h-[700px] max-w-[900px]">
        
    
        <form action="registrazione.php" method="post" class="p-4 md:p-8 md:px-10 xl:w-1/2 rounded-md bg-neutral-700 shadow-lg shadow-black xl:p-8 xl:shadow-none">
    <div class="flex flex-col items-center justify-center">
        <img src="/img/logo-ombra.png" alt="" class=" w-1/2 md:w-2/3 xl:hidden">
    
    <br>
        <h1 class="text-white  text-center font-semibold font-Lora text-[42px] md:text-5xl lg:text-6xl">Registrazione</h1>
        <br><br>
            <div class="mb-4">
                <label for="nome" class="block text-white text-sm font-medium mb-2">Nome completo:</label>
                <input type="text" id="nome" name="nome" class=" p-2 max-md:w-[250px] w-[300px]  border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-white text-sm font-medium mb-2">Email</label>
                <input type="email" id="email" name="email" class=" p-2 max-md:w-[250px] w-[300px]  border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-4">
                <label for="password" class="block text-white text-sm font-medium mb-2">Password:</label>
                <input type="password" id="password" name="password" class=" p-2 max-md:w-[250px] w-[300px]  border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>

            <div class="mb-4">
                <label for="confirm_password" class="block text-white text-sm font-medium mb-2">Conferma Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" class=" p-2 max-md:w-[250px] w-[300px]  border rounded-md bg-neutral-800 text-white shadow-md shadow-neutral-900" required>
            </div>
<br>        
            <button type="submit" class="bg-green-800 text-white lg:bg-white float-right  lg:text-black font-medium text-lg w-full py-2  max-md:max-w-[250px] max-w-[300px]  rounded-md shadow-md shadow-neutral-900 hover:bg-green-800 hover:scale-105 hover:text-white duration-75  xl:py-3 xl:text-xl">Registrati</button>
    
</form></div>

<div class="hidden w-1/2 xl:block ">

<img src="/img/sfondo-reg.jpg" alt="Logo" id="Logo-1024" class="h-full w-full rounded-r-md z-10 max-h-[700px] max-w-[485px]  ">
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

