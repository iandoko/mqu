<div class="row">
    <div class="col-md-12">
        <script type="text/javascript">
            function pilih(id,par) {
                window.opener.document.getElementById("paket_paketid").value = id;
                window.opener.document.getElementById("nama_paket").value = par;
                window.close();

            }
        </script>
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                    <?php echo form_open()?>
                    <div class="form-group">
                        <label class="col-md-1 control-label">Jenis Hewan</label>
                        <div class="col-md-2">
                            <div class="input-icon">
                                <?php  $options = array();
                                $options['All'] = '----All----';
                                foreach($jenis_ops as $jenis_op){
                                    $options[$jenis_op['nama_hewan']] = $jenis_op['nama_hewan'];
                                }

                                echo form_dropdown('jenis_s',$options,$jenis,'class="form-control input-medium"');?>

                            </div>
                        </div>

                    </div>
                <div class="form-group">
                    <?php echo form_submit('submit', 'cari','class="btn btn-small red margin-bottom-5"'); ?>
                </div>
                    <?php echo form_close()?>

            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-condensed">
                    <thead>
                    <tr>
                        <th width="30%">
                            Nama Paket
                        </th>
                        <th>
                            Deskripsi
                        </th>

                    </thead>
                    <tbody>
                    <?php if(count($datas) > 0) {
                  foreach ($datas as $data){?>

                        <tr>
                            <td>
                                <?php echo $data['nama_paket'];?><br>
                                <a href="javascript:void(0);" onclick="pilih('<?php echo $data['paketid'];?>','<?php echo $data['nama_paket'];?>')"  class="label label-sm label-danger">Pilih</a>
                            </td>
                            <td>
                                <?php echo 'Harga : Rp. '.number_format($data['harga'], 0, ',', '.');?><br>
                                <?php echo 'Harga Group / user: @Rp. '.number_format($data['harga_group'], 0, ',', '.');?><br>
                                Jenis Hewan : <?php echo  $data['jenis_sapi'];?> <?php echo $data['detail'];?><br>
                                Range Berat : <?php echo  $data['range_berat'];?> kg

                            </td>
                        </tr>
                    <?php }} else { ?>
                        <tr class="odd gradeX">
                            <td colspan="6">Tidak Ada data</td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
                </div>
                <?php if($pagination): ?>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
        <!-- BEGIN SAMPLE TABLE PORTLET-->
    </div>
</div>