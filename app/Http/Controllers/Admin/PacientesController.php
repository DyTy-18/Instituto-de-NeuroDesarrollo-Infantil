<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacientesController extends Controller
{
    public function index(Request $request)
    {
        $query = Paciente::with('especialista')->latest();

        if ($request->filled('especialidad')) {
            $query->where('especialidad', $request->especialidad);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function ($q) use ($buscar) {
                $q->where('nombre_nino', 'like', "%{$buscar}%")
                  ->orWhere('tutores', 'like', "%{$buscar}%");
            });
        }

        $pacientes = $query->paginate(15)->withQueryString();

        $total      = Paciente::count();
        $totalFono  = Paciente::where('especialidad', 'fonoaudiologia')->count();
        $totalPsico = Paciente::where('especialidad', 'psicomotricidad')->count();

        return view('admin.pacientes', compact(
            'pacientes', 'total', 'totalFono', 'totalPsico'
        ));
    }

    public function show(Paciente $paciente)
    {
        $paciente->load('especialista');
        return view('admin.paciente-detalle', compact('paciente'));
    }
}
