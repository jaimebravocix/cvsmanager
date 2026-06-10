@extends('layouts.app')
@section('title', 'Agregar Producción Científica')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item"><a href="{{ route('personas.show', $persona) }}">{{ $persona->nombre_completo }}</a></li>
    <li class="breadcrumb-item active">Agregar Producción Científica</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Producción Científica</div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.produccion-cientifica.store', $persona) }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Tipo <span class="text-danger">*</span></label>
                <select name="tipo" class="form-select">
                    <option value="Artículo Científico" {{ old('tipo', $registro->tipo ?? '') == 'Artículo Científico' ? 'selected' : '' }}>Artículo Científico</option>
                    <option value="Artículo de Revisión" {{ old('tipo', $registro->tipo ?? '') == 'Artículo de Revisión' ? 'selected' : '' }}>Artículo de Revisión</option>
                    <option value="Libro" {{ old('tipo', $registro->tipo ?? '') == 'Libro' ? 'selected' : '' }}>Libro</option>
                    <option value="Capítulo de Libro" {{ old('tipo', $registro->tipo ?? '') == 'Capítulo de Libro' ? 'selected' : '' }}>Capítulo de Libro</option>
                    <option value="Ponencia en Congreso" {{ old('tipo', $registro->tipo ?? '') == 'Ponencia en Congreso' ? 'selected' : '' }}>Ponencia en Congreso</option>
                    <option value="Patente" {{ old('tipo', $registro->tipo ?? '') == 'Patente' ? 'selected' : '' }}>Patente</option>
                    <option value="Reporte Técnico" {{ old('tipo', $registro->tipo ?? '') == 'Reporte Técnico' ? 'selected' : '' }}>Reporte Técnico</option>
                    <option value="Tesis Asesorada" {{ old('tipo', $registro->tipo ?? '') == 'Tesis Asesorada' ? 'selected' : '' }}>Tesis Asesorada</option>
                    <option value="Software" {{ old('tipo', $registro->tipo ?? '') == 'Software' ? 'selected' : '' }}>Software</option>
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
            <div class="col-md-8">
                <label class="form-label fw-medium">Revista / Editorial </label>
                <input type="text" name="revista_editorial" value="{{ old('revista_editorial', $registro->revista_editorial ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-2">
                <label class="form-label fw-medium">Volumen </label>
                <input type="text" name="volumen" value="{{ old('volumen', $registro->volumen ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-2">
                <label class="form-label fw-medium">Número </label>
                <input type="text" name="numero" value="{{ old('numero', $registro->numero ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Páginas </label>
                <input type="text" name="paginas" value="{{ old('paginas', $registro->paginas ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-5">
                <label class="form-label fw-medium">DOI </label>
                <input type="text" name="doi" value="{{ old('doi', $registro->doi ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">ISSN / ISBN </label>
                <input type="text" name="issn_isbn" value="{{ old('issn_isbn', $registro->issn_isbn ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Año Publicación</label>
                <input type="number" name="anio_publicacion" value="{{ old('anio_publicacion', $registro->anio_publicacion ?? '') }}" class="form-control" min="1900">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Indexación </label>
                <select name="indexacion" class="form-select">
                    <option value="Scopus" {{ old('indexacion', $registro->indexacion ?? '') == 'Scopus' ? 'selected' : '' }}>Scopus</option>
                    <option value="Web of Science" {{ old('indexacion', $registro->indexacion ?? '') == 'Web of Science' ? 'selected' : '' }}>Web of Science</option>
                    <option value="PubMed" {{ old('indexacion', $registro->indexacion ?? '') == 'PubMed' ? 'selected' : '' }}>PubMed</option>
                    <option value="Latindex" {{ old('indexacion', $registro->indexacion ?? '') == 'Latindex' ? 'selected' : '' }}>Latindex</option>
                    <option value="SciELO" {{ old('indexacion', $registro->indexacion ?? '') == 'SciELO' ? 'selected' : '' }}>SciELO</option>
                    <option value="Redalyc" {{ old('indexacion', $registro->indexacion ?? '') == 'Redalyc' ? 'selected' : '' }}>Redalyc</option>
                    <option value="Sin indexar" {{ old('indexacion', $registro->indexacion ?? '') == 'Sin indexar' ? 'selected' : '' }}>Sin indexar</option>
                    <option value="Otro" {{ old('indexacion', $registro->indexacion ?? '') == 'Otro' ? 'selected' : '' }}>Otro</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label fw-medium">Cuartil </label>
                <input type="text" name="cuartil" value="{{ old('cuartil', $registro->cuartil ?? '') }}" class="form-control"  >
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">URL del artículo </label>
                <input type="text" name="enlace_url" value="{{ old('enlace_url', $registro->enlace_url ?? '') }}" class="form-control"  >
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
