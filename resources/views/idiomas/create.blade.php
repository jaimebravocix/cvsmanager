@extends('layouts.app')
@section('title', 'Agregar Certificación de Idioma')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Certificación de Idioma</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Certificación de Idioma</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.idiomas.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Idioma <span class="text-danger">*</span></label>
                <input type="text" name="idioma" value="{{ old('idioma', $registro->idioma ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Comprensión </label>
                <select name="nivel_comprension" class="form-select">
                    <option value="A1" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'A1' ? 'selected' : '' }}>A1</option>
                    <option value="A2" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'A2' ? 'selected' : '' }}>A2</option>
                    <option value="B1" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'B1' ? 'selected' : '' }}>B1</option>
                    <option value="B2" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'B2' ? 'selected' : '' }}>B2</option>
                    <option value="C1" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'C1' ? 'selected' : '' }}>C1</option>
                    <option value="C2" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'C2' ? 'selected' : '' }}>C2</option>
                    <option value="Nativo" {{ old('nivel_comprension', $registro->nivel_comprension ?? '') == 'Nativo' ? 'selected' : '' }}>Nativo</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Escritura </label>
                <select name="nivel_escritura" class="form-select">
                    <option value="A1" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'A1' ? 'selected' : '' }}>A1</option>
                    <option value="A2" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'A2' ? 'selected' : '' }}>A2</option>
                    <option value="B1" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'B1' ? 'selected' : '' }}>B1</option>
                    <option value="B2" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'B2' ? 'selected' : '' }}>B2</option>
                    <option value="C1" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'C1' ? 'selected' : '' }}>C1</option>
                    <option value="C2" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'C2' ? 'selected' : '' }}>C2</option>
                    <option value="Nativo" {{ old('nivel_escritura', $registro->nivel_escritura ?? '') == 'Nativo' ? 'selected' : '' }}>Nativo</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Expresión Oral </label>
                <select name="nivel_habla" class="form-select">
                    <option value="A1" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'A1' ? 'selected' : '' }}>A1</option>
                    <option value="A2" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'A2' ? 'selected' : '' }}>A2</option>
                    <option value="B1" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'B1' ? 'selected' : '' }}>B1</option>
                    <option value="B2" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'B2' ? 'selected' : '' }}>B2</option>
                    <option value="C1" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'C1' ? 'selected' : '' }}>C1</option>
                    <option value="C2" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'C2' ? 'selected' : '' }}>C2</option>
                    <option value="Nativo" {{ old('nivel_habla', $registro->nivel_habla ?? '') == 'Nativo' ? 'selected' : '' }}>Nativo</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Examen (ej: TOEFL, DELF) </label>
                <input type="text" name="examen_certificacion" value="{{ old('examen_certificacion', $registro->examen_certificacion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Puntaje </label>
                <input type="text" name="puntaje" value="{{ old('puntaje', $registro->puntaje ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Institución Certificadora </label>
                <input type="text" name="institucion" value="{{ old('institucion', $registro->institucion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Certificación </label>
                <input type="date" name="fecha" value="{{ old('fecha', isset($registro->fecha) ? $registro->fecha->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Vencimiento </label>
                <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', isset($registro->fecha_vencimiento) ? $registro->fecha_vencimiento->format('Y-m-d') : '') }}" class="form-control" >
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
