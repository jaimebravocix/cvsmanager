<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentoIdentidadController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\EmailPersonaController;
use App\Http\Controllers\RegimenPensionarioController;
use App\Http\Controllers\CuentaHaberesController;
use App\Http\Controllers\DocumentoSaludController;
use App\Http\Controllers\AntecedenteController;
use App\Http\Controllers\FormacionAcademicaController;
use App\Http\Controllers\ExperienciaDocenteController;
use App\Http\Controllers\ExperienciaProfesionalController;
use App\Http\Controllers\CertificacionIdiomaController;
use App\Http\Controllers\RegistroInstitucionalController;
use App\Http\Controllers\ProduccionCientificaController;
use App\Http\Controllers\ProduccionBibliograficaController;
use App\Http\Controllers\ProduccionInvestigacionController;
use App\Http\Controllers\CongresoController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\LicenciaProfesionalController;
use App\Http\Controllers\MembresiaController;
use Illuminate\Support\Facades\Route;

// Redirigir raíz al login
Route::get('/', fn() => redirect()->route('login'));

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Personas (Docentes/Administrativos)
    Route::resource('personas', PersonaController::class);

    // Gestión de usuarios (solo administrador)
    Route::resource('users', UserController::class)->except(['show']);

    // Rutas anidadas para secciones del CV
    // Documentos de Identidad
    Route::prefix('personas/{persona}')->name('personas.')->group(function () {
        Route::get('documentos/create',     [DocumentoIdentidadController::class, 'create'])->name('documentos.create');
        Route::post('documentos',           [DocumentoIdentidadController::class, 'store'])->name('documentos.store');
        Route::get('documentos/{registro}/edit',   [DocumentoIdentidadController::class, 'edit'])->name('documentos.edit');
        Route::put('documentos/{registro}',        [DocumentoIdentidadController::class, 'update'])->name('documentos.update');
        Route::delete('documentos/{registro}',     [DocumentoIdentidadController::class, 'destroy'])->name('documentos.destroy');

        // Direcciones
        Route::get('direcciones/create',    [DireccionController::class, 'create'])->name('direcciones.create');
        Route::post('direcciones',          [DireccionController::class, 'store'])->name('direcciones.store');
        Route::get('direcciones/{registro}/edit',  [DireccionController::class, 'edit'])->name('direcciones.edit');
        Route::put('direcciones/{registro}',       [DireccionController::class, 'update'])->name('direcciones.update');
        Route::delete('direcciones/{registro}',    [DireccionController::class, 'destroy'])->name('direcciones.destroy');

        // Emails
        Route::get('emails/create',         [EmailPersonaController::class, 'create'])->name('emails.create');
        Route::post('emails',               [EmailPersonaController::class, 'store'])->name('emails.store');
        Route::get('emails/{registro}/edit',[EmailPersonaController::class, 'edit'])->name('emails.edit');
        Route::put('emails/{registro}',     [EmailPersonaController::class, 'update'])->name('emails.update');
        Route::delete('emails/{registro}',  [EmailPersonaController::class, 'destroy'])->name('emails.destroy');

        // Régimen Pensionario
        Route::get('regimen/create',        [RegimenPensionarioController::class, 'create'])->name('regimen.create');
        Route::post('regimen',              [RegimenPensionarioController::class, 'store'])->name('regimen.store');
        Route::get('regimen/{registro}/edit',[RegimenPensionarioController::class, 'edit'])->name('regimen.edit');
        Route::put('regimen/{registro}',    [RegimenPensionarioController::class, 'update'])->name('regimen.update');
        Route::delete('regimen/{registro}', [RegimenPensionarioController::class, 'destroy'])->name('regimen.destroy');

        // Cuentas de Haberes
        Route::get('haberes/create',        [CuentaHaberesController::class, 'create'])->name('haberes.create');
        Route::post('haberes',              [CuentaHaberesController::class, 'store'])->name('haberes.store');
        Route::get('haberes/{registro}/edit',[CuentaHaberesController::class, 'edit'])->name('haberes.edit');
        Route::put('haberes/{registro}',    [CuentaHaberesController::class, 'update'])->name('haberes.update');
        Route::delete('haberes/{registro}', [CuentaHaberesController::class, 'destroy'])->name('haberes.destroy');

        // Documentos de Salud
        Route::get('salud/create',          [DocumentoSaludController::class, 'create'])->name('salud.create');
        Route::post('salud',                [DocumentoSaludController::class, 'store'])->name('salud.store');
        Route::get('salud/{registro}/edit', [DocumentoSaludController::class, 'edit'])->name('salud.edit');
        Route::put('salud/{registro}',      [DocumentoSaludController::class, 'update'])->name('salud.update');
        Route::delete('salud/{registro}',   [DocumentoSaludController::class, 'destroy'])->name('salud.destroy');

        // Antecedentes
        Route::get('antecedentes/create',   [AntecedenteController::class, 'create'])->name('antecedentes.create');
        Route::post('antecedentes',         [AntecedenteController::class, 'store'])->name('antecedentes.store');
        Route::get('antecedentes/{registro}/edit', [AntecedenteController::class, 'edit'])->name('antecedentes.edit');
        Route::put('antecedentes/{registro}',      [AntecedenteController::class, 'update'])->name('antecedentes.update');
        Route::delete('antecedentes/{registro}',   [AntecedenteController::class, 'destroy'])->name('antecedentes.destroy');

        // Formación Académica
        Route::get('formacion/create',      [FormacionAcademicaController::class, 'create'])->name('formacion.create');
        Route::post('formacion',            [FormacionAcademicaController::class, 'store'])->name('formacion.store');
        Route::get('formacion/{registro}/edit',    [FormacionAcademicaController::class, 'edit'])->name('formacion.edit');
        Route::put('formacion/{registro}',         [FormacionAcademicaController::class, 'update'])->name('formacion.update');
        Route::delete('formacion/{registro}',      [FormacionAcademicaController::class, 'destroy'])->name('formacion.destroy');

        // Experiencia Docente
        Route::get('experiencia-docente/create',   [ExperienciaDocenteController::class, 'create'])->name('experiencia-docente.create');
        Route::post('experiencia-docente',          [ExperienciaDocenteController::class, 'store'])->name('experiencia-docente.store');
        Route::get('experiencia-docente/{registro}/edit',  [ExperienciaDocenteController::class, 'edit'])->name('experiencia-docente.edit');
        Route::put('experiencia-docente/{registro}',       [ExperienciaDocenteController::class, 'update'])->name('experiencia-docente.update');
        Route::delete('experiencia-docente/{registro}',    [ExperienciaDocenteController::class, 'destroy'])->name('experiencia-docente.destroy');

        // Experiencia Profesional
        Route::get('experiencia-profesional/create', [ExperienciaProfesionalController::class, 'create'])->name('experiencia-profesional.create');
        Route::post('experiencia-profesional',        [ExperienciaProfesionalController::class, 'store'])->name('experiencia-profesional.store');
        Route::get('experiencia-profesional/{registro}/edit',  [ExperienciaProfesionalController::class, 'edit'])->name('experiencia-profesional.edit');
        Route::put('experiencia-profesional/{registro}',       [ExperienciaProfesionalController::class, 'update'])->name('experiencia-profesional.update');
        Route::delete('experiencia-profesional/{registro}',    [ExperienciaProfesionalController::class, 'destroy'])->name('experiencia-profesional.destroy');

        // Idiomas
        Route::get('idiomas/create',        [CertificacionIdiomaController::class, 'create'])->name('idiomas.create');
        Route::post('idiomas',              [CertificacionIdiomaController::class, 'store'])->name('idiomas.store');
        Route::get('idiomas/{registro}/edit',[CertificacionIdiomaController::class, 'edit'])->name('idiomas.edit');
        Route::put('idiomas/{registro}',    [CertificacionIdiomaController::class, 'update'])->name('idiomas.update');
        Route::delete('idiomas/{registro}', [CertificacionIdiomaController::class, 'destroy'])->name('idiomas.destroy');

        // Registros Institucionales (Renacyt, CIP, etc.)
        Route::get('registros/create',      [RegistroInstitucionalController::class, 'create'])->name('registros.create');
        Route::post('registros',            [RegistroInstitucionalController::class, 'store'])->name('registros.store');
        Route::get('registros/{registro}/edit',    [RegistroInstitucionalController::class, 'edit'])->name('registros.edit');
        Route::put('registros/{registro}',         [RegistroInstitucionalController::class, 'update'])->name('registros.update');
        Route::delete('registros/{registro}',      [RegistroInstitucionalController::class, 'destroy'])->name('registros.destroy');

        // Producción Científica
        Route::get('produccion-cientifica/create',  [ProduccionCientificaController::class, 'create'])->name('produccion-cientifica.create');
        Route::post('produccion-cientifica',         [ProduccionCientificaController::class, 'store'])->name('produccion-cientifica.store');
        Route::get('produccion-cientifica/{registro}/edit',    [ProduccionCientificaController::class, 'edit'])->name('produccion-cientifica.edit');
        Route::put('produccion-cientifica/{registro}',         [ProduccionCientificaController::class, 'update'])->name('produccion-cientifica.update');
        Route::delete('produccion-cientifica/{registro}',      [ProduccionCientificaController::class, 'destroy'])->name('produccion-cientifica.destroy');

        // Producción Bibliográfica
        Route::get('produccion-bibliografica/create', [ProduccionBibliograficaController::class, 'create'])->name('produccion-bibliografica.create');
        Route::post('produccion-bibliografica',        [ProduccionBibliograficaController::class, 'store'])->name('produccion-bibliografica.store');
        Route::get('produccion-bibliografica/{registro}/edit', [ProduccionBibliograficaController::class, 'edit'])->name('produccion-bibliografica.edit');
        Route::put('produccion-bibliografica/{registro}',      [ProduccionBibliograficaController::class, 'update'])->name('produccion-bibliografica.update');
        Route::delete('produccion-bibliografica/{registro}',   [ProduccionBibliograficaController::class, 'destroy'])->name('produccion-bibliografica.destroy');

        // Proyectos de Investigación
        Route::get('produccion-investigacion/create', [ProduccionInvestigacionController::class, 'create'])->name('produccion-investigacion.create');
        Route::post('produccion-investigacion',        [ProduccionInvestigacionController::class, 'store'])->name('produccion-investigacion.store');
        Route::get('produccion-investigacion/{registro}/edit', [ProduccionInvestigacionController::class, 'edit'])->name('produccion-investigacion.edit');
        Route::put('produccion-investigacion/{registro}',      [ProduccionInvestigacionController::class, 'update'])->name('produccion-investigacion.update');
        Route::delete('produccion-investigacion/{registro}',   [ProduccionInvestigacionController::class, 'destroy'])->name('produccion-investigacion.destroy');

        // Congresos y Eventos
        Route::get('congresos/create',      [CongresoController::class, 'create'])->name('congresos.create');
        Route::post('congresos',            [CongresoController::class, 'store'])->name('congresos.store');
        Route::get('congresos/{registro}/edit',    [CongresoController::class, 'edit'])->name('congresos.edit');
        Route::put('congresos/{registro}',         [CongresoController::class, 'update'])->name('congresos.update');
        Route::delete('congresos/{registro}',      [CongresoController::class, 'destroy'])->name('congresos.destroy');

        // Reconocimientos y Honores
        Route::get('reconocimientos/create', [ReconocimientoController::class, 'create'])->name('reconocimientos.create');
        Route::post('reconocimientos',        [ReconocimientoController::class, 'store'])->name('reconocimientos.store');
        Route::get('reconocimientos/{registro}/edit',  [ReconocimientoController::class, 'edit'])->name('reconocimientos.edit');
        Route::put('reconocimientos/{registro}',       [ReconocimientoController::class, 'update'])->name('reconocimientos.update');
        Route::delete('reconocimientos/{registro}',    [ReconocimientoController::class, 'destroy'])->name('reconocimientos.destroy');

        // Licencias Profesionales
        Route::get('licencias/create',      [LicenciaProfesionalController::class, 'create'])->name('licencias.create');
        Route::post('licencias',            [LicenciaProfesionalController::class, 'store'])->name('licencias.store');
        Route::get('licencias/{registro}/edit',    [LicenciaProfesionalController::class, 'edit'])->name('licencias.edit');
        Route::put('licencias/{registro}',         [LicenciaProfesionalController::class, 'update'])->name('licencias.update');
        Route::delete('licencias/{registro}',      [LicenciaProfesionalController::class, 'destroy'])->name('licencias.destroy');

        // Membresías
        Route::get('membresias/create',     [MembresiaController::class, 'create'])->name('membresias.create');
        Route::post('membresias',           [MembresiaController::class, 'store'])->name('membresias.store');
        Route::get('membresias/{registro}/edit',   [MembresiaController::class, 'edit'])->name('membresias.edit');
        Route::put('membresias/{registro}',        [MembresiaController::class, 'update'])->name('membresias.update');
        Route::delete('membresias/{registro}',     [MembresiaController::class, 'destroy'])->name('membresias.destroy');
    });
});
