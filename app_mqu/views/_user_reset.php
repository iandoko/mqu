<div>

    <?php echo form_open(base_url()."register/reset/".$useredit[0]->userid)?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Password Baru</div>
        <div>
            <input type="password" name="password" value="<?php echo set_value('password') ?>" />
        </div>
    </div>

    <div>
        <div>Konfirmasi Password Baru</div>
        <div>
            <input type="password" name="passconf" value="<?php echo set_value('passconf') ?>" />
        </div>
    </div>

    <input  type="hidden" name="userid" value="<?php echo $useredit[0]->userid; ?>"/>
    <div><input type="submit" value="Ganti" name="submit"/></div>

</div>
<?php echo form_close()?>


