<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkerService extends Model
{
    use HasFactory;

    protected $fillable=[
        'worker_id',
        'service_id'
    ];
}
