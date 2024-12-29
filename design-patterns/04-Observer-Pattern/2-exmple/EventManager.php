<?php

class EventManager {
    private $listeners = []; // List of observers/listeners

    // Method to attach a listener to an event
    public function attach($event, $listener) {
        if (!isset($this->listeners[$event])) {
            $this->listeners[$event] = [];
        }
        $this->listeners[$event][] = $listener;
    }

    // Method to detach a listener from an event
    public function detach($event, $listener) {
        if (isset($this->listeners[$event])) {
            $this->listeners[$event] = array_filter($this->listeners[$event], function ($l) use ($listener) {
                return $l !== $listener;
            });
        }
    }

    // Notify all listeners about the event
    public function notify($event, $data) {
        if (isset($this->listeners[$event])) {
            foreach ($this->listeners[$event] as $listener) {
                $listener->handle($data);
            }
        }
    }

    public function show(){
        echo "<pre>";
        var_dump($this->listeners);
        echo "</pre>";
    }
}
