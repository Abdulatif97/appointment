<?php

namespace App\Models;

use App\Models\Traits\MakePrefixId;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Performer.
 *
 * @package namespace App\Models;
 */
class Performer extends Model implements Transformable
{
    use TransformableTrait, MakePrefixId;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'reference',
		'prefix'
	];




}
