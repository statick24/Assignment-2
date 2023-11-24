<?php

namespace View;
/**
 * Form Generator Class
 *
 * This class extends the AbstractFormGenerator class, providing specific implementations
 * for generating and validating HTML forms within the MVP framework's view module.
 */
class FormGenerator extends AbstractFormGenerator
{

    public function generateForm($action, $method): string
    {
        $form = '<div class="form-container"><form action="' . $action . '" method="' . $method . '">';
        $i = 0; // store class array index
        foreach ($this->fields as $field) {
            $form .= '<div class="row">';
            $class = "";
            if (isset($field['label']) && !empty($field['label'])) {
                $class = !empty($field['class'][$i]) ? ' class ="' . $field['class'][$i++] . '"' : '';
                if ($field['div']) {
                    $form .= '<div' . $class . '>' . '<label for="' . $field['name'] . '">' . $field['label'] . '</label></div>';
                } else {
                    $form .= '<label ' . $class . ' for="' . $field['name'] . '">'  . $field['label'] . '</label>';
                }
            }
            switch ($field["type"]) {
                case "text":
                case "email":
                case "password":
                case "tel":
                case "number":
                case "file":
                case "hidden":
                case "date":
                case "time":
                case "datetime-local":
                case "color":
                case 'button':
                case 'submit':
                case 'reset':
                    $class = !empty($field['class'][$i]) ? ' class ="' . $field['class'][$i++] . '"' : '';
                    if ($field['div']) {
                        $form .= '<div' . $class . '>' . '<input type="' . $field['type'] . '" name="' . $field['name'] . '"';
                    } else {
                        $form .= '<input ' . $class . ' type="' . $field['type'] . '" name="' . $field['name'] . '"';
                    }
                    if ($field['value']) {
                        $form .= ' value="' . $field['value'] . '"';
                    }
                    $rules = $field['rules'] ?? [];

                    if (is_array($rules)) {
                        if (in_array('required', $rules)) {
                            $form .= ' required';
                        }
                    }

                    $form .= '>';

                    if ($field['div']) {
                        $form .= '</div>';
                    }
                    $form .= '</div>';
                    $i = 0;
                    break;
                case 'select':
                    $class = !empty($field['class'][$i]) ? ' class ="' . $field['class'][$i++] . '"' : '';

                    if ($field['div']) {
                        $form .= '<div' . $class . '>' . '<select name="' . $field['name'] . '"';
                    } else {
                        $form .= '<select ' . $class . ' name="' . $field['name'] . '"';
                    }

                    $rules = $field['rules'] ?? [];

                    if (is_array($rules)) {
                        if (in_array('required', $rules)) {
                            $form .= ' required';
                        }
                    }

                    $form .= '>';
                    foreach ($field['options'] as $value => $option) {
                        $form .= '<option value="' . $value . '">' . $option . '</option>';
                    }
                    $form .= '</select>';
                    if ($field['div']) {
                        $form .= '</div>';
                    }
                    $form .= '</div>';
                    $i = 0;
            }
        }
        $form .= '</form></div>';
        return $form;
    }

    public function validateField($label, $value, $rule)
    {

        
        switch ($rule) {
            case 'required':
                return ['valid' => !empty($value), 'message' => "$label cannot be empty"];
            case 'email':
                return ['valid' => filter_var($value, FILTER_VALIDATE_EMAIL)? true: false, 'message' => "Invalid $label format"];
            case str_contains($rule, 'min_length'):
                $minLength = explode(':', $rule)[1];
                echo "";
                return ['valid' => strlen($value) >= $minLength, 'message' => "$label must  be at least and be at least " . $minLength . ' characters long'];
            case str_contains($rule, 'max_length'):
                $maxLength = explode(':', $rule)[1];
                return ['valid' => strlen($value) <= $maxLength, 'message' => "$label must  be no longer than " . $maxLength . ' characters long'];
            case 'upper_case':
                return ['valid' => (preg_match('/(?=.*[A-Z])/', $value) == 1)?true:false, 'message' => "$label must contain at least one uppercase character"];
            case "lower_case":
                return ['valid' => (preg_match('/(?=.*[a-z])/', $value) == 1)?true:false, 'message' => "$label must contain at least one lowercase character"];
            default:
                return ['valid' => true, 'message' => ''];
        }
    }
}
