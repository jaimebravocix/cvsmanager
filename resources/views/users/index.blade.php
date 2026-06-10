@extends('layouts.app')
@section('title', 'Usuarios')
@section('breadcrumb')
    <li class="breadcrumb-item active">Usuarios</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Gestión de Usuarios</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Nuevo Usuario</a>
</div>
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2">
            <div class="col-sm-5">
                <input type="text" name="buscar" value="{{ request('buscar') }}" class="form-control" placeholder="Buscar por nombre o email...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Buscar</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary ms-1">Limpiar</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr><th>Usuario</th><th>Email</th><th>Rol</th><th>Perfil CV</th><th>Estado</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                @forelse($users as $user)
                    <tr>
                        <td><div class="fw-medium">{{ $user->name }}</div></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->getRoleNames() as $role)
                                <span class="badge badge-role-{{ $role }}">{{ ucfirst($role) }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($user->persona)
                                <a href="{{ route('personas.show', $user->persona) }}" class="text-primary small">{{ $user->persona->nombre_completo }}</a>
                            @else
                                <span class="text-muted small">Sin perfil</span>
                            @endif
                        </td>
                        <td>
                            @if($user->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('¿Eliminar usuario?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-5">Sin usuarios</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer">{{ $users->links() }}</div>
    @endif
</div>
@endsection
