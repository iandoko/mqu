<?php
class Parameter_data extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->library(array('session'));
    }

    public function get_paket() {
        return  $this->db->get('paket')->result();
    }

    public function poin_list($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM poin ORDER BY nama_poin' );
            return $query->result_array();
        }

        $query = $this->db->get_where('poin', array('idpoin' => $id));
        return $query->row();
    }
    public function poin_update($id)
    {
        $nmPoin = $this->input->post('nama_poin');
        $jmlPoin  = $this->input->post('jumlah_poin');
        $jnsPoin = $this->input->post('jenis_poin');

        $data = array (
            'nama_poin' => $nmPoin,
            'jumlah_poin'  => $jmlPoin,
            'jenis_poin'=> $jnsPoin
        );
        $this->db->where('idpoin', $id);
        $this->db->update('poin', $data);

    }

    public function paket_list($id = 0)
    {
        if ($id === 0)
        {
            $this->db->from('paket');

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('paket', array('paketid' => $id));
        return $query->row();
    }
    public function paket_update($id)
    {
        $nmPaket = $this->input->post('nama_paket');
        $detail  = $this->input->post('content',true);
        $harga = $this->input->post('harga');
        $harga_group = $this->input->post('harga_group');
        $jenis_sapi = $this->input->post('jenis_sapi');
        $range_berat = $this->input->post('range_berat');
        $hpp = $this->input->post('hpp');
        $status = $this->input->post('status');

        $data = array (
            'nama_paket' => $nmPaket,
            'detail'  => $detail,
            'harga'=> $harga,
            'harga_group'=> $harga_group,
            'jenis_sapi' => $jenis_sapi,
            'range_berat' => $range_berat,
            'hpp' => $hpp,
            'status'=> $status,
            'time_created' => date('Y-m-d H:i:s')
        );
        $this->db->where('paketid', $id);
        $this->db->update('paket', $data);

    }
    public function paket_insert()
    {
        $nmPaket = $this->input->post('nama_paket');
        $detail  = $this->input->post('content',true);
        $harga = $this->input->post('harga');
        $harga_group = $this->input->post('harga_group');
        $jenis_sapi = $this->input->post('jenis_sapi');
        $range_berat = $this->input->post('range_berat');
        $hpp = $this->input->post('hpp');
        $status = $this->input->post('status');

        $data = array (
            'nama_paket' => $nmPaket,
            'detail'  => $detail,
            'harga'=> $harga,
            'harga_group'=> $harga_group,
            'jenis_sapi' => $jenis_sapi,
            'range_berat' => $range_berat,
            'hpp' => $hpp,
            'status'=> $status,
            'time_created' => date('Y-m-d H:i:s')
        );
        $this->db->insert('paket',$data);
    }
    public function paket_delete($id)
    {
        $this->db->where('paketid', $id);
        $this->db->delete('paket');
    }

    public function diskon_list($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM promo_list');
            return $query->result_array();
        }

        $query = $this->db->get_where('promo_list', array('idpromo' => $id));
        return $query->row();
    }

    public function diskon_update($id)
    {
        $nmPromo = $this->input->post('nama_promo');
        $jnsDiskon  = $this->input->post('jenis_diskon',true);
        $bsrDiskon = $this->input->post('besar_diskon');
        $paketid = $this->input->post('paketid');
        $status = $this->input->post('paketid');
        $jnsMember = $this->input->post('memberid');
        $grpRef = $this->input->post('group_ref');

        $data = array (
            'nama_promo' => $nmPromo,
            'jenis_diskon'  => $jnsDiskon,
            'besar_diskon'=> $bsrDiskon,
            'paket_paketid' => $paketid,
            'status'=> $status,
            'time_created' => date('Y-m-d H:i:s'),
            'jenis_member_memberid' => $jnsMember,
            'group_ref' => $grpRef
        );
        $this->db->where('idpromo', $id);
        $this->db->update('promo', $data);

    }
    public function diskon_insert($id)
    {
        $nmPromo = $this->input->post('nama_promo');
        $jnsDiskon  = $this->input->post('jenis_diskon',true);
        $bsrDiskon = $this->input->post('besar_diskon');
        $paketid = $this->input->post('paketid');
        $status = $this->input->post('paketid');
        $jnsMember = $this->input->post('memberid');
        $grpRef = $this->input->post('group_ref');

        $data = array (
            'nama_promo' => $nmPromo,
            'jenis_diskon'  => $jnsDiskon,
            'besar_diskon'=> $bsrDiskon,
            'paket_paketid' => $paketid,
            'status'=> $status,
            'time_created' => date('Y-m-d H:i:s'),
            'jenis_member_memberid' => $jnsMember,
            'group_ref' => $grpRef
        );
        $this->db->insert('promo',$data);
    }

    public function undian_list($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM undian_list');
            return $query->result_array();
        }

        $query = $this->db->get_where('undian_list', array('idundian' => $id));
        return $query->row();
    }
    public function target_list($id = 0)
    {
        if ($id === 0)
        {
            $query = $this->db->query('SELECT * FROM target_member_list');
            return $query->result_array();
        }

        $query = $this->db->get_where('target_member_list', array('idtarget_member' => $id));
        return $query->row();
    }

    public function hewan_list($id = 0)
    {
        if ($id === 0)
        {
            $this->db->from('jenis_hewan');

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('jenis_hewan', array('id_hewan' => $id));
        return $query->row();
    }

    public function range_list($id = 0)
    {
        if ($id === 0)
        {
            $this->db->from('range_berat');

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where('range_berat', array('idRange' => $id));
        return $query->row();
    }
}