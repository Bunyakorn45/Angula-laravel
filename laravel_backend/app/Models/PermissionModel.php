<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model
{
    protected $connection = 'mydb';
    protected $table = 'Permission';
    protected $primaryKey = 'Id_Permission';
    
    protected $fillable = [
        'Name_Permission',
        'Admin',
        'Umpire',
        'User',
    ];
    
    public $timestamps = false;
}
