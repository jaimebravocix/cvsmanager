@extends('layouts.app')
@section('title', 'Nueva Persona')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item active">Nueva</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">
        <i class="bi bi-person-plus-fill me-2"></i>Registrar Nueva Persona
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Paterno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                       class="form-control @error('apellido_paterno') is-invalid @enderror" required>
                @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Materno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                       class="form-control @error('apellido_materno') is-invalid @enderror" required>
                @error('apellido_materno')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Nombres <span class="text-danger">*</span></label>
                <input type="text" name="nombres" value="{{ old('nombres') }}"
                       class="form-control @error('nombres') is-invalid @enderror" required>
                @error('nombres')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Sexo</label>
                <select name="sexo" class="form-select">
                    <option value="">-- Seleccione --</option>
                    <option value="M" {{ old('sexo')=='M'?'selected':'' }}>Masculino</option>
                    <option value="F" {{ old('sexo')=='F'?'selected':'' }}>Femenino</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Estado Civil</label>
                <select name="estado_civil" class="form-select">
                    <option value="">-- Seleccione --</option>
                    @foreach(['soltero'=>'Soltero','casado'=>'Casado','divorciado'=>'Divorciado','viudo'=>'Viudo','conviviente'=>'Conviviente','otro'=>'Otro'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('estado_civil')==$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Tipo Personal <span class="text-danger">*</span></label>
                <select name="tipo_personal" class="form-select" required>
                    <option value="docente" {{ old('tipo_personal','docente')=='docente'?'selected':'' }}>Docente</option>
                    <option value="administrativo" {{ old('tipo_personal')=='administrativo'?'selected':'' }}>Administrativo</option>
                    <option value="ambos" {{ old('tipo_personal')=='ambos'?'selected':'' }}>Ambos</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Lugar de Nacimiento</label>
                <input type="text" name="lugar_nacimiento" value="{{ old('lugar_nacimiento') }}" class="form-control" placeholder="Ciudad, Departamento">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">País de Nacimiento</label>
                <input type="text" name="pais_nacimiento" value="{{ old('pais_nacimiento','Perú') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Código Personal</label>
                <input type="text" name="codigo_personal" value="{{ old('codigo_personal') }}" class="form-control" placeholder="Ej: DOC-001">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Celular</label>
                <input type="text" name="celular" value="{{ old('celular') }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Vincular Usuario</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Sin usuario --</option>
                    @foreach($usuarios_sin_persona as $u)
                        <option value="{{ $u->id }}" {{ old('user_id')==$u->id?'selected':'' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Resumen Profesional</label>
                <textarea name="resumen_profesional" rows="3" class="form-control" placeholder="Breve descripción profesional...">{{ old('resumen_profesional') }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
            <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
