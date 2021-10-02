<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('My_model', 'm');
        $this->load->library('form_validation');
        $this->load->helper('url');
        cek_login();
    }

    function index()
    {
        $data['title'] = 'Jenis Produk';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // $data['kategori'] = $this->m->get_kategori();
        $data['kategori'] = $this->db->get('kategori')->result();
        // $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Data Berhasil ditambah!</div>');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('produk/produk');
        $this->load->view('templates/footer');
    }

    function ambildata()
    {
        // $dataBarang = $this->m->ambildata('produk')->result();
        $dataBarang = $this->db->query("SELECT * FROM produk, kategori where kategori_produk=id_kategori order by id_produk asc")->result();
        echo json_encode($dataBarang);
    }

    public function tambahproduk()
    {
        $result = [
            $this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required|trim|is_unique[produk.nama_produk]', ['required' => '%s tidak boleh kosong!', 'is_unique' => '%s telah tersedia']),
            $this->form_validation->set_rules('volume', 'Volume', 'required|trim', ['required' => '%s tidak boleh kosong!']),
            // $this->form_validation->set_rules('satuan', 'Satuan', 'trim|required', ['required' => '%s tidak boleh kosong!']),
            // $this->form_validation->set_rules('gambar', 'Gambar', 'required', ['required' => '%s tidak boleh kosong!']),
            // $this->form_validation->set_rules('kategori_produk', 'Kategori Produk', 'trim|required', ['required' => '%s tidak boleh kosong!'])
        ];

        if ($this->form_validation->run() == false) {
            $result['pesan'] = form_error('nama_produk|volume', '<div class="alert alert-danger" role="alert">', '</div>');
            // $result['pesan'] = form_error('volume', '<div class="alert alert-danger" role="alert">', '</div>');
            // $result['pesan'] = form_error('satuan', '<div class="alert alert-danger" role="alert">', '</div>');
            // $result['pesan'] = form_error('gambar', '<div class="alert alert-danger" role="alert">', '</div>');
            // $result['pesan'] = form_error('kategori_produk', '<div class="alert alert-danger" role="alert">', '</div>');
        } else {
            $config['upload_path'] = "./assets/img/produk/";
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $config['file_name'] = uniqid();
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("gambar")) {
                $gbr = $this->upload->data();
                $gambar = $gbr['file_name'];
                $nama_produk = htmlspecialchars($this->input->post('nama_produk', true));
                $volume = htmlspecialchars($this->input->post('volume', true));
                $satuan = htmlspecialchars($this->input->post('satuan', true));
                $gambar = $this->input->post('gambar');
                $kategori_produk = $this->input->post('kategori_produk');
                $data = array(
                    'nama_produk' => $nama_produk,
                    'volume' => $volume,
                    'satuan' => $satuan,
                    'kategori_produk' => $kategori_produk,
                    'gambar' => $gambar,
                );

                $this->m->tambahdata($data, 'produk');
                $this->session->set_flashdata('flash', 'Ditambahkan');
            }
        }

        echo json_encode($result);
    }

    public function ambilId()
    {
        $id_produk = $this->input->post('id_produk');
        $where = array('id_produk' => $id_produk);
        $dataBarang = $this->m->ambilId('produk', $where)->result();

        echo json_encode($dataBarang);
    }

    public function ubahdata()
    {
        $id_produk = $this->input->post('id_produk');
        $nama_produk = $this->input->post('nama_produk');
        $volume = $this->input->post('volume');
        $satuan = $this->input->post('satuan');
        $gambar = $this->input->post('gambar');
        $kategori_produk = $this->input->post('kategori_produk');

        if ($nama_produk == '') {
            $result['pesan'] = "Nama Produk harus diisi";
        } elseif ($volume == '') {
            $result['pesan'] = "Volume harus diisi";
        } elseif ($satuan == '') {
            $result['pesan'] = "Satuan harus diisi";
        } elseif ($kategori_produk == '') {
            $result['pesan'] = "Kategori Produk harus diisi";
        } else {
            $result['pesan'] = "";

            $config['upload_path'] = "./assets/img/produk/";
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['encrypt_name'] = TRUE;
            $config['file_name'] = uniqid();
            $config['overwrite']     = TRUE;

            $this->load->library('upload', $config);
            if ($this->upload->do_upload("gambar")) {
                $gbr = $this->upload->data();
                $gambar = $gbr['file_name'];
                $where = array(
                    'id_produk' => $id_produk
                );
                $data = array(
                    'nama_produk' => $nama_produk,
                    'volume' => $volume,
                    'satuan' => $satuan,
                    'kategori_produk' => $kategori_produk,
                    'gambar' => $gambar
                );
            }
            $this->m->updatedata($where, $data, 'produk');
            $this->session->set_flashdata('flash', 'Diubah');
        }

        echo json_encode($result);
    }

    public function hapusdata()
    {
        $id_produk = $this->input->post('id_produk');
        $where = array(
            'id_produk' => $id_produk
        );
        $this->m->hapusdata($where, 'produk');
        $this->session->set_flashdata('flash', 'Dihapus');
    }
}
