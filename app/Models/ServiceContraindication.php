<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceContraindication extends Model
{
    use HasFactory;

    protected $fillable=[
        'contraindication_id',
        'service_id'
    ];

    public function contraindication(){
        return $this->belongsTo(Contraindication::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }

}
