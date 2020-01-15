<?php
include_once('../../WeatherStation.php');

class FmiStation extends WeatherStation {

    function __construct() {
        parent::__construct();

        // Finnish Meteorological Institute's open data
        // https://en.ilmatieteenlaitos.fi/open-data
        $this->location = "rovaniemi";
    }

    private function getUrl() {
        $url = 'http://opendata.fmi.fi/wfs?request=getFeature&storedquery_id=fmi::observations::weather::simple&place=';
        $url .= $this->location;
        return $url;
    }

    public function getWeather() {
        $data = $this->getData($this->getUrl());
        $w = new SimpleXMLElement($data);

        foreach($w->xpath('//BsWfs:BsWfsElement') as $item) {
            $name = $item->xpath('BsWfs:ParameterName')[0];
            $value = $item->xpath('BsWfs:ParameterValue')[0];

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
