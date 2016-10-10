<div class="row">
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
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
                            Member ID
                        </th>
                        <th>
                            Paket
                        </th>
                        <th>
                            Total Tagihan
                        </th>
                        <th>
                            Total Pembayaran
                        </th>
                        <th>
                            Group
                        </th>
                        <th>
                            Status
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
                                <?php echo $data['idorder'];?>
                            </td>
                            <td>
                                <?php echo $data['username'];?>
                            </td>
                            <td>
                                <?php echo $data['nama_paket'].' '.$data['jenis_sapi'].' '.$data['range_berat'].' kg';?>
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
                                <?php echo number_format($data['jumlah_pembayaran'], 0, ',', '.');?>
                            </td>
                            <td>
                                <?php echo $data['nama_group'];?>
                            </td>
                            <td>
                                <?php
                                if ($data['nama_group'] != '') {
                                   if ($data['harga_group'] == $data['jumlah_pembayaran']) {?>
                                       <span class="blue hidden-print margin-bottom-5">Ready for Q</span>
                                  <?php } else {?>
                                       <span class="yellow hidden-print margin-bottom-5">In Process</span>
                                  <?php }
                                } else {
                                    if ($data['harga'] == $data['jumlah_pembayaran']) {?>
                                        <span class="blue hidden-print margin-bottom-5">Ready for Q</span>
                                    <?php } else {?>
                                        <span class="yellow hidden-print margin-bottom-5">In Process</span>
                                    <?php }
                                }?>
                            </td>
                            <td>

                                <a class="btn blue hidden-print margin-bottom-5" href="<?php echo base_url();?>pembayaran/detail/<?php echo $data['idorder'];?>">
                                   Detail <i class="fa fa-check"></i>
                                </a>
                                <?php  if ($data['nama_group'] != '') {?>
                                   <a class="btn blue hidden-print margin-bottom-5" href="<?php echo base_url();?>pembayaran/group/<?php echo $data['idorder'];?>">
                                       Detail Group<i class="fa fa-check"></i>
                                   </a>
                            <?php }?>

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