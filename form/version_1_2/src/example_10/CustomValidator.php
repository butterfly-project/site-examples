<?php

namespace Example;

use Butterfly\Component\Form\Validation\IValidator;

class CustomValidator implements IValidator
{
    /**
     * @var int
     */
    protected $koef;

    /**
     * @var int
     */
    protected $max;

    /**
     * @param int $koef
     * @param int $max
     */
    public function __construct($koef, $max)
    {
        $this->koef = $koef;
        $this->max  = $max;
    }

    /**
     * @param mixed $value
     * @return bool
     * @throws \InvalidArgumentException if incorrect value type
     */
    public function check($value)
    {
        if (!is_int($value)) {
            throw new \InvalidArgumentException(sprintf(
                "Incorrect value. Expected integer. Given: %s",
                var_export($value, true)
            ));
        }

        return $value * $this->koef < $this->max;
    }
}
