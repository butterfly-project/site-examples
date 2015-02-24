<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Validation\Compare;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addValidator(new Type(Type::TYPE_INT), 'Значение должно быть числом')
    ->addValidator(new Compare(0, Compare::GREATER_OR_EQUAL), 'Значение должно быть больше 0')
    ->addValidator(new Compare(24, Compare::LESS), 'Значение должно быть меньше 24');

// Фильтрация
$form->filter('48');

// Проверить валидность
var_dump($form->isValid());              // bool(false)

// Получить ошибки
var_dump($form->getFirstErrorMessage()); // string(51) "Значение должно быть числом"
var_dump($form->getErrorMessages());     // array(2) {
                                         //      [0] => string(51) "Значение должно быть числом"
                                         //      [1] => string(54) "Значение должно быть меньше 24"
                                         // }
