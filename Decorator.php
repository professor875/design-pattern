<?php
// Step 1: Create the Coffee Interface
// -----------------------------------
// This ensures all coffee types have a "cost" and "description".
interface Coffee {
    public function getCost();
    public function getDescription();
}

// Step 2: Create the Basic Coffee Class
// -------------------------------------
// This is the original coffee (before adding milk, sugar, etc.).
class SimpleCoffee implements Coffee {
    public function getCost() {
        return 5; // Base price of coffee
    }

    public function getDescription() {
        return "Simple Coffee";
    }
}

// Step 3: Create a Decorator Class
// --------------------------------
// This class is used to "wrap" coffee and modify it.
class CoffeeDecorator implements Coffee {
    protected $coffee; // Store the original coffee object

    public function __construct(Coffee $coffee) {
        $this->coffee = $coffee; // Save the original coffee
    }

    public function getCost() {
        return $this->coffee->getCost(); // Default: same cost as the original coffee
    }

    public function getDescription() {
        return $this->coffee->getDescription(); // Default: same description
    }
}

// Step 4: Create Specific Decorators (Milk, Sugar, etc.)
// ------------------------------------------------------

// Milk Decorator (Adds Milk)
class MilkDecorator extends CoffeeDecorator {
    public function getCost() {
        return $this->coffee->getCost() + 2; // Adding milk costs $2 extra
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ", with Milk";
    }
}

// Sugar Decorator (Adds Sugar)
class SugarDecorator extends CoffeeDecorator {
    public function getCost() {
        return $this->coffee->getCost() + 1; // Adding sugar costs $1 extra
    }

    public function getDescription() {
        return $this->coffee->getDescription() . ", with Sugar";
    }
}

// Step 5: Testing the Decorator Pattern
// -------------------------------------

// Start with a simple coffee
$coffee = new SimpleCoffee();
echo $coffee->getDescription() . " costs $" . $coffee->getCost() . "\n";
// Output: Simple Coffee costs $5

// Add Milk
$coffeeWithMilk = new MilkDecorator($coffee);
echo $coffeeWithMilk->getDescription() . " costs $" . $coffeeWithMilk->getCost() . "\n";
// Output: Simple Coffee, with Milk costs $7

// Add Sugar
$coffeeWithMilkAndSugar = new SugarDecorator($coffeeWithMilk);
echo $coffeeWithMilkAndSugar->getDescription() . " costs $" . $coffeeWithMilkAndSugar->getCost() . "\n";
// Output: Simple Coffee, with Milk, with Sugar costs $8

