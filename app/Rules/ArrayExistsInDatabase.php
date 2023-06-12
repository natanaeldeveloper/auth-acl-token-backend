<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class ArrayExistsInDatabase implements Rule
{
    protected $table;
    protected $column;
    protected $noExisting = [];

    public function __construct($table, $column)
    {
        $this->column = $column;
        $this->table = $table;
    }

    public function passes($attribute, $value)
    {
        $existingIds = DB::table($this->table)
            ->whereIn($this->column, $value)
            ->select($this->column)
            ->pluck($this->column)
            ->toArray();

        return count($value) === count($existingIds);
    }

    public function message()
    {
        return __('validation.exists');
    }
}
