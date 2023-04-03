<?php
class Validator
{
    private $data = [];
    private $rules = [];
    private $errors = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        foreach ($this->rules as $field => $rules) {
            $value = $this->data[$field] ?? null;

            foreach (explode('|', $rules) as $rule) {
                $params = explode(':', $rule);

                switch ($params[0]) {
                    case 'required':
                        if ($value === null || $value === '') {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field is required.');
                        }
                        break;

                    case 'string':
                        if (!is_string($value)) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be a string.');
                        }
                        break;

                    case 'email':
                        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be a valid email address.');
                        }
                        break;

                    case 'min':
                        if (strlen($value) < $params[1]) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be at least ' . $params[1] . ' characters.');
                        }
                        break;

                    case 'max':
                        if (strlen($value) > $params[1]) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be at most ' . $params[1] . ' characters.');
                        }
                        break;

                    case 'in':
                        if (!in_array($value, explode(',', $params[1]))) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be one of: ' . $params[1]);
                        }
                        break;

                    case 'image':
                        if (!in_array($value['type'], ['image/jpeg', 'image/png'])) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be an image.');
                        }
                        break;

                    case 'mimes':
                        if (!in_array($value['type'], explode(',', $params[1]))) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be one of: ' . $params[1]);
                        }
                        break;

                    case 'size':

                        if ($value['size'] > $params[1] * 1024) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be less than ' . $params[1] . ' KB.');
                        }
                        break;

                    case 'file':
                        if (!is_file($value['tmp_name'])) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be a file.');
                        }
                        break;

                    case 'date':
                        if (!strtotime($value)) {
                            $this->addError($field, 'The ' . str_replace('_', ' ', $field) . ' field must be a date.');
                        }
                        break;



                    default:
                        throw new Exception('Invalid validation rule: ' . $params[0]);
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function addError(string $field, string $message)
    {
        if (!isset($this->errors[$field])) {
            $this->errors[$field] = [];
        }

        $this->errors[$field][] = $message;
    }
}
