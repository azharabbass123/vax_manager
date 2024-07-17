<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['user_id'];
    protected $dates = ['deleted_at'];
    protected $table = 'patients';


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'patient_id', 'id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }

}
