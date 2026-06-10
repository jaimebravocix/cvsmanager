<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\ProduccionCientifica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduccionCientificaController extends Controller
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
        return view('produccion.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'titulo' => 'required|string',
            'autores' => 'required|string',
            'revista_editorial' => 'nullable|string|max:300',
            'volumen' => 'nullable|string|max:50',
            'numero' => 'nullable|string|max:50',
            'paginas' => 'nullable|string|max:50',
            'doi' => 'nullable|string|max:200',
            'issn_isbn' => 'nullable|string|max:50',
            'anio_publicacion' => 'nullable|integer|min:1900|max:2100',
            'indexacion' => 'nullable|string',
            'cuartil' => 'nullable|string|max:10',
            'enlace_url' => 'nullable|url|max:500',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        $validated['persona_id'] = $persona->id;
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        ProduccionCientifica::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Científica registrado exitosamente.');
    }

    public function edit(Persona $persona, ProduccionCientifica $registro)
    {
        $this->getPersona($persona->id);
        return view('produccion.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, ProduccionCientifica $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'titulo' => 'required|string',
            'autores' => 'required|string',
            'revista_editorial' => 'nullable|string|max:300',
            'volumen' => 'nullable|string|max:50',
            'numero' => 'nullable|string|max:50',
            'paginas' => 'nullable|string|max:50',
            'doi' => 'nullable|string|max:200',
            'issn_isbn' => 'nullable|string|max:50',
            'anio_publicacion' => 'nullable|integer|min:1900|max:2100',
            'indexacion' => 'nullable|string',
            'cuartil' => 'nullable|string|max:10',
            'enlace_url' => 'nullable|url|max:500',
            'observaciones' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);
        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('documentos', 'public');
        }
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Científica actualizado correctamente.');
    }

    public function destroy(Persona $persona, ProduccionCientifica $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Producción Científica eliminado.');
    }
}
