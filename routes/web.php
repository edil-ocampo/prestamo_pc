<?php

use App\Http\Controllers\ComputadorController;
use Illuminate\Support\Facades\Route;

//Vista raíz
Route::view('/','index')->name('index');

                //Aprendiz

//Creacion del formulario y registro del formulario
Route::get('/registro-aprendiz',[ComputadorController::class, 'create'])->name('registro');
Route::post('/registro-aprendiz-exitoso',[ComputadorController::class, 'store'])->name('registroAprendiz.store');
//Listado de préstamos a lo largo del tiempo
Route::get('/listado-prestamos-aprendiz',[ComputadorController::class, 'indexAprendiz'])->name('index.prestamosAprendiz');
//Listado de préstamos en el día actual
Route::get('/listado-prestamos-aprendiz-hoy',[ComputadorController::class, 'indexAprendizAlDia'])->name('index.prestamosAprendizAlDia');
//Formulario para buscar por fecha
Route::get('/buscar-prestamos-aprendiz',[ComputadorController::class, 'buscarAprendiz'])->name('buscar.aprendiz');
//Formulario donde se trae la informacion del préstamo para posteriormente marcarlo como "Entregado"
Route::get('/entregar-prestamos-aprendiz',[ComputadorController::class, 'entregarAprendiz'])->name('entregar.aprendiz');
//Se busca por fecha y se descarga en formato PDF todos los préstamos de ese día
Route::get('/descargar-pdf-aprendiz',[ComputadorController::class, 'aprendizPdf'])->name('pdf.aprendiz');
//Descarga en formato PDF la lista de préstamos a lo largo del tiempo
Route::get('/descargar-pdf-listado-aprendiz',[ComputadorController::class, 'listadoAprendizPdf'])->name('pdf.listadoAprendiz');
//Se trae la información de los préstamos para posteriormente actualizar sus componentes
Route::get('/buscar-prestamo-componente-aprendiz',[ComputadorController::class, 'vistaPrestamoAprendiz'])->name('vistaPrestamoAprendiz');
//Se crea el formulario el cual trae el registro del préstamo
Route::get('/buscar-prestamo-componente-{id}',[ComputadorController::class, 'editAprendiz'])->name('edit.aprendiz');
//Se realiza y se guarda el registro del componente actualizado
Route::put('/buscar-prestamo-componente-{id}-exitoso', [ComputadorController::class, 'updateAprendiz'])->name('aprendiz.update');

                //Instructor

//Creacion del formulario y registro del formulario
Route::get('/registro-instructor',[ComputadorController::class, 'createInstructor'])->name('registro.instructor');
Route::post('/registro-instructor-exitoso',[ComputadorController::class, 'store'])->name('registroInstructor.store');
//Listado de préstamos a lo largo del tiempo
Route::get('/listado-prestamos-instructor',[ComputadorController::class, 'indexInstructor'])->name('index.prestamosInstructor');
//Listado de préstamos en el día actual
Route::get('/listado-prestamos-instructor-hoy',[ComputadorController::class, 'indexInstructorAlDia'])->name('index.prestamosInstructorAlDia');
//Formulario para buscar por fecha
Route::get('/buscar-prestamo-instructor',[ComputadorController::class, 'buscarInstructor'])->name('buscar.instructor');
//Formulario donde se trae la informacion del préstamo para posteriormente marcarlo como "Entregado"
Route::get('/entregar-prestamo-instructor',[ComputadorController::class, 'entregarInstructor'])->name('entregar.instructor');
//Se busca por fecha y se descarga en formato PDF todos los préstamos de ese día
Route::get('/descargar-pdf-instructor',[ComputadorController::class, 'instructorPdf'])->name('pdf.instructor');
//Descarga en formato PDF la lista de préstamos a lo largo del tiempo
Route::get('/descargar-pdf-listado-instructor',[ComputadorController::class, 'listadoInstructorPdf'])->name('pdf.listadoInstructor');

//Se trae la información de los préstamos para posteriormente actualizar sus componentes
Route::get('/componente-form-instructor', [ComputadorController::class, 'vistaPrestamoInstructor'])->name('index.form.instructor');

//Se crea el formulario el cual trae el registro del préstamo
Route::get('/componente-form-instructor-{id}', [ComputadorController::class, 'editInstructor'])->name('instructor.edit');
//Se realiza y se guarda el registro del componente actualizado
Route::put('/buscar-prestamo-componente-instructor-{id}-exitoso', [ComputadorController::class, 'updateInstructor'])->name('instructor.update');

//Maneja la logica con la cual se cambia el estado del préstamo tanto de instructor como de aprendiz
Route::get('/entregar-prestamo-{id}-exitoso',[ComputadorController::class, 'entregar'])->name('prestamo.entregado');

                //General

//Listado de préstamos a lo largo del tiempo
Route::get('/listado-prestamos-general',[ComputadorController::class, 'indexGeneral'])->name('index.prestamosGeneral');

//Descarga en formato PDF la lista de préstamos a lo largo del tiempo
Route::get('/descargar-pdf-general',[ComputadorController::class, 'listadoGeneralPdf'])->name('pdf.listadoGeneral');

//Formulario para buscar por fecha
Route::get('/buscar-prestamo-general',[ComputadorController::class, 'buscarGeneral'])->name('buscar.general');

//Se busca por fecha y se descarga en formato PDF todos los préstamos de ese día
Route::get('/descargar-pdf-listado-general',[ComputadorController::class, 'generalPdf'])->name('pdf.general');

