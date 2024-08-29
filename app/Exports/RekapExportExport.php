<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class RekapExportExport implements FromCollection
{
    /**
     * @return Collection
     */
    public function collection()
    {
        return collect([]);
    }
}
