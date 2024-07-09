<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = ['userId'];

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }

    public function Appointments(){
        return $this->hasMany(Appointment::class, 'patient_Id');
    }

    public function Vaccinations()
    {
        return $this->hasMany(Vaccination::class, 'patient_Id');
    }
}
