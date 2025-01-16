<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once 'classes/database.php';
class Plant {
    public function showPlants($id) {
        $db = new Database();
        $sql = "
        SELECT P.*, 
               COUNT(CASE WHEN DATE(M.timestamp) = CURDATE() THEN 1 END) as aantalKeerWater, 
               MAX(M.timestamp) as laatsteKeerWater, 
               (SELECT M2.vochtigheid 
                FROM Meting M2 
                WHERE M2.product = P.id 
                ORDER BY M2.timestamp DESC 
                LIMIT 1) as nieuwsteVochtigheid
        FROM Product P
        LEFT JOIN Meting M ON P.id = M.product
        WHERE P.gebruikersId = '$id'
        GROUP BY P.id";
        $response = $db->sendData($sql);
        return $response;
    }

    public function showPlant($id) {
        $db = new Database();
        $sql = "SELECT P.nicknaam, P.plaatje, P.id
        FROM Product P
        WHERE P.id = '$id'";
        $response = $db->sendData($sql);
        return $response;
    }

    public function plantMeting($id) {
        $db = new Database();
        $sql = "SELECT timestamp, SUM(waterGebruikt) as waterGebruikt 
                FROM Meting 
                WHERE product = '$id' 
                AND timestamp >= DATE_SUB(NOW(), INTERVAL 1 WEEK) 
                GROUP BY DATE(timestamp) 
                ORDER BY timestamp ASC";
        $response = $db->sendData($sql);
        if ($response == '[]') {
            return [[], '0 dagen en 0 uur'];
        }
        $response = json_decode($response, true);
        $currentDateTime = new DateTime();
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date = clone $currentDateTime;
            $date->modify("-$i days");
            $dates[$date->format('Y-m-d')] = 0;
        }
    
        foreach ($response as $row) {
            $date = (new DateTime($row['timestamp']))->format('Y-m-d');
            if (isset($dates[$date])) {
                $dates[$date] = $row['waterGebruikt'];
            }
        }
    
        $result = [];
        foreach ($dates as $date => $waterGebruikt) {
            $result[] = [
                'timestamp' => $date,
                'waterGebruikt' => $waterGebruikt
            ];
        }
        //invert the array so it is in the correct order
        $result = array_reverse($result);
        $timestamp = $response[0]['timestamp'];
        $timestampDateTime = new DateTime($timestamp);
        $interval = $currentDateTime->diff($timestampDateTime);
        $return = [$result, $interval->format('%a dagen en %h uur')];
        return $return;
    }

    public function addPlant($id, $nickname, $user, $img) {
        $sql = "SELECT geactiveerd FROM Product WHERE id = '$id' AND geactiveerd = 1;";
        $db = new Database();
        $response = $db->sendData($sql);
        if ($response != '[]') {
            die ('<div class="error">ERROR: Plant is already added.</div>');
        }
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

            $file = $dir . $id . '.' . pathinfo($img['name'], PATHINFO_EXTENSION);

            if (!move_uploaded_file($img['tmp_name'], $file)) {
                die('Failed to upload image.');
            }

            $imgPath = pathinfo($img['name'], PATHINFO_EXTENSION);
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
