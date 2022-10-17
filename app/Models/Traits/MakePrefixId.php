<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait MakePrefixId
{
    protected static function bootMakePrefixId()
    {
        static::creating(function ($model) {
            $data = explode("/",$model->reference);
            $model->prefix = $data[0];
            $model->id = $data[1];

        });
    }

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    public function getKeyType()
    {
        return 'string';
    }

    public $incrementing = true;


}
