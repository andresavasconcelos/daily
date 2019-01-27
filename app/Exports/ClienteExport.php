<?php

namespace App\Exports;

use App\Cliente;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ClienteExport implements FromView
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;

        return $this->data;
    }

    public function view(): View
    {
        return view('admin.excel.clientes', [
            'clientes' => $this->data
        ]);
    }

//    public function collection()
//    {
//        return Cliente::all();
//    }
}
