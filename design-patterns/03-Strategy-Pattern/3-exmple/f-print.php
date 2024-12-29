<?php

// Strategy Interface
interface ReportFormatStrategy {
    public function generateReport($data);
}

// Concrete Strategy: PDF Format
class PDFReport implements ReportFormatStrategy {
    public function generateReport($data) {
        echo "Generating PDF Report...<br/>";
        echo "PDF Content: " . json_encode($data) . "\n";
    }
}

// Concrete Strategy: Excel Format
class ExcelReport implements ReportFormatStrategy {
    public function generateReport($data) {
        echo "Generating Excel Report...<br/>";
        echo "Excel Content: " . implode(", ", $data) . "\n";
    }
}

// Concrete Strategy: CSV Format
class CSVReport implements ReportFormatStrategy {
    public function generateReport($data) {
        echo "Generating CSV Report...<br/>";
        echo "CSV Content: " . implode(",", $data) . "\n";
    }
}

// Context Class
class ReportGenerator {
    private $strategy;

    // নির্দিষ্ট ফরম্যাটের স্ট্রাটেজি সেট করা
    public function setFormatStrategy(ReportFormatStrategy $strategy) {
        $this->strategy = $strategy;
    }

    // রিপোর্ট জেনারেট করা
    public function generate($data) {
        if ($this->strategy) {
            $this->strategy->generateReport($data);
        } else {
            throw new Exception("No report format strategy set.");
        }
    }
}

// ব্যবহার উদাহরণ:

// ডাটাসেট
$data = [
    "id" => 1,
    "name" => "Ruhin Ahmed",
    "email" => "ruhin.ahmed@example.com",
    "role" => "Admin"
];

// কনটেক্সট তৈরি
$reportGenerator = new ReportGenerator();

// PDF ফরম্যাটে রিপোর্ট জেনারেট
$reportGenerator->setFormatStrategy(new PDFReport());
$reportGenerator->generate($data);
echo '<br/>';

// Excel ফরম্যাটে রিপোর্ট জেনারেট
$reportGenerator->setFormatStrategy(new ExcelReport());
$reportGenerator->generate($data);
echo '<br/>';

// CSV ফরম্যাটে রিপোর্ট জেনারেট
$reportGenerator->setFormatStrategy(new CSVReport());
$reportGenerator->generate($data);
