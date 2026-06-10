@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection
@section('content')
<h4 class="fw-bold mb-1">Dashboard</h4>
<p class="text-muted small mb-4">Bienvenido, {{ auth()->user()->name }}
    @foreach(auth()->user()->getRoleNames() as $role)
        <span class="badge badge-role-{{ $role }} ms-1" style="font-size:.7rem;">{{ ucfirst($role) }}</span>
    @endforeach
</p>

@role('administrador|supervisor')
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#1d4ed8,#3b82f6)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="opacity-75 small mb-1">Total Docentes</div>
                    <h2 class="fw-bold mb-0">{{ $stats['total_docentes'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-mortarboard-fill" style="font-size:2rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#059669,#10b981)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="opacity-75 small mb-1">Administrativos</div>
                    <h2 class="fw-bold mb-0">{{ $stats['total_administrativos'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-briefcase-fill" style="font-size:2rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#d97706,#f59e0b)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="opacity-75 small mb-1">Usuarios Activos</div>
                    <h2 class="fw-bold mb-0">{{ $stats['total_usuarios'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-people-fill" style="font-size:2rem;opacity:.4"></i>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card" style="background:linear-gradient(135deg,#7c3aed,#a78bfa)">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="opacity-75 small mb-1">Docentes Activos</div>
                    <h2 class="fw-bold mb-0">{{ $stats['docentes_activos'] ?? 0 }}</h2>
                </div>
                <i class="bi bi-person-check-fill" style="font-size:2rem;opacity:.4"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <span><i class="bi bi-clock-history me-2"></i>Últimos Registros</span>
        <a href="{{ route('personas.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr><th>Nombre</th><th>Tipo</th><th>Código</th><th>Estado</th><th>Acciones</th></tr>
                </thead>
                <tbody>
                @forelse($ultimas_personas as $p)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:.8rem;">
                                    {{ strtoupper(substr($p->nombres,0,1)) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $p->nombre_completo }}</div>
                                    <div class="text-muted" style="font-size:.78rem;">{{ $p->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td><span class="badge bg-secondary">{{ ucfirst($p->tipo_personal) }}</span></td>
                        <td>{{ $p->codigo_personal ?? '-' }}</td>
                        <td>
                            @if($p->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('personas.show', $p) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Sin registros recientes</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
    {{-- Vista para docente/administrativo --}}
    @if(auth()->user()->persona)
    <div class="alert alert-info d-flex align-items-center gap-2">
        <i class="bi bi-info-circle-fill fs-5"></i>
        <span>Bienvenido a su portal de CV. Use el menú lateral para gestionar su información.</span>
    </div>
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-person-badge" style="font-size:3rem;color:#1d4ed8"></i>
            <h5 class="mt-3">{{ auth()->user()->persona->nombre_completo }}</h5>
            <p class="text-muted">{{ ucfirst(auth()->user()->persona->tipo_personal) }}</p>
            <a href="{{ route('personas.show', auth()->user()->persona) }}" class="btn btn-primary">
                <i class="bi bi-eye me-1"></i> Ver Mi CV Completo
            </a>
        </div>
    </div>
    @else
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Su cuenta no tiene un perfil asociado. Contacte al administrador.
    </div>
    @endif
@endrole
@endsection
