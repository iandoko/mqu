<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="portlet green-meadow box">
            <div class="portlet-title">
                <div class="caption">
                    Data Pembayaran
                </div>
            </div>
            <div class="portlet-body">
                <div class="row static-info">
                    <div class="col-md-12 value">
                        <table class="table table-hover table-light">

                            <tbody>
                            <tr>
                                <td colspan="5">Member Status &nbsp;
                                    <?php
                                    //print_r($group);
                                    if (isset($group[0]['status'])) { ?>
                                        <span class="btn blue hidden-print margin-bottom-5">JOINED</span>
                                    <?php } else { ?>
                                        <span class="btn red hidden-print margin-bottom-5">OPEN</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Member ID</span>
                                </td>
                                <td colspan="3">
                                    <?php echo $datas[0]['username']; ?>
                                </td>
                                <td>
                                    <span class="bold theme-font">Harga HQ</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Nama</span>
                                </td>
                                <td colspan="3">
                                    <?php echo $datas[0]['nama_lengkap']; ?>
                                </td>
                                <td>
                                    <?php if ($datas[0]['nama_group'] != '') {
                                        $harga = $datas[0]['harga_group'];
                                    } else {
                                        $harga = $datas[0]['harga'];
                                    } ?>
                                    Rp. <?php echo number_format($harga, 0, ',', '.'); ?>,-
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Jenis HQ</span>
                                </td>
                                <td colspan="3">
                                    <?php echo $datas[0]['nama_paket']; ?>
                                </td>
                                <td>
                                    <span class="bold theme-font">Sisa Pembayaran</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Nama HQ</span>
                                </td>
                                <td colspan="3">
                                    Sapi Bali 320 - 300 kg
                                </td>
                                <td>
                                    <?php if ($datas[0]['nama_group'] != '') {
                                        $sisa = $datas[0]['harga_group'] - $datas[0]['jumlah_pembayaran'];
                                    } else {
                                        $sisa = $datas[0]['harga'] - $datas[0]['jumlah_pembayaran'];
                                    } ?>
                                    Rp. <?php echo number_format($sisa, 0, ',', '.'); ?>,-
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Group Q</span>
                                </td>
                                <td colspan="3">
                                    <?php if ($datas[0]['nama_group'] != '') {
                                        echo $datas[0]['nama_group'];
                                    } else {
                                        echo '-';
                                    } ?>
                                </td>
                            </tr>

                            <tr>
                                <?php if ($sisa > 0) {
                                    $status = 'IN-PROCESS';
                                } else {
                                    $status = 'COMPLETED';
                                } ?>
                                <td colspan="5">Payment Status <span
                                        class="btn blue hidden-print margin-bottom-5"><?php echo $status; ?></span></td>
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
                Detail Pembayaran
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>
                            Transaksi
                        </th>
                        <th>
                            Tanggal
                        </th>
                        <th>
                            Jumlah (Rp.)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 0;
                    foreach ($details as $data):
                        ?>
                        <tr>
                            <td>
                                <?php if ($data['nama_pembayaran'] == 'Uang Muka') {
                                    echo $data['nama_pembayaran'];
                                } else {
                                    echo 'Setoran - ' . $i;
                                };?>
                            </td>

                            <td>
                                <?php echo date('d-M-Y', strtotime($data['tanggal_bayar']));?>
                            </td>
                            <td align="right">
                                 <?php echo number_format($data['jumlah_pembayaran'], 0, ',', '.');?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    endforeach ?>
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
                Total Pembayaran:
            </div>
            <div class="col-md-8 value">
                <?php echo number_format($datas[0]['jumlah_pembayaran'], 0, ',', '.'); ?>
            </div>
        </div>

    </div>
</div>

<div class="col-md-6 col-sm-12">
    <a class="btn btn-lg blue hidden-print margin-bottom-5" onclick="javascript:window.print();">
        Print <i class="fa fa-print"></i>
    </a>
</div>




