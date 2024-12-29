<?php

// Product Class
class Meal {
    private $items = [];

    public function addItem($item) {
        $this->items[] = $item;
    }

    public function showItems() {
        foreach ($this->items as $item) {
            echo "Item: " . $item . PHP_EOL;
        }
    }
}

// Builder Interface
interface MealBuilder {
    public function addBurger();
    public function addDrink();
    public function getMeal();
}

// Concrete Builder: Veg Meal
class VegMealBuilder implements MealBuilder {
    private $meal;

    public function __construct() {
        $this->meal = new Meal();
    }

    public function addBurger() {
        $this->meal->addItem("Veg Burger");
    }

    public function addDrink() {
        $this->meal->addItem("Orange Juice");
    }

    public function getMeal() {
        return $this->meal;
    }
}

// Concrete Builder: Non-Veg Meal
class NonVegMealBuilder implements MealBuilder {
    private $meal;

    public function __construct() {
        $this->meal = new Meal();
    }

    public function addBurger() {
        $this->meal->addItem("Chicken Burger");
    }

    public function addDrink() {
        $this->meal->addItem("Coke");
    }

    public function getMeal() {
        return $this->meal;
    }
}

// Director Class
class MealDirector {
    public function construct(MealBuilder $builder) {
        $builder->addBurger();
        $builder->addDrink();
        return $builder->getMeal();
    }
}

// Usage
$director = new MealDirector();

echo "Veg Meal:" . PHP_EOL;
$vegMealBuilder = new VegMealBuilder();
$vegMeal = $director->construct($vegMealBuilder);
$vegMeal->showItems();

echo PHP_EOL . "Non-Veg Meal:" . PHP_EOL;
$nonVegMealBuilder = new NonVegMealBuilder();
$nonVegMeal = $director->construct($nonVegMealBuilder);
$nonVegMeal->showItems();

?>
