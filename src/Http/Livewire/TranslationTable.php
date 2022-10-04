<?php

namespace alessandrobelli\Lingua\Http\Livewire;

use alessandrobelli\Lingua\Translation;
use Livewire\Component;
use Livewire\WithPagination;

class TranslationTable extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public string $sortField = 'string';

    public bool $sortAsc = true;

    public bool $onlyToTranslate = false;

    public $listeners = ['refreshTranslations' => 'render'];

    public $showProject = false;

    public $showFiles = false;

    public function toggleshowFiles()
    {
        $this->showFiles != $this->showFiles;
    }

    public function toggleshowProject()
    {
        $this->showProject != $this->showProject;
    }

    public function toggleonlyToTranslate()
    {
        $this->onlyToTranslate != $this->onlyToTranslate;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = ! $this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function render()
    {
        return view('lingua::livewire.translation-table', ['translations' => Translation::search($this->search)
                ->where(
                    function ($query) {
                        if (! (auth()->user()->project === 'all' || is_null(auth()->user()->project) || auth()->user()->project == '')) {
                            $query->whereIn('project', explode(',', auth()->user()->project));
                        }
                        if ($this->onlyToTranslate) {
                            foreach (Translation::allLocales() as $locale) {
                                $query->where('locales->'.$locale, '');
                            }
                        }
                    }
                )
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
            'translationNotCompleted' => Translation::search($this->search)
                ->where(
                    function ($query) {
                        if (! (auth()->user()->project === 'all' || is_null(auth()->user()->project) || auth()->user()->project == '')) {
                            $query->whereIn('project', explode(',', auth()->user()->project));
                        }
                    }
                )
                ->where(
                    function ($query) {
                        foreach (Translation::allLocales() as $locale) {
                            $query->where('locales->'.$locale, '');
                        }
                    }
                )
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage),
        ]);
    }
}
