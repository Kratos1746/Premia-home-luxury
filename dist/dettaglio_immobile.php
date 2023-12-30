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

</head>

<body class="overflow-x-hidden">
    



        <div class="flex flex-col justify-center  w-full bg-neutral-900 h-screen text-white ">
            <div class="flex flex-col items-center  ">
            
            <img src="<?php echo $row['foto_principale']; ?>" alt="Anteprima" class="w-[80%] h-2/3  ">
            <h1 class="font-Ayer text-5xl uppercase"><?php echo $row['titolo']; ?></h1>
        </div>
         <!--   <p><strong>ID Immobile:</strong> <?php echo $row['id_immobile']; ?></p>
            <p><strong>Prezzo:</strong> €<?php echo $row['prezzo']; ?></p>
            <p><strong>Tipo Immobile:</strong> <?php echo $row['tipo_immobile']; ?></p>
            <p><strong>Descrizione:</strong> <?php echo nl2br($row['descrizione']); ?></p>
            <p><strong>Camere da letto:</strong> <?php echo $row['camere']; ?></p>
            <p><strong>Bagni:</strong> <?php echo $row['bagni']; ?></p>
            <p><strong>Metri Quadrati:</strong> <?php echo $row['metri_quadrati']; ?> m²</p>
            <p><strong>Piani:</strong> <?php echo $row['piani']; ?></p>
            <p><strong>Comune:</strong> <?php echo $row['comune']; ?></p>
             Aggiungi altri campi del database che desideri visualizzare -->
        </div>

        <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

        <script>
        AOS.init();
        </script>

        <script src="index.js"></script>

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