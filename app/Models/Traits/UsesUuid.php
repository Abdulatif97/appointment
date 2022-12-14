<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UsesUuid
{
    protected static function bootUsesUuid()
    {
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
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
