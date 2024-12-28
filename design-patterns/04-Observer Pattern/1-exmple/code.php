<?php

// Observer Interface
interface Observer {
    public function update($message);
}

// Subject (Observable) Interface
interface Subject {
    public function attach(Observer $observer);
    public function detach(Observer $observer);
    public function notify();
}

// Concrete Subject: Product
class Product implements Subject {
    private $observers = [];
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

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
            $observer->update(" n/The price of {$this->name} has changed to {$this->price}.");
        }
    }

    // Set new price
    public function setPrice($price) {
        $this->price = $price;
        $this->notify();
    }
}

// Concrete Observer: EmailNotifier
class EmailNotifier implements Observer {
    private $email;

    public function __construct($email) {
        $this->email = $email;
    }

    public function update($message) {
        echo "n/ Email sent to {$this->email}: {$message}<br/>";
    }
}

// Concrete Observer: SMSNotifier
// class SMSNotifier implements Observer {
//     private $phone;

//     public function __construct($phone) {
//         $this->phone = $phone;
//     }

//     public function update($message) {
//         echo "SMS sent to {$this->phone}: {$message}<br/>";
//     }
// }

// Usage Example:

// Create a product
$product = new Product("Laptop", 1000);


// Add observers
$emailNotifier = new EmailNotifier("user1@example.com");
$product->attach($emailNotifier);
$product->setPrice(900); 
$product->setPrice(800);
$product->setPrice(1100);