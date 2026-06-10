<?php $__env->startSection('title', 'Personas'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Personas</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Personas / Docentes</h4>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'administrador|supervisor')): ?>
    <a href="<?php echo e(route('personas.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Nuevo Registro
    </a>
    <?php endif; ?>
</div>

<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>"
                       class="form-control" placeholder="Buscar por nombre, apellido o código...">
            </div>
            <div class="col-sm-3">
                <select name="tipo" class="form-select">
                    <option value="">Todos los tipos</option>
                    <option value="docente" <?php echo e(request('tipo')=='docente'?'selected':''); ?>>Docente</option>
                    <option value="administrativo" <?php echo e(request('tipo')=='administrativo'?'selected':''); ?>>Administrativo</option>
                    <option value="ambos" <?php echo e(request('tipo')=='ambos'?'selected':''); ?>>Ambos</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Buscar</button>
                <a href="<?php echo e(route('personas.index')); ?>" class="btn btn-outline-secondary ms-1">Limpiar</a>
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
                <?php $__empty_1 = true; $__currentLoopData = $personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $persona): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <?php if($persona->foto): ?>
                                    <img src="<?php echo e(Storage::url($persona->foto)); ?>" class="rounded-circle" style="width:36px;height:36px;object-fit:cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:36px;height:36px;font-size:.85rem;">
                                        <?php echo e(strtoupper(substr($persona->nombres,0,1))); ?>

                                    </div>
                                <?php endif; ?>
                                <div>
                                    <div class="fw-medium"><?php echo e($persona->nombre_completo); ?></div>
                                    <div class="text-muted" style="font-size:.76rem;">
                                        <?php echo e($persona->documentos->where('principal',true)->first()->numero ?? ($persona->documentos->first()->numero ?? '-')); ?>

                                    </div>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($persona->codigo_personal ?? '-'); ?></td>
                        <td><span class="badge bg-info text-dark"><?php echo e(ucfirst($persona->tipo_personal)); ?></span></td>
                        <td>
                            <div style="font-size:.82rem;"><?php echo e($persona->celular ?? $persona->telefono ?? '-'); ?></div>
                        </td>
                        <td>
                            <?php if($persona->activo): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('personas.show', $persona)); ?>" class="btn btn-outline-primary" title="Ver CV">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'administrador|supervisor')): ?>
                                <a href="<?php echo e(route('personas.edit', $persona)); ?>" class="btn btn-outline-warning" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form method="POST" action="<?php echo e(route('personas.destroy', $persona)); ?>" class="d-inline"
                                      onsubmit="return confirm('¿Eliminar este registro?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-outline-danger" title="Eliminar"><i class="bi bi-trash"></i></button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5">
                        <i class="bi bi-inbox" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                        No se encontraron registros
                    </td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($personas->hasPages()): ?>
    <div class="card-footer"><?php echo e($personas->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/personas/index.blade.php ENDPATH**/ ?>