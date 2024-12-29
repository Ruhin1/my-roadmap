<?php
// Step 1: Handler Interface

interface Handler {
    public function setNext(Handler $nextHandler);
    public function handle($request);
}
// Step 2: Abstract Handler

abstract class AbstractHandler implements Handler {
    protected $nextHandler;

    public function setNext(Handler $nextHandler) {
        $this->nextHandler = $nextHandler;
    }

    public function handle($request) {
        if ($this->nextHandler) {
            $this->nextHandler->handle($request);
        }
    }
}

// Step 3: Concrete Handlers

class Waiter extends AbstractHandler {
    public function handle($request) {
        if ($request === "take order") {
            echo "Waiter: I have taken your order.\n";
        } else {
            echo "Waiter: Passing to the Chef.\n";
            parent::handle($request);
        }
    }
}

class Chef extends AbstractHandler {
    public function handle($request) {
        if ($request === "cook food") {
            echo "Chef: I have cooked the food.\n";
        } else {
            echo "Chef: Passing to the Manager.\n";
            parent::handle($request);
        }
    }
}

class Manager extends AbstractHandler {
    public function handle($request) {
        if ($request === "resolve issue") {
            echo "Manager: I have resolved your issue.\n";
        } else {
            echo "Manager: Sorry, I can't handle this request.\n";
        }
    }
}

// Step 4: Client Code

// Create handlers
$waiter = new Waiter();
$chef = new Chef();
$manager = new Manager();

// Create the chain
$waiter->setNext($chef);
$chef->setNext($manager);

// Handle requests
echo "Request: Take Order\n";
$waiter->handle("take order");

echo "\nRequest: Cook Food\n";
$waiter->handle("cook food");

echo "\nRequest: Resolve Issue\n";
$waiter->handle("resolve issue");

echo "\nRequest: Unknown Task\n";
$waiter->handle("unknown");
