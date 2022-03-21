<?php

namespace App\Models;

use App\Http\Resources\IndicationCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function services(){
        return $this->belongsToMany(Service::class,'service_indications');
    }
}
