<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'especialidad',
        'cedula',
        'direccion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


// $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
// $table->string('especialidad');
// $table->string('cedula');
// $table->string('direccion');