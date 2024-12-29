<?php 
// Step 1: Base Handler Interface

interface SupportHandler {
    public function setNext(SupportHandler $nextHandler);
    public function handle($request);
}

// Step 2: Abstract Handler Class

abstract class AbstractSupportHandler implements SupportHandler {
    protected $nextHandler;

    public function setNext(SupportHandler $nextHandler) {
        $this->nextHandler = $nextHandler;
    }

    public function handle($request) {
        if ($this->nextHandler) {
            $this->nextHandler->handle($request);
        }
    }
}

// Step 3: Concrete Handlers

class Level1Support extends AbstractSupportHandler {
    public function handle($request) {
        if ($request === "basic") {
            echo "Level 1 Support: Solved the basic issue.\n";
        } else {
            echo "Level 1 Support: Passing to next level.\n";
            parent::handle($request);
        }
    }
}

class Level2Support extends AbstractSupportHandler {
    public function handle($request) {
        if ($request === "intermediate") {
            echo "Level 2 Support: Solved the intermediate issue.\n";
        } else {
            echo "Level 2 Support: Passing to next level.\n";
            parent::handle($request);
        }
    }
}

class ManagerSupport extends AbstractSupportHandler {
    public function handle($request) {
        if ($request === "complex") {
            echo "Manager: Solved the complex issue.<br/>";
        } else {
            echo "Manager: Issue could not be resolved.<br/>";
        }
    }
}

// Step 4: Client Code

// Create handlers
$level1 = new Level1Support();
$level2 = new Level2Support();
$manager = new ManagerSupport();

// Create the chain
$level1->setNext($level2);
$level2->setNext($manager);

// Handle requests
echo "Request: Basic Issue\n";
$level1->handle("basic");

echo "\nRequest: Intermediate Issue\n";
$level1->handle("intermediate");

echo "\nRequest: Complex Issue\n";
$level1->handle("complex");

echo "\nRequest: Unknown Issue\n";
$level1->handle("unknown");



