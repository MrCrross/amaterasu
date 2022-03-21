<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $fillable=[
        'last_name',
        'first_name',
        'img',
        'birthday',
        'description',
        'user_id',
        'post_id'
    ];


    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class,'worker_services');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
