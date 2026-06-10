@extends('layouts.app')
@section('title', 'Editar Reconocimiento / Honor')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Reconocimiento / Honor</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Reconocimiento / Honor</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.reconocimientos.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Premio" {{ old('tipo', $registro->tipo ?? '') == 'Premio' ? 'selected' : '' }}>Premio</option>
                    <option value="Distinción" {{ old('tipo', $registro->tipo ?? '') == 'Distinción' ? 'selected' : '' }}>Distinción</option>
                    <option value="Beca" {{ old('tipo', $registro->tipo ?? '') == 'Beca' ? 'selected' : '' }}>Beca</option>
                    <option value="Honor al Mérito" {{ old('tipo', $registro->tipo ?? '') == 'Honor al Mérito' ? 'selected' : '' }}>Honor al Mérito</option>
                    <option value="Ciudadano Ilustre" {{ old('tipo', $registro->tipo ?? '') == 'Ciudadano Ilustre' ? 'selected' : '' }}>Ciudadano Ilustre</option>
                    <option value="Reconocimiento Institucional" {{ old('tipo', $registro->tipo ?? '') == 'Reconocimiento Institucional' ? 'selected' : '' }}>Reconocimiento Institucional</option>
                    <option value="Medalla" {{ old('tipo', $registro->tipo ?? '') == 'Medalla' ? 'selected' : '' }}>Medalla</option>
                    <option value="Diploma de Honor" {{ old('tipo', $registro->tipo ?? '') == 'Diploma de Honor' ? 'selected' : '' }}>Diploma de Honor</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción <span class="text-danger">*</span></label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $registro->descripcion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución Otorgante <span class="text-danger">*</span></label>
                <input type="text" name="institucion_otorgante" value="{{ old('institucion_otorgante', $registro->institucion_otorgante ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha <span class="text-danger">*</span></label>
                <input type="date" name="fecha" value="{{ old('fecha', isset($registro->fecha) ? $registro->fecha->format('Y-m-d') : '') }}" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Resolución </label>
                <input type="text" name="resolucion" value="{{ old('resolucion', $registro->resolucion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Detalle</label>
                <textarea name="detalle" rows="2" class="form-control">{{ old('detalle', $registro->detalle ?? '') }}</textarea>
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
