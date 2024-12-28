<?php

// Strategy Interface
interface DiscountStrategy {
    public function calculate($amount);
}

// Concrete Strategy: Festive Discount
class FestiveDiscount implements DiscountStrategy {
    public function calculate($amount) {
        // 20% ডিসকাউন্ট
        return $amount - ($amount * 0.20);
    }
}

// Concrete Strategy: Loyalty Discount
class LoyaltyDiscount implements DiscountStrategy {
    public function calculate($amount) {
        // 15% ডিসকাউন্ট
        return $amount - ($amount * 0.15);
    }
}

// Concrete Strategy: No Discount
class NoDiscount implements DiscountStrategy {
    public function calculate($amount) {
        // কোনো ডিসকাউন্ট নেই
        return $amount;
    }
}

// Context Class
class DiscountContext {
    private $strategy;

    // ডিসকাউন্ট স্ট্রাটেজি সেট করা
    public function setStrategy(DiscountStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // মোট অ্যামাউন্ট হিসাব করা
    public function calculateFinalAmount($amount) {
        if ($this->strategy) {
            return $this->strategy->calculate($amount);
        } else {
            throw new Exception("No discount strategy set.");
        }
    }
}

// ব্যবহার উদাহরণ:

// কনটেক্সট তৈরি
$discountContext = new DiscountContext();

// ফেস্টিভ ডিসকাউন্ট
$discountContext->setStrategy(new FestiveDiscount());
echo "Festive Discount Applied: " . $discountContext->calculateFinalAmount(1000) . "<br/>";

// লয়ালটি ডিসকাউন্ট
$discountContext->setStrategy(new LoyaltyDiscount());
echo "Loyalty Discount Applied: " . $discountContext->calculateFinalAmount(1000) . "<br/>";

// কোনো ডিসকাউন্ট নেই
$discountContext->setStrategy(new NoDiscount());
echo "No Discount Applied: " . $discountContext->calculateFinalAmount(1000) . "<br/>";
