<?php

namespace alessandrobelli\Lingua;

use alessandrobelli\Lingua\Commands\ChangeLinguaUserProject;
use alessandrobelli\Lingua\Http\Controllers\LinguaController;
use alessandrobelli\Lingua\Http\Livewire\ConfirmDeleteModal;
use alessandrobelli\Lingua\Http\Livewire\ConflictsDashboard;
use alessandrobelli\Lingua\Http\Livewire\CsvImport;
use alessandrobelli\Lingua\Http\Livewire\ExportToCsv;
use alessandrobelli\Lingua\Http\Livewire\ManageFiles;
use alessandrobelli\Lingua\Http\Livewire\ManageLocales;
use alessandrobelli\Lingua\Http\Livewire\ScanForStrings;
use alessandrobelli\Lingua\Http\Livewire\ToastMessageShow;
use alessandrobelli\Lingua\Http\Livewire\TranslationInput;
use alessandrobelli\Lingua\Http\Livewire\TranslationModal;
use alessandrobelli\Lingua\Http\Livewire\TranslationTable;
use alessandrobelli\Lingua\Http\Middleware\CheckRole;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LinguaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $this->app->register('Livewire\\LivewireServiceProvider');
        $this->registerLivewireComponents();
        $this->registerMiddleware();

        $package
            ->name('lingua')
            ->hasCommands(ChangeLinguaUserProject::class)
            ->hasViews()
            ->hasMigrations('add_projects_to_user_table', 'create_lingua_table', 'create_roles_table', 'create_users_table')
            ->hasConfigFile();
    }

    public function packageRegistered()
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
        Livewire::component('manage-files', ManageFiles::class);
        Livewire::component('scan-for-strings', ScanForStrings::class);
        Livewire::component('toast-message-show', ToastMessageShow::class);
        Livewire::component('translation-input', TranslationInput::class);
        Livewire::component('translation-modal', TranslationModal::class);
        Livewire::component('translation-table', TranslationTable::class);
        Livewire::component('conflicts-dashboard', ConflictsDashboard::class);

        return $this;
    }
}
