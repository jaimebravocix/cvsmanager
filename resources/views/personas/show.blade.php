@extends('layouts.app')
@section('title', 'CV - '.$persona->nombre_completo)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personas</a></li>
    <li class="breadcrumb-item active">{{ $persona->nombre_completo }}</li>
@endsection
@push('styles')
<style>
    .cv-section-card { margin-bottom: 1.25rem; }
    .cv-section-card .card-header { background: #f8fafc; font-size: .875rem; }
    .cv-item { padding: .75rem 0; border-bottom: 1px solid #f0f4f8; }
    .cv-item:last-child { border-bottom: none; }
    .cv-item-title { font-weight: 600; font-size: .9rem; }
    .cv-item-sub { color: #64748b; font-size: .8rem; }
    .tab-content { padding: 1rem 0 0; }
    .nav-tabs .nav-link { font-size: .82rem; font-weight: 500; color: #64748b; }
    .nav-tabs .nav-link.active { color: #1d4ed8; border-bottom: 2px solid #1d4ed8; }
</style>
@endpush
@section('content')
<div class="row">
    {{-- Header --}}
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    @if($persona->foto)
                        <img src="{{ Storage::url($persona->foto) }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #e2e8f0;">
                    @else
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:80px;height:80px;font-size:1.8rem;">
                            {{ strtoupper(substr($persona->nombres,0,1)) }}
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <h4 class="fw-bold mb-1">{{ $persona->nombre_completo }}</h4>
                        <div class="d-flex flex-wrap gap-2 mb-1">
                            <span class="badge bg-primary">{{ ucfirst($persona->tipo_personal) }}</span>
                            @if($persona->codigo_personal)
                                <span class="badge bg-secondary">{{ $persona->codigo_personal }}</span>
                            @endif
                            @if($persona->activo)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </div>
                        @if($persona->resumen_profesional)
                            <p class="text-muted small mb-0">{{ Str::limit($persona->resumen_profesional, 200) }}</p>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('personas.edit', $persona) }}" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i>Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabs de navegación --}}
<ul class="nav nav-tabs mb-3" id="cvTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Datos Personales</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#formacion">Formación Académica</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#experiencia">Experiencia</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#produccion">Producción</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#congresos">Congresos</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#otros">Otros</a></li>
</ul>

<div class="tab-content" id="cvTabsContent">

{{-- === TAB 1: DATOS PERSONALES === --}}
<div class="tab-pane fade show active" id="personal">
    <div class="row g-3">
        {{-- Info general --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between">
                    <span><i class="bi bi-person me-2"></i>Datos Generales</span>
                </div>
                <div class="card-body">
                    @include('partials.dato-fila', ['label'=>'Sexo','valor'=>$persona->sexo=='M'?'Masculino':($persona->sexo=='F'?'Femenino':'-')])
                    @include('partials.dato-fila', ['label'=>'Fecha Nac.','valor'=>$persona->fecha_nacimiento?->format('d/m/Y')])
                    @include('partials.dato-fila', ['label'=>'Lugar Nac.','valor'=>$persona->lugar_nacimiento.', '.$persona->pais_nacimiento])
                    @include('partials.dato-fila', ['label'=>'Estado Civil','valor'=>ucfirst($persona->estado_civil ?? '-')])
                    @include('partials.dato-fila', ['label'=>'Teléfono','valor'=>$persona->telefono])
                    @include('partials.dato-fila', ['label'=>'Celular','valor'=>$persona->celular])
                </div>
            </div>
        </div>

        {{-- Documentos --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-card-text me-2"></i>Documentos de Identidad</span>
                    <a href="{{ route('personas.documentos.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->documentos as $doc)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $doc->tipo }}: {{ $doc->numero }}</div>
                            <div class="cv-item-sub">{{ $doc->pais_emision }} @if($doc->fecha_vencimiento) · Vence: {{ $doc->fecha_vencimiento->format('d/m/Y') }} @endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.documentos.edit', [$persona, $doc]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.documentos.destroy', [$persona, $doc]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin documentos registrados</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Emails --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-envelope me-2"></i>Correos Electrónicos</span>
                    <a href="{{ route('personas.emails.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->emails as $email)
                    <div class="cv-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="cv-item-title">{{ $email->email }}</div>
                            <div class="cv-item-sub">{{ ucfirst($email->tipo) }} @if($email->principal)<span class="badge bg-success ms-1" style="font-size:.65rem;">Principal</span>@endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.emails.edit', [$persona, $email]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.emails.destroy', [$persona, $email]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin emails registrados</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Direcciones --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-house me-2"></i>Direcciones</span>
                    <a href="{{ route('personas.direcciones.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->direcciones as $dir)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $dir->direccion }}</div>
                            <div class="cv-item-sub">{{ $dir->distrito }}, {{ $dir->provincia }}, {{ $dir->departamento }} · {{ ucfirst($dir->tipo) }}</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.direcciones.edit', [$persona, $dir]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.direcciones.destroy', [$persona, $dir]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin direcciones registradas</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Régimen Pensionario --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-shield-check me-2"></i>Régimen Pensionario</span>
                    <a href="{{ route('personas.regimen.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->regimenesP as $r)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $r->tipo }}{{ $r->nombre_afp ? ' - '.$r->nombre_afp : '' }}</div>
                            <div class="cv-item-sub">CUSPP: {{ $r->numero_cuspp ?? '-' }} @if($r->fecha_afiliacion)· {{ $r->fecha_afiliacion->format('d/m/Y') }}@endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.regimen.edit', [$persona, $r]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.regimen.destroy', [$persona, $r]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin régimen registrado</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Cuentas de Haberes --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-bank me-2"></i>Cuentas de Haberes</span>
                    <a href="{{ route('personas.haberes.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->cuentasHaberes as $c)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $c->banco }} - {{ $c->numero_cuenta }}</div>
                            <div class="cv-item-sub">{{ ucfirst($c->tipo_cuenta) }} · {{ $c->moneda }} @if($c->cci)· CCI: {{ $c->cci }}@endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.haberes.edit', [$persona, $c]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.haberes.destroy', [$persona, $c]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin cuentas registradas</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Salud --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-heart-pulse me-2"></i>Documentos de Salud</span>
                    <a href="{{ route('personas.salud.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->documentosSalud as $s)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $s->tipo }}</div>
                            <div class="cv-item-sub">{{ $s->descripcion }} @if($s->fecha_emision)· {{ $s->fecha_emision->format('d/m/Y') }}@endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.salud.edit', [$persona, $s]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.salud.destroy', [$persona, $s]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin documentos de salud</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Antecedentes --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-file-earmark-text me-2"></i>Antecedentes</span>
                    <a href="{{ route('personas.antecedentes.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->antecedentes as $ant)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $ant->tipo }}
                                <span class="badge {{ $ant->resultado=='Sin antecedentes'?'bg-success':'bg-danger' }} ms-1" style="font-size:.65rem;">{{ $ant->resultado }}</span>
                            </div>
                            <div class="cv-item-sub">{{ $ant->entidad }} · {{ $ant->fecha_emision->format('d/m/Y') }}</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.antecedentes.edit', [$persona, $ant]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.antecedentes.destroy', [$persona, $ant]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin antecedentes registrados</p>@endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- === TAB 2: FORMACIÓN ACADÉMICA === --}}
<div class="tab-pane fade" id="formacion">
    <div class="row g-3">
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-mortarboard me-2"></i>Formación Académica</span>
                    <a href="{{ route('personas.formacion.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead><tr><th>Nivel</th><th>Especialidad / Mención</th><th>Institución</th><th>País</th><th>Año</th><th>Registro SUNEDU</th><th></th></tr></thead>
                        <tbody>
                        @forelse($persona->formacionAcademica->sortByDesc('anio_fin') as $fa)
                        <tr>
                            <td><span class="badge bg-info text-dark">{{ $fa->nivel }}</span></td>
                            <td>
                                <div class="fw-medium">{{ $fa->especialidad }}</div>
                                @if($fa->mencion)<div class="text-muted small">Mención: {{ $fa->mencion }}</div>@endif
                            </td>
                            <td>{{ $fa->institucion }}</td>
                            <td>{{ $fa->pais }}</td>
                            <td>{{ $fa->anio_fin ?? $fa->anio_inicio }}</td>
                            <td>{{ $fa->numero_registro_sunedu ?? '-' }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('personas.formacion.edit', [$persona, $fa]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('personas.formacion.destroy', [$persona, $fa]) }}" onsubmit="return confirm('¿Eliminar?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">Sin formación académica registrada</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Idiomas --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-translate me-2"></i>Certificaciones de Idiomas</span>
                    <a href="{{ route('personas.idiomas.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->certificacionesIdioma as $id)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $id->idioma }}</div>
                            <div class="cv-item-sub">Comprensión: {{ $id->nivel_comprension ?? '-' }} | Escritura: {{ $id->nivel_escritura ?? '-' }} | Habla: {{ $id->nivel_habla ?? '-' }}</div>
                            @if($id->examen_certificacion)<div class="cv-item-sub">{{ $id->examen_certificacion }} {{ $id->puntaje ? '- '.$id->puntaje : '' }}</div>@endif
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.idiomas.edit', [$persona, $id]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.idiomas.destroy', [$persona, $id]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin certificaciones de idiomas</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Registros Institucionales --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-patch-check me-2"></i>Registros Institucionales</span>
                    <a href="{{ route('personas.registros.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->registrosInstitucionales as $ri)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $ri->institucion }}
                                @if($ri->vigente)<span class="badge bg-success ms-1" style="font-size:.65rem;">Vigente</span>@endif
                            </div>
                            <div class="cv-item-sub">N° {{ $ri->numero_registro ?? '-' }} @if($ri->categoria)· {{ $ri->categoria }}@endif</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.registros.edit', [$persona, $ri]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.registros.destroy', [$persona, $ri]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin registros institucionales</p>@endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- === TAB 3: EXPERIENCIA === --}}
<div class="tab-pane fade" id="experiencia">
    <div class="col-12 mb-3">
        <div class="card cv-section-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book me-2"></i>Experiencia Docente</span>
                <a href="{{ route('personas.experiencia-docente.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Categoría / Régimen</th><th>Curso/Asignatura</th><th>Período</th><th>Hrs/sem</th><th></th></tr></thead>
                    <tbody>
                    @forelse($persona->experienciaDocente->sortByDesc('fecha_inicio') as $ed)
                    <tr>
                        <td>
                            <div class="fw-medium">{{ $ed->institucion }}</div>
                            @if($ed->facultad)<div class="text-muted small">{{ $ed->facultad }}</div>@endif
                        </td>
                        <td>
                            @if($ed->categoria)<span class="badge bg-secondary">{{ $ed->categoria }}</span>@endif
                            @if($ed->regimen)<div class="text-muted small">{{ $ed->regimen }}</div>@endif
                        </td>
                        <td>{{ $ed->curso_asignatura ?? '-' }}</td>
                        <td>
                            {{ $ed->fecha_inicio->format('d/m/Y') }} -
                            {{ $ed->trabajo_actual ? 'Actual' : ($ed->fecha_fin?->format('d/m/Y') ?? '') }}
                        </td>
                        <td>{{ $ed->horas_semanales ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('personas.experiencia-docente.edit', [$persona, $ed]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('personas.experiencia-docente.destroy', [$persona, $ed]) }}" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-3">Sin experiencia docente registrada</td></tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card cv-section-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-briefcase me-2"></i>Experiencia Profesional</span>
                <a href="{{ route('personas.experiencia-profesional.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Cargo</th><th>Tipo</th><th>Período</th><th></th></tr></thead>
                    <tbody>
                    @forelse($persona->experienciaProfesional->sortByDesc('fecha_inicio') as $ep)
                    <tr>
                        <td><div class="fw-medium">{{ $ep->institucion }}</div></td>
                        <td>{{ $ep->cargo }}</td>
                        <td>{{ $ep->tipo ?? '-' }}</td>
                        <td>{{ $ep->fecha_inicio->format('d/m/Y') }} - {{ $ep->trabajo_actual ? 'Actual' : ($ep->fecha_fin?->format('d/m/Y') ?? '') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('personas.experiencia-profesional.edit', [$persona, $ep]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('personas.experiencia-profesional.destroy', [$persona, $ep]) }}" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-3">Sin experiencia profesional registrada</td></tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- === TAB 4: PRODUCCIÓN === --}}
<div class="tab-pane fade" id="produccion">
    <div class="row g-3">
        {{-- Científica --}}
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-text me-2"></i>Producción Científica</span>
                    <a href="{{ route('personas.produccion-cientifica.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Tipo</th><th>Título</th><th>Revista/Editorial</th><th>Año</th><th>Indexación</th><th></th></tr></thead>
                    <tbody>
                    @forelse($persona->produccionCientifica->sortByDesc('anio_publicacion') as $pc)
                    <tr>
                        <td><span class="badge bg-info text-dark" style="font-size:.7rem;">{{ $pc->tipo }}</span></td>
                        <td>
                            <div class="fw-medium" style="max-width:280px;">{{ Str::limit($pc->titulo,60) }}</div>
                            <div class="text-muted small">{{ Str::limit($pc->autores,50) }}</div>
                        </td>
                        <td>{{ Str::limit($pc->revista_editorial ?? '-',40) }}</td>
                        <td>{{ $pc->anio_publicacion }}</td>
                        <td>{{ $pc->indexacion ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('personas.produccion-cientifica.edit', [$persona, $pc]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('personas.produccion-cientifica.destroy', [$persona, $pc]) }}" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-3">Sin producción científica registrada</td></tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        {{-- Bibliográfica --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-book me-2"></i>Producción Bibliográfica</span>
                    <a href="{{ route('personas.produccion-bibliografica.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->produccionBibliografica as $pb)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ Str::limit($pb->titulo,70) }}</div>
                            <div class="cv-item-sub">{{ $pb->tipo }} · {{ $pb->editorial ?? '-' }} · {{ $pb->anio_publicacion }}</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.produccion-bibliografica.edit', [$persona, $pb]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.produccion-bibliografica.destroy', [$persona, $pb]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin producción bibliográfica</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Investigación --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-search me-2"></i>Proyectos de Investigación</span>
                    <a href="{{ route('personas.produccion-investigacion.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->produccionInvestigacion as $pi)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ Str::limit($pi->titulo,70) }}</div>
                            <div class="cv-item-sub">{{ $pi->rol }} · <span class="badge {{ $pi->estado=='En Ejecución'?'bg-success':'bg-secondary' }}" style="font-size:.65rem;">{{ $pi->estado }}</span></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.produccion-investigacion.edit', [$persona, $pi]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.produccion-investigacion.destroy', [$persona, $pi]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin proyectos de investigación</p>@endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- === TAB 5: CONGRESOS === --}}
<div class="tab-pane fade" id="congresos">
    <div class="card cv-section-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-mic me-2"></i>Congresos y Eventos Académicos</span>
            <a href="{{ route('personas.congresos.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>Nombre del Evento</th><th>Tipo</th><th>Ámbito</th><th>Fecha</th><th>Lugar</th><th>Horas</th><th>Rol</th><th></th></tr></thead>
                <tbody>
                @forelse($persona->congresos->sortByDesc('fecha_inicio') as $cong)
                <tr>
                    <td>
                        <div class="fw-medium" style="max-width:250px;">{{ Str::limit($cong->nombre,60) }}</div>
                        @if($cong->titulo_ponencia)<div class="text-muted small">Ponencia: {{ Str::limit($cong->titulo_ponencia,50) }}</div>@endif
                        @if($cong->numero_certificado)<div class="text-muted small">Cert: {{ $cong->numero_certificado }}</div>@endif
                    </td>
                    <td><span class="badge bg-secondary">{{ $cong->tipo }}</span></td>
                    <td><span class="badge {{ $cong->ambito=='Internacional'?'bg-primary':'bg-info text-dark' }}">{{ $cong->ambito }}</span></td>
                    <td>{{ $cong->fecha_inicio->format('d/m/Y') }}</td>
                    <td>{{ $cong->ciudad }}, {{ $cong->pais }}</td>
                    <td>{{ $cong->numero_horas ?? '-' }}</td>
                    <td>{{ $cong->rol_participacion }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.congresos.edit', [$persona, $cong]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.congresos.destroy', [$persona, $cong]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted py-4">Sin congresos registrados</td></tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

{{-- === TAB 6: OTROS === --}}
<div class="tab-pane fade" id="otros">
    <div class="row g-3">
        {{-- Reconocimientos --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-trophy me-2"></i>Reconocimientos y Honores</span>
                    <a href="{{ route('personas.reconocimientos.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->reconocimientos as $rec)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $rec->descripcion }}</div>
                            <div class="cv-item-sub">{{ $rec->tipo }} · {{ $rec->institucion_otorgante }} · {{ $rec->fecha->format('Y') }}</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.reconocimientos.edit', [$persona, $rec]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.reconocimientos.destroy', [$persona, $rec]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin reconocimientos registrados</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Licencias --}}
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-award me-2"></i>Licencias Profesionales</span>
                    <a href="{{ route('personas.licencias.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    @forelse($persona->licencias as $lic)
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title">{{ $lic->nombre_licencia }}
                                @if($lic->vigente)<span class="badge bg-success ms-1" style="font-size:.65rem;">Vigente</span>@endif
                            </div>
                            <div class="cv-item-sub">{{ $lic->institucion_emisora }} · N° {{ $lic->numero_licencia ?? '-' }}</div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('personas.licencias.edit', [$persona, $lic]) }}" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('personas.licencias.destroy', [$persona, $lic]) }}" onsubmit="return confirm('¿Eliminar?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    @empty<p class="text-muted small">Sin licencias registradas</p>@endforelse
                </div>
            </div>
        </div>

        {{-- Membresías --}}
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-building me-2"></i>Membresías a Instituciones</span>
                    <a href="{{ route('personas.membresias.create', $persona) }}" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Siglas</th><th>Tipo</th><th>N° Membresía</th><th>Período</th><th>Estado</th><th></th></tr></thead>
                    <tbody>
                    @forelse($persona->membresias as $mem)
                    <tr>
                        <td><div class="fw-medium">{{ $mem->institucion }}</div></td>
                        <td>{{ $mem->siglas ?? '-' }}</td>
                        <td>{{ $mem->tipo_membresia ?? '-' }}</td>
                        <td>{{ $mem->numero_membresia ?? '-' }}</td>
                        <td>{{ $mem->fecha_inicio->format('Y') }} - {{ $mem->vigente ? 'Vigente' : ($mem->fecha_fin?->format('Y') ?? '') }}</td>
                        <td>
                            @if($mem->vigente)
                                <span class="badge bg-success">Activa</span>
                            @else
                                <span class="badge bg-secondary">Inactiva</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('personas.membresias.edit', [$persona, $mem]) }}" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('personas.membresias.destroy', [$persona, $mem]) }}" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-3">Sin membresías registradas</td></tr>
                    @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>{{-- end tab-content --}}
@endsection
