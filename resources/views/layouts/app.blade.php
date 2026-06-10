<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CV Docente') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 270px;
            --primary: #1a3c6e;
            --primary-light: #2557a7;
            --accent: #e8b84b;
            --sidebar-bg: #0f2547;
        }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; }
        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 1000;
            transition: transform .3s;
            overflow-y: auto;
        }
        #sidebar .brand {
            padding: 1.2rem 1.5rem;
            background: rgba(0,0,0,.2);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        #sidebar .brand h5 { color: var(--accent); font-weight: 700; font-size: .95rem; margin: 0; }
        #sidebar .brand small { color: rgba(255,255,255,.5); font-size: .75rem; }
        #sidebar .nav-link {
            color: rgba(255,255,255,.72);
            padding: .5rem 1.5rem;
            font-size: .83rem;
            display: flex; align-items: center; gap: .55rem;
            border-radius: 0; transition: all .2s;
        }
        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: #fff; background: rgba(255,255,255,.1);
            border-left: 3px solid var(--accent);
            padding-left: calc(1.5rem - 3px);
        }
        #sidebar .nav-section {
            font-size: .68rem; font-weight: 600; letter-spacing: .08em;
            color: rgba(255,255,255,.35); text-transform: uppercase;
            padding: 1rem 1.5rem .3rem;
        }
        #sidebar .nav-link i { font-size: 1rem; width: 20px; }
        /* Main content */
        #main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar {
            background: #fff;
            padding: .75rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            position: sticky; top: 0; z-index: 999;
        }
        .content-area { padding: 1.75rem; }
        .card { border: none; box-shadow: 0 1px 4px rgba(0,0,0,.06); border-radius: .75rem; }
        .card-header {
            background: #fff; border-bottom: 1px solid #f0f4f8;
            font-weight: 600; border-radius: .75rem .75rem 0 0 !important;
        }
        .btn-primary { background: var(--primary-light); border-color: var(--primary-light); }
        .btn-primary:hover { background: var(--primary); border-color: var(--primary); }
        .stat-card { border-radius: .75rem; padding: 1.25rem; color: #fff; }
        .table thead th { background: #f8fafc; font-size: .8rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .04em; border: none; }
        .table td { vertical-align: middle; font-size: .88rem; }
        .badge-role-administrador { background: #dc2626; }
        .badge-role-supervisor { background: #d97706; }
        .badge-role-docente { background: #1d4ed8; }
        .badge-role-administrativo { background: #059669; }
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
<!-- Sidebar -->
<nav id="sidebar">
    <div class="brand">
        <h5><i class="bi bi-mortarboard-fill me-2"></i>CV Universitario</h5>
        <small>{{ config('app.name') }}</small>
    </div>
    <ul class="nav flex-column py-2">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>

        <div class="nav-section">Personal</div>
        <li class="nav-item">
            <a href="{{ route('personas.index') }}" class="nav-link {{ request()->routeIs('personas.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Personas / Docentes
            </a>
        </li>

        @role('administrador')
        <div class="nav-section">Administración</div>
        <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <i class="bi bi-person-gear"></i> Usuarios
            </a>
        </li>
        @endrole

        <div class="nav-section">Mi Perfil</div>
        @auth
        @if(auth()->user()->persona)
        <li class="nav-item">
            <a href="{{ route('personas.show', auth()->user()->persona) }}" class="nav-link">
                <i class="bi bi-person-badge"></i> Ver Mi CV
            </a>
        </li>
        @endif
        @endauth
    </ul>
    <div class="p-3 mt-auto" style="border-top:1px solid rgba(255,255,255,.08)">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center" style="width:34px;height:34px;font-size:.85rem;color:#fff;">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <div>
                <div style="color:#fff;font-size:.82rem;font-weight:500;">{{ auth()->user()->name }}</div>
                <div style="color:rgba(255,255,255,.4);font-size:.72rem;">
                    @foreach(auth()->user()->getRoleNames() as $role)
                        {{ ucfirst($role) }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Main -->
<div id="main-content">
    <div class="topbar d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list"></i>
            </button>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    @yield('breadcrumb')
                </ol>
            </nav>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center gap-2">
            @csrf
            <span class="text-muted small d-none d-md-inline">{{ auth()->user()->email }}</span>
            <button type="submit" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-box-arrow-right"></i> Salir
            </button>
        </form>
    </div>

    <div class="content-area">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
