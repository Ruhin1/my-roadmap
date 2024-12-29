<?php
// Step 1: কফির মূল ইন্টারফেস (Component Interface)
interface Coffee {
    public function getCost(); // কফির দাম
    public function getDescription(); // কফির বর্ণনা
}

// Step 2: মূল কফি ক্লাস (Concrete Component)

class SimpleCoffee implements Coffee {
    public function getCost() {
        return 50; // মূল কফির দাম
    }

    public function getDescription() {
        return "Simple Coffee"; // মূল কফির বর্ণনা
    }
}

// Step 3: ডেকোরেটর ক্লাস (Base Decorator)

class CoffeeDecorator implements Coffee {
    protected $coffee;

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee;
    }

    public function getCost() {
        return $this->coffee->getCost();
    }

    public function getDescription() {
        return $this->coffee->getDescription();
    }
}

// Step 4: নির্দিষ্ট ডেকোরেটর (Concrete Decorators) 

    // Milk (দুধ যোগ করা):

    class MilkDecorator extends CoffeeDecorator {
        public function getCost() {
            return $this->coffee->getCost() + 20; // দুধের অতিরিক্ত দাম
        }

        public function getDescription() {
            return $this->coffee->getDescription() . ", Milk"; // বর্ণনায় দুধ যোগ
        }
    }
    

    

// Step 5: ব্যবহার (Usage)


// একটি সাধারণ কফি তৈরি
$coffee = new SimpleCoffee();
echo $coffee->getDescription() . " - ₹" . $coffee->getCost() . "<br/>";

// দুধ যোগ করা হলো
$coffee = new MilkDecorator($coffee);
echo $coffee->getDescription() . " - ₹" . $coffee->getCost() . "<br/>";








