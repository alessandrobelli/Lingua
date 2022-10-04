<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ManageLocales extends Component
{
    public $localeToAdd;

    public $locales;

    protected $listeners = ['refreshLocales' => 'getLocales'];

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

    public function buildJson()
    {
        $allFiles = [];
        foreach ($this->locales as $locale) {
            $allFiles[$locale] = [];
            foreach (Translation::all() as $translation) {
                array_push($allFiles[$locale], [$translation->string => $translation->locales[$locale]]);
            }

            try {
                $resource_path = Storage::createLocalDriver(['root' => resource_path(), 'driver' => 'local']);
                $resource_path->put('/lang'.'/'.$locale.'.json', json_encode(array_merge(...$allFiles[$locale])));
                $this->emit('show-toast', 'Json Files are built!', 'success');
            } catch (\Exception $error) {
                $this->emit('show-toast', 'An error occurred! \n'.$error, 'error');
            }
        }
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
