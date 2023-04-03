<?php


class Request
{
    private $data = [];
    private $files = [];

    public function __construct()
    {
        $this->data = array_merge($_POST, $_GET);
        $this->files = $_FILES;
    }

    public function get(string $key, $default = null)
    {
        return $this->data[$key] ?? $default;
    }

    // make accessible if

    public function all(): array
    {
        return $this->data;
    }

    public function has(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function file(string $key): ?array
    {
        return $this->files[$key] ?? null;
    }

    public function validate(array $rules): ?array
    {
        $validator = new Validator($this->data, $rules);

        if (!$validator->validate()) {
            $errors = $validator->getErrors();
            header('HTTP/1.1 422 Unprocessable content');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode($errors));
        }

        return null;
    }
}
