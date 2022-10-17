<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Identifier.
 *
 * @package namespace App\Models;
 */
class Identifier extends Model implements Transformable
{
    use TransformableTrait, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'use',
		'type',
		'system',
		'value',
		'start_date',
		'end_date',
		'assigner',
	];


}
