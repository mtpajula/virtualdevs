<?php
include_once('../../WeatherStation.php');

class OwmStation extends WeatherStation {

    function __construct() {
        parent::__construct();

        // Current weather data - openweathermap
        // https://openweathermap.org/current
        $this->appid    = "---";
        $this->location = "---";
        $this->country  = "Finland";
    }

    private function getUrl() {
        $url = 'http://api.openweathermap.org/data/2.5/weather?q=';
        $url .= $this->location . ',' . $this->country;
        $url .= '&appid=';
        $url .= $this->appid;
        return $url;
    }

    public function getWeather() {
        $data = $this->getData($this->getUrl());
        $json = json_decode($data);

        $this->response->status->temp = (string)($json->main->temp-272.15);
        $this->response->status->humidity = (string)$json->main->humidity;

        $this->replyJson();
    }
}

$fmi = new OwmStation();
$fmi->getWeather();

?>
