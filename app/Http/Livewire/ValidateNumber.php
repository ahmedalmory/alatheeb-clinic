<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ValidateNumber extends Component
{
    public $civil;
    public function submit()
    {
        $this->validate([
            'civil' => 'required|min:10|unique:patients',
        ]);
    }
    public function render()
    {
        return view('livewire.validate-number');
    }
}
