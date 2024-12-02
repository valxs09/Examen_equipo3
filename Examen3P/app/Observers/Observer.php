<?php
namespace App\Observers;

abstract class Observer
{
    // Método que se implementará para actualizar la hora
    abstract public function update();
}
