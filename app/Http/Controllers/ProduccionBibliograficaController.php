<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\ProduccionBibliografica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduccionBibliograficaController extends Controller
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
        return view('bibliografica.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'titulo' => 'required|string',
            'autores' => 'required|string',
            'editorial' => 'nullable|string|max:200',
            'lugar_edicion' => 'nullable|string|max:200',
            'anio_publicacion' => 'nullable|integer|min:1900|max:2100',
            'isbn' => 'nullable|string|max:50',
            'numero_edicion' => 'nullable|integer|min:1',
            'numero_paginas' => 'nullable|integer|min:1',
            'enlace_url' => 'nullable|url|max:500',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        ProduccionBibliografica::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Bibliográfica registrado exitosamente.');
    }

    public function edit(Persona $persona, ProduccionBibliografica $registro)
    {
        $this->getPersona($persona->id);
        return view('bibliografica.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, ProduccionBibliografica $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'titulo' => 'required|string',
            'autores' => 'required|string',
            'editorial' => 'nullable|string|max:200',
            'lugar_edicion' => 'nullable|string|max:200',
            'anio_publicacion' => 'nullable|integer|min:1900|max:2100',
            'isbn' => 'nullable|string|max:50',
            'numero_edicion' => 'nullable|integer|min:1',
            'numero_paginas' => 'nullable|integer|min:1',
            'enlace_url' => 'nullable|url|max:500',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Bibliográfica actualizado correctamente.');
    }

    public function destroy(Persona $persona, ProduccionBibliografica $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Bibliográfica eliminado.');
    }
}
