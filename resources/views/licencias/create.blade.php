@extends('layouts.app')
@section('title', 'Agregar Licencia Profesional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Licencia Profesional</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Licencia Profesional</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.licencias.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Nombre de Licencia <span class="text-danger">*</span></label>
                <input type="text" name="nombre_licencia" value="{{ old('nombre_licencia', $registro->nombre_licencia ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Colegiatura Profesional" {{ old('tipo', $registro->tipo ?? '') == 'Colegiatura Profesional' ? 'selected' : '' }}>Colegiatura Profesional</option>
                    <option value="Licencia de Ejercicio" {{ old('tipo', $registro->tipo ?? '') == 'Licencia de Ejercicio' ? 'selected' : '' }}>Licencia de Ejercicio</option>
                    <option value="Habilitación Profesional" {{ old('tipo', $registro->tipo ?? '') == 'Habilitación Profesional' ? 'selected' : '' }}>Habilitación Profesional</option>
                    <option value="Certificación Profesional" {{ old('tipo', $registro->tipo ?? '') == 'Certificación Profesional' ? 'selected' : '' }}>Certificación Profesional</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución Emisora <span class="text-danger">*</span></label>
                <input type="text" name="institucion_emisora" value="{{ old('institucion_emisora', $registro->institucion_emisora ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Licencia </label>
                <input type="text" name="numero_licencia" value="{{ old('numero_licencia', $registro->numero_licencia ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Especialidad </label>
                <input type="text" name="especialidad" value="{{ old('especialidad', $registro->especialidad ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Emisión </label>
                <input type="date" name="fecha_emision" value="{{ old('fecha_emision', isset($registro->fecha_emision) ? $registro->fecha_emision->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Vencimiento </label>
                <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', isset($registro->fecha_vencimiento) ? $registro->fecha_vencimiento->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Observaciones</label>
                <textarea name="observaciones" rows="2" class="form-control">{{ old('observaciones', $registro->observaciones ?? '') }}</textarea>
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
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
            <a href="{{ route('personas.show', $persona) }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
