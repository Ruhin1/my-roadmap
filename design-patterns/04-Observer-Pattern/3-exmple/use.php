<?php

// Include all files
require_once 'WeatherStation.php';
require_once 'Observer.php';
require_once 'MobileDevice.php';
require_once 'DesktopApp.php';

// Create the Weather Station (Subject)
$weatherStation = new WeatherStation();

// Create Observers
$mobileDevice = new MobileDevice();
$desktopApp = new DesktopApp();

// Attach observers to the Weather Station
$weatherStation->attach($mobileDevice);
$weatherStation->attach($desktopApp);

// Simulate weather data updates
$weatherStation->setWeatherData(25, 60); // Update 1


