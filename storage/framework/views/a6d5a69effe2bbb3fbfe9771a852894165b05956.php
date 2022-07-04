<?php $__env->startSection('title'); ?>
    Status Pembayaan
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            Pembayaran
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Status
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead class="thead-light">
                            <th scope="col">Kode Pembayaran</th>
                            <th>Ahli Waris</th>
                            <th scope="col">Nominal</th>
                            <th scope="col">Status Pembayaran</th>
                            <th>Tahun Herregistrasi</th>
                            <th scope="col"></th>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>#<?php echo e($order->number); ?></td>
                                    <?php $__currentLoopData = $order->registrasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($item->ahliwaris->nama); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td><?php echo e(number_format($order->total_price, 2, ',', '.')); ?></td>
                                    <td>
                                        <?php if($order->payment_status == 1): ?>
                                            Menunggu Pembayaran
                                        <?php elseif($order->payment_status == 2): ?>
                                            Sudah Dibayar
                                        <?php else: ?>
                                            Kadaluarsa
                                        <?php endif; ?>
                                    </td>
                                    <?php $__currentLoopData = $order->registrasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <th><?php echo e($tahun = \Carbon\Carbon::parse($item->tanggal_meninggal)->addYear(2)->format('Y')); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        <a href="<?php echo e(route('orders.show', $order->id)); ?>" class="btn btn-success">
                                            Lihat
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/orders/index.blade.php ENDPATH**/ ?>