<?php
session_start();
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password']; // Non è necessario usare mysqli_real_escape_string per password hashed

        $query = "SELECT * FROM users WHERE Email=?";
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                $user = mysqli_fetch_assoc($result);

                if ($user) {
                    // Utente trovato, confronta la password
                    if (password_verify($password, $user['Password'])) {
                        // Password corretta
                        $messaggio = "Accesso effettuato";
                
                        $_SESSION['ID'] = $user['ID'];
                        $_SESSION['Email'] = $user['Email']; 
                        $_SESSION['ruolo'] = $user['ruolo'];  

                        header("Location: /dist/immobili.php?messaggio=" . urlencode($messaggio));
                        exit();
                    } else {
                        // Password errata
                        echo "Credenziali non valide";
                    }
                } else {
                    // Utente non trovato
                    echo "Credenziali non valide";
                }
            } else {
                // Gestisci il fallimento della query
                error_log("Errore nella query: " . mysqli_error($conn));
                echo "Credenziali non valide";
            }

            mysqli_stmt_close($stmt);
        } else {
            // Gestisci il fallimento della prepared statement
            error_log("Errore nella preparazione della query: " . mysqli_error($conn));
            echo "Credenziali non valide";
        }
    } else {
        echo "Campo 'password' non presente nel modulo POST.";
    }
}
?>
