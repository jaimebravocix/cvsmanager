@extends('layouts.app')
@section('title', 'Editar Documento de Salud')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Documento de Salud</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Documento de Salud</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.salud.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Examen Médico Ocupacional" {{ old('tipo', $registro->tipo ?? '') == 'Examen Médico Ocupacional' ? 'selected' : '' }}>Examen Médico Ocupacional</option>
                    <option value="Seguro de Salud" {{ old('tipo', $registro->tipo ?? '') == 'Seguro de Salud' ? 'selected' : '' }}>Seguro de Salud</option>
                    <option value="Historia Clínica" {{ old('tipo', $registro->tipo ?? '') == 'Historia Clínica' ? 'selected' : '' }}>Historia Clínica</option>
                    <option value="Vacunación" {{ old('tipo', $registro->tipo ?? '') == 'Vacunación' ? 'selected' : '' }}>Vacunación</option>
                    <option value="Discapacidad" {{ old('tipo', $registro->tipo ?? '') == 'Discapacidad' ? 'selected' : '' }}>Discapacidad</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción <span class="text-danger">*</span></label>
                <input type="text" name="descripcion" value="{{ old('descripcion', $registro->descripcion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Entidad Emisora </label>
                <input type="text" name="entidad" value="{{ old('entidad', $registro->entidad ?? '') }}" class="form-control"  >
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
                <label class="form-label fw-medium">N° Documento </label>
                <input type="text" name="numero_documento" value="{{ old('numero_documento', $registro->numero_documento ?? '') }}" class="form-control"  >
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
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Actualizar</button>
            <a href="{{ route('personas.show', $persona) }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
