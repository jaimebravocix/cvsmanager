<?php $__env->startSection('title', 'Nueva Persona'); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('personas.index')); ?>">Personas</a></li>
    <li class="breadcrumb-item active">Nueva</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row justify-content-center">
<div class="col-xl-9">
<div class="card">
    <div class="card-header py-3">
        <i class="bi bi-person-plus-fill me-2"></i>Registrar Nueva Persona
    </div>
    <div class="card-body">
    <form method="POST" action="<?php echo e(route('personas.store')); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Paterno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_paterno" value="<?php echo e(old('apellido_paterno')); ?>"
                       class="form-control <?php $__errorArgs = ['apellido_paterno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['apellido_paterno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Apellido Materno <span class="text-danger">*</span></label>
                <input type="text" name="apellido_materno" value="<?php echo e(old('apellido_materno')); ?>"
                       class="form-control <?php $__errorArgs = ['apellido_materno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['apellido_materno'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Nombres <span class="text-danger">*</span></label>
                <input type="text" name="nombres" value="<?php echo e(old('nombres')); ?>"
                       class="form-control <?php $__errorArgs = ['nombres'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <?php $__errorArgs = ['nombres'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Sexo</label>
                <select name="sexo" class="form-select">
                    <option value="">-- Seleccione --</option>
                    <option value="M" <?php echo e(old('sexo')=='M'?'selected':''); ?>>Masculino</option>
                    <option value="F" <?php echo e(old('sexo')=='F'?'selected':''); ?>>Femenino</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" value="<?php echo e(old('fecha_nacimiento')); ?>" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Estado Civil</label>
                <select name="estado_civil" class="form-select">
                    <option value="">-- Seleccione --</option>
                    <?php $__currentLoopData = ['soltero'=>'Soltero','casado'=>'Casado','divorciado'=>'Divorciado','viudo'=>'Viudo','conviviente'=>'Conviviente','otro'=>'Otro']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e(old('estado_civil')==$k?'selected':''); ?>><?php echo e($v); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-medium">Tipo Personal <span class="text-danger">*</span></label>
                <select name="tipo_personal" class="form-select" required>
                    <option value="docente" <?php echo e(old('tipo_personal','docente')=='docente'?'selected':''); ?>>Docente</option>
                    <option value="administrativo" <?php echo e(old('tipo_personal')=='administrativo'?'selected':''); ?>>Administrativo</option>
                    <option value="ambos" <?php echo e(old('tipo_personal')=='ambos'?'selected':''); ?>>Ambos</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Lugar de Nacimiento</label>
                <input type="text" name="lugar_nacimiento" value="<?php echo e(old('lugar_nacimiento')); ?>" class="form-control" placeholder="Ciudad, Departamento">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">País de Nacimiento</label>
                <input type="text" name="pais_nacimiento" value="<?php echo e(old('pais_nacimiento','Perú')); ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Código Personal</label>
                <input type="text" name="codigo_personal" value="<?php echo e(old('codigo_personal')); ?>" class="form-control" placeholder="Ej: DOC-001">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Teléfono</label>
                <input type="text" name="telefono" value="<?php echo e(old('telefono')); ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Celular</label>
                <input type="text" name="celular" value="<?php echo e(old('celular')); ?>" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Vincular Usuario</label>
                <select name="user_id" class="form-select">
                    <option value="">-- Sin usuario --</option>
                    <?php $__currentLoopData = $usuarios_sin_persona; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($u->id); ?>" <?php echo e(old('user_id')==$u->id?'selected':''); ?>><?php echo e($u->name); ?> (<?php echo e($u->email); ?>)</option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label fw-medium">Resumen Profesional</label>
                <textarea name="resumen_profesional" rows="3" class="form-control" placeholder="Breve descripción profesional..."><?php echo e(old('resumen_profesional')); ?></textarea>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-medium">Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
            </div>
        </div>
        <hr class="my-4">
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i>Guardar</button>
            <a href="<?php echo e(route('personas.index')); ?>" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
    </div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Proyectos\CvsManager\resources\views/personas/create.blade.php ENDPATH**/ ?>