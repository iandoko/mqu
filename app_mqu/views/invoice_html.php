<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Invoice Uang Muka No. {nomer_invoice}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="max-width: 600px; margin: 0; padding: 30px 0;">
    <table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="5%"></td>
            <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Yth. {nama_lengkap}</h2>
                Berikut kami sampaikan invoice uang muka order Hewan Qurban Anda, <br/>
                Dengan rincian sebagai berikut :<br />
                <br />
                <br />
                <table width="70%" border="1" cellpadding="2" cellspacing="0" style="font: normal 12px/14px Arial, Helvetica, sans-serif;">
                    <tr>
                        <td width="30%">Member ID</td>
                        <td><strong>{memberID}</strong></td>
                    </tr>
                <tr>
                    <td width="30%">No Invoice</td>
                    <td><strong>#{nomer_invoice}</strong></td>
                </tr>
                    <tr>
                        <td>Tanggal Order</td>
                        <td><strong>{tanggal}</strong></td>
                    </tr>
                    <tr>
                        <td>Tanggal Kirim</td>
                        <td><strong>{tgl_pengiriman}</strong></td>
                    </tr>
                    <tr>
                        <td>Paket</td>
                        <td><strong>{nama_paket}</strong></td>
                    </tr>

                    <tr>
                        <td>Jenis Hewan</td>
                        <td><strong>{jenis_sapi}</strong></td>
                    </tr>
                    <tr>
                        <td>Range Berat (Kg)</td>
                        <td><strong>{range_berat}</strong></td>
                    </tr>
                    <tr>
                        <td>Harga (Rp.)</td>
                        <td><strong>{harga}</strong></td>
                    </tr>
                    <tr>
                        <td>Uang Muka</td>
                        <td><strong>{uang_muka}%</strong></td>
                    </tr>
                    <tr>
                        <td>Jenis Pembayaran</td>
                        <td><strong>{jenis_pembayaran}</strong></td>
                    </tr>
                    <tr>
                        <td>Periode Bayar</td>
                        <td><strong>{periode_bayar} / @Rp. {harga_cicilan}</strong></td>
                    </tr>
                    <tr>
                        <td>Tgl Pelunasan Order</td>
                        <td><strong>{jatuh_tempo_order}</strong></td>
                    </tr>
                    <tr>
                        <td>Tagihan Uang Muka (Rp.)</td>
                        <td><strong>{total_pembayaran}</strong></td>
                    </tr>
                    <tr>
                        <td>Tgl Pelunasan Uang Muka</td>
                        <td><strong>{jatuh_tempo_um}</strong></td>
                    </tr>
                </table>
                <br />
                <br />
                Untuk Pembayaran Dapat di transfer ke:<br/>
                <strong>{bank}</strong><br/>
                No. Rekening  {bank_acc_no}<br/>
                An. {bank_acc_name} <br/>
                <br />
                Setelah melakukan pembayaran harap konfirmasi melalui aplikasi M-qu
                <br /><br /><br />


                <br />
                Salam,<br />
                Manajemen <strong>{sitename}</strong><br/>

                <img
                    src="{imgurl}"
                    alt="logo" class="logo-default">
            </td>
        </tr>
    </table>
</div>
</body>
</html>