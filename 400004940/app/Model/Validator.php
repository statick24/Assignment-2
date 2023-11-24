<?php

namespace Model;
/**
 * Validation Class
 *
 * This class extends the AbstractValidation class, providing specific implementations for running validation checks and managing validation errors within the MVP framework's model module.
 */
class Validator extends AbstractValidator
{
    public function validate()
    {
        if (count($this->data) == 2 && (isset($this->data['email']) && isset($this->data['password']))) {
            $this->validateEmail($this->data["email"]);
            $this->validatePassword($this->data["password"]);
            if (isset($this->errors["Email"]) || isset($this->errors["Password"])) {
                unset($this->errors);
                $this->addError('Email/Password', "Invalid email/password");
            }
        } else {


            if (isset($this->data["email"])) {
                $this->validateEmail($this->data["email"]);
            }
            if (isset($this->data["password"])) {
                $this->validatePassword($this->data["password"]);
            }
            if (isset($this->data["username"])) {
                $this->validateUser($this->data["username"]);
            }
        }
    }
    public function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        $this->addError("Email", "Invalid Email Format");
        return false;
    }

    public function validatePassword($password)
    {

        if (preg_match('/^(?=.*[0-9])(?=.*[A-Z]).{10,}$/', $password)) {
            return true;
        }
        $this->addError('Password', 'Password must contain at least one upper case character, at least one digit and be at 
        least 10 characters long ');
        return false;
    }

    public function validateUser($user)
    {
        if (empty($user)) {
            $this->addError('Username', "Username cannot be empty");
            return false;
        }
        /* Make sure username is unique*/
        if (!$this->checkUser($user)) {
            $this->addError('Username', "This username is already taken");
            return false;
        }

        return true;
    }

    public function checkUser($user)
    {
        $orm = new ORM("localhost", 'root', '', 'user_management_system');
        if (!empty($orm->read('users', 'username', $user))) {
            return false;
        }
        return true;
    }
}
