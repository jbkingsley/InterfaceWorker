<?php

namespace InterfaceWorker\DataMapper\Types;

class Text extends Common
{
    public function normalize($value, array $attribute)
    {
        return $this->isNull($value) ? null : (string) $value;
    }
}
