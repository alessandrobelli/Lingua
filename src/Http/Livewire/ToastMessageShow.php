<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class ToastMessageShow extends Component
{
    public $alertTypeClasses = [
        'success' => 'green',
        'warning' => 'yellow',
        'error' => 'red',
    ];

    public $message = '';

    public $alertType = 'success';

    #[On('show-toast')]
    public function setToast($message, $alertType)
    {
        $this->message = $message;
        $this->alertType = $alertType;
        $this->dispatch('toast-message-show');
    }

    public function render()
    {
        return view('lingua::livewire.toast-message-show');
    }
}
