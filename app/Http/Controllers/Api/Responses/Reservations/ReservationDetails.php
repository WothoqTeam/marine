<?php

namespace App\Http\Controllers\Api\Responses\Reservations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Http\Controllers\Api\Responses\ListYachts;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\User;
use App\Models\Yachts;
use Carbon\Carbon;

class ReservationDetails extends DataInterface
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
    public object|null $times;
    /**
     * @param Reservations $reservation
     * @param User $user
     * @param string $language
     */

    public function __construct(Reservations $reservation, string $language = 'ar',User $user)
    {
        $images = array();
        $medias = $reservation->yacht->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $reservation->id;
        $this->date = Carbon::parse($reservation->created_at)->format('d-M-Y');
        $this->images = $images;
        $this->user = [
            'id' => $reservation->user->id,
            'name' => $reservation->user->name,
            'phone' => $reservation->user->phone,
            'image' => $reservation->user->image,
        ];
        $this->provider = [
            'id' => $reservation->yacht->provider->id,
            'name' => $reservation->yacht->provider->name,
            'phone' => $reservation->yacht->provider->phone,
            'image' => $reservation->yacht->provider->image,
        ];
        $this->start_day = $reservation->start_day;
        $this->end_day = $reservation->end_day;
        $this->reservations_status = $reservation->reservations_status;
        $this->payment_method = $reservation->payment_method;
        $this->payment_status = $reservation->payment_status;
        $this->total = $reservation->total;
        $this->note = $reservation->note;
        $this->yacht =  new ListYachts($reservation->yacht,$language,$user);
        $this->times = $reservation->times;
    }
}
