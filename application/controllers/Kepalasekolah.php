<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepalasekolah extends CI_Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Model_addAdmin');
    }

    public function index()
    {
        $data['title'] = 'halaman Kepala Sekolah';
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->load->view('templates/kepala_head', $data);
        $this->load->view('kepala/beranda', $data);
        $this->load->view('templates/kepala_footer');
    }

    // bagian user

    public function admin()
    {
        $data['title'] = 'halaman Kepala Sekolah';
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        //ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->session->unset_userdata('keyword');
        }

        //config pagination
        $config['base_url'] = 'http://localhost/bukuinduksiswa/kepalasekolah/admin';
        $this->db->like('nama', $data['keyword']);
        $this->db->from('user');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 5;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);

        $data['user'] = $this->Model_addAdmin->getCount($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/kepala_head', $data);
        $this->load->view('kepala/admin', $data);
        $this->load->view('templates/kepala_footer');
    }

    public function addAdmin()
    {
        $data['title'] = 'halaman Kepala Sekolah';
        $data['user'] = $this->Model_addAdmin->getUser();
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/kepala_head', $data);
            $this->load->view('kepala/admin', $data);
            $this->load->view('templates/kepala_footer');
        } else {
            $this->Model_addAdmin->addAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
         Data berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span></button></div>');
            redirect('kepalasekolah/admin');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'form edit';
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['user'] = $this->Model_addAdmin->getUserId($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');


        if ($this->input->post('password')) {
            $this->form_validation->set_rules('password', 'Password', 'min_length[3]');
        }
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/kepala_head', $data);
            $this->load->view('kepala/edit', $data);
            $this->load->view('templates/kepala_footer');
        } else {
            $this->Model_addAdmin->editAdmin();
            $this->session->set_flashdata('message', '<div class="alert
            alert-success alert-dismissible fade show" role="alert">Data berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('kepalasekolah/admin');
        }
    }

    public function hapus($id)
    {
        $this->Model_addAdmin->hapusUser($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button></div>');
        redirect('kepalasekolah/admin');
    }

    // akhir fungsi user


    public function SIswa()
    {
        $data['title'] = 'halaman Kepala Sekolah';
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        //ambil data keyword
        if ($this->input->post('Submit')) {
            $data['keyword'] = $this->input->post('Keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('Keyword');
            $this->session->unset_userdata('keyword');
        }

        //config pagination
        $config['base_url'] = 'http://localhost/bukuinduksiswa/kepalasekolah/SIswa';
        $this->db->like('nmSiswa', $data['keyword']);
        $this->db->or_like('nisn', $data['keyword']);
        $this->db->or_like('nik', $data['keyword']);
        $this->db->from('siswa');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);

        $data['murid'] = $this->Model_addAdmin->getSiswa($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/kepala_head', $data);
        $this->load->view('kepala/siswa', $data);
        $this->load->view('templates/kepala_footer');
    }
}