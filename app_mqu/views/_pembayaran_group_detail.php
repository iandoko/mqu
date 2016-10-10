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
                                <td colspan="5">Status M-Qu &nbsp;
                                    <?php
                                        $sisa = $datas[0]['harga'] - $datas[0]['jumlah_pembayaran'];

                                    if ($sisa > 0) { ?>
                                        <span class="btn blue hidden-print margin-bottom-5">OPEN</span>
                                    <?php } else { ?>
                                        <span class="btn red hidden-print margin-bottom-5">READY FOR Q</span>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Group ID</span>
                                </td>
                                <td colspan="3">
                                    <?php echo $datas[0]['nama_group']; ?>
                                </td>
                                <td>
                                    <span class="bold theme-font">Harga HQ</span>
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
                                    Rp. <?php echo number_format($datas[0]['harga'], 0, ',', '.'); ?>,-
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Jatuh Tempo</span>
                                </td>
                                <td colspan="3">
                                    10/11/2016
                                </td>
                                <td>
                                    <span class="bold theme-font">Saldo Akhir</span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="bold theme-font">Tahun Program</span>
                                </td>
                                <td colspan="3">
                                    2017
                                </td>
                                <td>

                                    Rp. <?php echo number_format($datas[0]['jumlah_pembayaran'], 0, ',', '.'); ?>,-
                                </td>
                            </tr>
                            <tr>

                                <td colspan="4">

                                    <div class="progress-bar-wrapper">
                                        <span class="title">Progress Q &nbsp;&nbsp;</span><span class="percent"><?php echo number_format(intval($datas[0]['jumlah_pembayaran'])/intval($datas[0]['harga'])*100,2);?> % </span><br>
                                       <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo intval($datas[0]['jumlah_pembayaran'])/intval($datas[0]['harga'])*100;?>%;">
                                            <div class="progress-bar-inner"><span class="title">&nbsp;&nbsp;</span><span class="percent">&nbsp;&nbsp;</span>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                           </div>
                                    </div>
                                </td>
                                <td> <span class="bold theme-font">Sisa</span></td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="bold theme-font">Alamat Pengiriman</span>
                                </td>
                                <td colspan="3">
                                    Jl. ....
                                </td>
                                <td colspan="5">Rp. <?php echo number_format($sisa, 0, ',', '.'); ?>,-</td>
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
                            Member
                        </th>
                        <th>
                            Nama Anggota
                        </th>
                        <th>
                            Jumlah (Rp.)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $i = 0;
                    //print_r($details);
                    foreach ($details as $data):
                        ?>
                        <tr>
                            <td>
                                <?php echo $data['username'];?>
                            </td>

                            <td>
                                <?php echo $data['nama_lengkap'];?>
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




