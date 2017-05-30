<?php

namespace InterfaceWorker\DataMapper\Db;

use InterfaceWorker\DataMapper\Data;
use InterfaceWorker\Service;

class DbData extends Data
{
    protected static $mapper = '\InterfaceWorker\DataMapper\DB\Mapper';

    public static function select()
    {
        return static::getMapper()->select();
    }

    public static function getBySQL($sql, array $parameters = [], Service $service = null)
    {
        $result = [];

        foreach (static::getBySQLAsIterator($sql, $parameters, $service) as $data) {
            $id = $data->id();

            if (is_array($id)) {
                $result[] = $data;
            } else {
                $result[$id] = $data;
            }
        }

        return $result;
    }

    public static function getBySQLAsIterator($sql, array $parameters = [], Service $service = null)
    {
        return static::getMapper()->getBySQLAsIterator($sql, $parameters, $service);
    }
}
