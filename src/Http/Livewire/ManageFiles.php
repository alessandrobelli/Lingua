<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ManageFiles extends Component
{
    public $localeToAdd;

    public $locales;

    protected $listeners = ['refreshLocales' => 'getLocales'];

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
        return view('lingua::livewire.manage-files', ['locales' => $this->locales, 'translationsCount' => (string) Translation::all()->count()]);
    }
}
