<?php

namespace Example;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;
use Butterfly\Component\Form\Validation\IsNotNull;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

function getUser($username, $password)
{
    if ('Bob' == $username && '1234' == $password) {
        $user = new \stdClass();
        $user->username = $username;
        $user->password = $password;

        return $user;
    }

    return null;
}

// Инициализация
$userForm = ArrayConstraint::create()
    ->addScalarConstraint('username')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Введите имя пользователя')
    ->end()
    ->addScalarConstraint('password')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Введите пароль пользователя')
    ->end()
    ->addSyntheticConstraint('user')
        ->addCallableTransformer(function(ArrayConstraint $form) {
            $username = $form->get('username')->getValue();
            $password = $form->get('password')->getValue();

            return getUser($username, $password);
        })
        ->addValidator(new IsNotNull(), 'Пользователь с данным логином и паролем не найден')
    ->end();

// Фильтрация
$data = array(
    'username' => 'Bob',
    'password' => '1234'
);

$userForm->filter($data);

// Проверить валидность формы
var_dump($userForm->isValid());               // bool(true)
var_dump($userForm->get('user')->getValue()); // class stdClass#18 (2) {
                                              //   public $username => string(3) "Bob"
                                              //   public $password => string(4) "1234"
                                              // }

