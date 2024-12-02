<?php
namespace App\Models;

use App\Observers\Subject;
use Carbon\Carbon;

class Clock extends Subject
{
    protected $currentTime;

    public function __construct()
    {
        $this->currentTime = Carbon::now();
    }

    // Simula el paso del tiempo
    public function tick()
    {
        $this->currentTime->addSecond();
        $this->notify(); // Notifica a los observadores
    }

    public function getTime()
    {
        return $this->currentTime->format('H:i:s');
    }
}
