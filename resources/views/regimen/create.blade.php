@extends('layouts.app')
@section('title', 'Agregar Régimen Pensionario')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Régimen Pensionario</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Régimen Pensionario</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.regimen.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="ONP" {{ old('tipo', $registro->tipo ?? '') == 'ONP' ? 'selected' : '' }}>ONP</option>
                    <option value="AFP" {{ old('tipo', $registro->tipo ?? '') == 'AFP' ? 'selected' : '' }}>AFP</option>
                    <option value="Ninguno" {{ old('tipo', $registro->tipo ?? '') == 'Ninguno' ? 'selected' : '' }}>Ninguno</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Nombre AFP </label>
                <input type="text" name="nombre_afp" value="{{ old('nombre_afp', $registro->nombre_afp ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° CUSPP </label>
                <input type="text" name="numero_cuspp" value="{{ old('numero_cuspp', $registro->numero_cuspp ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha de Afiliación </label>
                <input type="date" name="fecha_afiliacion" value="{{ old('fecha_afiliacion', isset($registro->fecha_afiliacion) ? $registro->fecha_afiliacion->format('Y-m-d') : '') }}" class="form-control" >
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
