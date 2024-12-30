<?php

// Step 1: Create Subsystems

// Subsystem 1: Inventory Management
class Inventory {
    public function checkStock($productId) {
        // Dummy logic
        echo "Checking stock for product $productId...\n";
        return true;
    }
}

// Subsystem 2: Payment Gateway
class PaymentGateway {
    public function processPayment($amount) {
        // Dummy logic
        echo "Processing payment of $$amount...\n";
        return true;
    }
}

// Subsystem 3: Shipping Service
class Shipping {
    public function shipProduct($productId, $address) {
        // Dummy logic
        echo "Shipping product $productId to $address...\n";
        return true;
    }
}

// Step 2: Create the Facade

class OrderFacade {
    private $inventory;
    private $paymentGateway;
    private $shipping;

    public function __construct() {
        $this->inventory = new Inventory();
        $this->paymentGateway = new PaymentGateway();
        $this->shipping = new Shipping();
    }

    public function placeOrder($productId, $amount, $address) {
        echo "Placing order for product $productId...\n";
        
        // Step 1: Check stock
        if (!$this->inventory->checkStock($productId)) {
            echo "Product $productId is out of stock.\n";
            return false;
        }

        // Step 2: Process payment
        if (!$this->paymentGateway->processPayment($amount)) {
            echo "Payment failed for amount $$amount.\n";
            return false;
        }

        // Step 3: Ship the product
        if (!$this->shipping->shipProduct($productId, $address)) {
            echo "Shipping failed for product $productId.\n";
            return false;
        }

        echo "Order placed successfully for product $productId.\n";
        return true;
    }
}


// Step 3: Client Code

$orderFacade = new OrderFacade();
$orderFacade->placeOrder(101, 50, '123 Main Street, Cityville');
?>




?>
