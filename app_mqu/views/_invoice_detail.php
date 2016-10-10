
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="portlet green-meadow box">
                <div class="portlet-title">
                    <div class="caption">
                        Billing Detail
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-md-12 value">
                            <table class="table table-hover table-light">

                                <tbody>
                            <?php if ($group) {?>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Nama Group</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $group->nama_group;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Leader</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $group->nama_lengkap;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Lokasi Pengiriman</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $group->alamat.' '.$group->no.' '.$group->rt.' '.$group->rw;?><br>
                                            <?php echo $group->nama_kota.', '.$group->nama_prop;?>
                                        </td>
                                    </tr>

                            <?php } ?>

                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Nama Customer</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $member['nama_lengkap'];?>
                                        </td>
                                    </tr>
                                    <?php if (!$group) {?>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Lokasi Pengiriman</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $member['alamat'].' '.$member['no'].' '.$member['rt'].' '.$member['rw'];?><br>
                                            <?php echo $member['nama_kota'].', '.$member['nama_prop'];?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr><td colspan="4"><span class="btn red hidden-print margin-bottom-5"><?php echo $datas[0]['status'];?></span></td></tr>
                                    </tbody>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-sm-12">
            <div class="portlet blue-hoki box">
                <div class="portlet-title">
                    <div class="caption">
                        Order Info
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row static-info">
                        <div class="col-md-12 value">


                                <table class="table table-hover table-light">

                                    <tbody>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Paket / Jenis Sapi / Berat</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $order->nama_paket.' ' .$order->jenis_sapi. ' ('.$order->range_berat.' kg)';?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Harga Paket / Group</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo number_format($order->harga, 0, ',', '.');
                                            if ($group) echo ' / '.number_format($order->harga_group, 0, ',', '.');
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Sistem Pembayaran</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo $order->nama_pembayaran;?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="bold theme-font">Est. Tgl. Pengiriman</span>
                                        </td>
                                        <td colspan="3">
                                            <?php echo date('d F Y',strtotime($order->est_tgl_pengiriman));?>
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
    <div class="col-md-12 col-sm-12">
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                <div class="caption">
                     Detail Tagihan
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>
                                Item
                            </th>
                            <th>
                                Harga
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th>
                                Total
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($datas as $data):
                            ?>
                        <tr>
                            <td>
                                <?php echo $data['item'];?>
                            </td>
                            <td>
                                <?php echo number_format($data['harga'], 0, ',', '.');?>
                            </td>
                            <td>
                                <?php echo $data['quantity'];?>
                            </td>
                            <td>
                                <?php echo number_format($data['total'], 0, ',', '.');?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="col-md-12 col-sm-12">
        <div class="well">
            <div class="row static-info align-reverse">
                <div class="col-md-4 name">
                    PPN:
                </div>
                <div class="col-md-8 value">
                    0
                </div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-4 name">
                    Grand Total:
                </div>
                <div class="col-md-8 value">
                    <?php echo number_format($data['total'], 0, ',', '.');?>
                </div>
            </div>
            <div class="row static-info align-reverse">
                <div class="col-md-4 name">
                    Pembayaran Transfer:
                </div>
                <div class="col-md-8 value">
                    <?php echo $bank;?><br>
                    <?php echo 'No. Rek. '.$bank_acc_no;?><br>
                    <?php echo 'A.n. '.$bank_acc_name;?>
                </div>
            </div>

        </div>
    </div>

        <div class="col-md-6 col-sm-12">
    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
        Print <i class="fa fa-print"></i>
    </a>
            </div>




