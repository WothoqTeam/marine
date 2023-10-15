<?php

namespace App\Http\Controllers\Api\Responses\Reservations;

use App\Http\Controllers\Api\Base\Interfaces\DataInterface;
use App\Models\Ratings;
use App\Models\Reservations;
use App\Models\Yachts;
use Carbon\Carbon;

class ReservationDetails extends DataInterface
{
    public int $id;
    public string $date;
    public int|null $yacht_id;
    public string|null $yacht_name;
    public string|null $yacht_address;
    public array|null $images;
    public array|null $user;
    public array|null $provider;
    public string|null $start_day;
    public string|null $end_day;
    public string|null $reservations_status;
    public string|null $payment_method;
    public float $total;

    /**
     * @param Reservations $reservation
     * @param string $language
     */

    public function __construct(Reservations $reservation, string $language = 'ar')
    {
        $images = array();
        $medias = $reservation->yacht->getMedia('cover');
        foreach ($medias as $image) {
            $images[] = $image->getFullUrl();
        }
        $this->id = $reservation->id;
        $this->date = Carbon::parse($reservation->created_at)->format('d-M-Y');
        $this->yacht_id = $reservation->yacht->id;
        $this->yacht_name = $language == 'en' ? $reservation->yacht->name_en : $reservation->yacht->name_ar;
        $this->yacht_address = $language == 'en' ? $reservation->yacht->address_en : $reservation->yacht->address_ar;
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
        $this->total = $reservation->total;
    }
}
