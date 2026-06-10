<?php $__env->startSection('title', 'Agregar Correo Electrónico'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.index')); ?>">Personas</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.show', $persona)); ?>"><?php echo e($persona->nombre_completo); ?></a></li>
    <li class="breadcrumb-item active">Agregar Correo Electrónico</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Correo Electrónico</div>
    <div class="card-body">
    <form method="POST" action="<?php echo e(route('personas.emails.store', $persona)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Tipo </label>
                <select name="tipo" class="form-select">
                    <option value="personal" <?php echo e(old('tipo', $registro->tipo ?? '') == 'personal' ? 'selected' : ''); ?>>personal</option>
                    <option value="institucional" <?php echo e(old('tipo', $registro->tipo ?? '') == 'institucional' ? 'selected' : ''); ?>>institucional</option>
                    <option value="otro" <?php echo e(old('tipo', $registro->tipo ?? '') == 'otro' ? 'selected' : ''); ?>>otro</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                <input type="text" name="email" value="<?php echo e(old('email', $registro->email ?? '')); ?>" class="form-control"  required>
            </div>

        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
            <a href="<?php echo e(route('personas.show', $persona)); ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/emails/create.blade.php ENDPATH**/ ?>