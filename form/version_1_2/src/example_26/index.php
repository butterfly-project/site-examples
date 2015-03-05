<?php

namespace Example;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\ScalarConstraint;
use Butterfly\Component\Form\Transform\ToType;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$userForm = ArrayConstraint::create()
    ->addScalarConstraint('name')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Имя не может быть пустым')
    ->end()
    ->addScalarConstraint('hasPhone')
        ->addTransformer(new ToType(ToType::TYPE_BOOL))
        ->addCallableTransformer(function ($hasPhone, ScalarConstraint $constraint) {
            if (!$hasPhone) {
                $form = $constraint->getParent();
                $form->removeConstraint('phone');
            }

            return $hasPhone;
        })
    ->end()
    ->addScalarConstraint('phone')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Телефон не может быть пустым')
    ->end();

// Фильтрация
$data = array(
    'name'     => 'Bob',
    'hasPhone' => false,
);

$userForm->filter($data);

// Проверить валидность формы
var_dump($userForm->isValid()); // bool(true)
