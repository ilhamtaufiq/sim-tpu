<?php $__env->startSection('title'); ?>
    SKRD Herregistrasi
<?php $__env->stopSection(); ?>
<link href="<?php echo e(asset('/assets/libs/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            SKRD
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Herregistrasi
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Registrasi</th>
                                <th>Nama Ahliwaris</th>
                                
                                <th>Nama Makam</th>
                                <th>Nominal</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $i = 1;
                            ?>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($item->registrasi->kode_registrasi); ?></td>
                                    <td><?php echo e($item->registrasi->ahliwaris->nama); ?></td>
                                    
                                    <td><?php echo e($item->registrasi->nama_meninggal); ?></td>
                                    <td><?php echo e($item->nominal); ?></td>
                                    <td>
                                        <button onclick="inv(<?php echo e($item->id); ?>)" type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light">
                                            Lihat
                                        </button>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <div class="modal fade transaction-detailModal" id="modal" tabindex="-1" role="dialog"
        aria-labelledby="transaction-detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaction-detailModalLabel">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Kode Makam <span class="text-primary" id="kode_registrasi"></span></p>
                    <p class="mb-4">Nama Makam: <span class="text-primary" id="nama_makam"></span></p>
                </div>
                <div class="modal-footer" id="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- Required datatable js -->
    <script src="<?php echo e(asset('/assets/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <!-- Datatable init js -->
    <script src="<?php echo e(asset('/assets/js/pages/datatables.init.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/inputmask/inputmask.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/js/pages/form-mask.init.js')); ?>"></script>


    <script>
        function inv(id) {
            $.ajax({
                url: "<?php echo e(route('herregistrasi')); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#modal').modal('show');
                    $('#kode_registrasi').text(res.registrasi.kode_registrasi);
                    $('#nama_makam').text(res.registrasi.nama_meninggal);

                }
            });
        }
    </script>
    <script type="text/javascript">
      
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/pages/pembayaran/herregistrasi.blade.php ENDPATH**/ ?>