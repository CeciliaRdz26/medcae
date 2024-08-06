<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Medico;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Medico $medico)
    {
        // Verifica si el Medico existe
        if (!$medico) {
            return redirect()->back()->withErrors('Meéico no encontrado.');
        }

        // Obtén todas las citas del Medico
        $citas = Cita::where('medico_id', $medico->id)->get();

        // Retorna la vista con las citas
        return view('admin.citas.index', [
            'citas' => $citas,
            'medico' => $medico,
        ]);
    }

    public function create()
    {
        
        return view('admin.citas.create');
    }
}
