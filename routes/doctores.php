<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\Doctor\ConsultorioController;
use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\PacienteController;
use App\Http\Controllers\HistorialCursoController;

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

//Rutas para el admin - pacientes
Route::get('pacientes', [PacienteController::class, 'index'])->name('doctor.pacientes.index');//->middleware('auth','can:doctor.pacientes.index');
Route::get('pacientes/create', [PacienteController::class, 'create'])->name('doctor.pacientes.create');//->middleware('auth','can:doctor.pacientes.create');
Route::post('pacientes/create', [PacienteController::class, 'store'])->name('doctor.pacientes.store');//->middleware('auth','can:doctor.pacientes.store');
Route::get('pacientes/{id}', [PacienteController::class, 'show'])->name('doctor.pacientes.show');//->middleware('auth','can:doctor.pacientes.show');
Route::get('pacientes/{id}/edit', [PacienteController::class, 'edit'])->name('doctor.pacientes.edit');//->middleware('auth','can:doctor.pacientes.edit');
Route::put('pacientes/{id}', [PacienteController::class, 'update'])->name('doctor.pacientes.update');//->middleware('auth','can:doctor.pacientes.update');
Route::get('pacientes/{id}/confirm-delete', [PacienteController::class, 'confirmDelete'])->name('doctor.pacientes.confirmDelete');//->middleware('auth','can:doctor.pacientes.confirmDelete');
Route::delete('pacientes/{id}', [PacienteController::class, 'destroy'])->name('doctor.pacientes.destroy');//->middleware('auth','can:doctor.pacientes.destroy');

//Rutas para el admin - consultorios
Route::get('consultorios', [ConsultorioController::class, 'index'])->name('doctor.consultorios.index');//->middleware('auth','can:doctor.consultorios.index');
Route::get('consultorios/create', [ConsultorioController::class, 'create'])->name('doctor.consultorios.create');//->middleware('auth','can:doctor.consultorios.create');
Route::post('consultorios/create', [ConsultorioController::class, 'store'])->name('doctor.consultorios.store');//->middleware('auth','can:doctor.consultorios.store');
Route::get('consultorios/{id}', [ConsultorioController::class, 'show'])->name('doctor.consultorios.show');//->middleware('auth','can:doctor.consultorios.show');
Route::get('consultorios/{id}/edit', [ConsultorioController::class, 'edit'])->name('doctor.consultorios.edit');//->middleware('auth','can:doctor.consultorios.edit');
Route::put('consultorios/{id}', [ConsultorioController::class, 'update'])->name('doctor.consultorios.update');//->middleware('auth','can:doctor.consultorios.update');
Route::get('consultorios/{id}/confirm-delete', [ConsultorioController::class, 'confirmDelete'])->name('doctor.consultorios.confirmDelete');//->middleware('auth','can:doctor.consultorios.confirmDelete');
Route::delete('consultorios/{id}', [ConsultorioController::class, 'destroy'])->name('doctor.consultorios.destroy');//->middleware('auth','can:doctor.consultorios.destroy');


//Rutas para el admin - doctor.
Route::get('doctor.', [DoctorController::class, 'index'])->name('doctor.index');//;//->middleware('auth','can:doctor.index');
Route::get('doctor./create', [DoctorController::class, 'create'])->name('doctor.create');//;//->middleware('auth','can:dmin.doctor.create');
Route::post('doctor./create', [DoctorController::class, 'store'])->name('doctor.store');//;//->middleware('auth','can:doctor.store');
Route::get('doctor./reportes', [DoctorController::class, 'reportes'])->name('doctor.reportes');//;//->middleware('auth','can:doctor.reportes');
Route::get('doctor./pdf', [DoctorController::class, 'pdf'])->name('doctor.pdf');//;//->middleware('auth','can:doctor.pdf');
Route::get('doctor./{id}', [DoctorController::class, 'show'])->name('doctor.show');//;//->middleware('auth','can:doctor.show');
Route::get('doctor./{id}/edit', [DoctorController::class, 'edit'])->name('doctor.edit');//;//->middleware('auth','can:doctor.edit');
Route::put('doctor./{id}', [DoctorController::class, 'update'])->name('doctor.update');//;//->middleware('auth','can:doctor.update');
Route::get('doctor./{id}/confirm-delete', [DoctorController::class, 'confirmDelete'])->name('doctor.confirmDelete');//;//->middleware('auth','can:doctor.confirmDelete');
Route::delete('doctor./{id}', [DoctorController::class, 'destroy'])->name('doctor.destroy');//;//->middleware('auth','can:doctor.destroy');

