<?php

// Step 1: Create Subsystems

// Subsystem 1: Email Content Creation
class EmailComposer {
    public function compose($to, $subject, $message) {
        return [
            'to' => $to,
            'subject' => $subject,
            'message' => $message
        ];
    }
}

// Subsystem 2: Email Validation
class EmailValidator {
    public function validate($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            echo "Invalid email address: $email\n";
            return false;
        }
    }
}

// Subsystem 3: Email Sender
class EmailSender {
    public function send($emailData) {
        // Dummy logic to simulate email sending
        echo "Sending email to: {$emailData['to']}\n";
        echo "Subject: {$emailData['subject']}\n";
        echo "Message: {$emailData['message']}\n";
        return true;
    }
}

// Step 2: Create the Facade


class EmailFacade {
    private $composer;
    private $validator;
    private $sender;

    public function __construct() {
        $this->composer = new EmailComposer();
        $this->validator = new EmailValidator();
        $this->sender = new EmailSender();
    }

    public function sendEmail($to, $subject, $message) {
        echo "Processing email...\n";

        // Step 1: Validate email address
        if (!$this->validator->validate($to)) {
            return false;
        }

        // Step 2: Compose email
        $emailData = $this->composer->compose($to, $subject, $message);

        // Step 3: Send email
        return $this->sender->send($emailData);
    }
}

// Step 3: Client Code

// Client Code
$emailFacade = new EmailFacade();
$emailFacade->sendEmail('test@example.com', 'Hello World', 'This is a test email.');

?>
