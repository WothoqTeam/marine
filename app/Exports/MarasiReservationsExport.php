<?php
namespace App\Exports;

use App\Models\MarasiReservations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class MarasiReservationsExport implements FromCollection , WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        // Define the headers for your Excel file
        return [
            'اسم العميل',
            'البريد االلكتروني للعميل',
            'رقم هاتف العميل',
            'رقم الحجز',
            'اجمالي الحجز',
            'تاريخ الحجز'
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return MarasiReservations::leftJoin('users','users.id','marasi_reservations.provider_id')
            ->select('users.name','users.email','users.phone','marasi_reservations.id','marasi_reservations.total','marasi_reservations.created_at')
            ->get();
    }
}
