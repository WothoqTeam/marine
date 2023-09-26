<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Responses\ListYachts;
use App\Http\Requests\Api\Favourites\StoreFavouritesRequest;
use App\Models\Favourites;
use App\Models\Yachts;

class FavouritesApiController extends BaseApiController
{
    public function index()
    {
        $user = auth('api')->user();
        $favourites = Favourites::where('user_id', $user->id)->pluck('yacht_id')->toArray();
        $yachts = Yachts::with('city', 'country', 'provider', 'specifications')->where('status', 1)->whereIn('id', $favourites)->orderBy('id', 'DESC')->get();
        $yachts = $yachts->map(function (Yachts $yacht) use ($user) {
            return new ListYachts($yacht, $this->language,$this->user);
        })->values();
        return $this->generateResponse(true, 'Success', $yachts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavouritesRequest $request)
    {
        $user = auth('api')->user();
        $check = Favourites::where('user_id', $user->id)->where('yacht_id', $request->yacht_id)->first();
        if ($check) {
            $check->delete();
            $message = 'Deleted';
        } else {
            Favourites::create(['user_id' => $user->id, 'yacht_id' => $request->yacht_id]);
            $message = 'Added';
        }
        return $this->generateResponse(true, $message . ' Successfully', []);
    }
}
