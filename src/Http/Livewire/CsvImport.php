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
        array_unshift($this->csv_header, "");
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
        for ($i = 1; $i < count($data); $i++) {
            $string = str_replace('"', "", $data[$i][($this->stringToBeTranslatedField - 1)]);
            $language = $data[$i][($this->languageField - 1)];
            $translation = $data[$i][($this->translatedStringField - 1)];
            $project = $this->projectLabelString ? $data[$i][($this->projectLabelString - 1)] : '';
            $existingTranslation = Translation::where('string', $string)->first();
            if (! $existingTranslation) {
                // CHECK WHY MULTI WORDS ARE CONSIDERED NOT THE SAME
                $newTranslation = Translation::create(['string' => $string, 'project' => $project]);
                $json_array = $newTranslation->locales;
                $json_array[LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'), 'isolanguagename', $language)[0]['locale']] = $translation;
                $newTranslation->locales = $json_array;
                $newTranslation->save();
                foreach (Translation::AllLocales() as $locale) {
                    if ($locale != LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'), 'isolanguagename', $language)[0]['locale']) {
                        $json_array = $newTranslation->locales;
                        if (array_key_exists($locale, $json_array)) {
                            $json_array[$locale] = ! is_null($json_array[$locale]) ? $json_array[$locale] : "";
                        } else {
                            $json_array[$locale] = "";
                        }
                        $newTranslation->locales = $json_array;
                        $newTranslation->save();
                    }
                }
            } else {
                $languageToAdd = LinguaUtilities::array_multidimensional_search(config('lingua.locales-list'), 'isolanguagename', $language)[0]['locale'];
                foreach (Translation::all() as $translation) {
                    $json_array = $translation->locales;
                    $json_array[$languageToAdd] = "";
                    $translation->locales = $json_array;
                    $translation->save();
                }
                $json_array = $existingTranslation->locales;
                $json_array[$languageToAdd] = $translation;
                $existingTranslation->locales = $json_array;
                $existingTranslation->project = $project;
                $existingTranslation->save();
                //update the value you get back
            }
        }
        $this->emit('show-toast', 'Successfully imported CSV', 'success');
    }

    public function render()
    {
        return view('lingua::livewire.csv-import');
    }
}
