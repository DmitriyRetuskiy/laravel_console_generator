<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDataset extends Model
{
    protected $table = 'user_datasets';
    protected $fillable = [
        'contact_address',
        'register_address',
        'contact_phone',
        'passport_serial',
        'passport_number',
        'passport_address_from', // must be changed into passport_from_department
        'passport_from_date',
        'passport_cod_department',
        'passport_birthday',
        'city_birthday',
        'INN',
        'SNILS'
    ];

}
