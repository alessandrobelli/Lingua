<?php

namespace alessandrobelli\Lingua;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'string', 'file', 'project', 'locales',
    ];

    protected $casts = [
        'locales' => 'array',
    ];

    protected $attributes = ['locales' => '{}'];

    protected static function newFactory()
    {
        return \alessandrobelli\Lingua\Tests\Database\Factories\TranslationFactory::new();
    }

    public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('string', 'like', '%'.$query.'%');
    }

    public function hasEmptyTranslation(): bool
    {
        foreach ($this->locales as $locale) {
            if (empty($locale)) {
                return true;
            }
        }

        return false;
    }

    public static function allLocales()
    {
        $translations = Translation::all();

        if ($translations->isEmpty()) {
            return [];
        }

        $localesArray = $translations->pluck('locales')->filter()->unique()->toArray();

        if (empty($localesArray)) {
            return [];
        }

        // testing doesn't like the cast and if table is empty return empty string instead of empty array
        if (app()->runningInConsole()) {
            $allLocales = array_keys(array_merge(...$localesArray));
        } else {
            $allLocales = array_keys(array_merge(...$localesArray));
        }

        return $allLocales;
    }
}
