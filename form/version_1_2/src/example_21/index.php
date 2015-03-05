<?php

namespace Example;

use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\ToType;
use Butterfly\Component\Form\Validation\Compare;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = new ScalarConstraint();

$form->addTransformer(new ToType(ToType::TYPE_INT));
$form->addValidator(
    new Compare(1900, Compare::GREATER_OR_EQUAL),
    'Год рождения должен быть больше чем 1900'
);

$currentYear = date('Y');
$form->addValidator(
    new Compare($currentYear, Compare::LESS_OR_EQUAL),
    sprintf('Год рождения должен быть меньше чем %d', $currentYear)
);

// Фильтрация
$form->filter('2050');

// Проверить валидность
var_dump($form->isValid());              // bool(false)
var_dump($form->getFirstErrorMessage()); // string(70) "Год рождения должен быть меньше чем 2015"
