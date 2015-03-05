<?php

namespace Example;

use Butterfly\Component\Form\ListConstraint;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ListConstraint::create()
    ->declareAsScalar()
        ->addValidator(new Type(Type::TYPE_INT), 'Значение должно быть числом')
    ->end();

// Фильтрация
$data = array(
    100,
    200,
    'abc',
    'key' => 300,
);

$form->filter($data);

// Проверить валидность формы
var_dump($form->isValid());          // bool(false)
var_dump($form->getErrorMessages()); // array(1) {
                                     //   [0] => string(51) "Значение должно быть числом"
                                     // }
var_dump($form->get(0)->getValue()); // int(100)
var_dump($form->get(2)->isValid());  // bool(false)
var_dump($form['key']->getValue());  // int(300)
