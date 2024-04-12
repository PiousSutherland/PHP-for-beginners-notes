<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes)
    {
        $this->attributes = $attributes;

        // Validation
        if (!$attributes['email'] || !$attributes['password']) {
            $this->error('email', 'You need to input values.');
        } else if (!Validator::email($attributes['email'])) {
            $this->error('email', 'Please insert a valid email address');
        }
        if (!Validator::string($attributes['password'], 8, 255))
            $this->error('password', 'Password needs to be between 8 and 255 chars.');
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        if ($instance->hasErrors()) {
            ValidationException::throw($instance->errors(), $instance->attributes);
        }

        return $instance;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) !== 0;
    }
}
