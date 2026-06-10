<?php $__env->startSection('title', 'Agregar Dirección'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.index')); ?>">Personas</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.show', $persona)); ?>"><?php echo e($persona->nombre_completo); ?></a></li>
    <li class="breadcrumb-item active">Agregar Dirección</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">Agregar Dirección</div>
    <div class="card-body">
    <form method="POST" action="<?php echo e(route('personas.direcciones.store', $persona)); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-3">
                <label class="form-label fw-medium">Tipo </label>
                <select name="tipo" class="form-select">
                    <option value="domicilio" <?php echo e(old('tipo', $registro->tipo ?? '') == 'domicilio' ? 'selected' : ''); ?>>domicilio</option>
                    <option value="trabajo" <?php echo e(old('tipo', $registro->tipo ?? '') == 'trabajo' ? 'selected' : ''); ?>>trabajo</option>
                    <option value="otro" <?php echo e(old('tipo', $registro->tipo ?? '') == 'otro' ? 'selected' : ''); ?>>otro</option>
                </select>
            </div>
            <div class="col-md-9">
                <label class="form-label fw-medium">Dirección <span class="text-danger">*</span></label>
                <input type="text" name="direccion" value="<?php echo e(old('direccion', $registro->direccion ?? '')); ?>" class="form-control"  required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Urbanización </label>
                <input type="text" name="urbanizacion" value="<?php echo e(old('urbanizacion', $registro->urbanizacion ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Distrito </label>
                <input type="text" name="distrito" value="<?php echo e(old('distrito', $registro->distrito ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Provincia </label>
                <input type="text" name="provincia" value="<?php echo e(old('provincia', $registro->provincia ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Departamento </label>
                <input type="text" name="departamento" value="<?php echo e(old('departamento', $registro->departamento ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">País </label>
                <input type="text" name="pais" value="<?php echo e(old('pais', $registro->pais ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-md-6">
                <label class="form-label fw-medium">Código Postal </label>
                <input type="text" name="codigo_postal" value="<?php echo e(old('codigo_postal', $registro->codigo_postal ?? '')); ?>" class="form-control"  >
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Referencia</label>
                <textarea name="referencia" rows="2" class="form-control"><?php echo e(old('referencia', $registro->referencia ?? '')); ?></textarea>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/direcciones/create.blade.php ENDPATH**/ ?>