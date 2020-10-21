<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use Livewire\Component;

class ToastMessageShow extends Component
{
    protected $listeners = ['show-toast' => 'setToast'];
    public $alertTypeClasses = [
        'success' => ' bg-green-500 text-white',
        'warning' => ' bg-yellow-300 text-black',
        'error' => ' bg-red-500 text-white',
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
