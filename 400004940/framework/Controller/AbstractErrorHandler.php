<?php

namespace Controller;

/**
 * Constructor for Error Handler Class
 *
 * This constructor initializes the Error Handler class with a specified error level and initial errors.
 * It also sets up the error handler function using set_error_handler.
 *
 * @param int   $errorLevel The error reporting level to be used by the error handler.
 * @param array $errors     An optional array of errors to be initialized within the error handler.
 */
abstract class AbstractErrorHandler implements InterfaceErrorHandler
{
    /**
     * @var int $errorLevel The error reporting level to be used by the error handler.
     */
    protected $errorLevel;
    /**
     * @var array An array to store errors for further processing or analysis.
     */
    protected $errors = [];
    public function __construct(int $errorLevel, array $errors = [])
    {
        $this->errorLevel = $errorLevel;
        $this->errors = $errors;
        set_error_handler([$this, "handleError"], $this->errorLevel);
    }

    public function setErrors(array $errors)
    {
        $this->errors = $errors;
    }

    abstract public function handleError($errno, $errstr, $errfile, $errline);
    /**
     * Destructor for Error Handler Class
     *
     * This destructor restores the previous error handler when the Error Handler class is being destructed.
     * It is automatically called when the object is no longer referenced.
     * This ensures that the error handling behavior is reverted to the state before the object was created.
     */
    public function __destruct()
    {
        restore_error_handler();
    }
}
