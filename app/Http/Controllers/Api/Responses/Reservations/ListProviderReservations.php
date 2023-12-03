<?php

namespace App\Http\Controllers\Api\Responses\Reservations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\MarasiReservations;
use Carbon\Carbon;

class ListProviderReservations extends DataInterface
{
    public int $id;
    public string $date;
    public string $marasi_name;
    public array|null $user;
    public float $total;
    public string|null $payment_method;
    public string|null $payment_status;
    public string|null $reservations_status;

    /**
     * @param MarasiReservations $reservation
     * @param string $language
     */

    public function __construct(MarasiReservations $reservation, string $language = 'ar')
    {
        $this->id = $reservation->id;
        $this->date = Carbon::parse($reservation->created_at)->format('d-M-Y');
        $this->marasi_name = $language == 'en' ? $reservation->marasi->name_en : $reservation->marasi->name_ar;
        $this->provider = [
            'id' => $reservation->provider->id,
            'name' => $reservation->provider->name,
            'phone' => $reservation->provider->phone,
        ];
        $this->reservations_status = $reservation->reservations_status;
        $this->payment_method = $reservation->payment_method;
        $this->payment_status = $reservation->payment_status;
        $this->total = $reservation->total;
    }
}
