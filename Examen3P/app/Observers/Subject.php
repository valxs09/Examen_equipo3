<?php
namespace App\Observers;

abstract class Subject
{
    protected $observers = []; // Lista de observadores

    // Método para registrar observadores
    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    // Método para notificar cambios
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}
