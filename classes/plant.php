<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'classes/database.php';
class Plant {
    public function showPlants($id) {
        $db = new Database();
        $sql = "SELECT * FROM Product WHERE gebruikersId = '$id'";
        $response = $db->sendData($sql);
        return $response;
    }

    public function showPlant($id) {
        $db = new Database();
        $sql = "SELECT M.timestamp, M.vochtigheid, M.waterGebruikt, P.nicknaam, P.plaatje
        FROM Meting M
        JOIN Product P ON M.product = P.id
        WHERE P.id = '$id'";
        $response = $db->sendData($sql);
        return $response;
    }

    public function plantMeting($id) {
        $db = new Database();
        $sql = "SELECT timestamp, waterGebruikt FROM Meting WHERE product = '$id' ORDER BY timestamp ASC LIMIT 7";
        $response = $db->sendData($sql);
        $response = json_decode($response, true);
        // get highest timestamp
        $timestamp = $response[0]['timestamp'];
        $currentDateTime = new DateTime();
        $timestampDateTime = new DateTime($timestamp);
        $interval = $currentDateTime->diff($timestampDateTime);
        $return = [$response, $interval->format('%a dagen en %h uur')];
        return $return;
    }
    public function addPlant($id, $nickname, $user, $img) {
        if ($img == null || $img['error'] != UPLOAD_ERR_OK) {
            $imgPath = null;
        } else {
            $type = mime_content_type($img['tmp_name']);
            $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

            if (!in_array($type, $allowedTypes)) {
                die('Invalid file type. Only PNG and JPEG images are allowed.');
            }

            $dir = 'assets/images/user-uploads/';
            if (!is_dir($dir)) {
                mkdir($dir, 0777, true);
            }

            $file = $dir . basename($img['name']);

            if (!move_uploaded_file($img['tmp_name'], $file)) {
                die('Failed to upload image.');
            }

            $imgPath = $file;
        }

        $db = new Database();
        if ($imgPath === null) {
            $sql = "UPDATE Product SET gebruikersId = '$user', nicknaam = '$nickname', plaatje = NULL, geactiveerd = 1 WHERE id = '$id'";
        } else {
            $sql = "UPDATE Product SET gebruikersId = '$user', nicknaam = '$nickname', plaatje = '$imgPath', geactiveerd = 1 WHERE id = '$id'";
        }
        $response = $db->sendData($sql);
        return $response;
    }
}
