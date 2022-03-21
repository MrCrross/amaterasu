<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceIndication extends Model
{
    use HasFactory;

    protected $fillable=[
        'indication_id',
        'service_id'
    ];

    public function indication(){
        return $this->belongsTo(Indication::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
