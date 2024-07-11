<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccination extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['patient_id', 'vax_Date', 'vax_Status'];
    protected $dates = ['deleted_at'];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
