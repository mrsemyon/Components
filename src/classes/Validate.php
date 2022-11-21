<?php

class Validate
{
    private $passed = false;
    private $errors = [];
    private $db = null;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function check($source, $items = [])
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $ruleValue) {
                $value = $source[$item];

                if ($rule == 'required' && empty($value)) {
                    $this->addError("{$item} is required");
                } else {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $ruleValue) {
                                $this->addError("The {$item} must be at least {$ruleValue} characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $ruleValue) {
                                $this->addError("The {$item} must be no more than {$ruleValue} characters");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$ruleValue]) {
                                $this->addError("The {$item} must match {$ruleValue}");
                            }
                            break;
                        case 'unique':
                            $check = $this->db->get($ruleValue, [$item, '=', $value]);
                            if ($check->count()) {
                                $this->addError("The {$item} alredy exists");
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }
        return $this;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function passed()
    {
        return $this->passed;
    }
}
