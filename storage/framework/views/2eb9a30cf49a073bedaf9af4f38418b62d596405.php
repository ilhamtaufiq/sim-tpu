<?php $__env->startSection('title'); ?>
    SKRD Registrasi
<?php $__env->stopSection(); ?>
<link href="<?php echo e(asset('/assets/libs/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
<style>
    @media  screen {
        #printSection {
            display: none;
        }
    }

    @media  print {
        body * {
            visibility: hidden;
        }

        #printSection,
        #printSection * {
            visibility: visible;
        }

        #printSection {
            position:absolute;
            left: 0;
            top: 0;
        }
        #printThis {
            position: relative;
            margin-top: 100px;
        }
        #modal-footer {
            display: none;
        }
    }
</style>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            SKRD
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Registrasi
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
                                <th>Total Pembayaran</th>
                                <th>Tahun Registrasi</th>
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
                                    <td><?php echo e($item->kode_registrasi); ?></td>
                                    <td><?php echo e($item->retribusi+$item->ambulance); ?></td>
                                    <td><?php echo e($tahun = \Carbon\Carbon::parse($item->tanggal_meninggal)->format('Y')); ?></td>
                                    <td>
                                        <button onclick="update(<?php echo e($item->id); ?>)" type="button"
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
    <div id="printThis">
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
                        <p class="mb-4"><span class="text-primary">Cek Status</span></p>


                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Kode Rekening</th>
                                        <th scope="col">Uraian Retribusi</th>
                                        <th scope="col">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">

                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Retribusi</h5>
                                            </div>
                                        </td>
                                        <td id="retribusi"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">

                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Ambulans</h5>
                                            </div>
                                        </td>
                                        <td id="ambulance"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td id="total_pembayaran">

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer" id="modal-footer">
                        
                        <button id="btnPrint">Print</button>       
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
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
    <script>
        function update(id) {
            $.ajax({
                type: "GET",
                url: "<?php echo e(route('pembayaran.show')); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#modal').modal('show');
                    $('#kode_registrasi').text(res.kode_registrasi);
                    $('#nama_makam').text(res.nama_meninggal);
                    $('#retribusi').text(res.retribusi);
                    $('#ambulance').text(res.ambulance);
                    $('#total_pembayaran').text(res.retribusi+res.ambulance);


                }
            });
        }
    </script>
    <script>
        document.getElementById("btnPrint").onclick = function() {
            printElement(document.getElementById("printThis"));
        }

        function printElement(elem) {
            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");

            if (!$printSection) {
                var $printSection = document.createElement("div");
                $printSection.id = "printSection";
                document.body.appendChild($printSection);
            }

            $printSection.innerHTML = "";
            $printSection.appendChild(domClone);
            window.print();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/pages/pembayaran/registrasi.blade.php ENDPATH**/ ?>