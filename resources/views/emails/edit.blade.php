@extends('layouts.app')
@section('title', 'Editar Correo Electrónico')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Correo Electrónico</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Correo Electrónico</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.emails.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo </label>
                <select name="tipo" class="form-select">
                    <option value="personal" {{ old('tipo', $registro->tipo ?? '') == 'personal' ? 'selected' : '' }}>personal</option>
                    <option value="institucional" {{ old('tipo', $registro->tipo ?? '') == 'institucional' ? 'selected' : '' }}>institucional</option>
                    <option value="otro" {{ old('tipo', $registro->tipo ?? '') == 'otro' ? 'selected' : '' }}>otro</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" value="{{ old('email', $registro->email ?? '') }}" class="form-control"  required>
            </div>

        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
            <a href="{{ route('personas.show', $persona) }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
