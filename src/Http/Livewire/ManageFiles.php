<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;

class ManageFiles extends Component
{
    public $localeToAdd;

    public $locales;

    #[On('refreshLocales')]
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
                $this->dispatch('show-toast', message: 'Json Files are built!', alertType: 'success');
            } catch (\Exception $error) {
                $this->dispatch('show-toast', message: 'An error occurred! \n'.$error, alertType: 'error');
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
