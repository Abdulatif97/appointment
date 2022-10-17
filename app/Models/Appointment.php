<?php

namespace App\Models;

use App\Models\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Appointment.
 *
 * @package namespace App\Models;
 */
class Appointment extends Model implements Transformable
{
    use TransformableTrait, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
		'status',
		'performer_id',
	];

    /**
     * Barcha ishtirokchilar (lar) ko'rib chiqildi va uchrashuv belgilangan sana/vaqtda davom etishi tasdiqlandi.
     *  Статус "Booked" может быть изменен на "ARRIVED" или "CANCELLED".
     */
    const STATUS_BOOKED = 'BOOKED';

    /**
     * Bemor/bemorlar keldi/keldi va ko'rishni kutmoqda.
     * Статус "ARRIVED" может быть изменен на "CANCELLED" или "FULFILLED".
     */
    const STATUS_ARRIVED = 'ARRIVED';

    /**
     * Uchrashuvni rejalashtirish bosqichlari tugallandi, uchrashuv (Encounter)resursi mavjud bo'ladi va keyingi holat o'zgarishlarini kuzatib boradi.
     * E'tibor bering, ko'p sabablarga ko'ra uchrashuv maqomi bajarilgunga qadar bo'lishi mumkin.
     *  Статусы "CANCELLED" и "FULFILLED" изменяться не могут.
     */
    const STATUS_FULFILLED = 'FULFILLED';

    /**
     * Uchrashuv bekor qilindi.
     * Статусы "CANCELLED" и "FULFILLED" изменяться не могут.
     */
    const STATUS_CANCELLED = 'CANCELLED';



    public function identifier()
    {
        return $this->belongsToMany(
            Identifier::class,
            'appointment_identifiers',
            'appointment_id',
            'identifier_id'
        );
    }

    public function participant()
    {
        return $this->belongsToMany(
            Participant::class,
            'appointment_participants',
            'appointment_id',
            'participant_id'
        );
    }

    public function performer()
    {
        return $this->belongsTo(Performer::class);
    }

    public function setIdentifiers($ids = [])
    {
        $this->identifier()->sync($ids);
    }

    public function setParticipant($ids = [])
    {
        $this->participant()->sync($ids);
    }

}
