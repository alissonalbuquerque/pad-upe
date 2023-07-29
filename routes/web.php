<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Dimensao\EnsinoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CoordenadorController;
use App\Http\Controllers\DiretorController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AvaliadorController;
use App\Http\Controllers\PadController;

use App\Http\Controllers\PDFController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

require __DIR__ . '/profile.php';

require __DIR__ . '/pad.php';
require __DIR__ . '/avaliador_pad.php';
require __DIR__ . '/professor_pad.php';

require __DIR__ . '/unidade.php';
require __DIR__ . '/campus.php';
require __DIR__ . '/curso.php';

require __DIR__ . '/anexo.php';

require __DIR__ . '/users.php';

require __DIR__ . '/user_type.php';

require __DIR__ . '/dimensao/dimensao.php';

require __DIR__ . '/dimensao/ensino.php';
require __DIR__ . '/dimensao/gestao.php';
require __DIR__ . '/dimensao/pesquisa.php';
require __DIR__ . '/dimensao/extensao.php';

require __DIR__ . '/import/update_user.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::prefix('/ensino')->group(function () {
    Route::get('/index', [EnsinoController::class, 'index'])->name('ensino_index');
    Route::get('/create', [EnsinoController::class, 'create'])->name('ensino_create');
    Route::post('/store', [EnsinoController::class, 'store'])->name('ensino_store');
    Route::get('/edit/{id}', [EnsinoController::class, 'edit'])->name('ensino_edit');
    Route::post('/update/{id}', [EnsinoController::class, 'update'])->name('ensino_update');
    Route::delete('/delete/{id}', [EnsinoController::class, 'destroy'])->name('ensino_delete');
});

Route::prefix('/coordenador')->group(function () {
    Route::get('/index', [CoordenadorController::class, 'index'])->name('coordenador_index');
    Route::get('/create', [CoordenadorController::class, 'create'])->name('coordenador_create');
    Route::post('/store', [CoordenadorController::class, 'store'])->name('coordenador_store');
    Route::get('/edit/{id}', [CoordenadorController::class, 'edit'])->name('coordenador_edit');
    Route::post('/update/{id}', [CoordenadorController::class, 'update'])->name('coordenador_update');
    Route::delete('/delete/{id}', [CoordenadorController::class, 'destroy'])->name('coordenador_delete');
});

Route::prefix('/diretor')->group(function () {
    Route::get('/index', [DiretorController::class, 'index'])->name('diretor_index');
    Route::get('/create', [DiretorController::class, 'create'])->name('diretor_create');
    Route::post('/store', [DiretorController::class, 'store'])->name('diretor_store');
    Route::get('/edit/{id}', [DiretorController::class, 'edit'])->name('diretor_edit');
    Route::post('/update/{id}', [DiretorController::class, 'update'])->name('diretor_update');
    Route::delete('/delete/{id}', [DiretorController::class, 'destroy'])->name('diretor_delete');
});

Route::prefix('/professor')->group(function () {
    Route::get('/index', [ProfessorController::class, 'index'])->name('professor_index');
    Route::get('/create', [ProfessorController::class, 'create'])->name('professor_create');
    Route::post('/store', [ProfessorController::class, 'store'])->name('professor_store');
    Route::get('/edit/{id}', [ProfessorController::class, 'edit'])->name('professor_edit');
    Route::post('/update/{id}', [ProfessorController::class, 'update'])->name('professor_update');
    Route::delete('/delete/{id}', [ProfessorController::class, 'destroy'])->name('professor_delete');
});

Route::prefix('/avaliador')->group(function () {
    Route::get('/index', [AvaliadorController::class, 'index'])->name('avaliador_index');
    Route::put('/avaliar', [AvaliadorController::class, 'avaliar'])->name('avaliador_avaliar');
    Route::get('/create', [AvaliadorController::class, 'create'])->name('avaliador_create');
    Route::post('/store', [AvaliadorController::class, 'store'])->name('avaliador_store');
    Route::get('/edit/{id}', [AvaliadorController::class, 'edit'])->name('avaliador_edit');
    Route::post('/update/{id}', [AvaliadorController::class, 'update'])->name('avaliador_update');
    Route::delete('/delete/{id}', [AvaliadorController::class, 'destroy'])->name('avaliador_delete');
    Route::get('/relatorio', [AvaliadorController::class, 'relatorio'])->name('avaliador_relatorio');
    Route::get('/relatorio/{id}', [PadController::class, 'relatorio'])->name('pad_relatório');
    Route::get('/relatorio/{id}/pdf', [PadController::class, 'Generate_PDF'])->name('pad_relatório_pdf');
});

Route::prefix('/user')->group(function () {
    Route::get('/edit/perfil/{tab?}', [UserController::class, 'editPerfil'])->name('edit_perfil');
    Route::post('/update/perfil', [UserController::class, 'updatePerfil'])->name('update_perfil');
    Route::post('/update/password', [UserController::class, 'updatePassword'])->name('update_password');
});

// Simple concept test of creating a LOREM IPSUM With Barryvdh-DomPDF
Route::get('generate-pdf',[PDFController::class, 'generatePDF']);
