<?php

namespace Example;

use Butterfly\Component\Form\IConstraint;
use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\Trim;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addTransformer(new Trim());

// Фильтрация
$form->filter(' value ');

// Получить значение
var_dump($form->getValue());                          // string(5) "value"
var_dump($form->getValue(IConstraint::VALUE_AFTER));  // string(5) "value"

var_dump($form->getOldValue());                       // string(7) " value "
var_dump($form->getValue(IConstraint::VALUE_BEFORE)); // string(7) " value "
