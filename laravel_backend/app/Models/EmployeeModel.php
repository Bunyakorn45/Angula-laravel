<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeModel extends Model
{
    protected $connection = 'mydb';
    protected $table = 'Employee';
    protected $primaryKey = 'Id_Employee';

    protected $fillable = [
        'Fname',
        'Lname',
        'Email',
        'Department',
    ];

    public $timestamps = false;

}
