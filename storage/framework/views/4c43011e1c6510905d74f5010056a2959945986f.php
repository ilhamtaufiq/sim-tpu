<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('assets/style.css')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  </head>
  <body>
    <form action="/payment" method="GET">
      <h1>Data Diri</h1>
      <div class="formcontainer">
      <hr/>
      <div class="container">
        <label for="uname"><strong>Nama</strong></label>
        <input type="text" placeholder="Masukan nama" name="uname" required>
        <label for="psw"><strong>Email</strong></label>
        <input type="text" placeholder="Masukan Email" name="email" required>
        <label for="psw"><strong>Nomor</strong></label>
        <input type="text" placeholder="Masukan Nomor" name="number" required>
      </div>
      <button type="submit">Lanjut</button>
    </form>
    <?php if(session('alert-success')): ?>
    <script>alert("<?php echo e(session('alert-success')); ?>")</script>
    <?php elseif(session('alert-failed')): ?>
    <script>alert("<?php echo e(session('alert-failed')); ?>")</script>
    <?php endif; ?>
  </body>
</html><?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/pages/pembayaran/index.blade.php ENDPATH**/ ?>