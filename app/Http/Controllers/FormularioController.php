<?php

namespace App\Http\Controllers;

use App\Models\Especialista;
use App\Models\Paciente;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        $rows = Especialista::whereIn('nombre', ['Pamela Mamani', 'Carla Carpero', 'Brittany Lara'])
            ->where('activo', true)
            ->get(['id', 'nombre']);

        $especialistas = [
            'pamela'   => $rows->firstWhere('nombre', 'Pamela Mamani')?->id,
            'carla'    => $rows->firstWhere('nombre', 'Carla Carpero')?->id,
            'brittany' => $rows->firstWhere('nombre', 'Brittany Lara')?->id,
        ];

        return view('formulario', ['especialistas' => $especialistas]);
    }

    public function especialistas(Request $request)
    {
        $especialidad = $request->query('especialidad');

        if (!in_array($especialidad, ['fonoaudiologia', 'quiropraxia'])) {
            return response()->json([]);
        }

        $especialistas = Especialista::where('especialidad', $especialidad)
            ->where('activo', true)
            ->orderBy('nombre')
            ->get(['id', 'nombre']);

        return response()->json($especialistas);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_nino'    => 'required|string|max:100',
            'edad'           => 'required|integer|min:1|max:17',
            'escolaridad'    => 'required|string|max:100',
            'tutores'        => 'required|string|max:255',
            'especialidad'   => 'required|in:fonoaudiologia,quiropraxia,psicomotricidad',
            'especialista_id'=> 'required|exists:especialistas,id',
        ], [
            'nombre_nino.required'    => 'El nombre del niño es obligatorio.',
            'edad.required'           => 'La edad es obligatoria.',
            'edad.min'                => 'La edad mínima es 1 año.',
            'edad.max'                => 'La edad máxima es 17 años.',
            'escolaridad.required'    => 'La escolaridad es obligatoria.',
            'tutores.required'        => 'El nombre del tutor es obligatorio.',
            'especialidad.required'   => 'Debes elegir una especialidad.',
            'especialista_id.required'=> 'Debes elegir un especialista.',
            'especialista_id.exists'  => 'El especialista seleccionado no es válido.',
        ]);

        // Verificar que el especialista pertenece a la especialidad elegida
        $especialista = Especialista::where('id', $data['especialista_id'])
            ->where('activo', true)
            ->first();

        if (!$especialista) {
            return response()->json([
                'success' => false,
                'message' => 'El especialista no corresponde a la especialidad seleccionada.',
            ], 422);
        }

        Paciente::create($data);

        return response()->json([
            'success' => true,
            'message' => '¡Registro guardado con éxito!',
        ]);
    }
}
