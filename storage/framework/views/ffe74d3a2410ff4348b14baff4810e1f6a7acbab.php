<?php $__env->startSection('title'); ?>
    Data Dasar TPU
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('/assets/libs/datatables/datatables.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('/assets/libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            TPU
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Data Dasar TPU
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex flex-wrap">
                        <h4 class="card-title mb-4">Daftar TPU</h4>
                        <div class="ms-auto">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <button class="btn btn-primary btn-sm" onClick="add()" href="javascript:void(0)">Tambah
                                        Data
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-toolbar">
                        <div class="d-flex flex-wrap gap-2">
                           
                        </div>
                    </div>
                    <br>
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama TPU</th>
                                        <th>Alamat</th>
                                        <th>Luas m2</th>
                                        <th>Kode TPU</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(asset('/assets/libs/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/jszip/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/pdfmake/pdfmake.min.js')); ?>"></script>
    <!-- Datatable init js -->

    <script src="<?php echo e(asset('/assets/libs/parsleyjs/parsleyjs.min.js')); ?>"></script>

    <script src="<?php echo e(asset('/assets/js/pages/form-validation.init.js')); ?>"></script>
    <script src="<?php echo e(asset('/assets/libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script>
        <?php if($message = Session::get('success')): ?>
            Swal.fire({
                title: 'Info',
                text: '<?php echo e($message); ?>',
                icon: 'success',
            })
        <?php endif; ?>
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {

            var table = $('.table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "<?php echo e(route('tpu')); ?>",
                columns: [
                    { data: 'DT_RowIndex', searchable: false, orderable: false }, // row index
                    { data: 'nama_tpu' },
                    { data: 'alamat_tpu' },
                    { data: 'luas_tpu' },
                    { data: 'kode_tpu' },
                ],
            });
        });

        function add() {
            $('#ModalForm').trigger("reset");
            $('#AhliwarisModal').html("Tambah Data");
            $('#ahliwaris-modal').modal('show');
            $('#id').val('').trigger('change');

        }

        function update(id) {
            $.ajax({
                type: "POST",
                url: "<?php echo e(url('ahliwaris/update')); ?>",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#AhliwarisModal').html("Ubah Data");
                    $('#ahliwaris-modal').modal('show');
                    $('#id').val(res.id);
                    $('#nama').val(res.nama);
                    $('#alamat').val(res.alamat);
                    $('#nik').val(res.nik);
                    $('#nomor_telepon').val(res.nomor_telepon);
                    $('#agama').find('option[value="' + res.agama + '"]').prop('selected', true);
                    $('#tempat_lahir').val(res.tempat_lahir);
                    $('#tanggal_lahir').val(res.tanggal_lahir);
                    $('#nomor_telepon').val(res.nomor_telepon);
                }
            });
        }

        function hapus(id) {
            var url = '<?php echo e(route('ahliwaris.hapus')); ?>';
            var id = id;
            Swal.fire({
                title: "Apakah Anda Yakin ?",
                text: "Data Yang Sudah Dihapus Tidak Bisa Dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Tetap Hapus!"
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            "id": id,
                        },
                        success: function(response) {
                            swal.fire({
                                title: 'Hapus Data',
                                text: 'Data Berhasil Dihapus.',
                                icon: 'success',
                                timer: 2000,
                            });
                            $('.table').DataTable().ajax.reload(null, false);
                        }
                    })
                }
            })
        }

        $('#ModalForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "<?php echo e(url('ahliwaris')); ?>",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#ahliwaris-modal").modal('hide');
                    var oTable = $('.table').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                    swal.fire({
                        title: 'Berhasil',
                        text: 'Data Berhasil Disimpan.',
                        icon: 'success',
                        timer: 2000,
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/pages/tpu/index.blade.php ENDPATH**/ ?>