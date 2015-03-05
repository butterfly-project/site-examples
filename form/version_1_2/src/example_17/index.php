<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\StringLength;
use Butterfly\Component\Form\Transform\Trim;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addTransformer(new Trim())
    ->saveValue('afterTrim')
    ->addTransformer(new StringLength(6));

// Фильтрация
$form->filter(' transformers ');

// Получить значение
var_dump($form->getOldValue());         // string(14) " transformers "
var_dump($form->getValue('afterTrim')); // string(12) "transformers"
var_dump($form->getValue());            // string(6) "transf"
