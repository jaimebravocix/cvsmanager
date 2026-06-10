<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\RegistroInstitucional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroInstitucionalController extends Controller
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
        return view('registros.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:200',
            'tipo_registro' => 'nullable|string|max:200',
            'numero_registro' => 'nullable|string|max:100',
            'fecha_registro' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'categoria' => 'nullable|string|max:100',
            'especialidad' => 'nullable|string|max:200',
            'vigente' => 'boolean',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        RegistroInstitucional::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Registro Institucional registrado exitosamente.');
    }

    public function edit(Persona $persona, RegistroInstitucional $registro)
    {
        $this->getPersona($persona->id);
        return view('registros.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, RegistroInstitucional $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'institucion' => 'required|string|max:200',
            'tipo_registro' => 'nullable|string|max:200',
            'numero_registro' => 'nullable|string|max:100',
            'fecha_registro' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'categoria' => 'nullable|string|max:100',
            'especialidad' => 'nullable|string|max:200',
            'vigente' => 'boolean',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Registro Institucional actualizado correctamente.');
    }

    public function destroy(Persona $persona, RegistroInstitucional $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Registro Institucional eliminado.');
    }
}
