<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;

class Window extends Component
{
    public $appointments_type = 'waiting'; # can be [ waiting - today ]
    public function render()
    {
        return view('livewire.doctor.window');
    }
}
