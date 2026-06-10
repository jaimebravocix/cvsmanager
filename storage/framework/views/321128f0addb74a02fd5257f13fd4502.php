<?php $__env->startSection('title', 'Agregar Membresía Institucional'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.index')); ?>">Personas</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.show', $persona)); ?>"><?php echo e($persona->nombre_completo); ?></a></li>
    <li class="breadcrumb-item active">Agregar Membresía Institucional</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Membresía Institucional</div>
    <div class="card-body">
    <form method="POST" action="<?php echo e(route('personas.membresias.store', $persona)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label fw-medium">Institución <span class="text-danger">*</span></label>
                <input type="text" name="institucion" value="<?php echo e(old('institucion', $registro->institucion ?? '')); ?>" class="form-control"  required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Siglas (ej: IEEE) </label>
                <input type="text" name="siglas" value="<?php echo e(old('siglas', $registro->siglas ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Ámbito <span class="text-danger">*</span></label>
                <select name="ambito" class="form-select">
                    <option value="Nacional" <?php echo e(old('ambito', $registro->ambito ?? '') == 'Nacional' ? 'selected' : ''); ?>>Nacional</option>
                    <option value="Internacional" <?php echo e(old('ambito', $registro->ambito ?? '') == 'Internacional' ? 'selected' : ''); ?>>Internacional</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Tipo Membresía </label>
                <input type="text" name="tipo_membresia" value="<?php echo e(old('tipo_membresia', $registro->tipo_membresia ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">N° Membresía </label>
                <input type="text" name="numero_membresia" value="<?php echo e(old('numero_membresia', $registro->numero_membresia ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Inicio <span class="text-danger">*</span></label>
                <input type="date" name="fecha_inicio" value="<?php echo e(old('fecha_inicio', isset($registro->fecha_inicio) ? $registro->fecha_inicio->format('Y-m-d') : '')); ?>" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Fecha Fin </label>
                <input type="date" name="fecha_fin" value="<?php echo e(old('fecha_fin', isset($registro->fecha_fin) ? $registro->fecha_fin->format('Y-m-d') : '')); ?>" class="form-control" >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Rol / Cargo </label>
                <input type="text" name="rol_cargo" value="<?php echo e(old('rol_cargo', $registro->rol_cargo ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Descripción</label>
                <textarea name="descripcion" rows="2" class="form-control"><?php echo e(old('descripcion', $registro->descripcion ?? '')); ?></textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Archivo</label>
                <?php if(isset($registro) && $registro->archivo): ?>
                    <div class="mb-1"><a href="<?php echo e(Storage::url($registro->archivo)); ?>" target="_blank" class="text-primary small"><i class="bi bi-file-earmark me-1"></i>Ver archivo actual</a></div>
                <?php endif; ?>
                <input type="file" name="archivo" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/membresias/create.blade.php ENDPATH**/ ?>