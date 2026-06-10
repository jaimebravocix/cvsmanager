<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\DocumentoSalud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoSaludController extends Controller
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
        return view('salud.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string|max:300',
            'entidad' => 'nullable|string|max:200',
            'fecha_emision' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'numero_documento' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        DocumentoSalud::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Documento de Salud registrado exitosamente.');
    }

    public function edit(Persona $persona, DocumentoSalud $registro)
    {
        $this->getPersona($persona->id);
        return view('salud.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, DocumentoSalud $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'descripcion' => 'required|string|max:300',
            'entidad' => 'nullable|string|max:200',
            'fecha_emision' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'numero_documento' => 'nullable|string|max:100',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Documento de Salud actualizado correctamente.');
    }

    public function destroy(Persona $persona, DocumentoSalud $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Documento de Salud eliminado.');
    }
}
