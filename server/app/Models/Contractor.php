<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contractor extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'contractors';
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

    protected $attributes = [
        'country_code' => 'US',
        'status' => 'pending',
        'tier' => 'Certified',
    ];

    protected $casts = [
        'lat' => 'decimal:6',
        'lng' => 'decimal:6',
        'google_rating_avg' => 'decimal:1',
        'google_rating_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->id) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}

