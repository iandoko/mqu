<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo base_url();?>memberq/group_new/" class="btn green" id="sample_editable_1_new">
                                   Buat GroupQ <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="portlet-title">
                <div class="col-md-12">
                <?php echo form_open()?>
                <div class="form-group">
                    <label class="col-md-1 control-label">Kategori</label>
                    <div class="col-md-3">
                        <div class="input-icon">
                            <?php $options = array(
                                'nama_group'  => 'GroupQ',
                                'nama_lengkap'  => 'Leader',
                                'area'  => 'Area',
                            );

                            echo form_dropdown('kategori_s',$options,$cat,'class="form-control input-small"');?>

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-1 control-label">Pencarian</label>
                    <div class="col-md-3">
                        <div class="input-icon">
                            <?php echo form_input('keywords',$keywords,'class="form-control" placeholder="kata kunci"');?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                        <?php echo form_submit('submit', 'cari','class="btn btn-small red margin-bottom-5"'); ?>
                </div>
                <?php echo form_close()?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>
                            Nama GroupQ
                        </th>
                        <th>
                            Member
                        </th>
                        <th>
                            Leader
                        </th>
                        <th>
                            Area
                        </th>
                        <th>
                            Tgl Group Aktif
                        </th>
                        <th>
                            Proses
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($members) > 0) {
                     foreach ($members as $member) { ?>
                         <tr class="odd gradeX">
                         <td>
                             <?php echo $member['nama_group']; ?>
                         </td>
                         <td>
                             <?php echo $member['jumlah']; ?>
                         </td>
                         <td>
                             <?php echo $member['nama_lengkap']; ?>
                         </td>
                         <td>
                             <?php echo $member['nama_kota'] . ', ' . $member['nama_prop']; ?>
                         </td>
                         <td>
                             <?php echo date('d-m-Y', strtotime($member['tgl_create'])); ?>
                         </td>
                         <td>
                         <?php
                         if ($proses) {
                         if ($member['idgroup'] == $proses[0]->idgroup) {

                             if ($proses[0]->status == 1) { ?>
                             <a class="btn blue hidden-print margin-bottom-5"
                                href="<?php echo base_url(); ?>pembayaran/group/<?php echo $member['idgroup']; ?>">
                                     On Group
                                 </a><?php }
                             if ($proses[0]->status == 0) { ?>
                                 <a class="btn yellow hidden-print margin-bottom-5" href="#">
                                     Proses Approval
                                 </a><?php } ?>
                         <?php }
                     } else { ?>
                                <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>memberq/group_reg/<?php echo $member['idgroup'];?>">
                                    Join <i class="fa fa-check"></i>
                                </a>
                             <?php }?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } else {?>
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
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>