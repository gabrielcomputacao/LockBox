<?php

namespace Core;

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
                } elseif ($rule == 'min') {
                    $validationFields->$rule(6, $field, $data[$field]);
                } elseif ($rule == 'strong') {
                    $validationFields->$rule('*', $field, $data[$field]);
                } elseif ($rule == 'unique') {
                    $validationFields->$rule('usuarios', $field, $data[$field]);
                } else {

                    $validationFields->$rule($field, $data[$field]);
                }
            }
        }

        return $validationFields;
    }

    private function addError($field, $err)
    {

        $this->validations[$field][] = $err;
    }

    private function required($field, $value)
    {

        if (strlen($value) == 0) {
            $this->addError($field, "The $field is required");
        }
    }

    private function email($field, $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, 'invalid email');
        }
    }

    private function confirmed($field, $confirmedField)
    {
        if ($field != $confirmedField) {
            $this->addError($field, 'Confirmation email is different');
        }
    }

    private function min($min, $field, $value)
    {
        echo $value;
        if (strlen($value) < $min) {
            $this->addError($field, "The $field must have $min character");
        }
    }

    private function strong($specialCharacter, $field, $value)
    {
        if (! strpbrk($value, $specialCharacter)) {
            $this->addError($field, "The $field must is strong");
        }
    }

    private function unique($table, $field, $value)
    {
        if (strlen($value) < 0) {
            return;
        }

        $db = new Database(config());

        $result = $db->query(
            "select * from $table where email = :value",
            null,
            [
                'value' => $value,
            ]
        )->fetch();

        if ($result) {
            $this->addError($field, 'The email is used');
        }
    }

    public function notPass()
    {

        flash()->push('validation', $this->validations);

        return count($this->validations) > 0;
    }
}
