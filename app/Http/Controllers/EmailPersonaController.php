<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\EmailPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailPersonaController extends Controller
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
        return view('emails.create', compact('persona'));
    }

    public function store(Request $request, Persona $persona)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'email' => 'required|email',
            'principal' => 'boolean',
        ]);
        $validated['persona_id'] = $persona->id;
        EmailPersona::create($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Email registrado exitosamente.');
    }

    public function edit(Persona $persona, EmailPersona $registro)
    {
        $this->getPersona($persona->id);
        return view('emails.edit', compact('persona', 'registro'));
    }

    public function update(Request $request, Persona $persona, EmailPersona $registro)
    {
        $this->getPersona($persona->id);
        $validated = $request->validate([
            'tipo' => 'required|string',
            'email' => 'required|email',
            'principal' => 'boolean',
        ]);
        $registro->update($validated);
        return redirect()->route('personas.show', $persona)->with('success', 'Email actualizado correctamente.');
    }

    public function destroy(Persona $persona, EmailPersona $registro)
    {
        $this->getPersona($persona->id);
        $registro->delete();
        return redirect()->route('personas.show', $persona)->with('success', 'Email eliminado.');
    }
}
