<?php
include_once('../../WeatherStation.php');

class FmiStation extends WeatherStation {

    function __construct() {
        parent::__construct();

        // Finnish Meteorological Institute's open data
        // https://en.ilmatieteenlaitos.fi/open-data
        $this->appid    = "---";
        $this->location = "---";
    }

    private function getUrl() {
        $url = 'http://data.fmi.fi/fmi-apikey/';
        $url .= $this->appid;
        $url .= '/wfs?request=getFeature&storedquery_id=fmi::observations::weather::simple&place=';
        $url .= $this->location;
        return $url;
    }

    public function getWeather() {
        $data = $this->getData($this->getUrl());
        $w = new SimpleXMLElement($data);

        foreach($w->xpath('//BsWfs:BsWfsElement') as $item) {
            //echo "<p>";
            //echo $item->xpath('BsWfs:Time')[0];
            //echo "<br>";
            $name = $item->xpath('BsWfs:ParameterName')[0];
            //echo "<br>";
            $value = $item->xpath('BsWfs:ParameterValue')[0];
            //echo "<p>";
            if (strpos($name, 't2m') !== false) {
                $this->response->status->temp = (string)$value;
            } else if  (strpos($name, 'rh') !== false) {
                $this->response->status->humidity = (string)$value;
            }
        }

        $this->replyJson();
    }
}

$fmi = new FmiStation();
$fmi->getWeather();

?>
