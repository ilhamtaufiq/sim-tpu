<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"><?php echo app('translator')->get('translation.Menu'); ?></li>

                <li>
                    <a href="<?php echo e(route('root')); ?>" class="waves-effect active">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-starter-page">Dashboard</span>
                    </a>
                </li>
                <li class="menu-title" key="t-menu">Halaman</li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-success float-end"
                            key="t-new"><?php echo app('translator')->get('translation.New'); ?></span>
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">Database</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('ahliwaris')); ?>">Ahli Waris</a></li>
                        <li><a href="<?php echo e(route('registrasi')); ?>">Registrasi</a></li>
                        <li><a href="<?php echo e(route('tpu')); ?>">Data TPU</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-success float-end"
                            key="t-new"><?php echo app('translator')->get('translation.New'); ?></span>
                        <i class="bx bx-user-circle"></i>
                        <span key="t-authentication">SKRD</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="<?php echo e(route('pembayaran')); ?>">Registrasi</a></li>
                        <li><a href="<?php echo e(route('herregistrasi')); ?>">Herregistrasi</a></li>

                    </ul>
                </li>
                

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
<?php /**PATH /Users/ilhamtaufiq/www/Admin/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>