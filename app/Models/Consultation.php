<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_id',
        'diagnosis',
        'treatment',
        'notes',
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }
}
