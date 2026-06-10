<?php $__env->startSection('title', 'Usuarios'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active">Usuarios</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Gestión de Usuarios</h4>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Nuevo Usuario</a>
</div>
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2">
            <div class="col-sm-5">
                <input type="text" name="buscar" value="<?php echo e(request('buscar')); ?>" class="form-control" placeholder="Buscar por nombre o email...">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search me-1"></i>Buscar</button>
                <a href="<?php echo e(route('users.index')); ?>" class="btn btn-outline-secondary ms-1">Limpiar</a>
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
                <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><div class="fw-medium"><?php echo e($user->name); ?></div></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge badge-role-<?php echo e($role); ?>"><?php echo e(ucfirst($role)); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>
                        <td>
                            <?php if($user->persona): ?>
                                <a href="<?php echo e(route('personas.show', $user->persona)); ?>" class="text-primary small"><?php echo e($user->persona->nombre_completo); ?></a>
                            <?php else: ?>
                                <span class="text-muted small">Sin perfil</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user->activo): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-outline-warning"><i class="bi bi-pencil"></i></a>
                                <?php if($user->id !== auth()->id()): ?>
                                <form method="POST" action="<?php echo e(route('users.destroy', $user)); ?>" onsubmit="return confirm('¿Eliminar usuario?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="6" class="text-center text-muted py-5">Sin usuarios</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($users->hasPages()): ?>
    <div class="card-footer"><?php echo e($users->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/users/index.blade.php ENDPATH**/ ?>