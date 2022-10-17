<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\PerformerRepository;
use App\Models\Performer;
use App\Validators\PerformerValidator;

/**
 * Class PerformerRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PerformerRepositoryEloquent extends BaseRepository implements PerformerRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Performer::class;
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
