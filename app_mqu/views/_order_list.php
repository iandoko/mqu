<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">

                <div class="col-md-6">
                    <div class="btn-group">
                        <a href="<?php echo base_url();?>order/paket/" class="btn green" id="sample_editable_1_new">
                            Order Paket <i class="fa fa-plus"></i>
                        </a>

                    </div>
                    <div class="btn-group">
                        <a href="<?php echo base_url();?>order/paket_group/" class="btn green" id="sample_editable_1_new">
                            Order Paket Group <i class="fa fa-plus"></i>
                        </a>

                    </div>
                </div>

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
                        <th>
                            No. Order
                        </th>
                        <th width="150">
                            Tanggal Order
                        </th>
                        <th>
                            Paket
                        </th>
                        <th>
                            Total Tagihan
                        </th>
                        <th>
                            Perkiraan Pengiriman
                        </th>
                        <th>
                            Metode Pembayaran
                        </th>
                        <th>
                            Uang Muka
                        </th>
                        <th>
                            Sisa Pembayaran (Tahapan)
                        </th>
                        <th>
                            Group
                        </th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                   if(count($datas) > 0) {
                    foreach ($datas as $data): ?>

                        <tr>
                            <td>
                                <?php echo $data['idtransaksi_paket'];?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($data['created_time']));?>
                            </td>
                            <td>
                                <?php echo $data['nama_paket'];?>
                            </td>

                            <td>
                                <?php
                                    if ($data['nama_group'] != '') {
                                        echo number_format($data['harga_group'], 0, ',', '.');
                                    } else {
                                        echo number_format($data['harga'], 0, ',', '.');
                                    }?>
                            </td>
                            <td>
                                <?php echo date('d-m-Y',strtotime($data['est_tgl_pengiriman']));?>
                            </td>

                            <td>
                                <?php echo $data['nama_pembayaran'];?>
                            </td>

                            <td>
                                <?php
                                if ($data['nama_group'] != '') {
                                    echo number_format(($data['uang_muka'] * $data['harga_group']), 0, ',', '.')." (" .($data['uang_muka']*100) ."%)";
                                } else {
                                    echo number_format(($data['uang_muka'] * $data['harga']), 0, ',', '.')." (" .($data['uang_muka']*100) ."%)";
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo number_format($data['harga_cicilan'], 0, ',', '.') . " (".$data['jumlah_cicilan'].")";?>
                            </td>
                            <td>
                                <?php echo $data['nama_group'];?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                   <?php }  else {?>
                       <tr class="odd gradeX">
                           <td colspan="8">Tidak Ada data</td>
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