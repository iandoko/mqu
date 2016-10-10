<?php
class Profile_m extends CI_Model
{
    protected $_table_name = 'user_profile';
    protected $_table_view = 'member_list';
    protected $_key = 'profileid';
    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array('html','url','form'));

    }
    public $rules = array(
        'nama_lengkap' => array(
            'field' => 'nama_lengkap',
            'label' => 'Nama Lengkap',
            'rules' => 'trim|required'
        ),


        /*'nomor_ktp' => array(
            'field' => 'nomor_ktp',
            'label' => 'No. KTP',
            'rules' => 'trim|required'
        ),*/
       /* 'tempat_lahir' => array(
            'field' => 'tempat_lahir',
            'label' => 'Tempat Lahir',
            'rules' => 'trim|required'
        ),
        'tanggal_lahir' => array(
            'field' => 'tanggal_lahir',
            'label' => 'Tanggal Lahir',
            'rules' => 'trim|required'
        ),
        'jenis_kelamin' => array(
            'field' => 'jenis_kelamin',
            'label' => 'Jenis Kelamin',
            'rules' => 'trim|required'
        ),
        'alamat' => array(
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'trim|required'
        ),
        'kabupaten_kota' => array(
            'field' => 'kabupaten_kota',
            'label' => 'Kabupaten / Kota',
            'rules' => 'trim|required'
        ),*/
        'no_handphone' => array(
            'field' => 'no_handphone',
            'label' => 'Nomer HP',
            'rules' => 'trim|required'
        ),
        'alamat' => array(
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'trim|required'
        ),

    );
    public function get($id = 0)
    {
        if ($id === 0)
        {

            $this->db->from($this->_table_view);

            $query = $this->db->get();
            return $query->result_array();
        }

        $query = $this->db->get_where($this->_table_view, array($this->_key => $id));
        return $query->row();
    }


    public function get_new ()
    {
        $data = new stdClass();
        $data->nama_lengkap = $this->input->post('nama_lengkap');
        $data->nomor_ktp = $this->input->post('nomor_ktp');
        $data->nama_ayah_kandung = $this->input->post('nama_ayah_kandung');
        $data->tempat_lahir = $this->input->post('tempat_lahir');
        $data->tanggal_lahir = $this->input->post('tanggal_lahir');
        $data->umur = $this->input->post('umur');
        $data->jenis_kelamin = $this->input->post('jenis_kelamin');
        $data->kewarganegaraan = $this->input->post('kewarganegaraan');
        $data->alamat = $this->input->post('alamat');
        $data->no = $this->input->post('no');
        $data->rt = $this->input->post('rt');
        $data->rw = $this->input->post('rw');
        $data->desa_kelurahan = $this->input->post('desa_kelurahan');
        $data->kecamatan = $this->input->post('kecamatan');
        $data->kabupaten_kota = $this->input->post('kabupaten_kota');
        $data->propinsi = $this->input->post('propinsi');
        $data->kodepos = $this->input->post('kodepos');
        $data->no_handphone = $this->input->post('no_handphone');
        $data->pendidikan = $this->input->post('pendidikan');
        $data->pekerjaan = $this->input->post('pekerjaan');
        $data->nama_perusahaan = $this->input->post('nama_perusahaan');
        $data->hubunganmahram = $this->input->post('hubunganmahram');
        $data->golongan_darah = $this->input->post('golongan_darah');
        $data->ciri_rambut = $this->input->post('ciri_rambut');
        $data->ciri_alis = $this->input->post('ciri_alis');
        $data->ciri_hidung = $this->input->post('ciri_hidung');
        $data->ciri_tinggi = $this->input->post('ciri_tinggi');
        $data->ciri_berat = $this->input->post('ciri_berat');
        $data->ciri_muka = $this->input->post('ciri_muka');
        $data->merokok = $this->input->post('merokok');
        $data->rekomender_userid = $this->input->post('rekomender_userid');
        $data->pas_foto = '';
        return $data;
    }

    public function save($data,$id = NULL){

        // Insert
        if ($id === NULL) {
            !isset($this->_key) || $this->_key = NULL;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
        }
        // Update
        else {
            $this->db->set($data);
            $this->db->where($this->_key, $id);
            $this->db->update($this->_table_name);
        }

    }

}