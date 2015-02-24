<?php

namespace Example_2_1;

use Butterfly\Component\Form\ArrayConstraint;
use Butterfly\Component\Form\Transform\Trim;
use Butterfly\Component\Form\Validation\IsNotEmpty;
use Butterfly\Component\Form\Validation\StringLength;

$rootDir = realpath(__DIR__ . '/../..');

require_once $rootDir . '/vendor/autoload.php';

// Инициализация
$form = ArrayConstraint::create()
    ->addScalarConstraint('author')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Заполните поле "Автор"')
    ->end()
    ->addScalarConstraint('text')
        ->addTransformer(new Trim())
        ->addValidator(new IsNotEmpty(), 'Заполните поле "Текст"')
        ->addValidator(new StringLength(500, StringLength::LESS_OR_EQUAL), 'Текст сообщения должен быть меньше 500 символов')
    ->end();

// Фильтрация
$value = array(
    'author' => ' John Smith ',
    'text'   => 'Message text'
);
$form->filter($value);

// Проверить валидность
var_dump($form->isValid());                 // bool(true)

// Получение значений
var_dump($form->get('author')->getValue()); // string(10) "John Smith"
var_dump($form->get('text')->getValue());   // string(12) "Message text"
