# virtualdevs

Virtual iot devices. php -Scripts in server to simulate for ex. iot-temperature-humidity sensors.

Idea is, that [iotLocalNetworkServer](https://github.com/mtpajula/iotLocalNetworkServer) -service is able to read virtualdevices.

Currently two temp-humidity devices:

 * From Finnish Meteorological Institute api
 * OpenWeatherMap current -api

## Install

Download/clone to servers public html. Folder should be located in root: **localhost/virtualdevs**.

Edit virtualdevices by adding your location and appid in: **virtualdevs/.../status/index.php**.

    function __construct() {
        parent::__construct();

        // Current weather data - openweathermap
        // https://openweathermap.org/current
        $this->appid    = "APP_ID_HERE"; //Yuor appid
        $this->location = "Helsinki";    //Your location
        $this->country  = "Finland";     //Your country (OpenWeatherMap)
    }

## use

Visit **virtualdevs/.../status**
