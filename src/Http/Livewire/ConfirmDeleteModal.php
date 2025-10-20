<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Attributes\On;
use Livewire\Component;
use Storage;

class ConfirmDeleteModal extends Component
{
    public bool $isOpen = false;

    public $entityToDelete;

    public $whatToDelete;

    public $params = [];

    public $message;

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
            $this->dispatch('refreshTranslations');
            $this->dispatch('show-toast', message: 'All translations deleted', alertType: 'success');
            $this->isOpen = false;
        } elseif ($this->entityToDelete === 'merge translations') {
            $this->dispatch('merge', $this->params[0], $this->params[1]);
            $this->isOpen = false;
        }
    }

    #[On('closeModal')]
    public function close()
    {
        $this->whatToDelete = '';
        $this->isOpen = false;
    }

    #[On('confirmDelete')]
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
                    $this->dispatch('refreshLocales');
                    $this->dispatch('show-toast', message: 'There it was an error while deleting a locale file.', alertType: 'error');
                    $this->isOpen = false;
                }
            }
            $this->dispatch('refreshLocales');
        } elseif ($this->entityToDelete == 'locale') {
            try {
                $resource_path->delete('/lang/'.$this->whatToDelete.'.json');
                $this->dispatch('refreshLocales');
                $this->dispatch('refreshTranslations');
                $this->dispatch('show-toast', message: 'Locales Successfully deleted', alertType: 'success');
                $this->isOpen = false;
            } catch (\Exception $e) {
                $this->dispatch('refreshLocales');
                $this->dispatch('refreshTranslations');
                $this->dispatch('show-toast', message: 'Locales deleted, error on deleting file.', alertType: 'error');
                $this->isOpen = false;
            }
        }
    }
}
