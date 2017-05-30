<?php

namespace InterfaceWorker\DataMapper\Types;

class Number extends Common
{
    public function normalize($value, array $attribute)
    {
        return $value * 1;
    }
}
