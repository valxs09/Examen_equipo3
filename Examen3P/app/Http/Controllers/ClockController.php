<?php

namespace App\Http\Controllers;

use App\Models\Clock;
use App\Models\CityClock;

class ClockController extends Controller
{
    public function getTime()
    {
        // Crear el reloj (sujeto)
        $clock = new Clock();

        // Crear observadores (ciudades)
        $madrid = new CityClock('Madrid', 'Europe/Madrid');
        $ny = new CityClock('New York', 'America/New_York');

        // Registrar los observadores al reloj
        $clock->attach($madrid);
        $clock->attach($ny);

        // Simular el paso del tiempo
        $clock->tick();

        // Devolver las horas de las ciudades
        return response()->json([
            $madrid->getTime(),
            $ny->getTime(),
        ]);
    }
}
