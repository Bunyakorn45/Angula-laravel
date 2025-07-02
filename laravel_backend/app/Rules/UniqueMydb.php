<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueMydb implements Rule
{
    protected $table;
    protected $column;

    public function __construct($table, $column)
    {
        $this->table = $table;
        $this->column = $column;
    }

    public function passes($attribute, $value)
    {
        return DB::connection('mydb')
            ->table($this->table)
            ->where($this->column, $value)
            ->count() === 0;
    }

    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}