<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_type',
        'package_name',
        'duration',
        'price',
        'upload_speed',
        'download_speed'
    ];
}
