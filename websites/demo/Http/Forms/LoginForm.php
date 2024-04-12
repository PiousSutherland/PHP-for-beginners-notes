<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function validate($email, $password)
    {
        $this->errors = [];

        // Validation
        if (!$email || !$password) {
            $this->error('email', 'You need to input values.');
        } else if (!Validator::email($email)) {
            $this->error('email', 'Please insert a valid email address');
        }
        if (!Validator::string($password, 8, 255))
            $this->error('password', 'Password needs to be between 8 and 255 chars.');

        return empty($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }
}
