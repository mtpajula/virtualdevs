<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Status {
    public $temp      = "";
    public $humidity  = "";
}

class Response {

    public $status;

    function __construct() {
        $this->status = new Status();
    }
}

class WeatherStation {

    public $response;
    public $location = "";
    public $country  = "";
    public $appid    = "";

    function __construct() {
        $this->response = new Response();
    }
    
    public function getData($url) {
        return file_get_contents($url);
    }

    public function replyJson() {
        header('Content-Type: application/json');
        print json_encode($this->response);
    }
}

?>
