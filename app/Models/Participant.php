<?php

namespace App\Models;

use App\Models\Traits\MakePrefixId;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Participant.
 *
 * @package namespace App\Models;
 */
class Participant extends Model implements Transformable
{
    use TransformableTrait, MakePrefixId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
		'reference',
		'prefix',
	];


}
