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
                                   Tambah Diskon <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;">
                                            Print </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            Save as PDF </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            Export to Excel </a>
                                    </li>
                                </ul>
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
                            Nama Diskon
                        </th>
                        <th>
                            Jenis Diskon
                        </th>
                        <th>
                            Besar Diskon
                        </th>
                        <th>
                            Nama Paket
                        </th>
                        <th>
                            Jenis Member
                        </th>
                        <th>
                            Jumlah Orang
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Tgl. Perubahan
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
                            <?php echo $member['nama_promo'];?>
                        </td>
                        <td>
                            <?php echo $member['jenis_diskon'];?>
                        </td>
                        <td>
                            <?php echo number_format($member['besar_diskon'], 0, ',', '.');?>
                        </td>
                        <td>
                            <?php echo $member['nama_paket'];?>
                        </td>
                        <td>
                            <?php echo $member['nama_member'];?>
                        </td>
                        <td>
                            <?php echo $member['group_ref'];?>
                        </td>
                        <td>
                            <?php if ($member['status'] == 1) {?>
                                <button class="btn btn-circle green-haze btn-sm" type="button">Aktif</button>
                            <?php } else {?>
                                <button class="btn btn-circle btn-danger btn-sm" type="button">Non Aktif</button>
                            <?php } ?>
                        </td>
                        <td>
                            <?php echo date('d-m-Y H:i:s',strtotime($member['time_created']));?>
                        </td>
                        <td>
                            <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>parameter/diskon/<?php echo $member['idpromo'];?>">
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