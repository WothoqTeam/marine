<?php
namespace App\Exports;

use App\Models\Reservations;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ReservationsExport implements FromCollection , WithHeadings
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
        return Reservations::leftJoin('users','users.id','reservations.user_id')
            ->select('users.name','users.email','users.phone','reservations.id','reservations.total','reservations.created_at')
            ->get();
    }
}
