<?php

namespace alessandrobelli\Lingua\Tests\Feature\Commands;

use alessandrobelli\Lingua\Commands\ChangeLinguaUserProject;
use alessandrobelli\Lingua\Tests\TestCase;
use alessandrobelli\Lingua\Tests\User;
use alessandrobelli\Lingua\Translation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;

class AssignUserToProjectCommandTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function user_factory_works()
    {
        $user = User::factory()->create();
        $translation = Translation::factory()->create();
        $user->linguaprojects = $translation->project;
        $user->save();
        $this->assertEquals($translation->project, $user->linguaprojects);
    }

    #[Test]
    public function assign_user_to_projects_command_works()
    {
        $user = User::factory()->create();
        $translation = Translation::factory()->create();
        $this->artisan(ChangeLinguaUserProject::class)
            ->expectsQuestion('Enter user email', $user->email)
            ->expectsQuestion('Any specific project to assign to '.$user->email.'? (blank for all, comma separated for multiple)', $translation->project)
            ->expectsOutput('User assigned to project(s)')
            ->assertExitCode(0);
    }
}
