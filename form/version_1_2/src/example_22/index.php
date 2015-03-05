<?php

namespace Example;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$commentForm = ArrayConstraint::create()
    ->addScalarConstraint('username')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Имя пользователя не может быть пустым')
    ->end()
    ->addScalarConstraint('message')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Сообщение не может быть пустым')
    ->end();

// Фильтрация
$data = array(
    'username' => 'Bob',
    'message'  => 'Hello, world!!!'
);
$commentForm->filter($data);

// Проверить валидность формы
var_dump($commentForm->isValid()); // bool(true)

// Получить значение формы
var_dump($commentForm->getValue()); // array(2) {
                                    //  'username' => string(3) "Bob"
                                    //  'message'  => string(15) "Hello, world!!!"
                                    // }

// Проверить валидность вложенного констрейнта
var_dump($commentForm->get('username')->isValid());  // bool(true)

// Альтернативный способ получения вложенного констрейнта
var_dump($commentForm['username']->isValid());       // bool(true)

// Получить значение элемента
var_dump($commentForm->get('username')->getValue()); // string(3) "Bob"

