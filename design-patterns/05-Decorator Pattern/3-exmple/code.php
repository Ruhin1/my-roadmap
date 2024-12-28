<?php

// Step 1: Create a FileWriter Interface
interface FileWriter {
    public function write($data);
}

// Step 2: Create a Concrete FileWriter
class BasicFileWriter implements FileWriter {
    private $filePath;

    public function __construct($filePath) {
        $this->filePath = $filePath;
    }

    public function write($data) {
        file_put_contents($this->filePath, $data, FILE_APPEND);
        echo "Data written to file: {$this->filePath}<br/>";
    }
}

// Step 3: Create an Abstract Decorator
abstract class FileWriterDecorator implements FileWriter {
    protected $fileWriter;

    public function __construct(FileWriter $fileWriter) {
        $this->fileWriter = $fileWriter;
    }

    public function write($data) {
        $this->fileWriter->write($data);
    }
}

// Step 4: Create Concrete Decorators
// Encrypt data before writing
class EncryptedFileWriter extends FileWriterDecorator {
    public function write($data) {
        $encryptedData = base64_encode($data); // Simple encryption using Base64
        echo "Data encrypted.<br/>";
        parent::write($encryptedData);
    }
}

// Log data before writing
class LoggingFileWriter extends FileWriterDecorator {
    public function write($data) {
        $logMessage = "[LOG] Writing data: " . substr($data, 0, 20) . "..."; // Log first 20 characters
        file_put_contents('app.log', $logMessage . PHP_EOL, FILE_APPEND);
        echo "Log entry created.<br/>";
        parent::write($data);
    }
}

// Step 5: Use the Decorators
$filePath = 'data.txt';

// Step 5.1: Basic File Writing
$fileWriter = new BasicFileWriter($filePath);
$fileWriter->write("Basic data.<br/>");

// Step 5.2: File Writing with Encryption
$encryptedWriter = new EncryptedFileWriter($fileWriter);
$encryptedWriter->write("Sensitive data.<br/>");

// Step 5.3: File Writing with Encryption and Logging
$loggingEncryptedWriter = new LoggingFileWriter($encryptedWriter);
$loggingEncryptedWriter->write("Highly confidential data.<br/>");

?>
