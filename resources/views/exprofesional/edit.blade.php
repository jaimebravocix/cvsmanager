@extends('layouts.app')
@section('title', 'Editar Experiencia Profesional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Experiencia Profesional</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Experiencia Profesional</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.experiencia-profesional.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución <span class="text-danger">*</span></label>
                <input type="text" name="institucion" value="{{ old('institucion', $registro->institucion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Cargo <span class="text-danger">*</span></label>
                <input type="text" name="cargo" value="{{ old('cargo', $registro->cargo ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Área </label>
                <input type="text" name="area" value="{{ old('area', $registro->area ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo </label>
                <select name="tipo" class="form-select">
                    <option value="Pública" {{ old('tipo', $registro->tipo ?? '') == 'Pública' ? 'selected' : '' }}>Pública</option>
                    <option value="Privada" {{ old('tipo', $registro->tipo ?? '') == 'Privada' ? 'selected' : '' }}>Privada</option>
                    <option value="ONG" {{ old('tipo', $registro->tipo ?? '') == 'ONG' ? 'selected' : '' }}>ONG</option>
                    <option value="Consultora" {{ old('tipo', $registro->tipo ?? '') == 'Consultora' ? 'selected' : '' }}>Consultora</option>
                    <option value="Independiente" {{ old('tipo', $registro->tipo ?? '') == 'Independiente' ? 'selected' : '' }}>Independiente</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Inicio <span class="text-danger">*</span></label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($registro->fecha_inicio) ? $registro->fecha_inicio->format('Y-m-d') : '') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Fin </label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($registro->fecha_fin) ? $registro->fecha_fin->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción de Funciones</label>
                <textarea name="descripcion_funciones" rows="3" class="form-control">{{ old('descripcion_funciones', $registro->descripcion_funciones ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Archivo</label>
                @if(isset($registro) && $registro->archivo)
                    <div class="mb-1"><a href="{{ Storage::url($registro->archivo) }}" target="_blank" class="text-primary small"><i class="bi bi-file-earmark me-1"></i>Ver archivo actual</a></div>
                @endif
                <input type="file" name="archivo" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
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
