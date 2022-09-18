<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PsychologistStatus extends Component
{

    public $user;
    public $isActive;

    public function mount(){
        if($this->user){
            $status = ($this->user->status === 'active' ? true : false);
            $this->isActive = $status;
        }
    }
    public function updating(){
        if($this->isActive){
            $this->user->update([
                'status' => 'non-active',
            ]);
        } else {
            $this->user->update([
                'status' => 'active',
            ]);
        }
    }
    public function render()
    {
        return view('livewire.psychologist-status');
    }
}
