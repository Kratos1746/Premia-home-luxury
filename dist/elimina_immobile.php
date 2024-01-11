<?php
session_start();
include './php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_immobile'])) {
    $id_immobile = $_POST['id_immobile'];

    // Ottieni le informazioni sulle foto e video prima di eliminare l'immobile
    $file_info_query = "SELECT foto_principale, video FROM immobili WHERE id_immobile = $id_immobile";
    $file_info_result = mysqli_query($conn, $file_info_query);

    if ($file_info_result) {
        $file_info = mysqli_fetch_assoc($file_info_result);

        // Elimina la foto principale
        if (!empty($file_info['foto_principale'])) {
            $main_photo_path = './imgphp/' . $file_info['foto_principale'];
            if (file_exists($main_photo_path)) {
                unlink($main_photo_path);
            }
        }


        // Elimina il video
        if (!empty($file_info['video'])) {
            $video_path = 'video/' . $file_info['video'];
            if (file_exists($video_path)) {
                unlink($video_path);
            }
        }

        // Esegui la logica di eliminazione dell'immobile dal database
        $delete_query = "DELETE FROM immobili WHERE id_immobile = $id_immobile";
        $result = mysqli_query($conn, $delete_query);

        if ($result) {
            // Redireziona alla pagina degli immobili dopo l'eliminazione
            header("Location: /dist/immobili.php");
            exit();
        }
    } else {
        echo "Errore nel recupero delle informazioni sulle foto e video: " . mysqli_error($conn);
    }
} else {
    echo "Richiesta non valida.";
}
?>
