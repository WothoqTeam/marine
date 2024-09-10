<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ReportsExport implements FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        // Format data for the Excel file
        $exportData = [];
        $exportData[] = ['Name', 'Total Reservations Amount', 'Total Platform Ratio', 'Date From', 'Date To'];

        foreach ($this->data as $item) {
            $exportData[] = [
                $item['name'],
                $item['totalReservationsAmount'],
                $item['totalPlatformRatio'],
                $item['date_from'],
                $item['date_to']
            ];
        }

        return $exportData;
    }
}

