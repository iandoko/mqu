
    <?php echo form_open(base_url()."memberq/group_reg/".$groupid)?>
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
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="portlet green-meadow box">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs"></i>Detail Group
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-md-12 value">

                                <table class="table table-hover table-light">

                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Nama Group</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $detail[0]['nama_group'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Leader</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $detail[0]['nama_lengkap'];?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Lokasi</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $detail[0]['nama_kota'].', '.$detail[0]['nama_prop'];?>
                                        </td>
                                    </tr>
                                    </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
    <?php
       echo form_hidden('groupid', $groupid);?>

    <div style="padding-top: 10px;"><?php echo form_submit('submit', 'Gabung GroupQ','class="btn btn-small red hidden-print margin-bottom-5"'); ?> </div>


<?php echo form_close()?>


