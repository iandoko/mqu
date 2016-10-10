<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo base_url();?>parameter/diskon_insert/" class="btn green" id="sample_editable_1_new">
                                   Buat Group <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover" id="sample_1">
                    <thead>
                    <tr>
                        <th>
                            Nama Group
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
                    <?php foreach ($members as $member): ?>
                    <tr class="odd gradeX">
                        <td>
                            <?php echo $member['idgroup'];?>
                        </td>
                        <td>
                            <?php echo $member['userid'];?>
                        </td>
                        <td>
                            <?php echo $member['nama_paket'];?>
                        </td>
                        <td>
                            <?php echo $member['nama_paket'];?>
                        </td>
                        <td>
                            <?php echo date('d-m-Y H:i:s',strtotime($member['tanggal_kirim']));?>
                        </td>
                        <td>
                            <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>register/group_reg/<?php echo $member['idpromo'];?>">
                                Edit <i class="fa fa-check"></i>
                            </a>

                        </td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>