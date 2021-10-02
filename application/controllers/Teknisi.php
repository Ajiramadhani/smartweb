<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teknisi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('m_data');
    }
    public function index()
    {
        $data['title'] = 'Dashboard Teknisi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('teknisi/index', $data);
        $this->load->view('templates/footer');
    }

    public function preventive()
    {
        $data['title'] = 'Preventive Maintenance AC Sentral';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['preventive'] = $this->db->query("SELECT * FROM preventive_ac, user, sub_kategori, kategori, inventory WHERE preventive_ac.user_id=id_user AND preventive_ac.subkategori_id=id_sub_kategori AND  preventive_ac.kategori_id=id_kategori AND unit_id=id_inventory ORDER BY id_preventive ASC")->result();
        $data['kategori'] = $this->m_data->get_data('kategori')->result();
        $data['sub_kategori'] = $this->m_data->get_data('sub_kategori')->result();
        $data['inventory'] = $this->m_data->get_data('inventory')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('teknisi/preventive', $data);
        $this->load->view('templates/footer');
    }

    public function add_preventive()
    {
        $data['title'] = 'Preventive Maintenance AC Sentral';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengguna'] = $this->m_data->get_data('user')->result();
        $this->form_validation->set_rules('unit', 'Unit', 'trim|required');

        if ($this->form_validation->run() != FALSE) {
            // $date_created  = date('d-m-Y H:i:s');
            $kategori  = $this->input->post('kategori');
            $sub_kategori = $this->input->post('sub_kategori');
            $user = $this->session->userdata('id');
            $unit = $this->input->post('unit');
            $pressure = $this->input->post('pressure');
            $daya = $this->input->post('daya');
            $keterangan = $this->input->post('keterangan');

            $data = array(
                'date_created' => time(),
                'kategori_id' => $kategori,
                'subkategori_id' => $sub_kategori,
                'user_id' => $user,
                'unit_id' => $unit,
                'pressure' => $pressure,
                'daya' => $daya,
                'keterangan' => $keterangan,
            );
            $this->m_data->insert_data($data, 'preventive_ac');
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Data has been added !</div>');
            redirect(base_url('teknisi/preventive'));
        } else {
            $data['pengguna'] = $this->m_data->get_data('user')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('teknisi/preventive', $data);
            $this->load->view('templates/footer');
        }
    }
}
