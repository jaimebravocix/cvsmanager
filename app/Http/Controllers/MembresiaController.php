<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Membresia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembresiaController extends Controller
{
    private function getPersona(int $personaId): Persona
    {
        $persona = Persona::findOrFail($personaId);
        $user = Auth::user();
        if (!$user->hasRole(['administrador', 'supervisor']) && $persona->user_id !== $user->id) {
            abort(403, 'Sin acceso a este perfil.');
        }
        return $persona;
    }

    public function create(Persona $persona)
    {
        $this->getPersona($persona->id);
        return view('membresias.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'siglas' => 'nullable|string|max:50',
            'ambito' => 'required|string',
            'tipo_membresia' => 'nullable|string|max:100',
            'numero_membresia' => 'nullable|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'vigente' => 'boolean',
            'rol_cargo' => 'nullable|string|max:200',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        Membresia::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Membresía registrado exitosamente.');
    }

    public function edit(Persona $persona, Membresia $registro)
    {
        $this->getPersona($persona->id);
        return view('membresias.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, Membresia $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:300',
            'siglas' => 'nullable|string|max:50',
            'ambito' => 'required|string',
            'tipo_membresia' => 'nullable|string|max:100',
            'numero_membresia' => 'nullable|string|max:100',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'vigente' => 'boolean',
            'rol_cargo' => 'nullable|string|max:200',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Membresía actualizado correctamente.');
    }

    public function destroy(Persona $persona, Membresia $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Membresía eliminado.');
    }
}
