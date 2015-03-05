<?php

namespace Example;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ArrayConstraint::create()
    ->addScalarConstraint('username')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Имя пользователя не может быть пустым')
    ->end()
    ->addListConstraint('phones')
        ->declareAsScalar()
            ->addTransformer(new Trim())
            ->addValidator(new IsNotEmpty(), 'Телефон не может быть пустым')
        ->end()
    ->end();

// Фильтрация
$data = array(
    'username' => 'Bob',
    'phones' => array(
        '+12345600',
        '+12345601',
        '+12345602',
        '',
    ),
);

$form->filter($data);

// Проверить валидность формы
var_dump($form->isValid());                         // bool(false)
var_dump($form->get('username')->isValid());        // bool(true)
var_dump($form->get('phones')->isValid());          // bool(false)
var_dump($form->get('phones')->getErrorMessages()); // array(1) {
                                                    //   [0] => string(52) "Телефон не может быть пустым"
                                                    // }
