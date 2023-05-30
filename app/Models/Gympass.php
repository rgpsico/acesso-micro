<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Gympass extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    protected $table = 'gympass_checkins';

    protected $connection = 'mysql';

    protected $fillable = [
        'event_type', 'unique_token', 'first_name', 'last_name', 'email', 'phone_number', 'lat', 'lon',
        'gym_id', 'gym_title', 'product_id', 'product_description', 'timestamp'
    ];

    public $timestamps = false;
}
