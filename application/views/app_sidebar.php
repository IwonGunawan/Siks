<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <?php
            $whoIsLogin = whoIsLogin();
            ?>


            <ul class="metismenu" id="side-menu">
                <li class="active">
                    <a href="<?=base_url('home');?>" class="waves-effect">
                        <i class="mdi mdi-home"></i><span> Home </span>
                    </a>
                </li>

                <?php if($whoIsLogin == config("LEVEL_ADMIN")){ ?>
                <li class="menu-title">Data Master</li>
                <li>
                    <a href="<?=base_url('guru');?>" class="waves-effect">
                        <i class="mdi mdi-account-settings"></i><span> Data Ustadz </span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('santri');?>" class="waves-effect">
                        <i class="mdi mdi-account-multiple"></i><span> Data Santri </span>
                    </a>
                </li>
                <?php } ?>

                <?php if($whoIsLogin == config("LEVEL_ADMIN")|| $whoIsLogin == config("LEVEL_USTADZ")) { ?>  
                <li class="menu-title">Aktivitas</li>
                <li>
                    <a href="<?=base_url('tahfidz');?>" class="waves-effect">
                        <i class="mdi mdi-barcode-scan"></i><span> Nilai Tahfidz </span>
                    </a>
                </li>
                <li>
                    <a href="<?=base_url('pelanggaran');?>" class="waves-effect">
                        <i class="mdi mdi-file-plus"></i><span> Pencatatan Sanksi </span>
                    </a>
                </li>

                <li class="menu-title">Laporan</li>
                <li>
                    <a href="<?=base_url('page_not_found');?>" class="waves-effect">
                        <i class="mdi mdi-chart-bar-stacked"></i><span>Laporan Nilai Tahfidz </span>
                    </a>
                </li> 
                <li>
                    <a href="<?=base_url('page_not_found');?>" class="waves-effect">
                        <i class="mdi mdi-chart-pie"></i><span>Laporan Perkembangan Santri</span>
                    </a>
                </li>
                <?php } ?>

                <?php if($whoIsLogin == config("LEVEL_ADMIN")) { ?>
                <li class="menu-title">Settings</li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="mdi mdi-calendar-multiple"></i><span> Tahun Ajaran </span>
                    </a>
                </li>
                <li>
                    <a href="#" class="waves-effect">
                        <i class="mdi mdi-settings"></i><span> Management User</span>
                    </a>
                </li>  
                <?php } ?> 

                <?php if($whoIsLogin == config("LEVEL_SANTRI")){ ?>
                <li class="menu-title">Laporan</li>
                <li>
                    <a href="<?=base_url('page_not_found');?>" class="waves-effect">
                        <i class="mdi mdi-chart-bar-stacked"></i><span>Nilai Tahfidz </span>
                    </a>
                </li> 
                <li>
                    <a href="<?=base_url('page_not_found');?>" class="waves-effect">
                        <i class="mdi mdi-chart-pie"></i><span>Perkembangan Sikap</span>
                    </a>
                </li>
                <?php } ?>
            </ul>

        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>