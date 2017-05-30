<?php

namespace InterfaceWorker\DataMapper\Types;

class Integer extends Number
{
    public function normalize($value, array $attribute)
    {
        return (int) $value;
    }
}
