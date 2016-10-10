<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Invoice keanggotaan No. {nomer_invoice}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<body>
<div style="max-width: 600px; margin: 0; padding: 30px 0;">
    <table width="80%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td width="5%"></td>
            <td align="left" width="95%" style="font: 13px/18px Arial, Helvetica, sans-serif;">
                <h2 style="font: normal 20px/23px Arial, Helvetica, sans-serif; margin: 0; padding: 0 0 18px; color: black;">Yth. {nama_lengkap}</h2>
                Berikut kami sampaikan invoice hasil klaim undian anda, <br/>
                Paket <strong>{nama_paket}</strong><br/>
                Detail invoice sebagai berikut :<br />
                <br />
                <br />
                <table width="70%" border="1" cellpadding="2" cellspacing="0" style="font: normal 12px/14px Arial, Helvetica, sans-serif;">
                <tr>
                    <td width="30%">No Invoice</td>
                    <td><strong>#{nomer_invoice}</strong></td>
                </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td><strong>{tanggal}</strong></td>
                    </tr>
                    <tr>
                        <td>Total Tagihan</td>
                        <td><strong>{total_pembayaran}</strong></td>
                    </tr>
                </table>


                <br />
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