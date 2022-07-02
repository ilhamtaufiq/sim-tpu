<table>
    <thead>
        <tr>
        <th>No</th>
        <th>Tanggal Meninggal</th>
        <th>Nama Ahli Waris</th>
        <th>Alamat Aspirasi</th>
        <th>Nama Meninggal</th>
        <th>Tempat Meninggal</th>
        <th>NIK</th>
        <th>Nama TPU</th>
        <th>Nomor Blok TPU</th>
        <th>Retribusi</th>
        <th>Ambulance</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $i = 1;
        ?>
        <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($item->tanggal_meninggal); ?></td>
            <td><?php echo e($item->nama_ahliwaris); ?></td>
            <td><?php echo e($item->alamat_ahliwaris); ?></td>
            <td><?php echo e($item->nama_meninggal); ?></td>
            <td><?php echo e($item->tempat_meninggal); ?></td>
            <td><?php echo e($item->nik); ?></td>
            <td><?php echo e($item->id_makam); ?></td>
            <td><?php echo e($item->blok_makam); ?></td>
            <td><?php echo e($item->retribusi); ?></td>
            <td><?php echo e($item->ambulance); ?></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/exports/registrasi.blade.php ENDPATH**/ ?>