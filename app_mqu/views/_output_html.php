<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8">
    <title>M-qu Indo Berkah - investasi hewan ternak | Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta content="" name="description">
    <meta content="" name="author">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=all" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE STYLES -->
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url();?>assets/admin/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/select2/select2.css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <!-- DOC: To use 'rounded corners' style just load 'components-rounded.css' stylesheet instead of 'components.css' in the below style tag -->
    <link href="<?php echo base_url();?>assets/global/css/components-rounded.css" id="style_components" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/global/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color">
    <link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css" rel="stylesheet" type="text/css">
    <!-- END THEME STYLES -->
    <script src="<?php echo base_url();?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <link rel="shortcut icon" href="<?php echo base_url();?>favicon.ico">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <div class="row">
                    <div class="col-md-4">
                <a href="<?php echo base_url();?>"><img src="<?php echo base_url();?>images/logo.png" alt="logo" height="70"></a>
                    </div>
                </div>
            </div>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                           <?php if($user['pas_foto']) {?>
                               <img alt="" class="img-circle" src="<?php echo base_url().'images/profile/'.$user['pas_foto'];?>#">
                               <?php } else {?>
                               <img alt="" class="img-circle" src="<?php echo base_url();?>images/profile/no-images.png">
                            <?php }?>
                            <span class="username username-hide-mobile"><?php echo $username;?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?php echo base_url().'login/logout/';?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <!-- BEGIN HEADER SEARCH BOX -->

            <!-- END HEADER SEARCH BOX -->
            <!-- BEGIN MEGA MENU -->
            <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
            <div class="hor-menu">
                <ul class="nav navbar-nav">
                    <li<?php if ($this->uri->segment(1) == 'member_area' ) echo ' class="active"';?>>
                        <a href="<?php echo base_url();?>">Dashboard</a>
                    </li>
                    <li class="menu-dropdown mega-menu-dropdown<?php if ($this->uri->segment(1) == 'member' || $this->uri->segment(1) == 'register' ) echo ' active';?>">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                            Member<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($jmember->memberid != 1 ) { ?><li><?php echo anchor('member/detail/'.$userid, '<i class="icon-pin"></i> Profile','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid == 1 ) { ?><li><?php echo anchor('member', '<i class="icon-pin"></i> Listing Anggota','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid == 1 ) { ?><li><?php echo anchor('member', '<i class="icon-pin"></i> Listing Group','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid == 1 ) { ?><li><?php echo anchor('register', '<i class="icon-pin"></i> Tambah User','class="iconify"');?></li><?php }?>
                            <li><?php echo anchor('memberq/', '<i class="icon-pin"></i> GroupQ','class="iconify"');?></li>
                            <li><?php echo anchor('register/reset/'.$userid, '<i class="icon-pin"></i> Ganti Password','class="iconify"');?></li>
                            <li><?php echo anchor('register/email/'.$userid, '<i class="icon-pin"></i> Ganti Email','class="iconify"');?></li>

                        </ul>

                    </li>

                    <li class="menu-dropdown mega-menu-dropdown">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                            Layanan M-Qu<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($jmember->memberid >0 ) { ?><li><?php echo anchor('order', '<i class="icon-pin"></i> List Order','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid > 1 ) { ?><li><?php echo anchor('order/paket', '<i class="icon-pin"></i> Order Paket Individu','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid > 1 ) { ?><li><?php echo anchor('order/paket_group', '<i class="icon-pin"></i> Order Paket Group','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid > 0 ) { ?><li><?php echo anchor('invoice/', '<i class="icon-pin"></i> Invoice','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid != 1 ) { ?><li><?php echo anchor('invoice/konfirm', '<i class="icon-pin"></i> Konfirmasi Pembayaran','class="iconify"');?></li><?php }?>
                            <?php if ($jmember->memberid == 1 ) { ?><li><?php echo anchor('konfirmasi/', '<i class="icon-pin"></i> Konfirmasi Pembayaran','class="iconify"');?></li><?php }?>
                        </ul>
                    </li>
                    <?php if ($jmember->memberid == 1 ) { ?> <li class="menu-dropdown mega-menu-dropdown<?php if ($this->uri->segment(1) == 'parameter') echo ' active';?>">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                            Parameter<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor('parameter', '<i class="icon-pin"></i> Konfigurasi','class="iconify"');?></li>
                            <li><?php echo anchor('parameter/jbayar', '<i class="icon-pin"></i> Jenis Pembayaran','class="iconify"');?></li>
                            <li><?php echo anchor('parameter/paket', '<i class="icon-pin"></i> Paket','class="iconify"');?></li>
                        </ul>
                    </li><?php }?>
                    <li class="menu-dropdown mega-menu-dropdown">
                        <a data-hover="megamenu-dropdown" data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                            Laporan<i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor('pembayaran', '<i class="icon-pin"></i> Pembayaran','class="iconify"');?></li>

                        </ul>
                    </li>

                </ul>
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<?php //echo $menu_top; ?>


<!-- BEGIN PAGE CONTAINER -->
<div class="page-container">
    <!-- BEGIN PAGE HEAD -->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1><?php echo $title?></h1>
            </div>
            <!-- END PAGE TITLE -->

        </div>
    </div>
    <!-- END PAGE HEAD -->
    <!-- BEGIN PAGE CONTENT -->
    <div class="page-content">
        <div class="container">

            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="row margin-top-10">
                <div class="col-md-12 col-sm-12">
                    <?php echo $body; ?>
                </div>

            </div>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="container">
        2015 - <?php echo date('Y') ;?>© CV. M-qu Indo Berkah - investasi hewan ternak App.
    </div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS (Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript" ></script>
<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/components-pickers.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/admin/pages/scripts/form-wizard.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core componets
        Layout.init(); // init layout
        Tasks.initDashboardWidget(); // init tash dashboard widget
        ComponentsPickers.init();
        FormWizard.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>

<!-- END BODY -->
</html>