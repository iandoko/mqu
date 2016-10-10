<?php
class Sistem_m extends CI_Model
{
    //protected $_emailfrom = 'master@mail.localserver.com';

    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));
        $this->load->model(array('user_m','jbayar_m','parameter_m','pakettr_m'));
        $this->load->library('parser');
        $this->load->library('email');
    }
    public function send_mail($data,$from,$to,$format,$subject)
    {
        $config = array(
           'protocol' => 'mail',
            'protocol' => 'smtp', //for local
           // 'smtp_port' => 465,
            //'smtp_host' => 'ssl://smtp.gmail.com',
            //'smtp_user' => 'iandoko32@gmail.com',
            //'smtp_pass' => '*******',
            'smtp_host' => 'smtp.mail.localserver.com', //for local
            'smtp_user' => 'master@mail.localserver.com', // for local
           'smtp_pass' => 'P@ssw0rd', // for local
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE,
            'wrapchars'=> 200
        );

        $company = $this->parameter_m->get(1);
        $company = $company->value;
        $message = $this->parser->parse($format,$data,TRUE); ;

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");
        $this->email->from($from,$company); // change it to yours
        $this->email->to($to);// change it to yours
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }
    public function create_invoice_pendaftaran($member_id,$userid,$from_mail,$to_mail,$data_email)
    {

       $count = $this->db->count_all_results('invoice');
        $no_invoice = str_pad(($count + 1), 8, '0', STR_PAD_LEFT);
        $jbayar = $this->jbayar_m->get(1);
        $jbayar = $jbayar->nama_pembayaran;
        $data_inv = array (
            'no_invoice' => $no_invoice,
            'userid' => $userid,
            'created_time' => date('Y-m-d'),
            'status' => 'unpaid',
            'jenis_pembayaran' => $jbayar
        );
        $this->db->set($data_inv);
        $this->db->insert('invoice');
        $invoice_id = $this->db->insert_id();

        $query = $this->db->get_where('biaya_keanggotaan', array('jenis_memberid' => $member_id));
        $data_biaya = $query->result_array();

        foreach ($data_biaya as $item) {
            $data_order = array(
                'idinvoice' => $invoice_id,
                'detail_order' => $item['nama_biaya'],
                'quantity' => 1,
                'harga_order' => $item['jumlah_biaya'],
                'total_harga' => $item['jumlah_biaya']
            );

            $this->db->set($data_order);
            $this->db->insert('order');
        }

        $query = $this->db->query("SELECT sum(total_harga) as total FROM `order` WHERE idinvoice =".$invoice_id);
        $amount = $query->row();

        $data_update = array (
            'total' => $amount->total
        );

        $this->db->set($data_update);
        $this->db->where('idinvoice', $invoice_id);
        $this->db->update('invoice');

        $data_email_in = array(
            'nomer_invoice' => $no_invoice,
            'tanggal' => date('d M Y'),
            'total_pembayaran' =>  $amount->total
        );
        $data_email = array_merge ($data_email_in,$data_email);
        $this->send_mail($data_email,$from_mail,$to_mail,'invoice_html','Invoice Pendaftaran Keanggotaan PT. M-qu Indo Berkah');
    }

        public function undian () {
            $call_procedure = 'CALL `alter_tmpundian`()';
            $this->db->query($call_procedure);

        }

    public function create_invoice_klaim_undian($member_id,$userid,$from_mail,$to_mail,$data_email)
    {

        $count = $this->db->count_all_results('invoice');
        $no_invoice = str_pad(($count + 1), 8, '0', STR_PAD_LEFT);
        $jbayar = $this->jbayar_m->get(5);
        $jbayar = $jbayar->nama_pembayaran;
        $data_inv = array (
            'no_invoice' => $no_invoice,
            'userid' => $userid,
            'created_time' => date('Y-m-d'),
            'status' => 'paid',
            'jenis_pembayaran' => $jbayar
        );
        $this->db->set($data_inv);
        $this->db->insert('invoice');
        $invoice_id = $this->db->insert_id();

        $idtransaksi_undian = $data_email['idtransaksi_undian'];
        $data_transaksi = $this->undiantr_m->get($idtransaksi_undian);

        $detail_order = $data_transaksi->nama_paket;

            $data_order = array(
                'idinvoice' => $invoice_id,
                'detail_order' => 'Paket Undian : '. $detail_order,
                'quantity' => 1,
                'harga_order' => 0,
                'total_harga' => 0
            );

            $this->db->set($data_order);
            $this->db->insert('order');


        $query = $this->db->query("SELECT sum(total_harga) as total FROM `order` WHERE idinvoice =".$invoice_id);
        $amount = $query->row();

        $data_update = array (
            'total' => $amount->total
        );

        $this->db->set($data_update);
        $this->db->where('idinvoice', $invoice_id);
        $this->db->update('invoice');

        $data_email_in = array(
            'nomer_invoice' => $no_invoice,
            'tanggal' => date('d M Y'),
            'total_pembayaran' =>  'Gratis',
            'nama_paket' => $detail_order
        );
        $data_email = array_merge ($data_email_in,$data_email);
        $this->send_mail($data_email,$from_mail,$to_mail,'invoice_undian_html','Invoice Klaim Undian '.$detail_order);
    }
    public function create_invoice_order_paket($member_id,$userid,$from_mail,$to_mail,$data_email)
    {
        $user_detail = $this->user_m->get($userid);
        $count = $this->db->count_all_results('invoice');
        $no_invoice = "IQ-3".str_pad(($count + 1), 5, '0', STR_PAD_LEFT);
        $order = $this->pakettr_m->get($data_email['idtransaksi_paket']);
        $jbayar = $this->jbayar_m->get($order->jenis_pembayaran);
        $jbayar = $jbayar->nama_pembayaran;
//print_r($order);
        $data_inv = array(
            'no_invoice' => $no_invoice,
            'idtransaksi_paket' => $data_email['idtransaksi_paket'],
            'created_time' => date('Y-m-d'),
            'status' => 'unpaid',
            'jenis_pembayaran' => $jbayar,
            'due_date' => $order->est_tgl_pelunasan_um,
        );
        $this->db->set($data_inv);
        $this->db->insert('invoice');
        $invoice_id = $this->db->insert_id();
        if(!$order->idgroup) {
            $harga = $order->harga * $order->uang_muka;
        } else {
            $harga = $order->harga_group * $order->uang_muka;
        }
        $data_order = array(
            'idinvoice' => $invoice_id,
            'item' => 'Uang Muka '.($order->uang_muka*100).'% '.$order->nama_paket,
            'quantity' => 1,
            'harga' => $harga,
        );
        $this->db->set($data_order);
        $this->db->insert('invoice_detail');


        $query = $this->db->query("SELECT sum(harga) as total FROM `invoice_detail` WHERE idinvoice =".$invoice_id);
        $amount = $query->row();

        $data_update = array (
            'total' => $amount->total
        );

        $this->db->set($data_update);
        $this->db->where('idinvoice', $invoice_id);
        $this->db->update('invoice');

        $bank = $this->parameter_m->get(8);
        $bank = $bank->value;

        $bank_acc_name = $this->parameter_m->get(10);
        $bank_acc_name = $bank_acc_name->value;

        $bank_acc_no = $this->parameter_m->get(9);
        $bank_acc_no = $bank_acc_no->value;

        $data_email_in = array(
            'memberID' => $user_detail->username,
            'nomer_invoice' => $no_invoice,
            'tanggal' => date('d M Y'),
            'total_pembayaran' =>  number_format($amount->total, 0, ',', '.'),
            'jatuh_tempo_um' => date_format(date_create($order->est_tgl_pelunasan_um), 'd M Y'),
            'jatuh_tempo_order' => date_format(date_create($order->est_tgl_pelunasan_order), 'd M Y'),
            'tgl_pengiriman' => date_format(date_create($order->est_tgl_pengiriman), 'd M Y'),
            'nama_paket' => $order->nama_paket,
            'jenis_sapi' => $order->jenis_sapi,
            'range_berat' => $order->range_berat,
            'harga' => number_format($order->harga, 0, ',', '.'),
            'uang_muka' => ($order->uang_muka * 100),
            'jenis_pembayaran' => $order->nama_pembayaran,
            'harga_cicilan' => number_format($order->harga_cicilan, 0, ',', '.'),
            'periode_bayar' => $order->jumlah_cicilan,
            'bank' => $bank,
            'bank_acc_name' => $bank_acc_name,
            'bank_acc_no' => $bank_acc_no

        );
        $data_email = array_merge ($data_email_in,$data_email);
        $this->send_mail($data_email,$from_mail,$to_mail,'invoice_html','Invoice Uang Muka Order Paket '.$data_email['sitename'] );
    }

    function pagination($count,$perpage,$site_uri,$links_uri=2){
        if ($count > $perpage) {
            $this->load->library('pagination');
            $config['base_url'] = site_url($site_uri);
            $config['total_rows'] = $count;
            $config['per_page'] = $perpage;

            $config['use_page_numbers'] = TRUE;

            //config for bootstrap pagination class integration
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);
            $sub_data['pagination'] = $this->pagination->create_links();
            $multiply = (($this->uri->segment($links_uri)-1) < 0) ? 0 : ($this->uri->segment($links_uri)-1);
            $sub_data['offset'] = ($multiply * $perpage);

        } else {
            $sub_data['pagination'] = '';
            $sub_data['offset'] = 0;
        }
        return $sub_data;
    }

}