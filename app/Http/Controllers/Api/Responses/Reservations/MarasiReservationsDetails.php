<?php

namespace App\Http\Controllers\Api\Responses\Reservations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Http\Controllers\Api\Responses\ListYachts;
use App\Http\Controllers\Api\Responses\Marasi\ListMarasi;
use App\Models\MarasiReservations;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\User;
use App\Models\Yachts;
use Carbon\Carbon;

class MarasiReservationsDetails extends DataInterface
{
    public int $id;
    public string $date;
    public array|null $images;
    public array|null $user;
    public array|null $provider;
    public string|null $start_day;
    public string|null $end_day;
    public string|null $reservations_status;
    public string|null $payment_method;
    public string|null $payment_status;
    public float $total;
    public string|null $note;
    public object|null $yacht;

    /**
     * @param MarasiReservations $reservation
     * @param User $user
     * @param string $language
     */

    public function __construct(MarasiReservations $reservation, string $language = 'ar',User $user)
    {
        $images = array();
        $medias = $reservation->marasi->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $reservation->id;
        $this->date = Carbon::parse($reservation->created_at)->format('d-M-Y');
        $this->images = $images;
        $this->provider = [
            'id' => $reservation->provider->id,
            'name' => $reservation->provider->name,
            'phone' => $reservation->provider->phone,
            'image' => $reservation->provider->image,
        ];
        $this->start_day = $reservation->start_day;
        $this->end_day = $reservation->end_day;
        $this->reservations_status = $reservation->reservations_status;
        $this->payment_method = $reservation->payment_method;
        $this->payment_status = $reservation->payment_status;
        $this->total = $reservation->total;
        $this->note = $reservation->note;
        $this->marasi =  new ListMarasi($reservation->marasi,$language);
    }
}
