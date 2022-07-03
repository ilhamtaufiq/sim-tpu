<?php if(Session::get('success', false)): ?>
    <?php $data = Session::get('success'); ?>
    <?php if(is_array($data)): ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                <?php echo e($msg); ?>

            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            <?php echo e($data); ?>

        </div>
    <?php endif; ?>
<?php endif; ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/layouts/partials/messages.blade.php ENDPATH**/ ?>