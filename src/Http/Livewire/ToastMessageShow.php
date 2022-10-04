<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use Livewire\Component;

class ToastMessageShow extends Component
{
    protected $listeners = ['show-toast' => 'setToast'];

    public $alertTypeClasses = [
        'success' => 'green',
        'warning' => 'yellow',
        'error' => 'red',
    ];

    public $message = '';

    public $alertType = 'success';

    public function setToast($message, $alertType)
    {
        $this->message = $message;
        $this->alertType = $alertType;
        $this->dispatchBrowserEvent('toast-message-show');
    }

    public function render()
    {
        return view('lingua::livewire.toast-message-show');
    }
}
