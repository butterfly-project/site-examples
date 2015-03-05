<?php

namespace Example;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\Compare;
use Butterfly\Component\Form\Validation\IsNotEmpty;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$userForm = ArrayConstraint::create()
    ->addScalarConstraint('username')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Имя пользователя не может быть пустым')
    ->end()
    ->addArrayConstraint('address')
        ->addScalarConstraint('city')
            ->addTransformer(new Trim())
            ->addValidator(new IsNotEmpty(), 'Город не может быть пустым')
        ->end()
        ->addScalarConstraint('street')
            ->addTransformer(new Trim())
            ->addValidator(new IsNotEmpty(), 'Улица не может быть пустой')
        ->end()
        ->addScalarConstraint('house')
            ->addValidator(new Compare(0, Compare::GREATER_OR_EQUAL), 'Номер дома должен быть больше 0')
        ->end()
    ->end();

// Фильтрация
$data = array(
    'username' => 'Bob',
    'address'  => array(
        'city'   => 'Novosibirsk',
        'street' => 'Borisa Bogatkova',
        'house'  => 262,
    ),
);

$userForm->filter($data);

// Проверить валидность формы
var_dump($userForm->isValid()); // bool(true)
