<?php

namespace InterfaceWorker\DataMapper\Mongo;

use \InterfaceWorker\DataMapper\Data;


class MongoData extends Data
{
    protected static $mapper = '\InterfaceWorker\DataMapper\Mongo\MongoMapper';

    public static function query($expr)
    {
        return static::getMapper()->query($expr);
    }

    public static function iterator($expr = null)
    {
        return static::getMapper()->iterator($expr);
    }
}
