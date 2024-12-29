<?php

class MobileDevice implements Observer {
    public function update($temperature, $humidity) {
        echo "Mobile Device: Temperature is $temperature °C, Humidity is $humidity%<br/>";
    }
} 