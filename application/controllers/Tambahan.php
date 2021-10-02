<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // $this->load->model('m_data');
        $this->load->model('My_model', 'm');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = 'Kategori';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('tambahan/kategori');
        $this->load->view('templates/footer');
    }

    public function ambildata()
    {
        $dataBarang = $this->m->ambildata('kategori')->result();
        echo json_encode($dataBarang);
    }

    public function tambahkategori()
    {
        $result = [
            $this->form_validation->set_rules('judul_kategori', 'Judul Kategori', 'required|trim|min_length[3]', ['required' => '%s tidak boleh kosong!', 'min_length' => '%s minimal 3 karakter'])
        ];

        if ($this->form_validation->run() == false) {
            $result['pesan'] =  form_error('judul_kategori', '<div class="alert alert-danger" role="alert">', '</div>');
        } else {
            $judul_kategori = $this->input->post('judul_kategori');
            $data = array(
                'judul_kategori' => $judul_kategori
            );
            $this->m->tambahdata($data, 'kategori');
        }
        echo json_encode($result);
    }

    public function ambilId()
    {
        $id_kategori = $this->input->post('id_kategori');
        $where = array('id_kategori' => $id_kategori);
        $dataBarang = $this->m->ambilId('kategori', $where)->result();

        echo json_encode($dataBarang);
    }

    public function ubahdata()
    {
        $id_kategori = $this->input->post('id_kategori');
        $judul_kategori = $this->input->post('judul_kategori');

        if ($judul_kategori == '') {
            $result['pesan'] = "Judul Kategori harus diisi";
        } else {
            $result['pesan'] = "";
            $where = array(
                'id_kategori' => $id_kategori
            );
            $data = array(
                'judul_kategori' => $judul_kategori,
            );

            $this->m->updatedata($where, $data, 'kategori');
        }

        echo json_encode($result);
    }

    public function hapusdata()
    {
        $id_kategori = $this->input->post('id_kategori');
        $where = array(
            'id_kategori' => $id_kategori
        );
        $this->m->hapusdata($where, 'kategori');
    }
}
