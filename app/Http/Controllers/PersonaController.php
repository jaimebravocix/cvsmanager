<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = Persona::with('user', 'documentos');

        if (!$user->hasRole(['administrador', 'supervisor'])) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('buscar')) {
            $buscar = $request->buscar;
            $query->where(function($q) use ($buscar) {
                $q->where('apellido_paterno', 'ilike', "%{$buscar}%")
                  ->orWhere('apellido_materno', 'ilike', "%{$buscar}%")
                  ->orWhere('nombres', 'ilike', "%{$buscar}%")
                  ->orWhere('codigo_personal', 'ilike', "%{$buscar}%");
            });
        }

        if ($request->filled('tipo')) {
            $query->where('tipo_personal', $request->tipo);
        }

        $personas = $query->orderBy('apellido_paterno')->paginate(15)->withQueryString();
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        $usuarios_sin_persona = User::doesntHave('persona')->get();
        return view('personas.create', compact('usuarios_sin_persona'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'apellido_paterno'    => 'required|string|max:100',
            'apellido_materno'    => 'required|string|max:100',
            'nombres'             => 'required|string|max:200',
            'sexo'                => 'nullable|in:M,F',
            'fecha_nacimiento'    => 'nullable|date',
            'lugar_nacimiento'    => 'nullable|string|max:200',
            'pais_nacimiento'     => 'nullable|string|max:100',
            'estado_civil'        => 'nullable|string',
            'telefono'            => 'nullable|string|max:20',
            'celular'             => 'nullable|string|max:20',
            'tipo_personal'       => 'required|in:docente,administrativo,ambos',
            'codigo_personal'     => 'nullable|string|max:50|unique:personas',
            'resumen_profesional' => 'nullable|string',
            'user_id'             => 'nullable|exists:users,id',
            'foto'                => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $persona = Persona::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Persona registrada exitosamente.');
    }

    public function show(Persona $persona)
    {
        $this->authorize_access($persona);
        $persona->load([
            'documentos', 'direcciones', 'emails', 'regimenesP',
            'cuentasHaberes', 'documentosSalud', 'antecedentes',
            'formacionAcademica', 'experienciaDocente', 'experienciaProfesional',
            'certificacionesIdioma', 'registrosInstitucionales',
            'produccionCientifica', 'produccionBibliografica', 'produccionInvestigacion',
            'congresos', 'reconocimientos', 'licencias', 'membresias',
        ]);
        return view('personas.show', compact('persona'));
    }

    public function edit(Persona $persona)
    {
        $this->authorize_access($persona);
        $usuarios_sin_persona = User::doesntHave('persona')->orWhere('id', $persona->user_id)->get();
        return view('personas.edit', compact('persona', 'usuarios_sin_persona'));
    }

    public function update(Request $request, Persona $persona)
    {
        $this->authorize_access($persona);
        $validated = $request->validate([
            'apellido_paterno'    => 'required|string|max:100',
            'apellido_materno'    => 'required|string|max:100',
            'nombres'             => 'required|string|max:200',
            'sexo'                => 'nullable|in:M,F',
            'fecha_nacimiento'    => 'nullable|date',
            'lugar_nacimiento'    => 'nullable|string|max:200',
            'pais_nacimiento'     => 'nullable|string|max:100',
            'estado_civil'        => 'nullable|string',
            'telefono'            => 'nullable|string|max:20',
            'celular'             => 'nullable|string|max:20',
            'tipo_personal'       => 'required|in:docente,administrativo,ambos',
            'codigo_personal'     => 'nullable|string|max:50|unique:personas,codigo_personal,'.$persona->id,
            'resumen_profesional' => 'nullable|string',
            'user_id'             => 'nullable|exists:users,id',
            'foto'                => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($persona->foto) Storage::disk('public')->delete($persona->foto);
            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $persona->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Datos actualizados correctamente.');
    }

    public function destroy(Persona $persona)
    {
        $this->authorize_access($persona);
        $persona->delete();
        return redirect()->route('personas.index')->with('success', 'Persona eliminada.');
    }

    private function authorize_access(Persona $persona)
    {
        $user = Auth::user();
        if (!$user->hasRole(['administrador', 'supervisor']) && $persona->user_id !== $user->id) {
            abort(403, 'No tiene acceso a este perfil.');
        }
    }
}
