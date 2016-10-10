<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light">
            <div class="portlet-title">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a href="<?php echo base_url();?>parameter/paket_insert/" class="btn green" id="sample_editable_1_new">
                                   Tambah Paket <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="btn-group pull-right">
                                <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:window.print();">
                                            Print </a>
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
                            Nama Paket
                        </th>
                        <th>
                            Detail
                        </th>
                        <th>
                            Harga /Ekor
                        </th>
                        <th>
                            Harga Group /Orang
                        </th>
                        <th>
                            Range Berat (kg)
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
                            <?php echo $member['nama_paket'];?>
                        </td>
                        <td>
                            <?php echo $member['detail'];?>
                        </td>
                        <td>
                            <?php echo number_format($member['harga'], 0, ',', '.');?>
                        </td>
                        <td>
                            <?php echo number_format($member['harga_group'], 0, ',', '.');?>
                        </td>
                        <td>
                            <?php echo $member['range_berat'];?>
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
                            <a class="btn green hidden-print margin-bottom-5" href="<?php echo base_url();?>parameter/paket/<?php echo $member['paketid'];?>">
                                Edit <i class="fa fa-check"></i>
                            </a>
                            <a class="btn red hidden-print margin-bottom-5" href="<?php echo base_url();?>parameter/paket_hapus/<?php echo $member['paketid'];?>" onclick="return confirm('Hapus Data?')">
                                Hapus <i class="fa fa-check"></i>
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