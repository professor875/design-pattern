<?php
// Step 1: Define the Observer Interface
// -------------------------------------
// All observers must have an update() method.
interface Observer {
    public function update();
}

// Step 2: Define the Observable (Subject) Interface
// -------------------------------------------------
// The WeatherStation class will implement this interface.
interface Observable {
    public function addObserver(Observer $observer);
    public function removeObserver(Observer $observer);
    public function notifyObservers();
}

// Step 3: Create the Concrete Observable (WeatherStation)
// ------------------------------------------------------
// This class tracks weather data and notifies observers when it updates.
class WeatherStation implements Observable {
    private $observers = []; // List of observers
    private $temperature;
    private $windSpeed;

    // Add an observer (subscribe)
    public function addObserver(Observer $observer) {
        $this->observers[] = $observer;
    }

    // Remove an observer (unsubscribe)
    public function removeObserver(Observer $observer) {
        $this->observers = array_filter($this->observers, function ($obs) use ($observer) {
            return $obs !== $observer;
        });
    }

    // Notify all observers of an update
    public function notifyObservers() {
        foreach ($this->observers as $observer) {
            $observer->update(); // Call update() on each observer
        }
    }

    // Set new weather data
    public function setWeatherData($temperature, $windSpeed) {
        $this->temperature = $temperature;
        $this->windSpeed = $windSpeed;
        $this->notifyObservers(); // Notify all observers
    }

    // Getter methods for observers to fetch specific data
    public function getTemperature() {
        return $this->temperature;
    }

    public function getWindSpeed() {
        return $this->windSpeed;
    }
}

// Step 4: Create Concrete Observers
// ---------------------------------
// These observers store a reference to WeatherStation and fetch only what they need.

class PhoneDisplay implements Observer {
    private $weatherStation;

    // Constructor stores a reference to WeatherStation
    public function __construct(WeatherStation $weatherStation) {
        $this->weatherStation = $weatherStation;
    }

    // Fetch and display only the temperature
    public function update() {
        $temperature = $this->weatherStation->getTemperature();
        echo "Phone Display: Temperature = $temperature°C\n";
    }
}

class TVDisplay implements Observer {
    private $weatherStation;

    // Constructor stores a reference to WeatherStation
    public function __construct(WeatherStation $weatherStation) {
        $this->weatherStation = $weatherStation;
    }

    // Fetch and display only the wind speed
    public function update() {
        $windSpeed = $this->weatherStation->getWindSpeed();
        echo "TV Display: Wind Speed = $windSpeed km/h\n";
    }
}

// Step 5: Demonstrate the Observer Pattern
// ----------------------------------------

// Create a weather station (Observable)
$weatherStation = new WeatherStation();

// Create observer instances and pass the WeatherStation reference
$phoneDisplay = new PhoneDisplay($weatherStation);
$tvDisplay = new TVDisplay($weatherStation);

// Subscribe observers to the weather station
$weatherStation->addObserver($phoneDisplay);
$weatherStation->addObserver($tvDisplay);

// Update weather data (this will notify all observers)
$weatherStation->setWeatherData(25, 15); // Phone gets temperature, TV gets wind speed

// Remove TV Display and update again
$weatherStation->removeObserver($tvDisplay);
$weatherStation->setWeatherData(30, 20); // Only Phone Display gets the update now

