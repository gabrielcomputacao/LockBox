<?php

class Validation
{

    public $validations = [];

    public static function toValidate($rules, $data)
    {

        $validationFields = new self;


        foreach ($rules as $field => $rulesField) {

            foreach ($rulesField as $rule) {

                if ($rule === 'confirmed') {
                    $validationFields->$rule($data[$field], $data['confirmemail']);
                } else if ($rule == 'min') {
                    $validationFields->$rule(6, $field, $data[$field]);
                } else if ($rule == 'strong') {
                    $validationFields->$rule('*', $field, $data[$field]);
                } else if ($rule == 'unique') {
                    $validationFields->$rule('usuarios', $field, $data[$field]);
                } else {
                    var_dump($field);
                    $validationFields->$rule($field, $data[$field]);
                }
            }
        }

        return $validationFields;
    }


    private function required($field, $value)
    {

        if (strlen($value) == 0) {
            $this->validations[] = "The $field is required";
        }
    }


    private function email($field, $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->validations[] = 'invalid email';
        }
    }

    private function confirmed($field, $confirmedField)
    {
        if ($field != $confirmedField) {
            $this->validations[] = 'Confirmation email is different';
        }
    }

    private function min($min, $field, $value)
    {
        echo $value;
        if (strlen($value) < $min) {
            $this->validations[] = "The $field must have $min character";
        }
    }

    private function strong($specialCharacter, $field, $value)
    {
        if (! strpbrk($value, $specialCharacter)) {
            $this->validations[] = "The $field must is strong";
        }
    }

    private function unique($table, $field, $value)
    {
        if (strlen($value) < 0) {
            return;
        }

        $db = new DB(config());

        $result = $db->query(
            "select * from $table where email = :value",
            null,
            [
                "value" => $value,
            ]
        )->fetch();

        if ($result) {
            $this->validations[] = "The email is used";
        }
    }

    public function notPass()
    {

        flash()->push('validation', $this->validations);

        return sizeof($this->validations) > 0;
    }
}
