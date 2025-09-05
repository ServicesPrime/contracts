<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\BladePreviewController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ContractPreviewController;
use App\Http\Controllers\CoverageController;
use App\Http\Controllers\CoveragePackageController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

use App\Http\Controllers\WelcomeController;
use App\Models\EntryFormat;
use App\Models\Module;
use App\Models\PartialReceipt;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



// PUBLICO
Route::get('/', function () {
    return Inertia::render('Welcome/Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', ['users' => User::all(), 'modulos' => Module::all()]);
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Seguridad
    Route::resource('module', ModuleController::class)->parameters(['module' => 'module']);
    Route::resource('permissions', PermissionController::class)->names('permissions');
    Route::resource('perfiles', RoleController::class)->parameters(['perfiles' => 'perfiles']);
    Route::resource('user', UserController::class)->parameters(['user' => 'user']);

    //Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::resource('contracts', ContractController::class);
    Route::get('/contracts/{contract}/pdf', [ContractController::class, 'downloadPdf'])->name('contracts.pdf');


    Route::resource('client', ClientController::class);
    Route::resource('services', ServiceController::class);


    // Ruta para generar contrato real
    Route::get('/generate-contract/{id}', [ContractController::class, 'generateContract']);
    //previsualizador 

Route::post('/contracts/preview', [ContractPreviewController::class, 'preview'])
    ->name('contracts.preview');


Route::match(['GET', 'POST'], '/blade-preview', [ContractPreviewController::class, 'preview'])
    ->name('blade.preview');

Route::get('/contracts/preview-direct', [ContractPreviewController::class, 'previewDirect'])
    ->name('contracts.preview.direct');



// Test con parámetros de query
Route::get('/test-preview-query', [App\Http\Controllers\ContractPreviewController::class, 'previewDirect']);

// Endpoint para verificar qué llega exactamente
Route::post('/debug-preview', function(Request $request) {
    return response()->json([
        'method' => $request->method(),
        'all' => $request->all(),
        'pages' => $request->input('pages'),
        'pages_type' => gettype($request->input('pages')),
        'headers' => $request->headers->all()
    ]);
});
});



require __DIR__ . '/auth.php';
