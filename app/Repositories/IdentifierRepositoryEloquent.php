<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\IdentifierRepository;
use App\Models\Identifier;
use App\Validators\IdentifierValidator;

/**
 * Class IdentifierRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class IdentifierRepositoryEloquent extends BaseRepository implements IdentifierRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Identifier::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return null;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
