@extends('layouts.app')
@section('title', 'Editar Persona')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">
        <i class="bi bi-pencil-square me-2"></i>Editar: {{ $persona->nombre_completo }}
    </div>
    <div class="card-body">
    <form method="POST" action="{{ route('personas.update', $persona) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Paterno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $persona->apellido_paterno) }}"
                       class="form-control @error('apellido_paterno') is-invalid @enderror" required>
                @error('apellido_paterno')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Materno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $persona->apellido_materno) }}"
                       class="form-control @error('apellido_materno') is-invalid @enderror" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Nombres <span class="text-danger">*</span></label>
                <input type="text" name="nombres" value="{{ old('nombres', $persona->nombres) }}"
                       class="form-control @error('nombres') is-invalid @enderror" required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Sexo</label>
                <select name="sexo" class="form-select">
                    <option value="">-- Seleccione --</option>
                    <option value="M" {{ old('sexo',$persona->sexo)=='M'?'selected':'' }}>Masculino</option>
                    <option value="F" {{ old('sexo',$persona->sexo)=='F'?'selected':'' }}>Femenino</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $persona->fecha_nacimiento?->format('Y-m-d')) }}" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Estado Civil</label>
                <select name="estado_civil" class="form-select">
                    <option value="">-- Seleccione --</option>
                    @foreach(['soltero'=>'Soltero','casado'=>'Casado','divorciado'=>'Divorciado','viudo'=>'Viudo','conviviente'=>'Conviviente','otro'=>'Otro'] as $k=>$v)
                        <option value="{{ $k }}" {{ old('estado_civil',$persona->estado_civil)==$k?'selected':'' }}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Tipo Personal <span class="text-danger">*</span></label>
                <select name="tipo_personal" class="form-select" required>
                    <option value="docente" {{ old('tipo_personal',$persona->tipo_personal)=='docente'?'selected':'' }}>Docente</option>
                    <option value="administrativo" {{ old('tipo_personal',$persona->tipo_personal)=='administrativo'?'selected':'' }}>Administrativo</option>
                    <option value="ambos" {{ old('tipo_personal',$persona->tipo_personal)=='ambos'?'selected':'' }}>Ambos</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Lugar de Nacimiento</label>
                <input type="text" name="lugar_nacimiento" value="{{ old('lugar_nacimiento',$persona->lugar_nacimiento) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">País de Nacimiento</label>
                <input type="text" name="pais_nacimiento" value="{{ old('pais_nacimiento',$persona->pais_nacimiento) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Código Personal</label>
                <input type="text" name="codigo_personal" value="{{ old('codigo_personal',$persona->codigo_personal) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Teléfono</label>
                <input type="text" name="telefono" value="{{ old('telefono',$persona->telefono) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Celular</label>
                <input type="text" name="celular" value="{{ old('celular',$persona->celular) }}" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Vincular Usuario</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Sin usuario --</option>
                    @foreach($usuarios_sin_persona as $u)
                        <option value="{{ $u->id }}" {{ old('user_id',$persona->user_id)==$u->id?'selected':'' }}>{{ $u->name }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Resumen Profesional</label>
                <textarea name="resumen_profesional" rows="3" class="form-control">{{ old('resumen_profesional',$persona->resumen_profesional) }}</textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Foto</label>
                @if($persona->foto)
                    <div class="mb-2">
                        <img src="{{ Storage::url($persona->foto) }}" style="height:60px;border-radius:.5rem;">
                    </div>
                @endif
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1"
                           {{ old('activo',$persona->activo) ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="activo">Persona activa</label>
                </div>
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
