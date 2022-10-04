<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\LinguaUtilities;
use alessandrobelli\Lingua\Translation;
use Livewire\Component;
use Livewire\WithFileUploads;

class CsvImport extends Component
{
    use WithFileUploads;

    public $csv;

    public $csv_header;

    public $csv_data;

    public $languageField;

    public $stringToBeTranslatedField;

    public $translatedStringField;

    public $projectLabelString;

    public function parseHeader()
    {
        $this->validate([
            'csv' => 'required|max:8218', // 1MB Max
        ]);
        $path = $this->csv->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $this->csv_header = $data[0];
        array_unshift($this->csv_header, '');
    }

    public function parseImport()
    {
        $this->validate([
            'csv' => 'required|max:8218', // 1MB Max
            'stringToBeTranslatedField' => 'required',
            'languageField' => 'required',
            'translatedStringField' => 'required',
        ]);
        $path = $this->csv->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $this->csv_data = $data;
        $this->emit('show-toast', count($data).' long', 'error');

        for ($i = 1; $i < count($data); $i++) {
            $string = str_replace('"', '', $data[$i][($this->stringToBeTranslatedField - 1)]);
            $language = $data[$i][($this->languageField - 1)];
            $translation = $data[$i][($this->translatedStringField - 1)];
            $project = $this->projectLabelString ? $data[$i][($this->projectLabelString - 1)] : '';

            $existingString = Translation::where('string', $string)->first();
            $translationLanguage = LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'), 'isolanguagename', $language)[0]['locale'];
            $this->addLocaleIfNotExist($translationLanguage);
            if (! $existingString) {
                // CHECK WHY MULTI WORDS ARE CONSIDERED NOT THE SAME
                $existingString = Translation::create(['string' => $string, 'project' => $project]);
            }
            $json_array = $existingString->locales;
            $json_array[$translationLanguage] = $translation;
            $existingString->locales = $json_array;
            $existingString->project = $project;
            $existingString->save();
        }
        $this->emit('show-toast', 'Successfully imported CSV', 'success');
    }

    public function render()
    {
        return view('lingua::livewire.csv-import');
    }

    /**
     * @param $translationLanguage
     */
    private function addLocaleIfNotExist($translationLanguage)
    {
        $translationAndLocale = Translation::whereNotNull('locales->'.$translationLanguage)->first();
        if (! $translationAndLocale) {
            //  locale doesn't. add it to the whole translations.
            foreach (Translation::all() as $translation) {
                $json_array = $translation->locales;
                $json_array[$translationLanguage] = '';
                $translation->locales = $json_array;
                $translation->save();
            }
        }
    }
}
