<?php

namespace View;
/**
 * Abstract Form Generator Class
 *
 * This abstract class provides a partial implementation of the FormGeneratorInterface
 * for generating and validating HTML forms within the MVP framework's view module.
 */
abstract class AbstractFormGenerator implements InterfaceFormGenerator
{
  /**
 * @var array Stores information about form fields added using the form generator.
 */
  protected $fields = [];

  public function addInput($name, $label, $type = 'text', $value = '', $class = [], $div = false, $rules = [])
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'class' => $class,
      'type' => $type,
      'value' => $value,
      'div' => $div,
      'rules' => $rules
    ];
  }

  public function addCheckbox($name, $label, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'class' => $class,
      'div' => $div,
      'type' => 'checkbox',
      'rules' => []
    ];
  }

  public function addRadio($name, $label, $options, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'class' => $class,
      'div' => $div,
      'options' => $options,
      'type' => 'radio',
      'rules' => []

    ];
  }

  public function addTextArea($name, $label, $cols, $rows, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'cols' => $cols,
      'rows' => $rows,
      'class' => $class,
      'div' => $div,
      'type' => 'textarea',
      'rules' => []
    ];
  }

  public function addSelect($name, $label, array $options, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'options' => $options,
      'class' => $class,
      'div' => $div,
      'type' => 'select',
      'rules' => []

    ];
  }

  public function addButton($name, $type = 'button', $value = '', $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'type' => $type,
      'value' => $value,
      'class' => $class,
      'div' => $div,
      'rules' => []

    ];
  }

  public function addFile($name, $label, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'label' => $label,
      'class' => $class,
      'div' => $div,
      'type' => 'file',
      'rules' => []
    ];
  }

  public function addHidden($name, $value, $class = [], $div = false)
  {
    $this->fields[] = [
      'name' => $name,
      'value' => $value,
      'class' => $class,
      'div' => $div,
      'type' => 'hidden',
      'rules' => []

    ];
  }

  public function addMeter($id, $value, $min, $max, $class = [], $div = false)
  {
    $this->fields[] = [
      'id' => $id,
      'value' => $value,
      'min' => $min,
      'max' => $max,
      'class' => $class,
      'div' => $div,
      'type' => 'meter',
      'rules' => []

    ];
  }

  
  public function addProgress($id, $value, $max, $class = [], $div = false)
  {
    $this->fields[] = [
      'id' => $id,
      'value' => $value,
      'max' => $max,
      'class' => $class,
      'div' => $div,
      'type' => 'progress',
      'rules' => []
    ];
  }


  abstract public function generateForm($action, $method): string;

  public function validateForm($data)
  {
    $errors = [];
    //match names from form data with name from this->fields
    foreach ($data as $name => $value) {
      $i = 0;
      foreach ($this->fields as $field) {
        if ($field["name"] == $name) {
          break;
        }
        ++$i;
      }
      $rules = $this->fields[$i]['rules'] ?? [];

      $label = $this->fields[$i]['label'] ?? '';
      foreach ($rules as $rule) {
        $result = $this->validateField($label, $value, $rule);

        if (!$result['valid']) {
          $errors[$label][] = $result['message'];
        }
      }
    }
    return $errors;
  }
  abstract public function validateField($label, $value, $rule);
}
