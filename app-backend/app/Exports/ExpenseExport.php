<?php

namespace App\Exports;

use App\Models\Expense;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExpenseExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Expense::all();
    }

    public function headings(): array
    {
        return [
            'Expense ID',
            'Expense Name',
            'Expense Value',
            'Expense Date',
            'Category ID',
            'User ID',
            'Description',
            'Receipt Path'
        ];
    }

    public function map($expense): array
    {
        return [
            $expense->id,
            $expense->name,
            $expense->value,
            $expense->date,
            $expense->category_id,
            $expense->user,
            $expense->description,
            $expense->receipt_path
        ];
    }

}
