<?php

namespace alessandrobelli\Lingua;

use alessandrobelli\Lingua\Commands\ChangeLinguaUserProject;
use alessandrobelli\Lingua\Http\Controllers\LinguaController;
use alessandrobelli\Lingua\Http\Livewire\ConfirmDeleteModal;
use alessandrobelli\Lingua\Http\Livewire\ConflictsDashboard;
use alessandrobelli\Lingua\Http\Livewire\CsvImport;
use alessandrobelli\Lingua\Http\Livewire\ExportToCsv;
use alessandrobelli\Lingua\Http\Livewire\ManageLocales;
use alessandrobelli\Lingua\Http\Livewire\ScanForStrings;
use alessandrobelli\Lingua\Http\Livewire\ToastMessageShow;
use alessandrobelli\Lingua\Http\Livewire\TranslationInput;
use alessandrobelli\Lingua\Http\Livewire\TranslationModal;
use alessandrobelli\Lingua\Http\Livewire\TranslationTable;
use alessandrobelli\Lingua\Http\Middleware\CheckRole;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LinguaServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->register("Livewire\\LivewireServiceProvider");

        $this->app->bind('lingua', function ($app) {
            return new Lingua();
        });

        $this
            ->registerCommands()
            ->registerPublishables()
            ->registerViews()
            ->registerRoutes()
            ->registerMiddleware()
            ->registerLivewireComponents()
            ->registerMigrations();
    }

    public function registerMigrations(): self
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        return $this;
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/lingua.php', 'lingua');
    }

    public function registerCommands(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }
        $this->commands([
            ChangeLinguaUserProject::class,
        ]);

        return $this;
    }

    public function registerPublishables(): self
    {
        if (! $this->app->runningInConsole()) {
            return $this;
        }
        $this->publishes([
            __DIR__ . '/../config/lingua.php' => config_path('lingua.php'),
        ], 'config');
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/lingua'),
        ], 'views');
        $this->publishes([
            __DIR__ . '/Http/Livewire' => base_path('app/Http/Livewire/Lingua'),
        ], 'controllers');
        if (! class_exists('CreateTranslationTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_lingua_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_lingua_table.php'),
            ], 'migrations');
            $this->publishes([
                __DIR__ . '/../database/migrations/add_projects_to_user_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_add_projects_to_user_table.php'),
            ], 'migrations');
        }

        return $this;
    }

    public function registerRoutes(): self
    {
        Route::macro('lingua', function (string $prefix) {
            Route::prefix($prefix)->group(function () {
                Route::group(['middleware' => ['auth']], static function () {
                    Route::get('/', function () {
                        return redirect()->route('lingua.index');
                    });
                    Route::get('/dashboard', [LinguaController::class, 'index'])->name('lingua.index');
                });
                Route::group(['middleware' => ['auth', 'role:admin']], static function () {
                    Route::get('/download/', [LinguaController::class, 'download'])->name('lingua.download');
                    Route::get('/upload/', [LinguaController::class, 'create'])->name('lingua.create');
                    Route::get('/conflicts/', [LinguaController::class, 'conflicts'])->name('lingua.conflicts');
                    Route::get('/download/AllJson', [LinguaController::class, 'downloadJsons'])->name('lingua.downloadJsons');
                });
            });
        });

        return $this;
    }

    public function registerViews(): self
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'lingua');

        return $this;
    }

    public function registerMiddleware(): self
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('role', CheckRole::class);

        return $this;
    }

    public function registerLivewireComponents(): self
    {
        Livewire::component('confirm-delete-modal', ConfirmDeleteModal::class);
        Livewire::component('csv-import', CsvImport::class);
        Livewire::component('export-to-csv', ExportToCsv::class);
        Livewire::component('manage-locales', ManageLocales::class);
        Livewire::component('scan-for-strings', ScanForStrings::class);
        Livewire::component('toast-message-show', ToastMessageShow::class);
        Livewire::component('translation-input', TranslationInput::class);
        Livewire::component('translation-modal', TranslationModal::class);
        Livewire::component('translation-table', TranslationTable::class);
        Livewire::component('conflicts-dashboard', ConflictsDashboard::class);

        return $this;
    }
}
