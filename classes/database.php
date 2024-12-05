<?php

class Database {
    private $envPath;

    public function __construct($envPath = __DIR__ . '/../.env') {
        $this->envPath = $envPath;
        $this->loadEnv();
    }

    private function loadEnv() {
        if (!file_exists($this->envPath)) {
            throw new Exception("The .env file does not exist.");
        }

        $lines = file($this->envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }

    public function sendData($sql) {
        $key = getenv('PRIVATE_KEY');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://floraflux.chillsy.net/receive_data.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('sql' => $sql, 'key' => $key)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable SSL verification
        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            echo "cURL Error: $error";
            return false;
        }

        curl_close($ch);
        return $response;
    }
}