<?php $__env->startSection('title'); ?>
    <?php echo app('translator')->get('translation.Invoice_Detail'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
            SKRD
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Detail SKRD
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                <form action="javascript:void(0)" id="skrdform" name="skrdform" method="POST">
                    <div class="invoice-title">
                        <h4 class="float-end font-size-16">Kode Registrasi #<?php echo e($data->id_registrasi); ?></h4>
                        <div class="mb-4">
                            
                            <p>Pemerintah Kabupaten Cianjur</p>
                        </div>
                        <div class="mb-4"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <address>
                                <strong>Data Ahli Waris:</strong><br>
                                <?php echo e($data->nama_ahliwaris); ?><br>
                                <?php echo e($data->alamat_ahliwaris); ?><br>
                            </address>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <address class="mt-2 mt-sm-0">
                                <strong>Data Makam:</strong><br>
                                <?php echo e($data->nama_meninggal); ?><br>
                                <?php echo e($data->nama_tpu); ?><br>
                                <?php echo e($data->blok_tpu); ?><br>
                                <?php echo e($data->tanggal_meninggal); ?>

                            </address>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mt-3">

                        </div>
                        <div class="col-sm-6 mt-3 text-sm-end">
                            <address>
                                <strong>Tanggal Registrasi:</strong><br>
                                <?php echo e($data->created_at); ?><br><br>
                            </address>
                        </div>
                    </div>
                    <div class="py-2 mt-3">
                        <h3 class="font-size-15 fw-bold">Retribusi</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 70px;">No.</th>
                                    <th>Kode Rekening</th>
                                    <th>Uraian Retribusi</th>
                                    <th class="text-end">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td></td>
                                    <td>Retribusi</td>
                                    <td class="text-end"><?php echo e($data->retribusi); ?></td>
                                </tr>

                                <tr>
                                    <td>02</td>
                                    <td></td>
                                    <td>Ambulans</td>
                                    <td class="text-end"><?php echo e($data->ambulance); ?></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-end"><?php echo e($data->retribusi+$data->ambulance); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="d-print-none">
                        <div class="float-end">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i
                                    class="fa fa-print"></i></a>
                            <button type="submit" class="btn btn-primary" id="pay-button">Bayar</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <form action="" id="submit_form" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="json" id="json_callback">
    </form>
    <!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript"
src="https://app.sandbox.midtrans.com/snap/snap.js"
data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>">
</script>
 <script type="text/javascript">
      // For example trigger on button clicked, or any time you need
      var payButton = document.getElementById('pay-button');
      payButton.addEventListener('click', function () {
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
        window.snap.pay('<?php echo e($snap_token); ?>', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_to_form(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('you closed the popup without finishing the payment');
          }
        })
      });

      function send_response_to_form(result){
        document.getElementById('json_callback').value = JSON.stringify(result);
        $('#submit_form').submit();
      }
    </script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
    <script>
        $('#skrdform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "<?php echo e(url('skrd')); ?>",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/pages/inv/index.blade.php ENDPATH**/ ?>