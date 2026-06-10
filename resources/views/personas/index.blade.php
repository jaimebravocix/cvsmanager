@extends('layouts.app')
@section('title', 'Personas')
@section('breadcrumb')
    <li class="breadcrumb-item active">Personas</li>
@endsection
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Personas / Docentes</h4>
    @role('administrador|supervisor')
    <a href="{{ route('personas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Registro
    </a>
    @endrole
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="buscar" value="{{ request('buscar') }}"
                       class="form-control" placeholder="Buscar por nombre, apellido o código...">
            </div>
            <div class="col-sm-3">
                <select name="tipo" class="form-select">
                    <option value="">Todos los tipos</option>
                    <option value="docente" {{ request('tipo')=='docente'?'selected':'' }}>Docente</option>
                    <option value="administrativo" {{ request('tipo')=='administrativo'?'selected':'' }}>Administrativo</option>
                    <option value="ambos" {{ request('tipo')=='ambos'?'selected':'' }}>Ambos</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Buscar</button>
                <a href="{{ route('personas.index') }}" class="btn btn-outline-secondary ms-1">Limpiar</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Persona</th>
                        <th>Código</th>
                        <th>Tipo</th>
                        <th>Contacto</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($personas as $persona)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                @if($persona->foto)
                                    <img src="{{ Storage::url($persona->foto) }}" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                                @else
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:36px;height:36px;font-size:.85rem;">
                                        {{ strtoupper(substr($persona->nombres,0,1)) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="fw-medium">{{ $persona->nombre_completo }}</div>
                                    <div class="text-muted" style="font-size:.76rem;">
                                        {{ $persona->documentos->where('principal',true)->first()->numero ?? ($persona->documentos->first()->numero ?? '-') }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $persona->codigo_personal ?? '-' }}</td>
                        <td><span class="badge bg-info text-dark">{{ ucfirst($persona->tipo_personal) }}</span></td>
                        <td>
                            <div style="font-size:.82rem;">{{ $persona->celular ?? $persona->telefono ?? '-' }}</div>
                        </td>
                        <td>
                            @if($persona->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('personas.show', $persona) }}" class="btn btn-outline-primary" title="Ver CV">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @role('administrador|supervisor')
                                <a href="{{ route('personas.edit', $persona) }}" class="btn btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="{{ route('personas.destroy', $persona) }}" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este registro?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </form>
                                @endrole
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                        No se encontraron registros
                    </td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($personas->hasPages())
    <div class="card-footer">{{ $personas->links() }}</div>
    @endif
</div>
@endsection
