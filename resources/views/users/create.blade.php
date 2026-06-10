@extends('layouts.app')
@section('title', 'Nuevo Usuario')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
@endsection
@section('content')
<div class="row justify-content-center">
<div class="col-xl-8">
<div class="card">
    <div class="card-header py-3"><i class="bi bi-person-plus me-2"></i>Crear Usuario</div>
    <div class="card-body">
    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-medium">Nombre completo <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Rol <span class="text-danger">*</span></label>
                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
                @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Contraseña <span class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="col-12 d-flex align-items-center gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1"
                           {{ old('activo', '1') ? 'checked' : '' }}>
                    <label class="form-check-label fw-medium" for="activo">Usuario activo</label>
                </div>
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Crear Usuario</button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
@endsection
