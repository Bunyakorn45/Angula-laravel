<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    protected $connection = 'mydb';
    protected $table = 'User';
    protected $primaryKey = 'Id_User';
    
    protected $fillable = [
        'Username',
        'Password',
        'Employee_Id',
        'Hospital_Id',
        'Permission_Id',
    ];
    
    public $timestamps = false;
}