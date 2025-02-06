<?php

// Step 1: Define the Strategy Interface
// -------------------------------------
// This interface declares a common method "pay()" that all payment strategies must implement.
interface PaymentStrategy
{
    public function pay($amount);
}

// Step 2: Implement Concrete Strategies
// -------------------------------------
// These classes implement different payment methods.

class PayPalPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        echo "Paid $amount using PayPal.\n";
    }
}

class CreditCardPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        echo "Paid $amount using Credit Card.\n";
    }
}

class BankTransferPayment implements PaymentStrategy
{
    public function pay($amount)
    {
        echo "Paid $amount using Bank Transfer.\n";
    }
}

// Step 3: Create the Context Class
// --------------------------------
// This class will manage the selected payment strategy and execute the payment.

class PaymentContext
{
    private $paymentStrategy; // Stores the selected payment method

    // Constructor: Accepts an object that implements PaymentStrategy
    public function __construct(PaymentStrategy $paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    // Executes the payment using the selected strategy
    public function executePayment($amount)
    {
        $this->paymentStrategy->pay($amount);
    }
}

// Step 4: Using the Strategy Pattern
// ----------------------------------
// Create instances of different payment methods and pass them to PaymentContext

// Using PayPal Payment
$paymentMethod1 = new PayPalPayment();  // Create an instance of PayPalPayment
$context1 = new PaymentContext($paymentMethod1); // Pass it to PaymentContext
$context1->executePayment(100); // Output: Paid 100 using PayPal.

// Using Credit Card Payment
$paymentMethod2 = new CreditCardPayment(); // Create an instance of CreditCardPayment
$context2 = new PaymentContext($paymentMethod2); // Pass it to PaymentContext
$context2->executePayment(250); // Output: Paid 250 using Credit Card.

// Using Bank Transfer Payment
$paymentMethod3 = new BankTransferPayment(); // Create an instance of BankTransferPayment
$context3 = new PaymentContext($paymentMethod3); // Pass it to PaymentContext
$context3->executePayment(500); // Output: Paid 500 using Bank Transfer.

