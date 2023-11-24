<?php

namespace View;

/**
 * Form Generator Interface
 *
 * This interface defines methods for generating and validating HTML forms
 * within the MVP framework's view module.
 */
interface InterfaceFormGenerator
{
    /**
     * Add Input Field
     *
     * Adds an input field to the form.
     *
     * @param string $name      The name attribute of the input.
     * @param string $label     The label for the input.
     * @param string $type      (Optional) The type of the input (default: 'text').
     * @param mixed  $value     (Optional) The value of the input (default: '').
     * @param array  $class     (Optional) Additional CSS classes for the input (default: []).
     * @param bool   $div       (Optional) Whether to wrap the input in a <div> (default: false).
     * @param array   $rules  (Optional) An array of rules for input validation
     */
    public function addInput($name, $label, $type = 'text', $value = '', $class = [], $div = false, $rules = []);

    /**
     * Add Checkbox
     *
     * Adds a checkbox input to the form.
     *
     * @param string $name   The name attribute of the checkbox.
     * @param string $label  The label for the checkbox.
     * @param array  $class  (Optional) Additional CSS classes for the checkbox (default: []).
     * @param bool   $div    (Optional) Whether to wrap the checkbox in a <div> (default: false).
     */
    public function addCheckbox($name, $label, $class = [], $div = false);

    /**
     * Add Radio Buttons
     *
     * Adds radio buttons to the form.
     *
     * @param string $name      The name attribute of the radio buttons.
     * @param string $label     The label for the radio buttons.
     * @param array  $options   An associative array of radio button options (value => label).
     * @param array  $class     (Optional) Additional CSS classes for the radio buttons (default: []).
     * @param bool   $div       (Optional) Whether to wrap the radio buttons in a <div> (default: false).
     */
    public function addRadio($name, $label, $options, $class = [], $div = false);

    /**
     * Add Textarea
     *
     * Adds a textarea to the form.
     *
     * @param string $name      The name attribute of the textarea.
     * @param string $label     The label for the textarea.
     * @param int    $cols      The number of columns for the textarea.
     * @param int    $rows      The number of rows for the textarea.
     * @param array  $class     (Optional) Additional CSS classes for the textarea (default: []).
     * @param bool   $div       (Optional) Whether to wrap the textarea in a <div> (default: false).
     */
    public function addTextArea($name, $label, $cols, $rows, $class = [], $div = false);

    /**
     * Add Select Dropdown
     *
     * Adds a select dropdown to the form.
     *
     * @param string $name      The name attribute of the select.
     * @param string $label     The label for the select.
     * @param array  $options   An associative array of options (value => label) for the select.
     * @param array  $class     (Optional) Additional CSS classes for the select (default: []).
     * @param bool   $div       (Optional) Whether to wrap the select in a <div> (default: false).
     */
    public function addSelect($name, $label, array $options, $class = [], $div = false);

    /**
     * Add Button
     *
     * Adds a button to the form.
     *
     * @param string $name      The name attribute of the button.
     * @param string $type      (Optional) The type of the button (default: 'button').
     * @param mixed  $value     (Optional) The value of the button (default: '').
     * @param array  $class     (Optional) Additional CSS classes for the button (default: []).
     * @param bool   $div       (Optional) Whether to wrap the button in a <div> (default: false).
     */
    public function addButton($name, $type = 'button', $value = '', $class = [], $div = false);

    /**
     * Add File Input
     *
     * Adds a file input to the form.
     *
     * @param string $name      The name attribute of the file input.
     * @param string $label     The label for the file input.
     * @param array  $class     (Optional) Additional CSS classes for the file input (default: []).
     * @param bool   $div       (Optional) Whether to wrap the file input in a <div> (default: false).
     */
    public function addFile($name, $label, $class = [], $div = false);

    /**
     * Add Hidden Input
     *
     * Adds a hidden input to the form.
     *
     * @param string $name      The name attribute of the hidden input.
     * @param mixed  $value     The value of the hidden input.
     * @param array  $class     (Optional) Additional CSS classes for the hidden input (default: []).
     * @param bool   $div       (Optional) Whether to wrap the hidden input in a <div> (default: false).
     */
    public function addHidden($name, $value, $class = [], $div = false);

    /**
     * Add Meter Element
     *
     * Adds a meter element to the form.
     *
     * @param string $id        The id attribute of the meter element.
     * @param mixed  $value     The value of the meter element.
     * @param mixed  $min       The minimum value of the meter element.
     * @param mixed  $max       The maximum value of the meter element.
     * @param array  $class     (Optional) Additional CSS classes for the meter element (default: []).
     * @param bool   $div       (Optional) Whether to wrap the meter element in a <div> (default: false).
     */
    public function addMeter($id, $value, $min, $max, $class = [], $div = false);

    /**
     * Add Progress Element
     *
     * Adds a progress element to the form.
     *
     * @param string $id        The id attribute of the progress element.
     * @param mixed  $value     The value of the progress element.
     * @param mixed  $max       The maximum value of the progress element.
     * @param array  $class     (Optional) Additional CSS classes for the progress element (default: []).
     * @param bool   $div       (Optional) Whether to wrap the progress element in a <div> (default: false).
     */
    public function addProgress($id, $value, $max, $class = [], $div = false);

    /**
     * Generate Form
     *
     * Generates the HTML representation of the form.
     *
     * @param string $action The form's action attribute.
     * @param string $method The form's method attribute.
     *
     * @return string The HTML representation of the form.
     */
    public function generateForm($action, $method): string;

    /**
     * Validate Form Data
     *
     * Validates the submitted form data.
     *
     * @param array $data The submitted form data.
     *
     * @return array  An array of errors.
     */
    public function validateForm($data);

    /**
     * Validate Form Data
     *
     * Validates the submitted form data.
     *
     * @param array $data The submitted form data.
     *
     * @return array An associative array with keys:
     *               - 'valid': (bool) True if the form data is valid, false otherwise.
     *               - 'message': (string) Additional message related to the form validation.
     */
    public function validateField($label, $value, $rule);
}
