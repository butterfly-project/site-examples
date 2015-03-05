<?php

namespace Example;

use Butterfly\Component\Form\Transform\ITransformer;

class CustomTransformer implements ITransformer
{
    protected $koef;

    public function __construct($koef)
    {
        $this->koef = $koef;
    }

    public function transform($value)
    {
        return $this->koef * $value;
    }
}
