<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


interface Validator
{
    /**
     * Valida os dados passados no método
     *
     * @param mixed $value Valor que será validado
     *
     * @return bool
     */
    public function validate($value);
    public function error();
}


class RequiredValidator implements Validator
{
    private $length;
    private $key;

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function validate($object)
    {
        $key = $this->key;

        if (!isset($object->$key)) {
            return false;
        }

        return !empty($object->$key);
    }

    public function error()
    {
        return "{$this->key} requerido.";
    }
}

class MaxLenghtValidator implements Validator
{
    private $length;
    private $key;

    public function __construct($key, $length)
    {
        $this->key = $key;
        $this->length = $length;
    }

    public function validate($object)
    {
        $key = $this->key;

        if (!isset($object->$key)) {
            return true;
        }

        return iconv_strlen($object->$key) <= $this->length;
    }

    public function error()
    {
        return "{$this->key} nao deve ter mais que {$this->length} caracteres";
    }
}

class MinLenghtValidator implements Validator
{
    private $length;
    private $key;

    public function __construct($key, $length)
    {
        $this->key = $key;
        $this->length = $length;
    }

    public function validate($object)
    {
        $key = $this->key;

        if (!isset($object->$key)) {
            return true;
        }

        return iconv_strlen($object->$key) >= $this->length;
    }

    public function error()
    {
        return "{$this->key} nao deve ter menos que {$this->length} caracteres";
    }
}

class Validation
{
    private $errors = array();
    private $validators = array();

    public function add(Validator $validator)
    {
        $this->validators[] = $validator;
    }

    public function __call($name, $args)
    {
        $class_name = ucfirst($name) . 'Validator';

        if (count($args) == 1) {
            $validator = new $class_name($args[0]);
        }

        if (count($args) == 2) {
            $validator = new $class_name($args[0], $args[1]);
        }

        if (count($args) == 3) {
            $validator = new $class_name($args[0], $args[1], $args[2]);
        }

        if (count($args) == 4) {
            $validator = new $class_name($args[0], $args[1], $args[2], $args[3]);
        }

        $this->add($validator);

        return $this;
    }

    public function validate($object)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($object)) {
                $this->errors[] = $validator->error();
            }
        }

        return count($this->errors) == 0;
    }

    public function errors()
    {
        return $this->errors;
    }
}


class UsersModel
{

}


$user_validation = new Validation();

// $user_validation->add(new RequiredValidator('username'));
// $user_validation->add(new RequiredValidator('password'));
// $user_validation->add(new MinLenghtValidator('password', 2));
// $user_validation->add(new MaxLenghtValidator('password', 8));
// $user_validation->add(new MinLenghtValidator('username', 2));
// $user_validation->add(new MaxLenghtValidator('username', 8));

$user_validation
    ->required('username')
    ->required('password')
    ->minLenght('password', 4);


$user = new UsersModel();
$user->username = '';
// $user->password='';

if ($user_validation->validate($user)) {
    echo 'Salva no banco';
} else {
    foreach ($user_validation->errors() as $error) {
        echo $error;
        echo '<br>';
    }
}
