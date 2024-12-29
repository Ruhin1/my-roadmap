<?php

class DesktopApp implements Observer {
    public function update($temperature, $humidity) {
        echo "Desktop App: Temperature is $temperature °C, Humidity is $humidity%<br/>";
    }
} 
