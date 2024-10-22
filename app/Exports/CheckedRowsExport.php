<?php

namespace App\Exports;

use App\Models\PortWise;
use Maatwebsite\Excel\Concerns\FromCollection;

class CheckedRowsExport implements FromCollection
{
    protected $ids;

    public function __construct(array $ids)
    {
        $this->ids = $ids;
    }

    public function collection()
    {
        return PortWise::whereIn('id', $this->ids)->get();
    }
}
