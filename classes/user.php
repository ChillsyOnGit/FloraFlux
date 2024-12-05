<?php
require_once 'classes/database.php';

class User {
    public function login($email, $wachtwoord) {
        $db = new Database();
        $sql = "SELECT * FROM Gebruiker WHERE email = '$email'";
        $response = $db->sendData($sql);
        if ($response) {
            $result = json_decode($response, true);
            if (!empty($result)) {
                $hash = $result[0]['wachtwoord'];
                if (password_verify($wachtwoord, $hash)) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $result[0]['id'];
                    $_SESSION['voornaam'] = $result[0]['voornaam'];
                    $_SESSION['achternaam'] = $result[0]['achternaam'];
                    $_SESSION['email'] = $result[0]['email'];
                    $_SESSION['telefoonnummer'] = $result[0]['telefoonnummer'];
                    Header('Location: index.php');
                } else {
                    echo 'Wachtwoord is onjuist';
                }
            } else {
                echo 'E-mailadres is onjuist';
            }
        } else {
            echo 'Er is een fout opgetreden bij het verbinden met de server.';
        }
    }
    public function register($voornaam, $achternaam, $email, $wachtwoord, $telefoonnummer, $wachtwoord_check) {
        $db = new Database();
        $sql = "SELECT * FROM Gebruiker WHERE email = '$email'";
        $response = $db->sendData($sql);
        if ($response) {
            $result = json_decode($response, true);
            if (empty($result)) {
                if ($wachtwoord == $wachtwoord_check) {
                    // hash the password
                    $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
                    // select last user
                    $sql = "SELECT id FROM Gebruiker ORDER BY id DESC LIMIT 1";
                    $response2 = $db->sendData($sql);
                    if ($response2 === false) {
                        $id = 'G0000001';
                    } else {
                    $result2 = json_decode($response2, true);
                    $id = $result2[0]['id'];
                    $id = substr($id, 1);
                    $id = intval($id);
                    $id++;
                    $id = str_pad($id, 7, '0', STR_PAD_LEFT);
                    $id = 'G'.$id;
                    }
                    $sql = "INSERT INTO Gebruiker (id, voornaam, achternaam, email, wachtwoord, telefoonnummer) VALUES ('$id', '$voornaam', '$achternaam', '$email', '$wachtwoord', '$telefoonnummer')";
                    $response = $db->sendData($sql);
                    if ($response) {
                        Header('Location: login.php');
                    } else {
                        echo 'Er is een fout opgetreden bij het verbinden met de server.';
                    }
                } else {
                    echo 'Wachtwoorden komen niet overeen';
                }
            } else {
                echo 'E-mailadres is al in gebruik';
            }
        } else {
            echo 'Er is een fout opgetreden bij het verbinden met de server.';
        }
    }
}