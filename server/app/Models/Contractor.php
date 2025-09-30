<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    use HasFactory;

    protected $table = 'contractors';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'legal_name',
        'display_name',
        'slug',
        'description',
        'website_url',
        'phone',
        'email',
        'headquarters_city',
        'headquarters_state',
        'country_code',
        'address_line1',
        'address_line2',
        'zip_code',
        'lat',
        'lng',
        'google_rating_avg',
        'google_rating_count',
        'status',
        'tier',
    ];
}

