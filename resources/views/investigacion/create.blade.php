@extends('layouts.app')
@section('title', 'Agregar Proyecto de Investigación')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Proyecto de Investigación</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Proyecto de Investigación</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.produccion-investigacion.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium">Título del Proyecto <span class="text-danger">*</span></label>
                <input type="text" name="titulo" value="{{ old('titulo', $registro->titulo ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Rol <span class="text-danger">*</span></label>
                <select name="rol" class="form-select">
                    <option value="Investigador Principal" {{ old('rol', $registro->rol ?? '') == 'Investigador Principal' ? 'selected' : '' }}>Investigador Principal</option>
                    <option value="Co-investigador" {{ old('rol', $registro->rol ?? '') == 'Co-investigador' ? 'selected' : '' }}>Co-investigador</option>
                    <option value="Asesor" {{ old('rol', $registro->rol ?? '') == 'Asesor' ? 'selected' : '' }}>Asesor</option>
                    <option value="Colaborador" {{ old('rol', $registro->rol ?? '') == 'Colaborador' ? 'selected' : '' }}>Colaborador</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Código de Proyecto </label>
                <input type="text" name="codigo_proyecto" value="{{ old('codigo_proyecto', $registro->codigo_proyecto ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Entidad Financiadora </label>
                <input type="text" name="entidad_financiadora" value="{{ old('entidad_financiadora', $registro->entidad_financiadora ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Ámbito </label>
                <select name="ambito" class="form-select">
                    <option value="Institucional" {{ old('ambito', $registro->ambito ?? '') == 'Institucional' ? 'selected' : '' }}>Institucional</option>
                    <option value="Nacional" {{ old('ambito', $registro->ambito ?? '') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                    <option value="Internacional" {{ old('ambito', $registro->ambito ?? '') == 'Internacional' ? 'selected' : '' }}>Internacional</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Monto Financiado </label>
                <input type="text" name="monto_financiado" value="{{ old('monto_financiado', $registro->monto_financiado ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Moneda </label>
                <select name="moneda" class="form-select">
                    <option value="PEN" {{ old('moneda', $registro->moneda ?? '') == 'PEN' ? 'selected' : '' }}>PEN</option>
                    <option value="USD" {{ old('moneda', $registro->moneda ?? '') == 'USD' ? 'selected' : '' }}>USD</option>
                    <option value="EUR" {{ old('moneda', $registro->moneda ?? '') == 'EUR' ? 'selected' : '' }}>EUR</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Inicio </label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($registro->fecha_inicio) ? $registro->fecha_inicio->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Fin </label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($registro->fecha_fin) ? $registro->fecha_fin->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Estado <span class="text-danger">*</span></label>
                <select name="estado" class="form-select">
                    <option value="En Ejecución" {{ old('estado', $registro->estado ?? '') == 'En Ejecución' ? 'selected' : '' }}>En Ejecución</option>
                    <option value="Concluido" {{ old('estado', $registro->estado ?? '') == 'Concluido' ? 'selected' : '' }}>Concluido</option>
                    <option value="Suspendido" {{ old('estado', $registro->estado ?? '') == 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                    <option value="En Formulación" {{ old('estado', $registro->estado ?? '') == 'En Formulación' ? 'selected' : '' }}>En Formulación</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Resolución de Aprobación </label>
                <input type="text" name="resolucion_aprobacion" value="{{ old('resolucion_aprobacion', $registro->resolucion_aprobacion ?? '') }}" class="form-control"  >
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
