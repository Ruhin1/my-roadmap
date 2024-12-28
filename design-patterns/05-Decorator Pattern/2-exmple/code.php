<?php

//Step 1: Validation Interface (Component Interface)
interface Validator {
    public function validate($input): bool; // ভ্যালিডেশন পাস করলে true, না হলে false
    public function getErrorMessage(): string; // ত্রুটির মেসেজ
}

//Step 2: Base Validator (Concrete Component)
class BaseValidator implements Validator {
    public function validate($input): bool {
        return true; // কোনো বেসিক ভ্যালিডেশন নেই
    }

    public function getErrorMessage(): string {
        return ""; // ত্রুটির মেসেজ নেই
    }
}

//Step 3: Validation Decorator (Base Decorator)
class ValidationDecorator implements Validator {
    protected $validator;

    public function __construct(Validator $validator) {
        $this->validator = $validator;
    }

    public function validate($input): bool {
        return $this->validator->validate($input);
    }

    public function getErrorMessage(): string {
        return $this->validator->getErrorMessage();
    }
}

//Step 4: Specific Validators (Concrete Decorators)

    //Required Field Validator:
    class RequiredValidator extends ValidationDecorator {
        private $errorMessage = "This field is required.";

        public function validate($input): bool {
            if (trim($input) === "") {
                return false;
            }
            return $this->validator->validate($input);
        }

        public function getErrorMessage(): string {
            return !$this->validate("") ? $this->errorMessage : $this->validator->getErrorMessage();
        }
    }

    //Email Format Validator:
    class EmailValidator extends ValidationDecorator {
        private $errorMessage = "Invalid email format.";

        public function validate($input): bool {
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                return false;
            }
            return $this->validator->validate($input);
        }

        public function getErrorMessage(): string {
            return !$this->validate("invalid@") ? $this->errorMessage : $this->validator->getErrorMessage();
        }
    }

    //Minimum Length Validator:
    class MinLengthValidator extends ValidationDecorator {
        private $minLength;
        private $errorMessage;

        public function __construct(Validator $validator, $minLength) {
            parent::__construct($validator);
            $this->minLength = $minLength;
            $this->errorMessage = "Minimum length must be {$this->minLength} characters.";
        }

        public function validate($input): bool {
            if (strlen($input) < $this->minLength) {
                return false;
            }
            return $this->validator->validate($input);
        }

        public function getErrorMessage(): string {
            return !$this->validate("") ? $this->errorMessage : $this->validator->getErrorMessage();
        }
    }

//Step 5: Usage

    // User input data
    $userInput = [
        'name' => '',
        'email' => 'invalid_email',
        'password' => '123'
    ];

    // Validators for 'name' field
    $nameValidator = new RequiredValidator(new BaseValidator());

    // Validators for 'email' field
    $emailValidator = new EmailValidator(new RequiredValidator(new BaseValidator()));

    // Validators for 'password' field
    $passwordValidator = new MinLengthValidator(new RequiredValidator(new BaseValidator()), 6);

    // Validate and display results
    echo "Name Validation: \n";
    if (!$nameValidator->validate($userInput['name'])) {
        echo $nameValidator->getErrorMessage() . "<br/>";
    }

    echo "\nEmail Validation: \n";
    if (!$emailValidator->validate($userInput['email'])) {
        echo $emailValidator->getErrorMessage() . "<br/>";
    }

    echo "\nPassword Validation: \n";
    if (!$passwordValidator->validate($userInput['password'])) {
        echo $passwordValidator->getErrorMessage() . "<br/>";
    }





