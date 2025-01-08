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
        $sql = "SELECT M.timestamp, M.vochtigheid, M.waterGebruikt, P.nicknaam
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
}
