<?php

namespace Example;

use Butterfly\Component\Form\ListConstraint;
use Butterfly\Component\Form\Transform\StringLength;
use Butterfly\Component\Form\Transform\ToType;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;

$rootDir = realpath(__DIR__ . '/../..');
require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ListConstraint::create()
    ->declareAsArray()
        ->addScalarConstraint('phone')
            ->addTransformer(new Trim())
            ->addValidator(new IsNotEmpty(), 'Телефон не может быть пустым')
        ->end()
        ->addScalarConstraint('message')
            ->addTransformer(new ToType(ToType::TYPE_STRING))
            ->addTransformer(new Trim())
            ->addTransformer(new StringLength(100))
        ->end()
    ->end();

// Фильтрация
$data = array(
    array('phone' => '112233', 'message' => 'test message 1'),
    array('phone' => '112244'),
    array('phone' => '', 'message' => 'test message 3'),
);

$form->filter($data);

// Проверить валидность формы
var_dump($form[0]->isValid());              // bool(true)

var_dump($form[1]->isValid());              // bool(true)
var_dump($form[1]->getValue());             // array(2) {
                                                 //   'phone'   => string(6) "112244"
                                                 //   'message' => string(0) ""
                                                 // }

var_dump($form[2]->isValid());              // bool(false)
var_dump($form[2]->getFirstErrorMessage()); // string(52) "Телефон не может быть пустым"
