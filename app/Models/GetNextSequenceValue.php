<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

trait GetNextSequenceValue
{
    public static function getNextSequenceValue()
    {
        $self = new static();

        if (!$self->getIncrementing()) {
            throw new \Exception(sprintf('Model (%s) is not auto-incremented', static::class));
        }

        $sequenceName = "{$self->getTable()}_id_seq";

        return DB::selectOne("SELECT last_value + 1 AS val FROM $sequenceName")->val;
    }
}