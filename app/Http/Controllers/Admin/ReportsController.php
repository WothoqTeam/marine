<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ReportsExport;
use App\Http\Controllers\Controller;
use App\Models\MarasiReservations;
use App\Models\Reservations;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportsController extends Controller
{
    public function create()
    {
        return view('admin.Reports.reservations');
    }

    public function search(Request $request)
    {
        $ratio = settings()->platform_ratio;
        $data = [];

        if ($request->user_type == '1') {
            // Fetch data for Marasi Owners
            $reservations = MarasiReservations::whereBetween('start_day', [$request->startDate, $request->endDate])
                ->get();

            foreach ($reservations as $reservation) {
                $totalPlatformRatio = ($reservation->total * $ratio) / 100;
                $data[] = [
                    'name' => $reservation->marasi->name??'',
                    'totalReservationsAmount' => $reservation->total,
                    'totalPlatformRatio' => $totalPlatformRatio,
                    'date_from' => $request->startDate,
                    'date_to' => $request->endDate,
                ];
            }
        } elseif ($request->user_type == '2') {
            // Fetch data for Service Providers
            $reservations = Reservations::whereBetween('start_day', [$request->startDate, $request->endDate]);

            // Apply reservation status filter if provided
            if (!empty($request->status_name)) {
                $reservations = $reservations->where('reservations_status', $request->status_name);
            }

            $reservations = $reservations->get();

            foreach ($reservations as $reservation) {
                $totalPlatformRatio = ($reservation->total * $ratio) / 100;
                $data[] = [
                    'name' => $reservation->yacht->provider->name??'',
                    'totalReservationsAmount' => $reservation->total,
                    'totalPlatformRatio' => $totalPlatformRatio,
                    'date_from' => $request->startDate,
                    'date_to' => $request->endDate,
                ];
            }
        }

        return response()->json(['data' => $data]);
    }

    public function export(Request $request)
    {
        // Fetch data based on the request
        $data = $this->fetchData($request);

        // Export data
        return Excel::download(new ReportsExport($data), 'reports-'.time().'.xlsx');

    }

    private function fetchData(Request $request)
    {
        $ratio = settings()->platform_ratio;
        $data = [];

        if ($request->user_type == '1') {
            // Fetch data for Marasi Owners
            $reservations = MarasiReservations::whereBetween('start_day', [$request->startDate, $request->endDate])
                ->get();

            foreach ($reservations as $reservation) {
                $totalPlatformRatio = ($reservation->total * $ratio) / 100;
                $data[] = [
                    'name' => $reservation->marasi->name??'',
                    'totalReservationsAmount' => $reservation->total,
                    'totalPlatformRatio' => $totalPlatformRatio,
                    'date_from' => $request->startDate,
                    'date_to' => $request->endDate,
                ];
            }
        } elseif ($request->user_type == '2') {
            // Fetch data for Service Providers
            $reservations = Reservations::whereBetween('start_day', [$request->startDate, $request->endDate]);

            // Apply reservation status filter if provided
            if (!empty($request->status_name)) {
                $reservations = $reservations->where('reservations_status', $request->status_name);
            }

            $reservations = $reservations->get();

            foreach ($reservations as $reservation) {
                $totalPlatformRatio = ($reservation->total * $ratio) / 100;
                $data[] = [
                    'name' => $reservation->yacht->provider->name??'',
                    'totalReservationsAmount' => $reservation->total,
                    'totalPlatformRatio' => $totalPlatformRatio,
                    'date_from' => $request->startDate,
                    'date_to' => $request->endDate,
                ];
            }
        }
        // For example:
        return $data;
    }
}
