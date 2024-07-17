<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthWorker extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id'];
    protected $dates = ['deleted_at'];
    protected $table = 'health_workers';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'hw_id', 'id');
    }
}
