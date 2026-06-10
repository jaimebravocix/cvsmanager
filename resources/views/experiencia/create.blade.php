@extends('layouts.app')
@section('title', 'Agregar Experiencia Docente')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Experiencia Docente</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Experiencia Docente</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.experiencia-docente.store', $persona) }}" enctype="multipart/form-data">
        @csrf
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
                <label class="form-label fw-medium">Facultad </label>
                <input type="text" name="facultad" value="{{ old('facultad', $registro->facultad ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Departamento Académico </label>
                <input type="text" name="departamento" value="{{ old('departamento', $registro->departamento ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Curso / Asignatura </label>
                <input type="text" name="curso_asignatura" value="{{ old('curso_asignatura', $registro->curso_asignatura ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Categoría </label>
                <select name="categoria" class="form-select">
                    <option value="Auxiliar" {{ old('categoria', $registro->categoria ?? '') == 'Auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                    <option value="Asociado" {{ old('categoria', $registro->categoria ?? '') == 'Asociado' ? 'selected' : '' }}>Asociado</option>
                    <option value="Principal" {{ old('categoria', $registro->categoria ?? '') == 'Principal' ? 'selected' : '' }}>Principal</option>
                    <option value="Contratado" {{ old('categoria', $registro->categoria ?? '') == 'Contratado' ? 'selected' : '' }}>Contratado</option>
                    <option value="Jefe de Práctica" {{ old('categoria', $registro->categoria ?? '') == 'Jefe de Práctica' ? 'selected' : '' }}>Jefe de Práctica</option>
                    <option value="Otro" {{ old('categoria', $registro->categoria ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Condición </label>
                <select name="condicion" class="form-select">
                    <option value="Ordinario" {{ old('condicion', $registro->condicion ?? '') == 'Ordinario' ? 'selected' : '' }}>Ordinario</option>
                    <option value="Extraordinario" {{ old('condicion', $registro->condicion ?? '') == 'Extraordinario' ? 'selected' : '' }}>Extraordinario</option>
                    <option value="Contratado" {{ old('condicion', $registro->condicion ?? '') == 'Contratado' ? 'selected' : '' }}>Contratado</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Régimen </label>
                <select name="regimen" class="form-select">
                    <option value="Tiempo Completo" {{ old('regimen', $registro->regimen ?? '') == 'Tiempo Completo' ? 'selected' : '' }}>Tiempo Completo</option>
                    <option value="Tiempo Parcial" {{ old('regimen', $registro->regimen ?? '') == 'Tiempo Parcial' ? 'selected' : '' }}>Tiempo Parcial</option>
                    <option value="Dedicación Exclusiva" {{ old('regimen', $registro->regimen ?? '') == 'Dedicación Exclusiva' ? 'selected' : '' }}>Dedicación Exclusiva</option>
                    <option value="Por Horas" {{ old('regimen', $registro->regimen ?? '') == 'Por Horas' ? 'selected' : '' }}>Por Horas</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Horas Semanales</label>
                <input type="number" name="horas_semanales" value="{{ old('horas_semanales', $registro->horas_semanales ?? '') }}" class="form-control" min="1">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Inicio <span class="text-danger">*</span></label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($registro->fecha_inicio) ? $registro->fecha_inicio->format('Y-m-d') : '') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Fin </label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($registro->fecha_fin) ? $registro->fecha_fin->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Resolución </label>
                <input type="text" name="resolucion" value="{{ old('resolucion', $registro->resolucion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción</label>
                <textarea name="descripcion" rows="3" class="form-control">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>
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
