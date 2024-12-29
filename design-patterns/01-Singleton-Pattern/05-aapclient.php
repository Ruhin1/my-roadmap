<?php

// রেজাল্ট চেক করা
function p($a = []) {
    echo "<pre>";
    var_dump($a);
    echo "</pre>";
    die();
}

class APIClient {
    private static $instance = null;
    private $baseUrl;
    private $token;

    private function __construct() {
        $this->baseUrl = 'https://jsonplaceholder.org';
        $this->token = 'your-api-token';
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new APIClient();
        }
        return self::$instance;
    }

    public function request($endpoint, $method = 'GET', $data = []) {
        $url = $this->baseUrl . $endpoint;

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->token,
                'Content-Type: application/json'
            ]
        ];

        if ($method === 'POST') {
            $options[CURLOPT_POST] = true;
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        $ch = curl_init($url); 
        curl_setopt_array($ch, $options);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function __clone() {}
    public function __wakeup() {}
}

// Usage Example:
$api = APIClient::getInstance();
$response = $api->request('/users');
foreach($response as $data){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    if($data['id'] === 2){
        break;
    }

}
?>
