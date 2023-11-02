<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservations;
use App\Models\Setting;
use App\Models\Yachts;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function index(){
        $reservations=Reservations::with('user')->orderBy('id','DESC')->get()->toArray();
        return view('admin.reservations.index',compact('reservations'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data=Reservations::with('user','yacht')->find($id)->toArray();
        return view('admin.reservations.show', compact('data'));
    }
}
