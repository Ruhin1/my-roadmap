<?php

require __DIR__ .'/payment.php';

// User's selected payment method
$paymentType = 'bkash';

// Create the appropriate payment method using the factory
$paymentMethod = PaymentFactory::createPaymentMethod($paymentType);
echo '<pre>';
var_dump($paymentMethod);
echo '</pre>';
die();
// Use the payment method
$paymentMethod->pay(1500);
