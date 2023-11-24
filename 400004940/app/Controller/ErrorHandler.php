<?php

namespace Controller;

/**
 * Error Handler Class
 *
 * This class extends the AbstractErrorHandler class, providing a concrete
 * implementation of error handling within the MVP framework's controller module.
 */
class ErrorHandler extends AbstractErrorHandler
{
    public function handleError($errno, $errstr, $errfile, $errline)
    {
        // Place errors in session
        if (!empty($this->errors)) {
            $session = new Session();

            $session->set('errors', $this->errors);
        }
        // Log errors
        $error_message = "Error: [$errno] $errstr in $errfile on line $errline";
        error_log($error_message . "\n", 3, "error_log.txt");
    }
}
