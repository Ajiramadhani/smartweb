<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('m_data');
        cek_login();
    }

    public function index()
    {
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">New menu added !</div>');
            redirect('menu');
        }
    }

    public function hapus($id)
    {
        // $this->m_data->delete_data($id);
        $where = array(
            'id' => $id
        );

        $this->m_data->delete_data($where, 'user_menu');
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('menu');
    }

    public function edit($id)
    {
        $data['title'] = 'Menu Management Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array(
            'id' => $id
        );

        $this->session->set_flashdata('message', 'Diubah');
        $data['user_menu'] = $this->m_data->edit_data($where, 'user_menu')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_menu', $data);
        $this->load->view('templates/footer');
    }

    public function menu_update()
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');
            $menu = $this->input->post('menu');

            $where = array(
                'id' => $id
            );

            $data = array(
                'menu' => $menu,
            );

            $this->m_data->update_data($where, $data, 'user_menu');

            redirect(base_url() . 'menu');
        } else {

            $id = $this->input->post('id');
            $where = array(
                'id' => $id
            );
            $data['user_menu'] = $this->m_data->edit_data($where, 'user_menu')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        }
    }

    // CRUD SUBMENU

    public function submenu()
    {
        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            // $data['subMenu'] = $this->db->get('user_sub_menu')->result_array();
            $data['subMenu'] = $this->db->query("SELECT * FROM user_sub_menu, user_menu WHERE menu_id=user_menu.id order by id_sub ASC")->result_array();
            $data['user_menu'] = $this->m_data->get_data('user_menu')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            ];
            $this->m_data->insert_data($data, 'user_sub_menu');
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">New Submenu added !</div>');
            redirect('menu/submenu');
        }
    }

    public function sub_hapus($id)
    {
        // $this->m_data->delete_data($id);
        $where = array(
            'id_sub' => $id
        );

        $this->m_data->delete_data($where, 'user_sub_menu');
        $this->session->set_flashdata('message', 'Dihapus');
        redirect('menu/submenu');
    }

    public function sub_edit($id)
    {
        $data['title'] = 'SubMenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array(
            'id_sub' => $id
        );

        $this->session->set_flashdata('message', 'Diubah');
        // $data['subMenu'] = $this->db->query("SELECT * FROM user_sub_menu, user_menu WHERE menu_id=user_menu.id order by id_sub ASC")->result_array();
        $data['sub'] = $this->m_data->edit_data($where, 'user_sub_menu')->result();
        $data['user_menu'] = $this->m_data->get_data('user_menu')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/edit_submenu', $data);
        $this->load->view('templates/footer');
    }

    public function sub_update()
    {
        $data['subMenu'] = $this->db->query("SELECT * FROM user_sub_menu, user_menu WHERE menu_id=user_menu.id order by id_sub ASC")->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');

            $where = array(
                'id_sub' => $id
            );

            $data = array(
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active'),
            );

            $this->m_data->update_data($where, $data, 'user_sub_menu');
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Submenu has been change!</div>');
            redirect(base_url() . 'menu/submenu');
        } else {

            $id = $this->input->post('id');
            $where = array(
                'id_sub' => $id
            );
            $data['sub'] = $this->m_data->edit_data($where, 'user_sub_menu')->result();
            $data['user_menu'] = $this->m_data->get_data('user_menu')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_submenu', $data);
            $this->load->view('templates/footer');
        }
    }
}
