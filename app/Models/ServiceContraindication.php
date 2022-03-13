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
}
