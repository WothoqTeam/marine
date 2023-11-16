<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvBanners;
use App\Models\ContactUs;
use App\Models\Employee;
use App\Models\Faqs;
use App\Models\Marasi;
use App\Models\MarasiReservations;
use App\Models\Notifications;
use App\Models\Pages;
use App\Models\Specifications;
use App\Models\Yachts;
use App\Models\YachtsMarasi;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Reservations;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $lang= App::getLocale();
        $emp=Auth::guard('admin')->user();
        if ($emp->role_id==1) {
            $data = [
                'yachts_count' => Yachts::count(),
                'specifications_count' => Specifications::count(),
                'employee_count' => Employee::count(),
                'users_count' => User::count(),
                'banners_count' => AdvBanners::count(),
                'faqs_count' => Faqs::count(),
                'marasi_count' => Marasi::count(),
                'marasi_reservations_count' => MarasiReservations::count(),
                'notifications_count' => Notifications::count(),
                'pages_count' => Pages::count(),
                'reservations_count' => Reservations::count(),
                'contactUs_count' => ContactUs::count(),
                'reservations_sum' => Reservations::where('reservations_status', 'completed')->sum('total'),
                'marasi_reservations_sum' => MarasiReservations::where('reservations_status', 'completed')->sum('total'),
                'role'=>'Admin'
            ];

            $data['yachts'] = Yachts::select('yachts.id', 'yachts.name_' . $lang . ' as name')
                ->where('yachts.status', 1)
                ->limit(6)
                ->get();

            //orders
            $now = Carbon::now();
            $month[] = $now->month;
            $year[] = $now->year;

            $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->count();
            $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->sum('total');

            for ($i = 1; $i < 12; $i++) {
                $last_month = $now->month - $i;
                if ($last_month < 1) {
                    if ($last_month == 0) {
                        $month[] = 12;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 12)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 12)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -1) {
                        $month[] = 11;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 11)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 11)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -2) {
                        $month[] = 10;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 10)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 10)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -3) {
                        $month[] = 9;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 9)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 9)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -4) {
                        $month[] = 8;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 8)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 8)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -5) {
                        $month[] = 7;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 7)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 7)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -6) {
                        $month[] = 6;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 6)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 6)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -7) {
                        $month[] = 5;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 5)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 5)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -8) {
                        $month[] = 4;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 4)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 4)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -9) {
                        $month[] = 3;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 3)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 3)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -10) {
                        $month[] = 2;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 2)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 2)->whereYear('created_at', ($now->year - 1))->sum('total');
                    } else if ($last_month == -11) {
                        $month[] = 1;
                        $year[] = $now->year - 1;
                        $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 1)->whereYear('created_at', ($now->year - 1))->count();
                        $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', 1)->whereYear('created_at', ($now->year - 1))->sum('total');
                    }
                } else {
                    $month[] = $last_month;
                    $year[] = $now->year;
                    $purchasesCount[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', $last_month)->whereYear('created_at', $now->year)->count();
                    $purchasesSum[] = Reservations::where('reservations_status', 'completed')->whereMonth('created_at', $last_month)->whereYear('created_at', $now->year)->sum('total');
                }
            }

            $purchasesSum = array_reverse($purchasesSum);
            $purchasesCount = array_reverse($purchasesCount);
            $purchasesMonth_result = array(array_reverse($month));

            //users
            $now = Carbon::now();
            $query['results'] = "[[0, 10, 20, 30, 40, 50, 30, 20, 80, 80, 70, 50, 30]]";
            $lastDay = date('m', strtotime('last month'));

            $month[] = $now->month;
            $year[] = $now->year;

            $count_user[] = User::whereMonth('created_at', $now->month)->whereYear('created_at', $now->year)->get()->count();

            for ($i = 1; $i < 12; $i++) {
                $last_month = $now->month - $i;
                if ($last_month < 1) {
                    if ($last_month == 0) {
                        $month[] = 12;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 12)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -1) {
                        $month[] = 11;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 11)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -2) {
                        $month[] = 10;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 10)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -3) {
                        $month[] = 9;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 9)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -4) {
                        $month[] = 8;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 8)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -5) {
                        $month[] = 7;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 7)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -6) {
                        $month[] = 6;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 6)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -7) {
                        $month[] = 5;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 5)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -8) {
                        $month[] = 4;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 4)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -9) {
                        $month[] = 3;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 3)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -10) {
                        $month[] = 2;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 2)->whereYear('created_at', ($now->year - 1))->get()->count();
                    } else if ($last_month == -11) {
                        $month[] = 1;
                        $year[] = $now->year - 1;
                        $count_user[] = User::whereMonth('created_at', 1)->whereYear('created_at', ($now->year - 1))->get()->count();
                    }
                } else {
                    $month[] = $last_month;
                    $year[] = $now->year;
                    $count_user[] = User::whereMonth('created_at', $last_month)->whereYear('created_at', $now->year)->get()->count();
                }
            }

            $count_user = array_reverse($count_user);
            $month_result = array(array_reverse($month));
            return view('admin/dashboard', compact('data', 'month_result', 'count_user', 'purchasesSum', 'purchasesCount', 'purchasesMonth_result'));
        }else{
            $marasi_ids=Marasi::where('employee_id',$emp->id)->pluck('id')->toArray();
            $yacht_ids=YachtsMarasi::wherein('marasi_id',$marasi_ids)->pluck('yacht_id')->toArray();
            $data = [
                'yachts_count' => Yachts::wherein('id',$yacht_ids)->count(),
                'marasi_count' => Marasi::where('employee_id',$emp->id)->count(),
                'marasi_reservations_count' => MarasiReservations::wherein('marasi_id',$marasi_ids)->count(),
                'marasi_reservations_sum' => MarasiReservations::wherein('marasi_id',$marasi_ids)->where('reservations_status', 'completed')->sum('total'),
                'role'=>'Marasi',
            ];
            return view('admin/dashboard', compact('data'));
        }
    }

    public function changLang(Request $request) {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);

        return redirect()->back();
    }
}
