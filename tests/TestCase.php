<?php

namespace alessandrobelli\Lingua\Tests;

use alessandrobelli\Lingua\LinguaServiceProvider;
use alessandrobelli\Lingua\Tests\database\seeds\RolesSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Facade as Facade;
use Illuminate\Support\Facades\Route;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->afterApplicationCreated(function () {
            $this->makeACleanSlate();
        });
        $this->beforeApplicationDestroyed(function () {
            $this->makeACleanSlate();
        });
        Facade::setFacadeApplication(app());
        $this->withFactories(__DIR__.'/database/factories');
        $this->setUpRoutes();
        //   $this->artisan('db:seed', ['--class' => RolesSeeder::class]);
    }

    public function makeACleanSlate()
    {
        Artisan::call('view:clear');
    }

    public function setUpRoutes(): void
    {
        Route::lingua('lingua');
        Route::get('login', function () {
            return view('lingua::auth.login');
        })->name('login');
        Route::get('logout', function () {
            return view('lingua::auth.logout');
        })->name('logout');
    }

    protected function getPackageProviders($app)
    {
        return [
            LinguaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('view.paths', [
            __DIR__.'/../views',
            resource_path('views'),
        ]);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('app.key', 'base64:Hupx3yAySikrM2/edkZQNQHslgDWYfiBfCuSThJ5SK8=');
        $app['config']->set('session.driver', 'file');
        include_once __DIR__.'/../database/migrations/create_lingua_table.php.stub';
        include_once __DIR__.'/../database/migrations/create_users_table.php.stub';
        include_once __DIR__.'/../database/migrations/create_roles_table.php.stub';
        include_once __DIR__.'/../database/migrations/add_projects_to_user_table.php.stub';
        (new \CreateLinguaTable())->up();
        (new \CreateRolesTable())->up();
        (new \CreateUsersTable())->up();
        (new \addProjectsToUserTable())->up();
    }
}
