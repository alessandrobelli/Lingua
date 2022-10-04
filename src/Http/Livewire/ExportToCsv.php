<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;

class ExportToCsv extends Component
{
    public $locales;

    public $languageToExport;

    protected $listeners = ['refreshLocales' => 'getLocales'];

    public function mount()
    {
        $this->getLocales();
    }

    public function getLocales()
    {
        $this->locales = Translation::AllLocales();
    }

    public function exportCsv()
    {
        $this->validate([
            'languageToExport' => 'required',
        ]);
        $this->redirectRoute('lingua.download', ['language' => $this->languageToExport]);
    }

    public function render()
    {
        return view('lingua::livewire.export-to-csv');
    }
}
