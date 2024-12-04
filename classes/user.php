<?php
require_once 'classes/database.php';

class User {
    public function login($email, $wachtwoord) {
        $db = new Database();
        $sql = "SELECT * FROM Gebruiker WHERE email = '$email' AND wachtwoord = '$wachtwoord'";
        $response = $db->sendData($sql);

        if ($response) {
            $result = json_decode($response, true); // Decode the JSON string into a PHP array
            if (!empty($result)) {
                echo $result[0]['voornaam']; // Access the 'voornaam' field
                session_start();
                $_SESSION['loggedin'] = true;
                Header('Location: index.php');
            } else {
                echo 'Gebruikersnaam of wachtwoord is onjuist';
            }
        } else {
            echo 'Er is een fout opgetreden bij het verbinden met de server.';
        }

        echo '<br>';
        echo $email . ' ' . $wachtwoord;
    }
}