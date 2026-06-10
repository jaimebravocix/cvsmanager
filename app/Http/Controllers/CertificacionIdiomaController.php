<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\CertificacionIdioma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificacionIdiomaController extends Controller
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
        return view('idiomas.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'idioma' => 'required|string|max:100',
            'nivel_comprension' => 'nullable|string',
            'nivel_escritura' => 'nullable|string',
            'nivel_habla' => 'nullable|string',
            'examen_certificacion' => 'nullable|string|max:100',
            'puntaje' => 'nullable|string|max:50',
            'institucion' => 'nullable|string|max:200',
            'fecha' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        CertificacionIdioma::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Certificación de Idioma registrado exitosamente.');
    }

    public function edit(Persona $persona, CertificacionIdioma $registro)
    {
        $this->getPersona($persona->id);
        return view('idiomas.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, CertificacionIdioma $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'idioma' => 'required|string|max:100',
            'nivel_comprension' => 'nullable|string',
            'nivel_escritura' => 'nullable|string',
            'nivel_habla' => 'nullable|string',
            'examen_certificacion' => 'nullable|string|max:100',
            'puntaje' => 'nullable|string|max:50',
            'institucion' => 'nullable|string|max:200',
            'fecha' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Certificación de Idioma actualizado correctamente.');
    }

    public function destroy(Persona $persona, CertificacionIdioma $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Certificación de Idioma eliminado.');
    }
}
