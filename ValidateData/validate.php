<?php
class validation{
  public $errors = array();

  public function validate($data, $rules){
    $valid = TRUE;
    foreach ($rules as $fieldname => $rule) {
        $callbacks = explode('|', $rule);

        foreach ($callbacks as $callback ) {
          $value = isset($data[$fieldname]) ? $data[$fieldname] : NULL;
          if ($this->$callback($value, $fieldname) == FALSE) $valid = FALSE;
        }
    }

    RETURN $valid;
  }

# on verifier si la valeur $value passer en parameters
# est une adresse email valide
  public function email($value, $fieldname){
    $valid = filter_var($value, FILTER_VALIDATE_EMAIL);
    if ($valid == FALSE) $this->errors[] = "The $fieldname is not a Valide Addresse Email";
    RETURN $valid;
  }
# on verifier si la valeur du $value n'est pas vide
  public function required($value, $fieldname){
    $valid = !empty($value);
    if ($valid == FALSE) $this->errors[] = "The $fieldname is Required";
    RETURN $valid;
  }
# on verifier si la valeur du $value contient soit (admin ou user)
  public function access($value, $fieldname){
    $values = array('admin','user');
    $valid  = in_array($value, $values);
    if ($valid == FALSE) $this->errors[] = "The $fieldname is not Correct";
    RETURN $valid;
  }
# on verifier si la valeur du $value contient un email qui se termine par @gmail.com
  public function semail($value, $fieldname){
    $string = '@gmail.com';
    $valid  = $string == substr($value, strrpos($value, $string));
    if ($valid == FALSE) $this->errors[] = "The $fieldname Should Terminated by @gmail.com";
    RETURN $valid;
  }
}
 ?>
