<?php

namespace Model;

/**
 * Abstract Validation Class
 *
 * This abstract class provides a partial implementation of the ValidationInterface
 * for running validation checks and managing validation errors within the MVP framework's model module.
 */
abstract class AbstractValidator implements InterfaceValidator
{
    /**
     * @var array The data to be validated.
     */
    protected $data;
    /**
     * @var array An associative array where keys are field names and values are error messages.
     */
    protected $errors = [];
    /**
     * @var \Controller\InterfaceErrorHandler The error handler to manage validation errors.
     */
    protected $errorHandler;
    /**
     * Abstract Validation Constructor
     *
     * Initializes the validation class with the provided data and error handler.
     *
     * @param array                             $data         The data to be validated.
     * @param \Controller\InterfaceErrorHandler $errorHandler The error handler to manage validation errors.
     */
    public function __construct(array $data, \Controller\InterfaceErrorHandler $errorHandler)
    {
        $this->data = $data;
        $this->errorHandler = $errorHandler;
    }
    abstract protected function validate();

    public function runValidation()
    {
        $this->validate();
        if (!empty($this->errors)) {
            $this->errorHandler->setErrors($this->errors);
            trigger_error("Validation error has occured.");
        }
    }

    public function addError($field, $message)
    {
        $this->errors[$field] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
