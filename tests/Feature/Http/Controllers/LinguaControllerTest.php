<?php

namespace alessandrobelli\Lingua\Tests\Feature\Http\Controllers;

use alessandrobelli\Lingua\Http\Livewire\ManageLocales;
use alessandrobelli\Lingua\Http\Livewire\ScanForStrings;
use alessandrobelli\Lingua\Http\Livewire\TranslationTable;
use alessandrobelli\Lingua\Tests\TestCase;
use alessandrobelli\Lingua\Tests\User;
use Config;
use Illuminate\Auth\AuthenticationException;
use Livewire\Livewire;

class LinguaControllerTest extends TestCase
{
    /** @test */
    public function lingua_dashboard_works()
    {
        $user = factory(User::class)->create();
        Config::push('lingua.admin', $user->email);
        $this->withoutExceptionHandling();
        $this->actingAs($user);
        if (! file_exists(\resource_path().'/lang/')) {
            mkdir(\resource_path().'/lang/', 0777, true);
        }
        Livewire::test(ScanForStrings::class)->assertHasNoErrors();
        Livewire::test(ManageLocales::class)->assertHasNoErrors();
        Livewire::test(TranslationTable::class)->assertHasNoErrors();
    }

    /** @test */
    public function lingua_dashboard_does_not_work()
    {
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);
        $this->withoutExceptionHandling();
        $this
            ->get('/lingua/dashboard');
    }

    /** @test */
    public function test_lingua_routes_translator()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Config::push('lingua.translator', $user->email);

        $this
            ->actingAs($user)
            ->get('/lingua/upload')
            ->assertStatus(403);
        $this
            ->get('/lingua/download')
            ->assertStatus(403);
        $this
            ->get('/lingua/download/AllJson')
            ->assertStatus(403);
    }

    /** @test */
    public function test_lingua_routes_admin()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();
        Config::push('lingua.admin', $user->email);
        if (! file_exists(\resource_path().'/lang/')) {
            mkdir(\resource_path().'/lang/', 0777, true);
        }
        $this
            ->actingAs($user)
            ->get('/lingua/upload')
            ->assertStatus(200);
        $this
            ->get('/lingua/download')
            ->assertStatus(200);
        $this
            ->get('/lingua/download/AllJson')
            ->assertStatus(200);
    }
}
