<div>

    <?php echo form_open(base_url()."memberq/group_new/")?>
    <?php if(validation_errors()) { $display1 = ''; } else { $display1 = ' display-hide';}?>
    <?php
    $notifi = $this->session->flashdata('notification' );
    if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
    <div class="alert alert-danger<?php echo $display;?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo $this->session->flashdata('notification'); ?></span>
    </div>
    <div class="alert alert-danger<?php echo $display1;?>">
        <button class="close" data-close="alert"></button>
        <span><?php echo validation_errors(); ?></span>
    </div>

    <div class="panel-group">
        <div class="panel panel-warning">
            <div class="panel-heading"><strong>Syarat dan Ketentuan</strong></div>
            <div class="panel-body"> <?php echo $sk->value; ?></div>
        </div>
    </div>
    <div>
        <div style="padding-top: 5px;"><?php $data_checkbox = array(
                'name' => 'agree',
                'value' => '1'
            );
            echo form_checkbox($data_checkbox);
            ?> Saya setuju dengan syarat dan ketentuan diatas</div>

    </div>


    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Buat GroupQ','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>

</div>
<?php echo form_close()?>


