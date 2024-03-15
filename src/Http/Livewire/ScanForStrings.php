<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class ScanForStrings extends Component
{
    public $path;

    public $project = '';

    public $pattern = 'all';

    public bool $isOpen = false;

    protected $listeners = [
        'cancelDeletionTranslations' => 'close',
        'confirmDeletionTranslations' => 'open',
        'scan' => 'scan',
    ];

    public function mount()
    {
        $this->path = resource_path();
    }

    public function close()
    {
        $this->isOpen = false;
    }

    public function open($locale, $locales)
    {
        $this->isOpen = true;
    }

    public function scan($path = false)
    {
        if (! $path) {
            $this->validate([
                'path' => 'required',
            ]);
        } else {
            $this->path = $path;
        }

        $files = '';

        try {
            $files = File::allFiles($this->path);
        } catch (\Exception $e) {
            $this->addError('path', 'This path is not valid.');
            $this->emit('show-toast', 'There is a problem with the directory you wrote.', 'error');

            return;
        }
        $pattern = $this->pattern;
        $oldStrings = Translation::pluck('string')->toArray();
        $addedStrings = [];
        if ($this->pattern === 'all') {
            foreach (config('lingua.regex') as $key => $pattern) {
                if ($key == 'all') {
                    continue;
                }
                $this->scanStringsInsideFiles($files, $pattern, $matches, $addedStrings);
            }
        } else {
            $this->scanStringsInsideFiles($files, $pattern, $matches, $addedStrings);
        }
        $this->removeTranslationsThatAreNotThereAnymore($oldStrings);
        $this->emit('show-toast', 'Translation successfully scanned', 'success');
        $this->resetErrorBag();
        $this->resetValidation();
        $this->emit('refreshTranslations');
    }

    public function render()
    {
        return view('lingua::livewire.scan-for-strings');
    }

    private function removeTranslationsThatAreNotThereAnymore($oldStrings)
    {
        $allNewStrings = Translation::pluck('string')->toArray();
        foreach ($oldStrings as $oldstring) {
            if (! in_array($oldstring, $allNewStrings)) {
                Translation::where('string', $oldstring)->delete();
            }
        }
    }

    /**
     * If I find a string multiple times in the same file, it needs to be a different project to be added.
     */
    private function scanStringsInsideFiles(array $files, $pattern, &$matches, array &$addedStrings): void
    {
        foreach ($files as $file) {
            if (preg_match_all($pattern, File::get($file->getPathname()), $matches, PREG_OFFSET_CAPTURE)) {
                foreach ($matches[1] as $match) {
                    array_push($addedStrings, $match[0]);
                    [$before] = str_split(File::get($file->getPathname()), $match[1]); // fetches all the text before the match
                    $line_number = strlen($before) - strlen(str_replace("\n", '', $before)) + 1;
                    $translation = Translation::where('string', '=', $match[0])->where('project', $this->project)->first();
                    if ($translation) {
                        if (strpos($translation->file, $file->getPathname().' line: '.$line_number) === false) {
                            $translation->update(['file' => $translation->file."\n".$file->getPathname().' line: '.$line_number]);
                        }
                    } else {
                        $translationCreated = Translation::create(['string' => $match[0], 'file' => $file->getPathname().' line: '.$line_number, 'project' => $this->project]);
                        foreach (Translation::allLocales() as $locale) {
                            $json_array = $translationCreated->locales;
                            $json_array[$locale] = '';
                            $translationCreated->locales = $json_array;
                            $translationCreated->save();
                        }
                    }
                }
            }
        }
    }
}
