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
    'username' => '',
    'message'  => ''
);
$commentForm->filter($data);

// Проверить валидность формы
var_dump($commentForm->isValid());                   // bool(false)

// Проверить валидность вложенного констрейнта
var_dump($commentForm->get('username')->isValid());  // bool(false)

// Получение сообщений об ошибках с формы
var_dump($commentForm->getErrorMessages()); // array(2) {
                                            //   [0] => string(69) "Имя пользователя не может быть пустым"
                                            //   [1] => string(56) "Сообщение не может быть пустым"
                                            // }

// Получение сообщений об ошибках с констрейнта
var_dump($commentForm->get('username')->getErrorMessages()); // array(1) {
                                                             //   [0] => string(69) "Имя пользователя не может быть пустым"
                                                             // }
