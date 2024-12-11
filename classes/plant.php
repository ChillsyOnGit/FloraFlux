<?php

require_once 'classes/database.php';
class Plant {
    public function showPlants($id) {
        $db = new Database();
        $sql = "SELECT * FROM Product WHERE gebruikersId = '$id'";
        $response = $db->sendData($sql);
        return $response;
    }
}