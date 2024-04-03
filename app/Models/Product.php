<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'company',
        'city',
        'country',
        'email',
        'subscription_date',
    ];
}
