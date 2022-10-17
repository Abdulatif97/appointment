<?php

namespace App\Services\Contracts;

use App\Models\Appointment;

/**
 * Interface AppointmentService.
 *
 * @package namespace App\Services\Contracts;
 */
interface AppointmentService extends BaseService
{
    /**
     * Store a newly created resource in storage
     *
     * @param array $data
     * @return Appointment
     */
    public function store(array $data);

    /**
     * Update block in the storage.
     *
     * @param  string  $id
     * @param  array  $data
     * @return Appointment
     */
    public function update(string $id, array $data);

    /**
     * Change status.
     *
     * @param string $id
     * @param string $status
     * @return Appointment
     */
    public function changeStatus(string $id, string $status);

    /**
     * Update block in the storage.
     *
     * @param  string  $id
     * @return bool
     */
    public function delete(string $id);
}
