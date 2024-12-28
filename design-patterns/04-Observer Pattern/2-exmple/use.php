<?php

// Include all files
require_once 'EventManager.php';
require_once 'Listener.php';
require_once 'EmailNotification.php';
require_once 'SMSNotification.php';

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
