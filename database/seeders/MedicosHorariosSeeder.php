<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MedicosHorariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $medicos = DB::table('medicos')->pluck('id');
        $horaInicio = Carbon::createFromTimeString('10:00:00');
        $horaFin = Carbon::createFromTimeString('17:00:00');
        $intervalo = 15; // minutos
        $fechaLimite = Carbon::create(2024, 12, 23); // Fecha límite para generar horarios

        foreach ($medicos as $medicoId) {
            $fechaActual = Carbon::now()->startOfWeek(); // Comienza el lunes de la semana actual

            while ($fechaActual->lessThanOrEqualTo($fechaLimite)) {
                $inicio = $horaInicio->copy();
                while ($inicio->lessThan($horaFin)) {
                    DB::table('medicos_horarios')->insert([
                        'medico_id' => $medicoId,
                        'fecha' => $fechaActual->toDateString(),
                        'hora_inicio' => $inicio->format('H:i:s'),
                        'hora_fin' => $inicio->copy()->addMinutes($intervalo)->format('H:i:s'),
                        'estado' => 'disponible',
                    ]);
                    $inicio->addMinutes($intervalo);
                }
                $fechaActual->addDay();
            }
        }
    }
}
