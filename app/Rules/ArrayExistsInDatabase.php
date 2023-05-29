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
        $existingIds = DB::table($this->table)->pluck($this->column);
        $this->noExisting = array_diff($value, $existingIds->toArray());

        return count($this->noExisting) === 0;
    }

    public function message()
    {
        return __('validation.exists');
    }
}
