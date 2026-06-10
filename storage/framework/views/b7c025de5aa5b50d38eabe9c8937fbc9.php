<?php $__env->startSection('title', 'CV - '.$persona->nombre_completo); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.index')); ?>">Personas</a></li>
    <li class="breadcrumb-item active"><?php echo e($persona->nombre_completo); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('styles'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-12 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <?php if($persona->foto): ?>
                        <img src="<?php echo e(Storage::url($persona->foto)); ?>" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;border:3px solid #e2e8f0;">
                    <?php else: ?>
                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center text-white fw-bold" style="width:80px;height:80px;font-size:1.8rem;">
                            <?php echo e(strtoupper(substr($persona->nombres,0,1))); ?>

                        </div>
                    <?php endif; ?>
                    <div class="flex-grow-1">
                        <h4 class="fw-bold mb-1"><?php echo e($persona->nombre_completo); ?></h4>
                        <div class="d-flex flex-wrap gap-2 mb-1">
                            <span class="badge bg-primary"><?php echo e(ucfirst($persona->tipo_personal)); ?></span>
                            <?php if($persona->codigo_personal): ?>
                                <span class="badge bg-secondary"><?php echo e($persona->codigo_personal); ?></span>
                            <?php endif; ?>
                            <?php if($persona->activo): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </div>
                        <?php if($persona->resumen_profesional): ?>
                            <p class="text-muted small mb-0"><?php echo e(Str::limit($persona->resumen_profesional, 200)); ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="<?php echo e(route('personas.edit', $persona)); ?>" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i>Editar Perfil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<ul class="nav nav-tabs mb-3" id="cvTabs">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#personal">Datos Personales</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#formacion">Formación Académica</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#experiencia">Experiencia</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#produccion">Producción</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#congresos">Congresos</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#otros">Otros</a></li>
</ul>

<div class="tab-content" id="cvTabsContent">


<div class="tab-pane fade show active" id="personal">
    <div class="row g-3">
        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between">
                    <span><i class="bi bi-person me-2"></i>Datos Generales</span>
                </div>
                <div class="card-body">
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Sexo','valor'=>$persona->sexo=='M'?'Masculino':($persona->sexo=='F'?'Femenino':'-')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Fecha Nac.','valor'=>$persona->fecha_nacimiento?->format('d/m/Y')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Lugar Nac.','valor'=>$persona->lugar_nacimiento.', '.$persona->pais_nacimiento], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Estado Civil','valor'=>ucfirst($persona->estado_civil ?? '-')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Teléfono','valor'=>$persona->telefono], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php echo $__env->make('partials.dato-fila', ['label'=>'Celular','valor'=>$persona->celular], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-card-text me-2"></i>Documentos de Identidad</span>
                    <a href="<?php echo e(route('personas.documentos.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->documentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($doc->tipo); ?>: <?php echo e($doc->numero); ?></div>
                            <div class="cv-item-sub"><?php echo e($doc->pais_emision); ?> <?php if($doc->fecha_vencimiento): ?> · Vence: <?php echo e($doc->fecha_vencimiento->format('d/m/Y')); ?> <?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.documentos.edit', [$persona, $doc])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.documentos.destroy', [$persona, $doc])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin documentos registrados</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-envelope me-2"></i>Correos Electrónicos</span>
                    <a href="<?php echo e(route('personas.emails.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-center">
                        <div>
                            <div class="cv-item-title"><?php echo e($email->email); ?></div>
                            <div class="cv-item-sub"><?php echo e(ucfirst($email->tipo)); ?> <?php if($email->principal): ?><span class="badge bg-success ms-1" style="font-size:.65rem;">Principal</span><?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.emails.edit', [$persona, $email])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.emails.destroy', [$persona, $email])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin emails registrados</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-house me-2"></i>Direcciones</span>
                    <a href="<?php echo e(route('personas.direcciones.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->direcciones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($dir->direccion); ?></div>
                            <div class="cv-item-sub"><?php echo e($dir->distrito); ?>, <?php echo e($dir->provincia); ?>, <?php echo e($dir->departamento); ?> · <?php echo e(ucfirst($dir->tipo)); ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.direcciones.edit', [$persona, $dir])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.direcciones.destroy', [$persona, $dir])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin direcciones registradas</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-shield-check me-2"></i>Régimen Pensionario</span>
                    <a href="<?php echo e(route('personas.regimen.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->regimenesP; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($r->tipo); ?><?php echo e($r->nombre_afp ? ' - '.$r->nombre_afp : ''); ?></div>
                            <div class="cv-item-sub">CUSPP: <?php echo e($r->numero_cuspp ?? '-'); ?> <?php if($r->fecha_afiliacion): ?>· <?php echo e($r->fecha_afiliacion->format('d/m/Y')); ?><?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.regimen.edit', [$persona, $r])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.regimen.destroy', [$persona, $r])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin régimen registrado</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-bank me-2"></i>Cuentas de Haberes</span>
                    <a href="<?php echo e(route('personas.haberes.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->cuentasHaberes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($c->banco); ?> - <?php echo e($c->numero_cuenta); ?></div>
                            <div class="cv-item-sub"><?php echo e(ucfirst($c->tipo_cuenta)); ?> · <?php echo e($c->moneda); ?> <?php if($c->cci): ?>· CCI: <?php echo e($c->cci); ?><?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.haberes.edit', [$persona, $c])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.haberes.destroy', [$persona, $c])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin cuentas registradas</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-heart-pulse me-2"></i>Documentos de Salud</span>
                    <a href="<?php echo e(route('personas.salud.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->documentosSalud; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($s->tipo); ?></div>
                            <div class="cv-item-sub"><?php echo e($s->descripcion); ?> <?php if($s->fecha_emision): ?>· <?php echo e($s->fecha_emision->format('d/m/Y')); ?><?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.salud.edit', [$persona, $s])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.salud.destroy', [$persona, $s])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin documentos de salud</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-file-earmark-text me-2"></i>Antecedentes</span>
                    <a href="<?php echo e(route('personas.antecedentes.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->antecedentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($ant->tipo); ?>

                                <span class="badge <?php echo e($ant->resultado=='Sin antecedentes'?'bg-success':'bg-danger'); ?> ms-1" style="font-size:.65rem;"><?php echo e($ant->resultado); ?></span>
                            </div>
                            <div class="cv-item-sub"><?php echo e($ant->entidad); ?> · <?php echo e($ant->fecha_emision->format('d/m/Y')); ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.antecedentes.edit', [$persona, $ant])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.antecedentes.destroy', [$persona, $ant])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin antecedentes registrados</p><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="formacion">
    <div class="row g-3">
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-mortarboard me-2"></i>Formación Académica</span>
                    <a href="<?php echo e(route('personas.formacion.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead><tr><th>Nivel</th><th>Especialidad / Mención</th><th>Institución</th><th>País</th><th>Año</th><th>Registro SUNEDU</th><th></th></tr></thead>
                        <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $persona->formacionAcademica->sortByDesc('anio_fin'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><span class="badge bg-info text-dark"><?php echo e($fa->nivel); ?></span></td>
                            <td>
                                <div class="fw-medium"><?php echo e($fa->especialidad); ?></div>
                                <?php if($fa->mencion): ?><div class="text-muted small">Mención: <?php echo e($fa->mencion); ?></div><?php endif; ?>
                            </td>
                            <td><?php echo e($fa->institucion); ?></td>
                            <td><?php echo e($fa->pais); ?></td>
                            <td><?php echo e($fa->anio_fin ?? $fa->anio_inicio); ?></td>
                            <td><?php echo e($fa->numero_registro_sunedu ?? '-'); ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo e(route('personas.formacion.edit', [$persona, $fa])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="<?php echo e(route('personas.formacion.destroy', [$persona, $fa])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Sin formación académica registrada</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-translate me-2"></i>Certificaciones de Idiomas</span>
                    <a href="<?php echo e(route('personas.idiomas.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->certificacionesIdioma; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($id->idioma); ?></div>
                            <div class="cv-item-sub">Comprensión: <?php echo e($id->nivel_comprension ?? '-'); ?> | Escritura: <?php echo e($id->nivel_escritura ?? '-'); ?> | Habla: <?php echo e($id->nivel_habla ?? '-'); ?></div>
                            <?php if($id->examen_certificacion): ?><div class="cv-item-sub"><?php echo e($id->examen_certificacion); ?> <?php echo e($id->puntaje ? '- '.$id->puntaje : ''); ?></div><?php endif; ?>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.idiomas.edit', [$persona, $id])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.idiomas.destroy', [$persona, $id])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin certificaciones de idiomas</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-patch-check me-2"></i>Registros Institucionales</span>
                    <a href="<?php echo e(route('personas.registros.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->registrosInstitucionales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($ri->institucion); ?>

                                <?php if($ri->vigente): ?><span class="badge bg-success ms-1" style="font-size:.65rem;">Vigente</span><?php endif; ?>
                            </div>
                            <div class="cv-item-sub">N° <?php echo e($ri->numero_registro ?? '-'); ?> <?php if($ri->categoria): ?>· <?php echo e($ri->categoria); ?><?php endif; ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.registros.edit', [$persona, $ri])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.registros.destroy', [$persona, $ri])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin registros institucionales</p><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="experiencia">
    <div class="col-12 mb-3">
        <div class="card cv-section-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-book me-2"></i>Experiencia Docente</span>
                <a href="<?php echo e(route('personas.experiencia-docente.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Categoría / Régimen</th><th>Curso/Asignatura</th><th>Período</th><th>Hrs/sem</th><th></th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $persona->experienciaDocente->sortByDesc('fecha_inicio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="fw-medium"><?php echo e($ed->institucion); ?></div>
                            <?php if($ed->facultad): ?><div class="text-muted small"><?php echo e($ed->facultad); ?></div><?php endif; ?>
                        </td>
                        <td>
                            <?php if($ed->categoria): ?><span class="badge bg-secondary"><?php echo e($ed->categoria); ?></span><?php endif; ?>
                            <?php if($ed->regimen): ?><div class="text-muted small"><?php echo e($ed->regimen); ?></div><?php endif; ?>
                        </td>
                        <td><?php echo e($ed->curso_asignatura ?? '-'); ?></td>
                        <td>
                            <?php echo e($ed->fecha_inicio->format('d/m/Y')); ?> -
                            <?php echo e($ed->trabajo_actual ? 'Actual' : ($ed->fecha_fin?->format('d/m/Y') ?? '')); ?>

                        </td>
                        <td><?php echo e($ed->horas_semanales ?? '-'); ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('personas.experiencia-docente.edit', [$persona, $ed])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="<?php echo e(route('personas.experiencia-docente.destroy', [$persona, $ed])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-3">Sin experiencia docente registrada</td></tr>
                    <?php endif; ?>
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
                <a href="<?php echo e(route('personas.experiencia-profesional.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Cargo</th><th>Tipo</th><th>Período</th><th></th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $persona->experienciaProfesional->sortByDesc('fecha_inicio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><div class="fw-medium"><?php echo e($ep->institucion); ?></div></td>
                        <td><?php echo e($ep->cargo); ?></td>
                        <td><?php echo e($ep->tipo ?? '-'); ?></td>
                        <td><?php echo e($ep->fecha_inicio->format('d/m/Y')); ?> - <?php echo e($ep->trabajo_actual ? 'Actual' : ($ep->fecha_fin?->format('d/m/Y') ?? '')); ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('personas.experiencia-profesional.edit', [$persona, $ep])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="<?php echo e(route('personas.experiencia-profesional.destroy', [$persona, $ep])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center text-muted py-3">Sin experiencia profesional registrada</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="produccion">
    <div class="row g-3">
        
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-journal-text me-2"></i>Producción Científica</span>
                    <a href="<?php echo e(route('personas.produccion-cientifica.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Tipo</th><th>Título</th><th>Revista/Editorial</th><th>Año</th><th>Indexación</th><th></th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $persona->produccionCientifica->sortByDesc('anio_publicacion'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><span class="badge bg-info text-dark" style="font-size:.7rem;"><?php echo e($pc->tipo); ?></span></td>
                        <td>
                            <div class="fw-medium" style="max-width:280px;"><?php echo e(Str::limit($pc->titulo,60)); ?></div>
                            <div class="text-muted small"><?php echo e(Str::limit($pc->autores,50)); ?></div>
                        </td>
                        <td><?php echo e(Str::limit($pc->revista_editorial ?? '-',40)); ?></td>
                        <td><?php echo e($pc->anio_publicacion); ?></td>
                        <td><?php echo e($pc->indexacion ?? '-'); ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('personas.produccion-cientifica.edit', [$persona, $pc])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="<?php echo e(route('personas.produccion-cientifica.destroy', [$persona, $pc])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-3">Sin producción científica registrada</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-book me-2"></i>Producción Bibliográfica</span>
                    <a href="<?php echo e(route('personas.produccion-bibliografica.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->produccionBibliografica; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e(Str::limit($pb->titulo,70)); ?></div>
                            <div class="cv-item-sub"><?php echo e($pb->tipo); ?> · <?php echo e($pb->editorial ?? '-'); ?> · <?php echo e($pb->anio_publicacion); ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.produccion-bibliografica.edit', [$persona, $pb])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.produccion-bibliografica.destroy', [$persona, $pb])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin producción bibliográfica</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-search me-2"></i>Proyectos de Investigación</span>
                    <a href="<?php echo e(route('personas.produccion-investigacion.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->produccionInvestigacion; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e(Str::limit($pi->titulo,70)); ?></div>
                            <div class="cv-item-sub"><?php echo e($pi->rol); ?> · <span class="badge <?php echo e($pi->estado=='En Ejecución'?'bg-success':'bg-secondary'); ?>" style="font-size:.65rem;"><?php echo e($pi->estado); ?></span></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.produccion-investigacion.edit', [$persona, $pi])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.produccion-investigacion.destroy', [$persona, $pi])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin proyectos de investigación</p><?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="congresos">
    <div class="card cv-section-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span><i class="bi bi-mic me-2"></i>Congresos y Eventos Académicos</span>
            <a href="<?php echo e(route('personas.congresos.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead><tr><th>Nombre del Evento</th><th>Tipo</th><th>Ámbito</th><th>Fecha</th><th>Lugar</th><th>Horas</th><th>Rol</th><th></th></tr></thead>
                <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $persona->congresos->sortByDesc('fecha_inicio'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cong): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="fw-medium" style="max-width:250px;"><?php echo e(Str::limit($cong->nombre,60)); ?></div>
                        <?php if($cong->titulo_ponencia): ?><div class="text-muted small">Ponencia: <?php echo e(Str::limit($cong->titulo_ponencia,50)); ?></div><?php endif; ?>
                        <?php if($cong->numero_certificado): ?><div class="text-muted small">Cert: <?php echo e($cong->numero_certificado); ?></div><?php endif; ?>
                    </td>
                    <td><span class="badge bg-secondary"><?php echo e($cong->tipo); ?></span></td>
                    <td><span class="badge <?php echo e($cong->ambito=='Internacional'?'bg-primary':'bg-info text-dark'); ?>"><?php echo e($cong->ambito); ?></span></td>
                    <td><?php echo e($cong->fecha_inicio->format('d/m/Y')); ?></td>
                    <td><?php echo e($cong->ciudad); ?>, <?php echo e($cong->pais); ?></td>
                    <td><?php echo e($cong->numero_horas ?? '-'); ?></td>
                    <td><?php echo e($cong->rol_participacion); ?></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.congresos.edit', [$persona, $cong])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.congresos.destroy', [$persona, $cong])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="8" class="text-center text-muted py-4">Sin congresos registrados</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>


<div class="tab-pane fade" id="otros">
    <div class="row g-3">
        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-trophy me-2"></i>Reconocimientos y Honores</span>
                    <a href="<?php echo e(route('personas.reconocimientos.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->reconocimientos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($rec->descripcion); ?></div>
                            <div class="cv-item-sub"><?php echo e($rec->tipo); ?> · <?php echo e($rec->institucion_otorgante); ?> · <?php echo e($rec->fecha->format('Y')); ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.reconocimientos.edit', [$persona, $rec])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.reconocimientos.destroy', [$persona, $rec])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin reconocimientos registrados</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-md-6">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-award me-2"></i>Licencias Profesionales</span>
                    <a href="<?php echo e(route('personas.licencias.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i></a>
                </div>
                <div class="card-body">
                    <?php $__empty_1 = true; $__currentLoopData = $persona->licencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="cv-item d-flex justify-content-between align-items-start">
                        <div>
                            <div class="cv-item-title"><?php echo e($lic->nombre_licencia); ?>

                                <?php if($lic->vigente): ?><span class="badge bg-success ms-1" style="font-size:.65rem;">Vigente</span><?php endif; ?>
                            </div>
                            <div class="cv-item-sub"><?php echo e($lic->institucion_emisora); ?> · N° <?php echo e($lic->numero_licencia ?? '-'); ?></div>
                        </div>
                        <div class="d-flex gap-1">
                            <a href="<?php echo e(route('personas.licencias.edit', [$persona, $lic])); ?>" class="btn btn-xs btn-outline-warning" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="<?php echo e(route('personas.licencias.destroy', [$persona, $lic])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-xs btn-outline-danger" style="padding:.15rem .4rem;font-size:.75rem;"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><p class="text-muted small">Sin licencias registradas</p><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="col-12">
            <div class="card cv-section-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span><i class="bi bi-building me-2"></i>Membresías a Instituciones</span>
                    <a href="<?php echo e(route('personas.membresias.create', $persona)); ?>" class="btn btn-sm btn-primary"><i class="bi bi-plus me-1"></i>Agregar</a>
                </div>
                <div class="card-body p-0">
                <table class="table table-hover align-middle mb-0">
                    <thead><tr><th>Institución</th><th>Siglas</th><th>Tipo</th><th>N° Membresía</th><th>Período</th><th>Estado</th><th></th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $persona->membresias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><div class="fw-medium"><?php echo e($mem->institucion); ?></div></td>
                        <td><?php echo e($mem->siglas ?? '-'); ?></td>
                        <td><?php echo e($mem->tipo_membresia ?? '-'); ?></td>
                        <td><?php echo e($mem->numero_membresia ?? '-'); ?></td>
                        <td><?php echo e($mem->fecha_inicio->format('Y')); ?> - <?php echo e($mem->vigente ? 'Vigente' : ($mem->fecha_fin?->format('Y') ?? '')); ?></td>
                        <td>
                            <?php if($mem->vigente): ?>
                                <span class="badge bg-success">Activa</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactiva</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="<?php echo e(route('personas.membresias.edit', [$persona, $mem])); ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="<?php echo e(route('personas.membresias.destroy', [$persona, $mem])); ?>" onsubmit="return confirm('¿Eliminar?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-muted py-3">Sin membresías registradas</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/personas/show.blade.php ENDPATH**/ ?>