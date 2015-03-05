<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Validation\Type;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addValidator(new Type(Type::TYPE_INT), 'Значение должно быть целым числом');

// Фильтрация
$form->filter('abc');

// Проверить валидность
var_dump($form->isValid());              // bool(false)

// Получить сообщение ошибки
var_dump($form->getFirstErrorMessage()); // string(62) "Значение должно быть целым числом"
