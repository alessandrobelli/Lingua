<?php

namespace alessandrobelli\Lingua\Tests\Feature\Http\Livewire;

use alessandrobelli\Lingua\Http\Livewire\ManageLocales;
use alessandrobelli\Lingua\Http\Livewire\TranslationInput;
use alessandrobelli\Lingua\Tests\TestCase;
use alessandrobelli\Lingua\Tests\User;
use alessandrobelli\Lingua\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class LinguaLivewireTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**  */
    public function can_update_locales()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(factory(User::class)->create());
        $newTranslation = "a";
        $translation = Translation::create(['string' => 'test', 'locales' => "[{'de':''}]"]);
        $this->actingAs(factory(User::class)->create());
        Livewire::test(ManageLocales::class, ['localeToAdd' => 'de'])->call('addLocale');
        Livewire::test(
            TranslationInput::class,
            ['id' => $translation->id, 'newTranslation' => $newTranslation, 'locale' => 'de']
        )
            ->call('saveTranslation');
        $this->assertTrue(Translation::where('locales->de', $newTranslation)->exists());
    }
}
