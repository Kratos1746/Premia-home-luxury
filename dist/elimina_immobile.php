<?php
session_start();
include './php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_immobile'])) {
    $id_immobile = $_POST['id_immobile'];

    // Esegui la logica di eliminazione dell'immobile dal database
    $delete_query = "DELETE FROM immobili WHERE id_immobile = $id_immobile";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Redireziona alla pagina degli immobili dopo l'eliminazione
        header("Location: /dist/immobili.php");
        exit();
    } else {
        echo "Errore nell'eliminazione dell'immobile: " . mysqli_error($conn);
    }
} else {
    echo "Richiesta non valida.";
}
?>
