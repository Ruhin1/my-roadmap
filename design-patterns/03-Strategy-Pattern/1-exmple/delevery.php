<?php

// Strategy Interface
interface DeliveryStrategy {
    public function deliver($package);
}

// Concrete Strategy: Bicycle Delivery
class BicycleDelivery implements DeliveryStrategy {
    public function deliver($package) {
        echo "Delivering '{$package}' using a Bicycle.<br/>";
    }
}

// Concrete Strategy: Motorbike Delivery
class MotorbikeDelivery implements DeliveryStrategy {
    public function deliver($package) {
        echo "Delivering '{$package}' using a Motorbike.<br/>";
    }
}

// Concrete Strategy: Drone Delivery
class DroneDelivery implements DeliveryStrategy {
    public function deliver($package) {
        echo "Delivering '{$package}' using a Drone.<br/>";
    }
}

// Context Class
class DeliveryContext {
    private $strategy;

    // Set the delivery strategy
    public function setStrategy(DeliveryStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // Perform delivery
    public function deliverPackage($package) {
        if ($this->strategy) {
            $this->strategy->deliver($package);
        } else {
            echo "No delivery strategy set.\n";
        }
    }

}

// ব্যবহার উদাহরণ:

// Create a Delivery Context
$deliveryContext = new DeliveryContext();



// বাইসাইকেল দিয়ে ডেলিভারি
$deliveryContext->setStrategy(new BicycleDelivery());
$deliveryContext->deliverPackage("Small Package");

// মোটরবাইক দিয়ে ডেলিভারি
$deliveryContext->setStrategy(new MotorbikeDelivery());
$deliveryContext->deliverPackage("Medium Package");

// ড্রোন দিয়ে ডেলিভারি
$deliveryContext->setStrategy(new DroneDelivery());
$deliveryContext->deliverPackage("Urgent Package");

 