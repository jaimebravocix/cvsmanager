@extends('layouts.app')
@section('title', 'Editar Congreso / Evento Académico')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Congreso / Evento Académico</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Congreso / Evento Académico</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.congresos.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label fw-medium">Nombre del Evento <span class="text-danger">*</span></label>
                <input type="text" name="nombre" value="{{ old('nombre', $registro->nombre ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Congreso" {{ old('tipo', $registro->tipo ?? '') == 'Congreso' ? 'selected' : '' }}>Congreso</option>
                    <option value="Simposio" {{ old('tipo', $registro->tipo ?? '') == 'Simposio' ? 'selected' : '' }}>Simposio</option>
                    <option value="Seminario" {{ old('tipo', $registro->tipo ?? '') == 'Seminario' ? 'selected' : '' }}>Seminario</option>
                    <option value="Taller" {{ old('tipo', $registro->tipo ?? '') == 'Taller' ? 'selected' : '' }}>Taller</option>
                    <option value="Coloquio" {{ old('tipo', $registro->tipo ?? '') == 'Coloquio' ? 'selected' : '' }}>Coloquio</option>
                    <option value="Conferencia" {{ old('tipo', $registro->tipo ?? '') == 'Conferencia' ? 'selected' : '' }}>Conferencia</option>
                    <option value="Foro" {{ old('tipo', $registro->tipo ?? '') == 'Foro' ? 'selected' : '' }}>Foro</option>
                    <option value="Jornada" {{ old('tipo', $registro->tipo ?? '') == 'Jornada' ? 'selected' : '' }}>Jornada</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Ámbito <span class="text-danger">*</span></label>
                <select name="ambito" class="form-select">
                    <option value="Local" {{ old('ambito', $registro->ambito ?? '') == 'Local' ? 'selected' : '' }}>Local</option>
                    <option value="Nacional" {{ old('ambito', $registro->ambito ?? '') == 'Nacional' ? 'selected' : '' }}>Nacional</option>
                    <option value="Internacional" {{ old('ambito', $registro->ambito ?? '') == 'Internacional' ? 'selected' : '' }}>Internacional</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Rol <span class="text-danger">*</span></label>
                <select name="rol_participacion" class="form-select">
                    <option value="Asistente" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Asistente' ? 'selected' : '' }}>Asistente</option>
                    <option value="Ponente" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Ponente' ? 'selected' : '' }}>Ponente</option>
                    <option value="Conferencista" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Conferencista' ? 'selected' : '' }}>Conferencista</option>
                    <option value="Organizador" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Organizador' ? 'selected' : '' }}>Organizador</option>
                    <option value="Moderador" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Moderador' ? 'selected' : '' }}>Moderador</option>
                    <option value="Otro" {{ old('rol_participacion', $registro->rol_participacion ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Inicio <span class="text-danger">*</span></label>
                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', isset($registro->fecha_inicio) ? $registro->fecha_inicio->format('Y-m-d') : '') }}" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Fin </label>
                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', isset($registro->fecha_fin) ? $registro->fecha_fin->format('Y-m-d') : '') }}" class="form-control" >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">N° Horas</label>
                <input type="number" name="numero_horas" value="{{ old('numero_horas', $registro->numero_horas ?? '') }}" class="form-control" min="1">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Certificado </label>
                <input type="text" name="numero_certificado" value="{{ old('numero_certificado', $registro->numero_certificado ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Ciudad </label>
                <input type="text" name="ciudad" value="{{ old('ciudad', $registro->ciudad ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="{{ old('pais', $registro->pais ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución Organizadora </label>
                <input type="text" name="institucion_organizadora" value="{{ old('institucion_organizadora', $registro->institucion_organizadora ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Título Ponencia </label>
                <input type="text" name="titulo_ponencia" value="{{ old('titulo_ponencia', $registro->titulo_ponencia ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Temática</label>
                <textarea name="tematica" rows="2" class="form-control">{{ old('tematica', $registro->tematica ?? '') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Certificado</label>
                @if(isset($registro) && $registro->archivo_certificado)
                    <div class="mb-1"><a href="{{ Storage::url($registro->archivo_certificado) }}" target="_blank" class="text-primary small"><i class="bi bi-file-earmark me-1"></i>Ver archivo actual</a></div>
                @endif
                <input type="file" name="archivo_certificado" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
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
