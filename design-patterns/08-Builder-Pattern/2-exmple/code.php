<?php

// Product Class
class Form {
    private $fields = [];
    private $formAttributes = "";

    public function addField($field) {
        $this->fields[] = $field;
    }

    public function setAttributes($attributes) {
        $this->formAttributes = $attributes;
    }

    public function render() {
        echo "<form {$this->formAttributes}>";
        foreach ($this->fields as $field) {
            echo $field . "<br>";
        }
        echo "<button type='submit'>Submit</button>";
        echo "</form>";
    }
}
//  $form = new Form();
//  $form->setAttributes("method='POST' action='/user'");
//  $form->addField("<input type='text' name='name' placeholder='Enter name...' />");
//  $form->addField("<input type='email' name='email' placeholder='Enter name...' />");
//  $form->render();
//  die();

// Builder Interface
interface FormBuilder {
    public function setFormAttributes($attributes);
    public function addTextInput($name, $placeholder);
    public function addCheckbox($name, $label);
    public function addRadioButton($name, $value, $label);
    public function addDropdown($name, $options);
    public function getForm();
}

// Concrete Builder
class DynamicFormBuilder implements FormBuilder {
    private $form;

    public function __construct() {
        $this->form = new Form();
    }

    public function setFormAttributes($attributes) {
        $this->form->setAttributes($attributes);
    }

    public function addTextInput($name, $placeholder) {
        $this->form->addField("<input type='text' name='{$name}' placeholder='{$placeholder}'>");
    }

    public function addCheckbox($name, $label) {
        $this->form->addField("<label><input type='checkbox' name='{$name}'> {$label}</label>");
    }

    public function addRadioButton($name, $value, $label) {
        $this->form->addField("<label><input type='radio' name='{$name}' value='{$value}'> {$label}</label>");
    }

    public function addDropdown($name, $options) {
        $dropdown = "<select name='{$name}'>";
        foreach ($options as $value => $label) {
            $dropdown .= "<option value='{$value}'>{$label}</option>";
        }
        $dropdown .= "</select>";
        $this->form->addField($dropdown);
    }

    public function getForm() {
        return $this->form;
    }
}

//  $form = new DynamicFormBuilder();
//  $form->setFormAttributes("method='POST' action='/user'");
//  $form->addTextInput('name','Enter Name....');
//  $form->addCheckbox('gender','your gender');
//  $form->addRadioButton('redio','redio','lable');
//  $form->addDropdown('drop',['one'=>'one','two'=>'two']);
//  $form->getForm(); 
//  die();

// Director Class
class FormDirector {
    public function buildContactForm(FormBuilder $builder) {
        $builder->setFormAttributes("action='submit.php' method='POST'");
        $builder->addTextInput("name", "Enter your name");
        $builder->addTextInput("email", "Enter your email");
        $builder->addCheckbox("subscribe", "Subscribe to newsletter");
        $builder->addDropdown("gender", [
            "male" => "Male",
            "female" => "Female",
            "other" => "Other"
        ]);
        return $builder->getForm();
    }

    public function buildSurveyForm(FormBuilder $builder) {
        $builder->setFormAttributes("action='survey.php' method='POST'");
        $builder->addTextInput("name", "Enter your name");
        $builder->addRadioButton("satisfaction", "good", "Good");
        $builder->addRadioButton("satisfaction", "average", "Average");
        $builder->addRadioButton("satisfaction", "poor", "Poor");
        $builder->addDropdown("gender", [
            "male" => "Male",
            "female" => "Female",
            "other" => "Other"
        ]);
        return $builder->getForm();
    }
}

// Usage Example
$director = new FormDirector();

echo "<h3>Contact Form:</h3>";
$contactFormBuilder = new DynamicFormBuilder();
$contactForm = $director->buildContactForm($contactFormBuilder);
$contactForm->render();

echo "<h3>Survey Form:</h3>";
$surveyFormBuilder = new DynamicFormBuilder();
$surveyForm = $director->buildSurveyForm($surveyFormBuilder);
$surveyForm->render();

?>
