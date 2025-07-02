<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalModel extends Model
{
    protected $connection = 'mydb';
    protected $table = 'Hospital';
    protected $primaryKey = 'Id_Hospital';

    protected $fillable = [
        'Name_Hospital',
    ];

    public $timestamps = false;

}
