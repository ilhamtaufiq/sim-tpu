<?php $__env->startSection('content'); ?>
    
    <h1 class="mb-3"></h1>

    <div class="bg-light p-4 rounded">
        <h2>Permissions</h2>
        <div class="lead">
            Manage your permissions here.
            <a href="<?php echo e(route('permissions.create')); ?>" class="btn btn-primary btn-sm float-right">Add permissions</a>
        </div>
        
        <div class="mt-2">
            <?php echo $__env->make('layouts.partials.messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="15%">Name</th>
                <th scope="col">Guard</th> 
                <th scope="col" colspan="3" width="1%"></th> 
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($permission->name); ?></td>
                        <td><?php echo e($permission->guard_name); ?></td>
                        <td><a href="<?php echo e(route('permissions.edit', $permission->id)); ?>" class="btn btn-info btn-sm">Edit</a></td>
                        <td>
                            <?php echo Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']); ?>

                            <?php echo Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']); ?>

                            <?php echo Form::close(); ?>

                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/permissions/index.blade.php ENDPATH**/ ?>