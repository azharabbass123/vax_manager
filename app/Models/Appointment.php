<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['patient_id', 'hw_id', 'apt_Date', 'apt_Status'];
    protected $dates = ['deleted_at'];
    protected $table = 'appointments';

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    // Assuming HealthWorker is related to appointments through some foreign key
    public function healthWorker()
    {
        return $this->belongsTo(HealthWorker::class, 'hw_id', 'id');
    }
}
