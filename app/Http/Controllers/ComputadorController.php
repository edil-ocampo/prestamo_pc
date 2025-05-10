<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Computador;
use App\Models\Componente;
use App\Models\ComputadorComponente;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ComputadorController extends Controller
{

    public function create (){
        $componentes = Componente::all();

        return view('aprendiz.frmPrestamoAprendiz',compact('componentes'));
    }

    public function indexAprendiz (){

        $totalRegistros = 0;

        $computadores = Computador::with('componentes')
                                    ->whereNotNull('documento')
                                    ->paginate(10);

        $totalRegistros = $computadores->total();

        return view('aprendiz.verPrestamosAprendiz', compact('computadores','totalRegistros'));
    }
    public function indexInstructor (){

        $totalRegistros = 0;

        $computadores = Computador::with('componentes')
                                    ->whereNull('documento')
                                    ->paginate(10);

        $totalRegistros = $computadores->total();

        return view('instructor.verPrestamosInstructor', compact('computadores','totalRegistros'));
    }
    public function indexGeneral (){

        $totalRegistros = 0;

        $computadores = Computador::with('componentes')
                                    ->paginate(10);

        $totalRegistros = $computadores->total();

        return view('general.verPrestamosGeneral', compact('computadores','totalRegistros'));
    }

    public function createInstructor (){
        $componentes = Componente::all();

        return view('instructor.frmPrestamoInstructor',compact('componentes'));
    }

    public function store(Request $request)
{
    // Validación de los datos del formulario
    $request->validate([
        'documento' => 'numeric',
        'nombres' => 'string',
        'serial' => 'nullable|string',
        'fecha' => 'date_format:Y-m-d H:i:s',
        'estado' => 'max:1',
    ]);

    $fecha = $request->input('fecha');
    // Crear una instancia de Carbon para obtener la fecha y hora actual
    $fechaActual = Carbon::createFromFormat('Y-m-d H:i:s', $fecha);

    // Crear un nuevo computador
    $computador = new Computador();
    $computador->documento = $request->input('documento');
    $computador->nombres = $request->input('nombres');
    $computador->serial = $request->input('serial');
    $computador->fecha = $fechaActual;
    $computador->estado = $request->input('estado');

    // Guardar el computador en la base de datos
    $computador->save();

    // Asociar componentes seleccionados al computador
    if ($request->has('componente')) {
        $componentesSeleccionados = $request->input('componente');
        foreach ($componentesSeleccionados as $componenteId) {
            ComputadorComponente::create([
                'id_computador' => $computador->id,
                'id_componente' => $componenteId,
            ]);
        }
    }

    return redirect()->route('index')->with('success', 'El préstamo se realizó correctamente.');
}

public function entregar ($id){
    $computador = Computador::find($id);
    $computador->estado = false;
    $computador->save();
    return redirect()->route('index')->with('success', 'El préstamo fue entregado correctamente.');
}

public function indexAprendizAlDia(){

    // Obtener la fecha de hoy usando Carbon
    $fechaHoy = Carbon::today();
    $totalRegistros = 0;

    // Consulta para obtener los computadores de hoy
    $computadores = Computador::whereDate('fecha', $fechaHoy)
                              ->whereNotNull('documento')
                              ->with('componentes')
                              ->paginate(10);

    $totalRegistros = $computadores->count();

    return view('aprendiz.prestamosAprendizAlDia', compact('computadores','totalRegistros'));
}

public function indexInstructorAlDia(){

    // Obtener la fecha de hoy usando Carbon
    $fechaHoy = Carbon::today();
    $totalRegistros = 0;

    // Consulta para obtener los computadores de hoy
    $computadores = Computador::whereDate('fecha', $fechaHoy)
                              ->whereNull('documento')
                              ->with('componentes')
                              ->paginate(10);

    $totalRegistros = $computadores->count();

    return view('instructor.prestamosInstructorAlDia', compact('computadores','totalRegistros'));
}

public function entregarAprendiz(Request $request){

    $computadores = null;

    // Obtener el documento del formulario
    $documento = $request->input('documento');

    // Obtener la fecha actual
    $fechaHoy = Carbon::today();

    // Buscar los computadores que coincidan con el documento y la fecha actual
    $computadores = Computador::where('documento', $documento)
                              ->whereDate('fecha', $fechaHoy)
                              ->where('estado', true)
                              ->paginate(10); // Usamos paginate(10) para obtener una colección de resultados

    return view('aprendiz.entregarPrestamoAprendiz',compact('computadores'));
}

public function entregarInstructor(Request $request)
{
    $computadores = null;

    // Obtener el documento del formulario
    $nombres = $request->input('nombres');

    // Obtener la fecha actual
    $fechaHoy = Carbon::today();

    // Buscar los computadores que coincidan con el documento y la fecha actual
    $computadores = Computador::where('nombres','LIKE' ,"%$nombres%")
                              ->whereDate('fecha', $fechaHoy)
                              ->where('estado', true)
                              ->paginate(10); // Usamos paginate(10) para obtener una colección de resultados

    return view('instructor.entregarPrestamoInstructor', compact('computadores'));
}

public function buscarAprendiz(Request $request){

    $computadores = null;
    $totalRegistros = 0;
    $fecha = null;

    if ($request->filled('fecha')) {
        // Validar la entrada del usuario
        $request->validate([
            'fecha' => 'required|date',
        ]);

        // Obtener la fecha ingresada por el usuario
        $fecha = Carbon::parse($request->input('fecha'))->toDateString();

        // Consultar los computadores con la fecha seleccionada
        $computadores = Computador::whereDate('fecha', $fecha)
                                ->whereNotNull('documento')
                                ->with('componentes')
                                ->paginate(10);

        $totalRegistros = $computadores->count();
    }

    // Retornar la vista con los computadores encontrados o null si no se ha enviado el formulario
    return view('aprendiz.frmBusquedaAprendiz', compact('computadores', 'fecha','totalRegistros'));
}

public function buscarInstructor(Request $request){

    $computadores = null;
    $totalRegistros = 0;
    $fecha = null;

    if ($request->filled('fecha')) {
        // Validar la entrada del usuario
        $request->validate([
            'fecha' => 'required|date',
        ]);

        // Obtener la fecha ingresada por el usuario
        $fecha = Carbon::parse($request->input('fecha'))->toDateString();

        // Consultar los computadores con la fecha seleccionada
        $computadores = Computador::whereDate('fecha', $fecha)
                                ->whereNull('documento')
                                ->with('componentes')
                                ->paginate(10);

        $totalRegistros = $computadores->count();
    }

    // Retornar la vista con los computadores encontrados o null si no se ha enviado el formulario
    return view('instructor.frmBusquedaInstructor', compact('computadores', 'fecha', 'totalRegistros'));
}
public function buscarGeneral(Request $request){

    $computadores = null;
    $totalRegistros = 0;
    $fecha = null;

    if ($request->filled('fecha')) {
        // Validar la entrada del usuario
        $request->validate([
            'fecha' => 'required|date',
        ]);

        // Obtener la fecha ingresada por el usuario
        $fecha = Carbon::parse($request->input('fecha'))->toDateString();

        // Consultar los computadores con la fecha seleccionada
        $computadores = Computador::whereDate('fecha', $fecha)
                                ->with('componentes')
                                ->paginate(10);
        // Obtener el total de registros encontrados
        $totalRegistros = $computadores->count();
    }

    // Retornar la vista con los computadores encontrados o null si no se ha enviado el formulario
    return view('general.frmBusquedaGeneral', compact('computadores', 'fecha','totalRegistros'));
}

public function aprendizPdf(Request $request)
{
    $fecha = $request->query('fecha');

    // Consultar los computadores con la fecha especificada
    $computadores = Computador::whereDate('fecha', $fecha)
                              ->whereNotNull('documento')
                              ->with('componentes')
                              ->paginate(10);
    $encabezado = "Reporte de préstamos a aprendices en la fecha: $fecha" ;

    //logo imagen
    $logo = public_path('img/logoSena.png');
    // Renderizar la vista en HTML
    $html = view('pdf.aprendizPdf', compact('computadores','encabezado','logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos_aprendices.pdf');
}

public function instructorPdf(Request $request)
{
    $fecha = $request->query('fecha');

    // Consultar los computadores con la fecha especificada
    $computadores = Computador::whereDate('fecha', $fecha)
                              ->whereNull('documento')
                              ->with('componentes')
                              ->paginate(10);
    $encabezado = "Reporte de préstamos a instructores en la fecha: $fecha" ;

    //logo imagen
    $logo = public_path('img/logoSena.png');
    // Renderizar la vista en HTML
    $html = view('pdf.instructorPdf', compact('computadores','encabezado','logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos_instructores.pdf');
}

public function generalPdf(Request $request)
{
    $fecha = $request->query('fecha');

    // Consultar los computadores con la fecha especificada
    $computadores = Computador::whereDate('fecha', $fecha)
                              ->with('componentes')
                              ->paginate(10);
    $encabezado = "Reporte de préstamos  en la fecha: $fecha" ;

    //logo imagen
    $logo = public_path('img/logoSena.png');
    // Renderizar la vista en HTML
    $html = view('pdf.generalPdf', compact('computadores','encabezado','logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos.pdf');
}


public function listadoGeneralPdf()
{
    // Consultar los computadores
    $computadores = Computador::with('componentes')->paginate(10);

    $encabezado = "Reporte de préstamos general";

    // Logo imagen
    $logo = public_path('img/logoSenaa.png');



    // Renderizar la vista en HTML
    $html = view('pdf.listadoGeneralPdf', compact('computadores', 'encabezado', 'logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);
    $options->set('defaultFont', 'Arial');

    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos_general.pdf');
}

public function listadoInstructorPdf()
{


    // Consultar los computadores con la fecha especificada
    $computadores = Computador::whereNull('documento')
                              ->with('componentes')
                              ->paginate(10);
    $encabezado = "Reporte de préstamos a instructores" ;

    //logo imagen
    $logo = public_path('img/logoSena.png');
    // Renderizar la vista en HTML
    $html = view('pdf.listadoInstructorPdf', compact('computadores','encabezado','logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos_instructores.pdf');
}

public function listadoAprendizPdf()
{


    // Consultar los computadores con la fecha especificada
    $computadores = Computador::whereNotNull('documento')
                              ->with('componentes')
                              ->paginate(10);
    $encabezado = "Reporte de préstamos a instructores" ;

    //logo imagen
    $logo = public_path('img/logoSena.png');
    // Renderizar la vista en HTML
    $html = view('pdf.listadoAprendizPdf', compact('computadores','encabezado','logo'))->render();

    // Configuración de DomPDF
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('defaultFont', 'Arial');
    $pdf = new Dompdf($options);

    // Cargar el HTML en DomPDF
    $pdf->loadHtml($html);

    // (Opcional) Configurar el tamaño del papel y la orientación
    $pdf->setPaper('A4', 'portrait');

    // Renderizar el PDF
    $pdf->render();

    // Enviar el PDF generado al navegador
    return $pdf->stream('reporte_préstamos_aprendices.pdf');
}

//desde aca para poder agregar componente
public function vistaPrestamoAprendiz(Request $request){

    $computadores = null;

    // Obtener el documento del formulario
    $documento = $request->input('documento');

    // Obtener la fecha actual
    $fechaHoy = Carbon::today();

    // Buscar los computadores que coincidan con el documento y la fecha actual
    $computadores = Computador::where('documento', $documento)
                              ->whereDate('fecha', $fechaHoy)
                              ->where('estado', true)
                              ->paginate(10); // Usamos paginate(10) para obtener una colección de resultados

    return view('aprendiz.indexAgregarComponenteAprendiz',compact('computadores'));
}



public function editAprendiz ($id)
{

    $computador = Computador::with('allComponentes')->findOrFail($id);
    $componentes = Componente::all();

    return view('aprendiz.agregarComponenteAprendiz', compact('computador', 'componentes'));
}

public function updateAprendiz(Request $request, $id)
{


    // Obtener el computador existente
    $computador = Computador::findOrFail($id);

    // Actualizar los campos del computador
    $computador->documento = $request->input('documento');
    $computador->nombres = $request->input('nombres');
    $computador->serial = $request->input('serial');


    // Guardar los cambios en la base de datos
    $computador->save();

    // Manejar la actualización de los componentes
    if ($request->has('componente')) {
        // Actualizar la relación con los componentes
        $computador->allComponentes()->sync($request->input('componente'));
    } else {
        // Si no se seleccionaron componentes, eliminar todos los relacionados
        $computador->allComponentes()->detach();
    }

    return redirect()->route('index')->with('success', 'El registro se actualizó correctamente.');
}


public function vistaPrestamoInstructor(Request $request){

    $computadores = null;

    // Obtener el documento del formulario
    $nombres = $request->input('nombres');

    // Obtener la fecha actual
    $fechaHoy = Carbon::today();

    // Buscar los computadores que coincidan con el documento y la fecha actual
    $computadores = Computador::where('nombres','LIKE' ,"%$nombres%")
                              ->whereDate('fecha', $fechaHoy)
                              ->where('estado', true)
                              ->paginate(10); // Usamos paginate(10) para obtener una colección de resultados


    return view('instructor.indexAgregarComponenteInstructor',compact('computadores'));
}

public function editInstructor ($id)
{

    $computador = Computador::with('allComponentes')->findOrFail($id);
    $componentes = Componente::all();

    return view('instructor.agregarComponenteInstructor', compact('computador', 'componentes'));
}

public function updateInstructor(Request $request, $id)
{


    // Obtener el computador existente
    $computador = Computador::findOrFail($id);

    // Actualizar los campos del computador
    $computador->nombres = $request->input('nombres');

    // Guardar los cambios en la base de datos
    $computador->save();

    // Manejar la actualización de los componentes
    if ($request->has('componente')) {
        // Actualizar la relación con los componentes
        $computador->allComponentes()->sync($request->input('componente'));
    } else {
        // Si no se seleccionaron componentes, eliminar todos los relacionados
        $computador->allComponentes()->detach();
    }

    return redirect()->route('index')->with('success', 'El registro se actualizó correctamente.');
}

}
