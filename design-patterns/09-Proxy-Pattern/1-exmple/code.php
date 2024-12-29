<?php
// Subject Interface
interface Image {
    public function display();
}

// Real Object: Heavy Image Object
class RealImage implements Image {
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
        $this->loadFromDisk(); // Load heavy resource
    }

    private function loadFromDisk() {
        echo "Loading image: {$this->filename}<br>";
    }

    public function display() {
        echo "Displaying image: {$this->filename}<br>";
    }
}

// Proxy Object
class ProxyImage implements Image {
    private $realImage;
    private $filename;

    public function __construct($filename) {
        $this->filename = $filename;
    }

    public function display() {
        // Lazy loading: Load real object only when needed
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename);
        }
        $this->realImage->display();
    }
}

// Client Code
echo "Using Proxy Pattern:<br>";

// Proxy is created, but the real image is not loaded yet
$image1 = new ProxyImage("image1.jpg");

// Real image will load only when 'display' is called
$image1->display();


// Calling display again will not reload the images
$image1->display();

