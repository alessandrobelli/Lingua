<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;
use Storage;

class ConfirmDeleteModal extends Component
{
    public bool $isOpen = false;

    public $entityToDelete;

    public $whatToDelete;

    public $params = [];

    public $message;

    protected $listeners = [
        'closeModal' => 'close',
        'confirmDelete' => 'open',
    ];

    public function delete()
    {
        if ($this->entityToDelete === 'locale') {
            foreach (Translation::all() as $translation) {
                $json_array = $translation->locales;
                $locales = explode(',', $this->params);
                foreach ($locales as $locale) {
                    if (array_key_exists($locale, $json_array) && $locale == $this->whatToDelete) {
                        unset($json_array[$locale]);
                    } elseif (! array_key_exists($locale, $json_array) && $locale != $this->whatToDelete) {
                        $json_array[$locale] = '';
                    }
                }
                $translation->locales = $json_array;
                $translation->save();
            }
            $this->deleteLocaleFiles();
        } elseif ($this->entityToDelete === 'translations') {
            $this->deleteLocaleFiles();
            Translation::truncate();
            $this->emit('refreshTranslations');
            $this->emit('show-toast', 'All translations deleted', 'success');
            $this->isOpen = false;
        } elseif ($this->entityToDelete === 'merge translations') {
            $this->emit('merge', $this->params[0], $this->params[1]);
            $this->isOpen = false;
        }
    }

    public function close()
    {
        $this->whatToDelete = '';
        $this->isOpen = false;
    }

    public function open($entityToDelete, $whatToDelete, $params, $message = '')
    {
        $this->entityToDelete = $entityToDelete;
        $this->whatToDelete = $whatToDelete;
        $this->params = $params;
        $this->message = $message;
        $this->isOpen = true;
    }

    public function mount()
    {
        $this->whatToDelete = '';
    }

    public function render()
    {
        return view('lingua::livewire.confirm-delete-modal');
    }

    private function deleteLocaleFiles(): void
    {
        $resource_path = Storage::createLocalDriver(['root' => resource_path(), 'driver' => 'local']);
        if ($this->entityToDelete === 'translations') {
            foreach (Translation::allLocales() as $locale) {
                try {
                    $resource_path->delete('/lang/'.$locale.'.json');
                } catch (\Exception $e) {
                    $this->emit('refreshLocales');
                    $this->emit('show-toast', 'There it was an error while deleting a locale file.', 'error');
                    $this->isOpen = false;
                }
            }
            $this->emit('refreshLocales');
        } elseif ($this->entityToDelete == 'locale') {
            try {
                $resource_path->delete('/lang/'.$this->whatToDelete.'.json');
                $this->emit('refreshLocales');
                $this->emit('refreshTranslations');
                $this->emit('show-toast', 'Locales Successfully deleted', 'success');
                $this->isOpen = false;
            } catch (\Exception $e) {
                $this->emit('refreshLocales');
                $this->emit('refreshTranslations');
                $this->emit('show-toast', 'Locales deleted, error on deleting file.', 'error');
                $this->isOpen = false;
            }
        }
    }
}
