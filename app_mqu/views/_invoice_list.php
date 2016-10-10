<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
            </div>
            <?php
            $notifi = $this->session->flashdata('pesan' );
            if(isset($notifi)) { $display = ''; } else { $display = ' display-hide';}?>
            <div class="alert alert-danger<?php echo $display;?>">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('pesan'); ?></span>
            </div>
            <div class="portlet-body flip-scroll">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed flip-content">
                    <thead class="flip-content">
                    <tr>
                        <th width="150">
                            No Invoice
                        </th>
                        <th>
                            Item
                        </th>
                        <th>
                            Jatuh Tempo
                        </th>
                        <th>
                            Besar Tagihan
                        </th>
                        <th>
                            Proses
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                   if(count($datas) > 0) {
                    foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['no_invoice'];?>
                            </td>
                            <td>
                                <?php echo $data['item'];?>
                            </td>

                            <td>
                                <?php echo date('d-m-Y',strtotime($data['created_time']));?>
                            </td>
                            <td>
                                <?php echo number_format($data['total'], 0, ',', '.');?>
                            </td>
                            <td>
                                <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>invoice/detail/<?php echo $data['idinvoice'];?>">
                                    Detail <i class="fa fa-check"></i>
                                </a>
                                <?php

                                if($data['status'] == 'unpaid') {
                                    if ($memberid != 1 ) {?>
                                <a class="btn red hidden-print margin-bottom-5" href="<?php echo base_url();?>invoice/konfirm/<?php echo $data['idinvoice'];?>">
                                    Konfirmasi Pembayaran <i class="fa fa-check"></i>
                                </a>
                            <?php }}  else { ?>
                                    <span class="btn red hidden-print margin-bottom-5">PAID</span>
                            <?php }?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                   <?php }  else {?>
                       <tr class="odd gradeX">
                           <td colspan="6">Tidak Ada data</td>
                       </tr>
                   <?php }?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <?php if($pagination): ?>
            <div class="row">
                <div class="col-md-12 text-center">
                    <?php echo $pagination; ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- END SAMPLE TABLE PORTLET-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
    </div>
</div>