<?php


// বাস্তব জীবনের আরেকটি উদাহরণ: API রেট লিমিট কন্ট্রোল
// আপনার একটি API আছে এবং প্রতিটি ইউজার প্রতি মিনিটে কেবলমাত্র ১০টি রিকোয়েস্ট করতে পারবে। Proxy Pattern ব্যবহার করে এটি হ্যান্ডেল করা যায়।

// Subject Interface
interface Api {
    public function request($data);
}

// Real Object: Actual API
class RealApi implements Api {
    public function request($data) {
        echo "Processing API request: {$data} <br/>";
    }
}

// Proxy Object: Rate Limiter
class ApiProxy implements Api {
    private $realApi;
    private $requestCount = 0;
    private $timeWindow;

    public function __construct() {
        $this->realApi = new RealApi();
        $this->timeWindow = time();
    }

    public function request($data) {
        // Reset count if 1 minute has passed
        if (time() - $this->timeWindow > 60) {
            $this->timeWindow = time();
            $this->requestCount = 0;
        }

        if ($this->requestCount < 10) {
            $this->realApi->request($data);
            $this->requestCount++;
        } else {
            echo "Rate limit exceeded. Try again later.\n";
        }
    }
}

// Client Code
$api = new ApiProxy();

// Simulate 12 API requests
for ($i = 1; $i <= 12; $i++) {
    $api->request("Request {$i}");
}
