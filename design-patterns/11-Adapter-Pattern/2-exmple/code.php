<?php 

// Step 1: Target Interface 

    // Client expects this interface
interface DistanceConverter {
    public function convertToMiles($kilometers);
}

// Step 2: Adaptee (Third-party API)

    // Third-party API works with meters
class ThirdPartyDistanceAPI {
    public function getMiles($meters) {
        return $meters * 0.000621371;
    }
}

// Step 3: Adapter Class

    // Adapter to convert kilometers to meters and use the third-party API
class DistanceAdapter implements DistanceConverter {
    private $thirdPartyAPI;

    public function __construct(ThirdPartyDistanceAPI $api) {
        $this->thirdPartyAPI = $api;
    }

    public function convertToMiles($kilometers) {
        // Convert kilometers to meters
        $meters = $kilometers * 1000;

        // Use the third-party API to get miles
        return $this->thirdPartyAPI->getMiles($meters);
    }
}

// Step 4: Client Code

// Client code
function calculateDistance(DistanceConverter $converter, $kilometers) {
    $miles = $converter->convertToMiles($kilometers);
    echo "$kilometers kilometers is equal to $miles miles.\n";
}

// Using the adapter
$thirdPartyAPI = new ThirdPartyDistanceAPI();
$adapter = new DistanceAdapter($thirdPartyAPI);

calculateDistance($adapter, 5);  // 5 kilometers
calculateDistance($adapter, 10); // 10 kilometers



