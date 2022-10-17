<?php

namespace App\Repositories;

use App\Repositories\Criteria\AppointmentFilterCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Contracts\AppointmentRepository;
use App\Models\Appointment;
use App\Validators\AppointmentValidator;

/**
 * Class AppointmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AppointmentRepositoryEloquent extends BaseRepository implements AppointmentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Appointment::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AppointmentValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param string $participant
     * @param string $performer
     * @return $this
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function searchByParticipantAndPerformer($participant = '', $performer = '') {
        $this->participantId = $participant;
        $this->performerId = $performer;
        $this->pushCriteria(app(AppointmentFilterCriteria::class));
        return $this;
    }
}
