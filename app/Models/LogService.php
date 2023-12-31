<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogService extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['service_name', 'service_type_call' , 'status_code' , 'execute_time'];

}
