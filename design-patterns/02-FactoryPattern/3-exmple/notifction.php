<?php

// Notification Interface
interface Notification {
    public function send($to, $message);
}

// Email Notification Class
class EmailNotification implements Notification {
    public function send($to, $message) {
        echo "Sending Email to {$to} with message: {$message}\n";
    }
}

// SMS Notification Class
class SMSNotification implements Notification {
    public function send($to, $message) {
        echo "Sending SMS to {$to} with message: {$message}\n";
    }
}

// Push Notification Class
class PushNotification implements Notification {
    public function send($to, $message) {
        echo "Sending Push Notification to {$to} with message: {$message}\n";
    }
}

// Notification Factory
class NotificationFactory {
    public static function createNotification($type) {
        switch (strtolower($type)) {
            case 'email':
                return new EmailNotification();
            case 'sms':
                return new SMSNotification();
            case 'push':
                return new PushNotification();
            default:
                throw new Exception("Notification type '{$type}' not supported.");
        }
    }
}

// ব্যবহার উদাহরণ
try {
    // ইমেইল নোটিফিকেশন
    $emailNotification = NotificationFactory::createNotification('email');
    $emailNotification->send('user@example.com', 'Hello from Email!');
    echo '<br/>';
    // এসএমএস নোটিফিকেশন
    $smsNotification = NotificationFactory::createNotification('sms');
    $smsNotification->send('+8801234567890', 'Hello from SMS!');
    echo '<br/>';
    // পুশ নোটিফিকেশন
    $pushNotification = NotificationFactory::createNotification('push');
    $pushNotification->send('DeviceToken123', 'Hello from Push Notification!');
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
