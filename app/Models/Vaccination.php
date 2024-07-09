<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'vax_Date', 'vax_Status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
