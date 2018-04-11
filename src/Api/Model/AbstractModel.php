<?php

namespace App\Api\Model;

abstract class AbstractModel implements \ArrayAccess
{
    protected $id;
    protected $data;

    public function __construct($id, array $data)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset): bool
    {
        return array_key_exists($offset, $this->data);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value): void
    {
        $this->data[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset) : void
    {
        unset($this->data[$offset]);
    }

}
