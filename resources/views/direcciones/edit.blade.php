@extends('layouts.app')
@section('title', 'Editar Dirección')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Dirección</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Dirección</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.direcciones.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-medium">Tipo </label>
                <select name="tipo" class="form-select">
                    <option value="domicilio" {{ old('tipo', $registro->tipo ?? '') == 'domicilio' ? 'selected' : '' }}>domicilio</option>
                    <option value="trabajo" {{ old('tipo', $registro->tipo ?? '') == 'trabajo' ? 'selected' : '' }}>trabajo</option>
                    <option value="otro" {{ old('tipo', $registro->tipo ?? '') == 'otro' ? 'selected' : '' }}>otro</option>
                </select>
            </div>
            <div class="col-md-9">
                <label class="form-label fw-medium">Dirección <span class="text-danger">*</span></label>
                <input type="text" name="direccion" value="{{ old('direccion', $registro->direccion ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Urbanización </label>
                <input type="text" name="urbanizacion" value="{{ old('urbanizacion', $registro->urbanizacion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Distrito </label>
                <input type="text" name="distrito" value="{{ old('distrito', $registro->distrito ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Provincia </label>
                <input type="text" name="provincia" value="{{ old('provincia', $registro->provincia ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Departamento </label>
                <input type="text" name="departamento" value="{{ old('departamento', $registro->departamento ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Código Postal </label>
                <input type="text" name="codigo_postal" value="{{ old('codigo_postal', $registro->codigo_postal ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Referencia</label>
                <textarea name="referencia" rows="2" class="form-control">{{ old('referencia', $registro->referencia ?? '') }}</textarea>
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
