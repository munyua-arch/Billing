<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $fillable = [
        'connection_type',
        'first_name',
        'last_name',
        'username',
        'password',
        'expiry_date',
        'package',
        'phone_number',
        'location'
    ];
}
