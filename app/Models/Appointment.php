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
    public function healthWorker()
    {
        return $this->belongsTo(HealthWorker::class, 'hw_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
