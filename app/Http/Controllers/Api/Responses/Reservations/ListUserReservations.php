<?php

namespace App\Http\Controllers\Api\Responses\Reservations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\Yachts;
use Carbon\Carbon;

class ListUserReservations extends DataInterface
{
    public int $id;
    public string $date;
    public string $yacht_name;
    public array|null $user;
    public float $total;
    public string|null $payment_method;
    public string|null $reservations_status;

    /**
     * @param Reservations $reservation
     * @param string $language
     */

    public function __construct(Reservations $reservation, string $language = 'ar')
    {
        $this->id = $reservation->id;
        $this->date = Carbon::parse($reservation->created_at)->format('d-M-Y');
        $this->yacht_name = $language == 'en' ? $reservation->yacht->name_en : $reservation->yacht->name_ar;
        $this->user = [
            'id' => $reservation->user->id,
            'name' => $reservation->user->name,
            'phone' => $reservation->user->phone,
        ];
        $this->reservations_status = $reservation->reservations_status;
        $this->payment_method = $reservation->payment_method;
        $this->total = $reservation->total;
    }
}
