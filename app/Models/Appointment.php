<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'hw_id', 'apt_Date', 'apt_Status'];

    public function healthWorker()
    {
        return $this->belongsTo(HealthWorker::class, 'hw_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
