<?php

namespace App\Enum;

abstract class BaseEnum
{
    private $value;

    public function __construct($value = null)
    {
        if (null !== $value && !\in_array($value, $this->getConstList(), true)) {
            throw new \InvalidArgumentException(sprintf('Value "%s" is not valid.', $value));
        }

        $this->value = $value;
    }

    public function getConstList(): array
    {
        $reflection = new \ReflectionClass($this);

        return $reflection->getConstants();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
