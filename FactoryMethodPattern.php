<?php

// Step 1: Define an interface for the product
interface Notification {
    public function send($message);
}

// Step 2: Create concrete classes implementing the interface
class EmailNotification implements Notification {
    public function send($message) {
        echo "Sending Email: $message\n";
    }
}

class SMSNotification implements Notification {
    public function send($message) {
        echo "Sending SMS: $message\n";
    }
}

// Step 3: Create a Factory Class with a Factory Method
class NotificationFactory {
    public static function createNotification($type): Notification {
        return match ($type) {
            'email' => new EmailNotification(),
            'sms' => new SMSNotification(),
            default => throw new Exception("Notification type not supported"),
        };
    }
}

// Step 4: Use the Factory to Create Objects
$email = NotificationFactory::createNotification('email');
$email->send("Hello via Email!");

$sms = NotificationFactory::createNotification('sms');
$sms->send("Hello via SMS!");

