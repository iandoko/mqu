<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Konfirmasi Penerimaan Pembayaran</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="max-width: 600px; margin: 0; padding: 30px 0;">
    <table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="5%"></td>
            <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                Pembayaran anda dengan detail tersebut dibawah. <br/>
                <br/>
                Sudah Kami terima
                <br/>
                <table width="60%" border="1" cellpadding="2" cellspacing="0"
                       style="font: normal 12px/14px Arial, Helvetica, sans-serif;">
                    <tr>
                        <td width="60%">No Anggota / Username:</td>
                        <td><strong>{username}</strong></td>
                    </tr>
                    <tr>
                        <td>Order ID:</td>
                        <td><strong>#{idorder}</strong></td>
                    </tr>
                    <tr>
                        <td>Jenis Pembayaran:</td>
                        <td><strong>{nama_pembayaran}</strong></td>
                    </tr>
                    <tr>
                        <td>Jumlah Pembayaran:</td>
                        <td><strong>{jumlah_pembayaran}</strong></td>
                    </tr>
                    <tr>
                        <td>Tgl. Pembayaran:</td>
                        <td><strong>{tanggal_bayar}</strong></td>
                    </tr>
                    <tr>
                        <td>Jam Pembayaran:</td>
                        <td><strong>{waktu_bayar}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Bank Pembayar:</td>
                        <td><strong>{nama_bank}</strong></td>
                    </tr>
                    <tr>
                        <td>No. Rek. Bank Pembayar:</td>
                        <td><strong>{no_rek_bayar}</strong></td>
                    </tr>
                    <tr>
                        <td>Nama Rek. Bank Pembayar:</td>
                        <td><strong>{nama_rek_bayar}</strong></td>
                    </tr>
                </table>
                <br/>
                <br/>
                Untuk detailnya silahkan cek laporan anda

                <br/>
                <br/>

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