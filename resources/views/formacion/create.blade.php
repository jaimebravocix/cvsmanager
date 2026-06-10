@extends('layouts.app')
@section('title', 'Agregar Formación Académica')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Formación Académica</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Formación Académica</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.formacion.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Nivel <span class="text-danger">*</span></label>
                <select name="nivel" class="form-select">
                    <option value="Doctorado" {{ old('nivel', $registro->nivel ?? '') == 'Doctorado' ? 'selected' : '' }}>Doctorado</option>
                    <option value="Maestría" {{ old('nivel', $registro->nivel ?? '') == 'Maestría' ? 'selected' : '' }}>Maestría</option>
                    <option value="Segunda Especialidad" {{ old('nivel', $registro->nivel ?? '') == 'Segunda Especialidad' ? 'selected' : '' }}>Segunda Especialidad</option>
                    <option value="Licenciatura" {{ old('nivel', $registro->nivel ?? '') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                    <option value="Bachillerato" {{ old('nivel', $registro->nivel ?? '') == 'Bachillerato' ? 'selected' : '' }}>Bachillerato</option>
                    <option value="Técnico Superior" {{ old('nivel', $registro->nivel ?? '') == 'Técnico Superior' ? 'selected' : '' }}>Técnico Superior</option>
                    <option value="Diplomado" {{ old('nivel', $registro->nivel ?? '') == 'Diplomado' ? 'selected' : '' }}>Diplomado</option>
                    <option value="Curso de Especialización" {{ old('nivel', $registro->nivel ?? '') == 'Curso de Especialización' ? 'selected' : '' }}>Curso de Especialización</option>
                    <option value="Curso" {{ old('nivel', $registro->nivel ?? '') == 'Curso' ? 'selected' : '' }}>Curso</option>
                    <option value="Certificación" {{ old('nivel', $registro->nivel ?? '') == 'Certificación' ? 'selected' : '' }}>Certificación</option>
                    <option value="Otro" {{ old('nivel', $registro->nivel ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Especialidad <span class="text-danger">*</span></label>
                <input type="text" name="especialidad" value="{{ old('especialidad', $registro->especialidad ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Mención </label>
                <input type="text" name="mencion" value="{{ old('mencion', $registro->mencion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Institución <span class="text-danger">*</span></label>
                <input type="text" name="institucion" value="{{ old('institucion', $registro->institucion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Año Inicio</label>
                <input type="number" name="anio_inicio" value="{{ old('anio_inicio', $registro->anio_inicio ?? '') }}" class="form-control" min="1950">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Año Fin</label>
                <input type="number" name="anio_fin" value="{{ old('anio_fin', $registro->anio_fin ?? '') }}" class="form-control" min="1950">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Fecha de Grado </label>
                <input type="date" name="fecha_grado" value="{{ old('fecha_grado', isset($registro->fecha_grado) ? $registro->fecha_grado->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">N° Resolución </label>
                <input type="text" name="numero_resolucion" value="{{ old('numero_resolucion', $registro->numero_resolucion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">N° Registro SUNEDU </label>
                <input type="text" name="numero_registro_sunedu" value="{{ old('numero_registro_sunedu', $registro->numero_registro_sunedu ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Observaciones</label>
                <textarea name="observaciones" rows="2" class="form-control">{{ old('observaciones', $registro->observaciones ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Archivo (PDF/Imagen)</label>
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
