<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;

class TranslationInput extends Component
{
    public $translation;

    public $locale;

    public $translationModel;

    public function mount($id, $locale, $newTranslation)
    {
        $this->translation = Translation::find($id);
        $this->translationModel = $newTranslation;
        $this->locale = $locale;
    }

    public function saveTranslation()
    {
        $json_array = $this->translation->locales;
        $json_array[$this->locale] = $this->translationModel;
        $this->translation->locales = $json_array;
        $this->translation->save();
        $this->emit('refreshTranslations');
        $this->emit('show-toast', 'Translation Successfully updated', 'success');
    }

    public function render()
    {
        return view('lingua::livewire.translation-input', ['locale' => $this->locale, 'id' => $this->translation->id]);
    }
}
