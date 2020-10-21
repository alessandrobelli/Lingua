<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use File;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class ConflictsDashboard extends Component
{
    use WithPagination;

    public array $conflictsArray = array();
    public array $missingText = array();
    public array $latestTextWrapped = array();
    public array $latestTextUnified = array();
    protected $listeners = [
        'merge' => 'merge'
    ];

    public function mount()
    {
        $this->getNonWrappedStrings();
        $this->checkForSimilarStrings();
    }

    public function render()
    {
        return view('lingua::livewire.conflicts-dashboard', ['conflictsArray' => $this->conflictsArray, 'missed' => $this->missingText]);
    }



    public function merge($arrayToUnify, Translation $unifier)
    {
        $regex = "/(?<=\/)(.*)(?=.line:)/m";
        foreach ($arrayToUnify as $key => $unified)
        {
            if (Translation::find($unified["id"])->isNot($unifier))
            {
                $extractPath = preg_match_all($regex, $unified["file"], $paths);
                if ($extractPath)
                {
                    //$paths[0] (or 1) is the path to the file, add / in the end.
                    foreach ($paths as $path)
                    {
                        $pathToUse = "/" . $path[0];
                        try
                        {
                            $patternUnified = "/__\((?:'|\")(" . $unified["string"] . ")(?:'|\")\)/m";
                            // $patternUnifier = "/__\((?:'|\")((".$unifier["string"].").+?)(?:'|\")\)/m";
                            $FileContent = preg_replace($patternUnified, "__('" . $unifier["string"] . "')", File::get($pathToUse));
                            // $FileContent = str_replace('>{{__("' . $unified["string"] . '")}}<', '>{{__("' . $unifier["string"] . '")}}<', File::get($pathToUse));
                            if (file_put_contents($pathToUse, $FileContent) > 0)
                            {
                                $this->emit('show-toast', 'Strings are unified', 'success');
                                //  array_push($this->latestTextUnified,$unifier);
                            } else
                            {
                                $this->emit('show-toast', 'Error replacing the string.', 'error');
                            }
                        } catch (Exception $e)
                        {
                            $this->emit('show-toast', 'Severe error, check log.', 'error');
                        }
                    }
                    if (!Str::contains($unifier->file, $unified["file"]))
                    {
                        $unifier->update(['file' => $unifier->file . "\n" . $unified["file"]]);
                    }
                    $translationToDelete = Translation::find($unified["id"]);
                    array_push($this->latestTextUnified, $translationToDelete);
                    $translationToDelete->delete();
                    $this->checkForSimilarStrings();
                    $this->getNonWrappedStrings();
                }
            }
        }
    }

    public function wrap($string, $file)
    {

        if (is_writable($file))
        {

            try
            {
                $FileContent = file_get_contents($file);
                $FileContent = str_replace('>' . $string . '<', '>{{__("' . $string . '")}}<', File::get($file));
                if (file_put_contents($file, $FileContent) > 0)
                {

                    $this->emit('show-toast', 'The file is changed.', 'success');
                    $this->checkForSimilarStrings();
                    $this->getNonWrappedStrings();
                    array_push($this->latestTextWrapped, [$string, $file]);
                } else
                {
                    $this->emit('show-toast', 'Error replacing the string.', 'error');
                }
            } catch (Exception $e)
            {
                $this->emit('show-toast', 'Severe error, check log.', 'error');
            }
        } else
        {
            $this->addError('path', 'This path is not valid.');
            $this->emit('show-toast', 'The file is not writable.', 'error');
        }
    }

    public function undoWrap()
    {
        if (!empty($this->latestTextWrapped))
        {
            try
            {
                $FileContent = str_replace('>{{__("' . end($this->latestTextWrapped)[0] . '")}}<', '>' . end($this->latestTextWrapped)[0] . '<', File::get(end($this->latestTextWrapped)[1]));
                if (file_put_contents(end($this->latestTextWrapped)[1], $FileContent) > 0)
                {

                    $this->emit('show-toast', 'The wrap is removed.', 'success');
                    $this->checkForSimilarStrings();
                    $this->getNonWrappedStrings();
                    array_pop($this->latestTextWrapped);
                } else
                {
                    $this->emit('show-toast', 'Error replacing the string.', 'error');
                }
            } catch (Exception $e)
            {
                $this->emit('show-toast', 'Severe error, check log.', 'error');
            }
        } else
        {
            $this->emit('show-toast', 'No text to unmerge.', 'warning');
        }
    }

    /**
     * @param $percent
     */
    private function checkForSimilarStrings(): void
    {
        $this->conflictsArray = array();
        $allTranslation = Translation::all();
        for ($i = 0; $i < count($allTranslation); $i++)
        {

            $base = $allTranslation[$i]->string;
            for ($j = $i + 1; $j < count($allTranslation); $j++)
            {
                $variation = $allTranslation[$j]->string;
                similar_text($base, $variation, $percent);
                if ($percent > 85)
                {
                    if (count($this->conflictsArray) > 0)
                    {

                        // is $allTranslation[$j] already in $this->conflictsArray?
                        foreach ($this->conflictsArray as $translation)
                        {
                            $isTranslationAlreadySomewhere = array_search($allTranslation[$i], $translation);
                            if ($isTranslationAlreadySomewhere !== false)
                            {
                                $isTranslationAlreadySomewhere = array_search($translation, $this->conflictsArray);
                                break;
                            }
                        }
                        if ($isTranslationAlreadySomewhere === false)
                        {
                            array_push($this->conflictsArray, [$allTranslation[$i], $allTranslation[$j]]);
                        } else
                        {
                            if (!in_array($allTranslation[$j], $this->conflictsArray[$isTranslationAlreadySomewhere]))
                            {
                                array_push($this->conflictsArray[$isTranslationAlreadySomewhere], $allTranslation[$j]);
                            }
                        }
                    } else
                    {
                        array_push($this->conflictsArray, [$allTranslation[$i], $allTranslation[$j]]);
                    }
                }
            }
        }
    }

    /**
     * @param $matches
     */
    private function getNonWrappedStrings(): void
    {
        $this->missingText = array();
        try
        {
            $files = File::allFiles(resource_path());
        } catch (\Exception $e)
        {
            $this->addError('path', 'This path is not valid.');
            $this->emit('show-toast', 'The resource path return an error.', 'error');
            return;
        }
        foreach ($files as $file)
        {
            if (preg_match_all(config('lingua.regexTags'), File::get($file->getPathname()), $matches, PREG_OFFSET_CAPTURE))
            {
                foreach ($matches[1] as $match)
                {
                    list($before) = str_split(File::get($file->getPathname()), $match[1]); // fetches all the text before the match
                    $line_number = strlen($before) - strlen(str_replace("\n", "", $before)) + 1;
                    array_push($this->missingText, [$match[0], $file->getPathname(), " line: " . $line_number]);
                }
            }
        }
    }
}
