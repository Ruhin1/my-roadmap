<?php

// Step 1: Interfaces তৈরি করা

interface PaymentGateway {
    public function processPayment($amount);
}

// Step 2: নির্ভরশীল ক্লাস তৈরি করা

class StripePaymentGateway implements PaymentGateway {
    public function processPayment($amount) {
        echo "Processing payment of $amount using Stripe.\n";
    }
}

class PaypalPaymentGateway implements PaymentGateway {
    public function processPayment($amount) {
        echo "Processing payment of $amount using PayPal.\n";
    }
}

// Step 3: Primary Service Class

class PaymentService {
    private $gateway;

    // Dependency Injection through Constructor
    public function __construct(PaymentGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function makePayment($amount) {
        $this->gateway->processPayment($amount);
    }
}

// Step 4: ব্যবহার করা


// Use Stripe Gateway
$stripeGateway = new StripePaymentGateway();
$paymentService = new PaymentService($stripeGateway);
$paymentService->makePayment(100);

// Use PayPal Gateway
$paypalGateway = new PaypalPaymentGateway();
$paymentService = new PaymentService($paypalGateway);
$paymentService->makePayment(200);



