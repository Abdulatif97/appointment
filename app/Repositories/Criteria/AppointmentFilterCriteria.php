<?php

namespace App\Repositories\Criteria;


use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;

class AppointmentFilterCriteria extends RequestCriteria
{
    public function apply($model, RepositoryInterface $repository)
    {
        $participantId = $repository->participantId;
        $performerId = $repository->performerId;

        if ($participantId && $performerId) {
            $model = $model->where('performer_id', $performerId)
                ->whereHas('participant', function($q) use($participantId) {
                    $q->where('participant_id', $participantId);
                })->get();
        } else {

            if ($performerId) {
                $model = $model->where('performer_id', $performerId)->get();
            }
            if ($participantId) {
                $model = $model->whereHas('participant', function($q) use($participantId) {
                    $q->where('participant_id', $participantId);
                })->get();
            }
        }

        return $model;
    }
}
