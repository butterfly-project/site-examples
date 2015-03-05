<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\Trim;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addTransformer(new Trim());

// Фильтрация
$form->filter(' abc ');

// Получить значение
var_dump($form->getValue());    // string(3) "abc"
var_dump($form->getOldValue()); // string(5) " abc "
