<?php

namespace Model;

/**
 * Validation Interface
 *
 * This interface defines methods for running validation checks and managing validation errors
 * within the MVP framework's model module.
 */
interface InterfaceValidator
{
    /**
     * Run Validation
     *
     * Executes the validation checks for the defined rules.
     * Implementations should perform validation logic for the associated fields.
     * 
     * @return void
     */
    public function runValidation();
    /**
     * Add Error
     *
     * Adds a validation error for a specific field.
     *
     * @param string $field   The name of the field associated with the error.
     * @param string $message The error message describing the validation issue.
     *
     * @return void
     */
    public function addError($field, $message);
    /**
     * Get Errors
     *
     * Retrieves an array of validation errors.
     *
     * @return array An associative array where keys are field names and values are error messages.
     */
    public function getErrors();
}
