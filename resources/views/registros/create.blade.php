@extends('layouts.app')
@section('title', 'Agregar Registro Institucional')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Registro Institucional</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Registro Institucional</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.registros.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución (ej: RENACYT) <span class="text-danger">*</span></label>
                <input type="text" name="institucion" value="{{ old('institucion', $registro->institucion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Tipo de Registro </label>
                <input type="text" name="tipo_registro" value="{{ old('tipo_registro', $registro->tipo_registro ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Registro </label>
                <input type="text" name="numero_registro" value="{{ old('numero_registro', $registro->numero_registro ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha de Registro </label>
                <input type="date" name="fecha_registro" value="{{ old('fecha_registro', isset($registro->fecha_registro) ? $registro->fecha_registro->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Vencimiento </label>
                <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', isset($registro->fecha_vencimiento) ? $registro->fecha_vencimiento->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Categoría </label>
                <input type="text" name="categoria" value="{{ old('categoria', $registro->categoria ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Especialidad </label>
                <input type="text" name="especialidad" value="{{ old('especialidad', $registro->especialidad ?? '') }}" class="form-control"  >
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
