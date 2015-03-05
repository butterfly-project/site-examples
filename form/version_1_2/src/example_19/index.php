<?php

namespace Example;

use Butterfly\Component\Form\IConstraint;
use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;
use Butterfly\Component\Form\Validation\StringLength;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ScalarConstraint::create()
    ->addTransformer(new Trim())
    ->addValidator(new IsNotEmpty(), 'Пароль не должен состоять из пробелов')
    ->restoreValue(IConstraint::VALUE_BEFORE)
    ->addValidator(new StringLength(6, StringLength::GREATER_OR_EQUAL), 'Минимальная длина пароля 6 символов');

// Фильтрация
$form->filter(' me password ');

// Проверить валидность
var_dump($form->isValid());  // bool(true)

// Получить значение
var_dump($form->getValue()); // string(13) " me password "
