<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="#" class="logo">
            <span>
                <!-- <img src="<?php //base_url('assets/img/logo.png');?>" alt="" height="24"> -->
                <p class="login-name">السلام عليكم ورحمة الله وبركاته<br/> 
                    <small><?= get_session("users_name");?></small>
                </p>
            </span>
            <i>
                <img src="<?=base_url('assets/img/logo-sm.png');?>" alt="" height="22">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="navbar-right d-flex list-inline float-right mb-0">
           <!--  <li class="dropdown notification-list d-none d-sm-block">
                <form role="search" class="app-search">
                    <div class="form-group mb-0"> 
                        <input type="text" class="form-control" placeholder="Search..">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form> 
            </li> -->

            
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?=base_url('assets/img/user.png');?>" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->
                        <a class="dropdown-item" href="#"><i class="mdi mdi-account-circle m-r-5"></i> Profile</a>
                        <a class="dropdown-item d-block" href="#"><i class="mdi mdi-settings m-r-5"></i> Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="<?=base_url('logout');?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>                                                                    
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect waves-light">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>