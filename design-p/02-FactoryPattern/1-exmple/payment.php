<?php

interface PaymentMethod {
    public function pay($amount);
}


class CreditCard implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount using Credit Card.";
    }
}

class PayPal implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount using PayPal.";
    }
}

class Bkash implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount using Bkash.";
    }
}


class PaymentFactory {
    public static function createPaymentMethod($type) {
        switch ($type) {
            case 'credit_card':
                return new CreditCard();
            case 'paypal':
                return new PayPal();
            case 'bkash':
                return new Bkash();
            default:
                throw new Exception("Payment method not supported.");
        }
    }
}

