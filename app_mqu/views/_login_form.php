<div class="content">
    <?php echo form_open(base_url().'login/')?>
    <?php if($captcha_return || validation_errors() || $login_failed) { $display = ''; } else { $display = ' display-hide';}?>

    <div class="row margin-bottom-10">
     <img src="<?php echo base_url();?>images/logo.png" alt="" class="center-block"/>
    </div>
    <div class="alert alert-danger<?php echo $display;?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo $captcha_return?><?php echo validation_errors(); ?><?php echo $login_failed; ?></span>
    </div>
    <div class="form-group">
        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
        <label class="control-label visible-ie8 visible-ie9">Member ID</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Member ID" name="username" value="<?php echo set_value('username'); ?>"/>
    </div>
    <div class="form-group">
        <label class="control-label visible-ie8 visible-ie9">Password</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>"/>
    </div>
    <div class="form-group">

       <?php echo $cap_img; ?>

    </div>
    <div class="form-group">

        <label class="control-label visible-ie8 visible-ie9">Input Kode Diatas</label>
        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Input Kode Diatas" name="captcha" value=""/>

        </div>

    <div class="form-group">

        <input type="submit" value="Login" name="submit_login" class="btn red btn-block uppercase" />

    </div>
    <div class="form-group margin-top-10">
        <div class="clearfix"></div>
        <div class="col-md-6 padding-top-10px"></div>
        <div class="col-md-6"></div>
    </div>
    <div class="form-group margin-top-10">
    <?php echo anchor('daftar', 'Daftar','class="btn blue btn-block uppercase"');?></div>
    <?php echo form_close()?>
</div>
