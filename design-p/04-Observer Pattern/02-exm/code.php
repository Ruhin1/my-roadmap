<?php

interface Listener {
    public function handle($data);
}


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
}

class EmailNotification implements Listener {
    public function handle($data) {
        echo "Sending Email to {$data['email']} with subject: '{$data['subject']}'\n";
    }
}

class SMSNotification implements Listener {
    public function handle($data) {
        echo "Sending SMS to {$data['phone']} with message: '{$data['message']}'\n";
    }
}


// Create the event manager
$eventManager = new EventManager();

// Create listeners
$emailNotification = new EmailNotification();
$smsNotification = new SMSNotification();

// Attach listeners to the 'user.registered' event
$eventManager->attach('user.registered', $emailNotification);
$eventManager->attach('user.registered', $smsNotification);

// Simulate a user registration event
$userData = [
    'email' => 'user@example.com',
    'phone' => '123-456-7890',
    'subject' => 'Welcome to Our Platform!',
    'message' => 'Thank you for signing up!'
];

// Notify all listeners of the 'user.registered' event
$eventManager->notify('user.registered', $userData);

