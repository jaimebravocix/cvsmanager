<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];

        if ($user->hasRole(['administrador', 'supervisor'])) {
            $stats['total_docentes'] = Persona::where('tipo_personal', 'docente')->count();
            $stats['total_administrativos'] = Persona::where('tipo_personal', 'administrativo')->count();
            $stats['total_usuarios'] = User::where('activo', true)->count();
            $stats['docentes_activos'] = Persona::where('tipo_personal', 'docente')->where('activo', true)->count();
            $ultimas_personas = Persona::with('user')->orderBy('created_at', 'desc')->take(5)->get();
        } else {
            $persona = $user->persona;
            $stats = [];
            $ultimas_personas = collect();
        }

        return view('dashboard', compact('stats', 'ultimas_personas', 'user'));
    }
}
