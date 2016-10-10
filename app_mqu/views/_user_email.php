<div>

    <?php echo form_open()?>
    <span><?php echo validation_errors() ?></span>

    <div>
        <div>Email Baru</div>
        <div>
            <input type="text" name="email" value="<?php echo set_value('email') ?>" />
        </div>
    </div>


    <input  type="hidden" name="userid" value="<?php echo $useredit[0]->userid; ?>"/>
    <div><input type="submit" value="Ganti" name="submit"/></div>

</div>
<?php echo form_close()?>


