@extends('layouts.app')
@section('title', 'Agregar Antecedente')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Antecedente</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Antecedente</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.antecedentes.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Penal" {{ old('tipo', $registro->tipo ?? '') == 'Penal' ? 'selected' : '' }}>Penal</option>
                    <option value="Judicial" {{ old('tipo', $registro->tipo ?? '') == 'Judicial' ? 'selected' : '' }}>Judicial</option>
                    <option value="Policial" {{ old('tipo', $registro->tipo ?? '') == 'Policial' ? 'selected' : '' }}>Policial</option>
                    <option value="REDAM" {{ old('tipo', $registro->tipo ?? '') == 'REDAM' ? 'selected' : '' }}>REDAM</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Resultado <span class="text-danger">*</span></label>
                <select name="resultado" class="form-select">
                    <option value="Sin antecedentes" {{ old('resultado', $registro->resultado ?? '') == 'Sin antecedentes' ? 'selected' : '' }}>Sin antecedentes</option>
                    <option value="Con antecedentes" {{ old('resultado', $registro->resultado ?? '') == 'Con antecedentes' ? 'selected' : '' }}>Con antecedentes</option>
                    <option value="No aplica" {{ old('resultado', $registro->resultado ?? '') == 'No aplica' ? 'selected' : '' }}>No aplica</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Entidad Emisora </label>
                <input type="text" name="entidad" value="{{ old('entidad', $registro->entidad ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Emisión <span class="text-danger">*</span></label>
                <input type="date" name="fecha_emision" value="{{ old('fecha_emision', isset($registro->fecha_emision) ? $registro->fecha_emision->format('Y-m-d') : '') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Vencimiento </label>
                <input type="date" name="fecha_vencimiento" value="{{ old('fecha_vencimiento', isset($registro->fecha_vencimiento) ? $registro->fecha_vencimiento->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Certificado </label>
                <input type="text" name="numero_certificado" value="{{ old('numero_certificado', $registro->numero_certificado ?? '') }}" class="form-control"  >
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
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
            <a href="{{ route('personas.show', $persona) }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
