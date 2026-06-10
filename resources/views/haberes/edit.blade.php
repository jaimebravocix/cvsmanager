@extends('layouts.app')
@section('title', 'Editar Cuenta de Haberes')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Cuenta de Haberes</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Cuenta de Haberes</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.haberes.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Banco <span class="text-danger">*</span></label>
                <input type="text" name="banco" value="{{ old('banco', $registro->banco ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Cuenta <span class="text-danger">*</span></label>
                <input type="text" name="numero_cuenta" value="{{ old('numero_cuenta', $registro->numero_cuenta ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo Cuenta </label>
                <select name="tipo_cuenta" class="form-select">
                    <option value="corriente" {{ old('tipo_cuenta', $registro->tipo_cuenta ?? '') == 'corriente' ? 'selected' : '' }}>corriente</option>
                    <option value="ahorros" {{ old('tipo_cuenta', $registro->tipo_cuenta ?? '') == 'ahorros' ? 'selected' : '' }}>ahorros</option>
                    <option value="otro" {{ old('tipo_cuenta', $registro->tipo_cuenta ?? '') == 'otro' ? 'selected' : '' }}>otro</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">CCI (20 dígitos) </label>
                <input type="text" name="cci" value="{{ old('cci', $registro->cci ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Moneda </label>
                <select name="moneda" class="form-select">
                    <option value="PEN" {{ old('moneda', $registro->moneda ?? '') == 'PEN' ? 'selected' : '' }}>PEN</option>
                    <option value="USD" {{ old('moneda', $registro->moneda ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="EUR" {{ old('moneda', $registro->moneda ?? '') == 'EUR' ? 'selected' : '' }}>EUR</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Observaciones</label>
                <textarea name="observaciones" rows="2" class="form-control">{{ old('observaciones', $registro->observaciones ?? '') }}</textarea>
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
