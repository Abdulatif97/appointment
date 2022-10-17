<?php

namespace App\Services;

use App\Repositories\Contracts\IdentifierRepository;
use App\Repositories\Contracts\ParticipantRepository;
use App\Repositories\Contracts\PerformerRepository;
use Exception;
use App\Models\Appointment;
use Illuminate\Log\Logger;
use Illuminate\Database\DatabaseManager;
use App\Repositories\Contracts\AppointmentRepository;
use App\Services\Contracts\AppointmentService as AppointmentServiceInterface;
use Illuminate\Support\Str;

/**
 * @method bool destroy
 */
class AppointmentServiceEntity  extends BaseService implements AppointmentServiceInterface
{

    /**
     * @var DatabaseManager $databaseManager
     */
    protected $databaseManager;

    /**
     * @var AppointmentRepository $repository
     */
    protected $repository;

    /**
     * @var IdentifierRepository $identifierRepository
     */
    protected $identifierRepository;

    /**
     * @var ParticipantRepository $participantRepository
     */
    protected $participantRepository;

    /**
     * @var PerformerRepository $perfomerRepository
     */
    protected $performerRepository;

    /**
     * @var Logger $logger
     */
    protected $logger;

    /**
     * Appointment constructor.
     *
     * @param DatabaseManager $databaseManager
     * @param AppointmentRepository $repository
     * @param IdentifierRepository $identifierRepository
     * @param ParticipantRepository $participantRepository
     * @param PerformerRepository $performerRepository
     * @param Logger $logger
     */
    public function __construct(
        DatabaseManager $databaseManager,
        AppointmentRepository $repository,
        IdentifierRepository $identifierRepository,
        ParticipantRepository $participantRepository,
        PerformerRepository $performerRepository,
        Logger $logger
    ) {

        $this->databaseManager     = $databaseManager;
        $this->repository     = $repository;
        $this->identifierRepository     = $identifierRepository;
        $this->participantRepository     = $participantRepository;
        $this->performerRepository     = $performerRepository;
        $this->logger     = $logger;
    }

    /**
     * Create Appointment
     *
     * @param array $data
     * @return Appointment
     * @throws \Exception
     */
    public function store(array $data)
    {
        $this->beginTransaction();
        try {
            /**
             * @var Appointment $model
             */

            /**
             * First Or Create Performer
             *
             */
            $performerData = $data['performer'];
            $performer = $this->performerRepository->firstOrCreate($performerData);
            $data['performer_id'] = $performer->id;

            /**
             *  Create Identifier
             *
             */
            $identifiers = $data['identifier'];
            $identifierIds = [];
            foreach($identifiers as $identifier) {
                $identifier['start_date'] = $identifier['period']['start'];
                $identifier['end_date'] = $identifier['period']['end'];
                unset($identifier['period']);
                $identifier = $this->identifierRepository->firstOrCreate($identifier);
                $identifierIds[] = $identifier->id;
            }

            /**
             *  Create Participants
             *
             */
            $participantsData = $data['participant'];
            $participantsIds = [];
            foreach ($participantsData as $participant) {
                $performer = $this->participantRepository->firstOrCreate($participant['actor']);
                $participantsIds[] = $performer->id;

            }

            $model = $this->repository->newInstance();
            $model->fill($data);
            if (!$model->save()) {
                throw new Exception('Appointment was not saved to the database.');
            }

            if (isset($identifierIds)) {
                $model->setIdentifiers($identifierIds);
            }

            if (isset($participantsIds)) {
                $model->setParticipant($participantsIds);
            }
            $model->refresh();
            $this->logger->info('Appointment successfully saved.', ['model_id' => $model->id]);
        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while storing an ', [
                'data' => $data,
            ]);
        }

        $this->commit();
        return $model;
    }


    /**
     * Update Appointment
     *
     * @param  string  $id
     * @param  array  $data
     *
     * @return Appointment
     *
     * @throws \Exception
     */
    public function update(string $id, array $data)
    {
        $this->beginTransaction();

        try {
            /**
             * @var Appointment $model
             */
            $model = $this->repository->update($data, $id);

            if (!$model) {
                throw new Exception('An error occurred while updating a Appointment');
            }

            $this->logger->info('Appointment  was successfully updated.');
        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while updating an articles.', [
                'id'   => $id,
                'data' => $data,
            ]);
        }
        $this->commit();
        return $model;
    }

    /**
     * Change Status Appointment
     *
     * @param string $id
     * @param string $status
     * @return Appointment
     *
     * @throws Exception
     */
    public function changeStatus(string $id, string $status)
    {
        $this->beginTransaction();

        try {
            /**
             * @var Appointment $model
             */
            $model = $this->repository->find($id);

           if (
               $model->status == Appointment::STATUS_BOOKED &&
               in_array($status,[Appointment::STATUS_ARRIVED, Appointment::STATUS_CANCELLED]) ||
               $model->status == Appointment::STATUS_ARRIVED &&
               in_array($status,[Appointment::STATUS_FULFILLED, Appointment::STATUS_CANCELLED]) ||
               !in_array($model->status,[Appointment::STATUS_FULFILLED, Appointment::STATUS_CANCELLED])
           ) {
               $model->status = $status;
               $model->save();
           } else{
                throw new Exception('Статус '. $model->status .' может быть изменен на ' . $status);
           }


            $this->logger->info('Appointment status was successfully updated.');
        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while updating an articles.', [
                'id'   => $id,
                'status' => $status,
            ]);

        }
        $this->commit();
        return $model;
    }

    /**
     * Delete Appointment
     *
     * @param  string $id
     *
     * @return bool
     *
     * @throws \Exception
     */
    public function delete(string $id)
    {

        $this->beginTransaction();

        try {
            $bufferCategory = [];
            /**
             * @var Appointment $model
             */
            $model = $this->repository->find($id);

            if (!$model->delete()) {
                throw new Exception(
                    'Appointment and  translations was not deleted from database.'
                );
            }
            $this->logger->info('Appointment  was successfully deleted from database.');
        } catch (Exception $e) {
            $this->rollback($e, 'An error occurred while deleting an Appointment.', [
                'id'   => $id,
            ]);
            return false;
        }
        $this->commit();
        return true;
    }

}
