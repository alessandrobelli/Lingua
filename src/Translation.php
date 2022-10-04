<?php

namespace alessandrobelli\Lingua;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
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
        // testing doesn't like the cast and if table is empty return empty string instead of empty array
        if (app()->runningInConsole()) {
            $allLocales = array_keys(array_merge([...Translation::all()->pluck('locales')->unique()->toArray()]));
        } else {
            $allLocales = array_keys(array_merge(...Translation::all()->pluck('locales')->unique()->toArray()));
        }

        return $allLocales;
    }
}
