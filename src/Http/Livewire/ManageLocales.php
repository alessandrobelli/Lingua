<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageLocales extends Component
{
    public $localeToAdd;

    public $locales;

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
                $this->dispatch('show-toast', message: 'Locales Successfully added', alertType: 'success');
                array_push($this->locales, $this->localeToAdd);
                $this->dispatch('refreshTranslations');
                $this->dispatch('refreshLocales');
            } else {
                $this->dispatch('show-toast', message: 'Locales already present', alertType: 'error');
            }
        } else {
            $this->dispatch('show-toast', message: 'Please scan for strings to add a locale.', alertType: 'error');
        }
    }

    #[On('refreshLocales')]
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
