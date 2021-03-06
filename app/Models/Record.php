<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    use HasFactory;

    protected $fillable=[
        'last_name',
        'first_name',
        'phone',
        'email',
        'service_id'
    ];


    public function service(){
        return $this->belongsTo(Service::class);
    }
}
