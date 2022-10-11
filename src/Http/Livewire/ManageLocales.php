<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;

class ManageLocales extends Component
{
    public $localeToAdd;

    public $locales;

    protected $listeners = ['refreshLocales' => 'getLocales'];

    protected $messages = [
    'localeToAdd.required' => 'Please select a language.',

    ];

    public function addLocale()
    {
        if (Translation::all()->count() > 0) {
            $this->validate([
                'localeToAdd' => 'required',
            ]);
            if (! in_array($this->localeToAdd, $this->locales)) {
                foreach (Translation::all() as $translation) {
                    $json_array = $translation->locales;
                    $json_array[$this->localeToAdd] = '';
                    $translation->locales = $json_array;
                    $translation->save();
                }
                $this->emit('show-toast', 'Locales Successfully added', 'success');
                array_push($this->locales, $this->localeToAdd);
                $this->emit('refreshTranslations');
                $this->emit('refreshLocales');
            } else {
                $this->emit('show-toast', 'Locales already present', 'error');
            }
        } else {
            $this->emit('show-toast', 'Please scan for strings to add a locale.', 'error');
        }
    }

    public function getLocales()
    {
        $this->locales = Translation::allLocales();
    }

    public function downloadjsons()
    {
        $this->redirectRoute('lingua.downloadJsons');
    }

    public function mount()
    {
        $this->getLocales();
    }

    public function render()
    {
        return view('lingua::livewire.manage-locales', ['locales' => $this->locales, 'translationsCount' => (string) Translation::all()->count()]);
    }
}
