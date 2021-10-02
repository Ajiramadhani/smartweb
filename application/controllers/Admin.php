<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('m_data');
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function addrole()
    {
        $data['title'] = 'Add Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">New menu added !</div>');
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Acccess Changed!</div>');
    }

    public function edit($id)
    {
        $data['title'] = 'Role Edit';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array(
            'id' => $id
        );

        $this->session->set_flashdata('sukses', 'Diubah');
        $data['role'] = $this->m_data->edit_data($where, 'user_role')->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_role', $data);
        $this->load->view('templates/footer');
    }

    public function role_update()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');
            $role = $this->input->post('role');

            $where = array(
                'id' => $id
            );

            $data = array(
                'role' => $role,
            );

            $this->m_data->update_data($where, $data, 'user_role');

            redirect(base_url() . 'admin/role');
        } else {

            $id = $this->input->post('id');
            $where = array(
                'id' => $id
            );
            $data['user_role'] = $this->m_data->edit_data($where, 'user_role')->result();
            $this->session->set_flashdata('sukses', 'Di update');
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        }
    }

    public function user()
    {
        $data['title'] = 'User';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['pengguna'] = $this->db->query("SELECT * FROM user,user_role where role_id=user_role.id order by id_user asc")->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_user($id)
    {
        $where = array(
            'id_user' => $id
        );

        $this->m_data->delete_data($where, 'user');
        // $this->db->delete('user', array('id' => $id));
        $this->session->set_flashdata('sukses', 'Dihapus');
        redirect('admin/user');
    }

    public function user_edit($id)
    {

        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $where = array(
            'id_user' => $id
        );
        $data['pengguna'] = $this->m_data->edit_data($where, 'user')->result();
        $data['role'] = $this->m_data->get_data('user_role')->result();
        $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Data berhasil di ubah !</div>');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('templates/footer');
    }

    public function user_update()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        // $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() != false) {

            $id = $this->input->post('id');
            $name = $this->input->post('name');
            $role_id = $this->input->post('role');
            $is_active = $this->input->post('is_active');

            $where = array(
                'id_user' => $id
            );

            $data = array(
                'name' => $name,
                'role_id' => $role_id,
                'is_active' => $is_active,
            );

            $this->m_data->update_data($where, $data, 'user');
            $this->session->set_flashdata('sukses', '<div class="alert alert-success" role="alert">Data berhasil di ubah !</div>');
            redirect(base_url('admin/user'));
        } else {

            $id = $this->input->post('id');
            $where = array(
                'id_user' => $id
            );
            $data['pengguna'] = $this->m_data->edit_data($where, 'user')->result();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/edit_menu', $data);
            $this->load->view('templates/footer');
        }
    }
}
