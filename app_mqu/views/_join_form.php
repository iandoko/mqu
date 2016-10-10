<div>

    <?php echo form_open(base_url()."register/")?>
    <span><?php echo $captcha_return?><?php echo validation_errors() ?></span>

    <div>
        <div>Username / No. Keanggotaan</div>

        <div>
            <input type="text" name="username" value="<?php echo set_value('username') ?>" />
        </div>
    </div>

    <div>
        <div>Password</div>
        <div>
            <input type="password" name="password" value="<?php echo set_value('password') ?>" />
        </div>
    </div>

    <div>
        <div>Konfirmasi Password</div>
        <div>
            <input type="password" name="passconf" value="<?php echo set_value('passconf') ?>" />
        </div>
    </div>
    <div>
        <div>Email</div>
        <div>
            <input type="text" name="email" value="<?php echo set_value('email') ?>" />
        </div>
    </div>


    <?php
    $member_options = array();
        foreach($jenis_members as $jenis_member){
            $member_options[$jenis_member->memberid] = $jenis_member->nama_member;
    }
    echo "<td> Jenis member : " . form_dropdown('jenis_member', $member_options) . "</td>";
    ?>
    <?php if($status == 0) {?>
    <div>
        Input Kode Captcha<br /><br />

        <?php echo $cap_img; ?>
        <input  type="text" name="captcha" value=""/>
    </div>
    <?php }?>
    <input  type="hidden" name="status" value="<?php echo $status; ?>"/>
    <div><input type="submit" value="Submit" name="submit"/></div>

</div>
<?php echo form_close()?>


