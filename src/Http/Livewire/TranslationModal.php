<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;

class TranslationModal extends Component
{
    public $translation;

    public bool $isOpen = false;
    protected $listeners = [
        'closeModal' => 'close',
        'showModal' => 'open',
    ];

    public function close()
    {
        $this->isOpen = false;
        $this->translation = "";
    }

    public function open($id)
    {
        $this->isOpen = true;
        $this->translation = Translation::find($id);
    }



    public function render()
    {
        return view('lingua::livewire.translation-modal', [
            'translation' => $this->translation,
        ]);
    }
}
