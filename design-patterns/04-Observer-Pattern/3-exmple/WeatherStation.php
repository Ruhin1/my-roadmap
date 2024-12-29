<?php

class WeatherStation {
    private $observers = []; // List of observers
    private $temperature;
    private $humidity;

    // Attach an observer
    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    // Detach an observer
    public function detach(Observer $observer) {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    // Notify all observers
    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this->temperature, $this->humidity);
        }
    }

    // Set weather data and notify observers
    public function setWeatherData($temperature, $humidity) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->notify();
    }
} 
