<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'img',
        'price',
        'description',
        'service_type_id'
    ];

    public function serviceType(){
        return $this->belongsTo(ServiceType::class);
    }

    public function workers(){
        return $this->belongsToMany(Worker::class,'worker_services');
    }

    public function indications(){
        return $this->belongsToMany(Indication::class,'service_indications');
    }

    public function contraindications(){
        return $this->belongsToMany(Contraindication::class,'service_contraindications');
    }
}
