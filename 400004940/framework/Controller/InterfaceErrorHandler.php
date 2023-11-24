<?php 
namespace Controller;
/**
 * Error Handler Interface
 *
 * This interface defines methods for handling errors within the MVP framework's controller module.
 */
interface InterfaceErrorHandler{
    /**
     * Handle Error
     *
     * Handles errors by logging, displaying, or performing other actions based on the error information.
     *
     * @param int    $errno   The level of the error raised.
     * @param string $errstr  The error message.
     * @param string $errfile The filename that the error was raised in.
     * @param int    $errline The line number the error was raised at.
     */
    public function handleError(int $errno, string $errstr, string $errfile, int $errline);
    /**
     * Set Errors
     *
     * Sets the errors for further processing or analysis within the error handler.
     *
     * @param array $errors An array of errors to be handled.
     */
    public function setErrors(array $errors);
    
}
?>