<?php 

// Step 1: Target Interface

interface PaymentGateway {
    public function pay($amount);
}

// Step 2: Adaptees (Different Payment Systems)

    // PayPal payment system
class PayPal {
    public function sendPayment($amount) {
        echo "Paid $$amount using PayPal.\n";
    }
}

    // Stripe payment system
class Stripe {
    public function makePayment($amount) {
        echo "Paid $$amount using Stripe.\n";
    }
}

// Step 3: Adapters

    // Adapter for PayPal
class PayPalAdapter implements PaymentGateway {
    private $paypal;

    public function __construct(PayPal $paypal) {
        $this->paypal = $paypal;
    }

    public function pay($amount) {
        $this->paypal->sendPayment($amount);
    }
}

    // Adapter for Stripe
class StripeAdapter implements PaymentGateway {
    private $stripe;

    public function __construct(Stripe $stripe) {
        $this->stripe = $stripe;
    }

    public function pay($amount) {
        $this->stripe->makePayment($amount);
    }
}


// Step 4: Client Code

// Client expects a unified interface
function processPayment(PaymentGateway $gateway, $amount) {
    $gateway->pay($amount);
}

// Using PayPal
$paypal = new PayPal();
$paypalAdapter = new PayPalAdapter($paypal);
processPayment($paypalAdapter, 100);

// Using Stripe
$stripe = new Stripe();
$stripeAdapter = new StripeAdapter($stripe);
processPayment($stripeAdapter, 200);



