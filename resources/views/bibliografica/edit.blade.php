@extends('layouts.app')
@section('title', 'Editar Producción Bibliográfica')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Editar Producción Bibliográfica</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Editar Producción Bibliográfica</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.produccion-bibliografica.update', [$persona, $registro]) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Libro" {{ old('tipo', $registro->tipo ?? '') == 'Libro' ? 'selected' : '' }}>Libro</option>
                    <option value="Texto Universitario" {{ old('tipo', $registro->tipo ?? '') == 'Texto Universitario' ? 'selected' : '' }}>Texto Universitario</option>
                    <option value="Material Didáctico" {{ old('tipo', $registro->tipo ?? '') == 'Material Didáctico' ? 'selected' : '' }}>Material Didáctico</option>
                    <option value="Guía de Laboratorio" {{ old('tipo', $registro->tipo ?? '') == 'Guía de Laboratorio' ? 'selected' : '' }}>Guía de Laboratorio</option>
                    <option value="Manual" {{ old('tipo', $registro->tipo ?? '') == 'Manual' ? 'selected' : '' }}>Manual</option>
                    <option value="Módulo de Enseñanza" {{ old('tipo', $registro->tipo ?? '') == 'Módulo de Enseñanza' ? 'selected' : '' }}>Módulo de Enseñanza</option>
                    <option value="Artículo de Divulgación" {{ old('tipo', $registro->tipo ?? '') == 'Artículo de Divulgación' ? 'selected' : '' }}>Artículo de Divulgación</option>
                    <option value="Otro" {{ old('tipo', $registro->tipo ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Título <span class="text-danger">*</span></label>
                <input type="text" name="titulo" value="{{ old('titulo', $registro->titulo ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Autores <span class="text-danger">*</span></label>
                <input type="text" name="autores" value="{{ old('autores', $registro->autores ?? '') }}" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Editorial </label>
                <input type="text" name="editorial" value="{{ old('editorial', $registro->editorial ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Lugar de Edición </label>
                <input type="text" name="lugar_edicion" value="{{ old('lugar_edicion', $registro->lugar_edicion ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Año</label>
                <input type="number" name="anio_publicacion" value="{{ old('anio_publicacion', $registro->anio_publicacion ?? '') }}" class="form-control" min="1900">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">ISBN </label>
                <input type="text" name="isbn" value="{{ old('isbn', $registro->isbn ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">N° Edición</label>
                <input type="number" name="numero_edicion" value="{{ old('numero_edicion', $registro->numero_edicion ?? '') }}" class="form-control" min="1">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">N° Páginas</label>
                <input type="number" name="numero_paginas" value="{{ old('numero_paginas', $registro->numero_paginas ?? '') }}" class="form-control" min="1">
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">URL </label>
                <input type="text" name="enlace_url" value="{{ old('enlace_url', $registro->enlace_url ?? '') }}" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción</label>
                <textarea name="descripcion" rows="2" class="form-control">{{ old('descripcion', $registro->descripcion ?? '') }}</textarea>
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
