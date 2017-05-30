<?php

namespace InterfaceWorker\DataMapper\DB;

use InterfaceWorker\Services\Db\Select;

class DbSelect extends Select
{
    public function get($limit = null)
    {
        $result = [];

        foreach (parent::get($limit) as $data) {
            $result[$data->id()] = $data;
        }

        return $result;
    }
}
