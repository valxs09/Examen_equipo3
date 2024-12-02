<?php
namespace App\Models;

use App\Observers\Observer;
use Carbon\Carbon;

class CityClock extends Observer
{
    protected $city;
    protected $timezone;
    protected $currentTime;

    public function __construct($city, $timezone)
    {
        $this->city = $city;
        $this->timezone = $timezone;
    }

    // Actualiza la hora según la notificación del reloj
    public function update()
    {
        $this->currentTime = Carbon::now($this->timezone)->format('H:i:s');
    }

    public function getTime()
    {
        return [
            'city' => $this->city,
            'time' => $this->currentTime,
        ];
    }
}
