<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'fecha_nacimiento',
        'sexo',
        'tipo_sangre',
        'alergias',
        'enfermedades_cronicas',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
