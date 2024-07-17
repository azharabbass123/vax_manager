<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'province_id'];

    protected $table = 'cities';

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'city_id', 'id');
    }
}
