<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model(['Model_wali', 'Model_orangtua', 'Model_siswa', 'M_data']);
    }

    public function index()
    {
        $data['title'] = "Halaman Admin";
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
        $config['base_url'] = 'http://localhost/bukuinduksiswa/admin/index';
        $this->db->like('nmSiswa', $data['keyword']);
        $this->db->from('siswa');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);

        $data['siswa'] = $this->Model_siswa->getAllSiswa($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/admin_head', $data);
        $this->load->view('admin/beranda', $data);
        $this->load->view('templates/admin_footer');
    }

    //fungsi siswa

    public function Siswa()
    {

        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();


        //ambil data keyword
        if ($this->input->post('SUbmit')) {
            $data['keyword'] = $this->input->post('KEyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
            $this->session->unset_userdata('keyword');
        }

        //config pagination
        $config['base_url'] = 'http://localhost/bukuinduksiswa/admin/Siswa';
        $this->db->like('nmSiswa', $data['keyword']);
        $this->db->or_like('nisn', $data['keyword']);
        $this->db->or_like('nik', $data['keyword']);
        $this->db->or_like('angkatan', $data['keyword']);
        $this->db->from('siswa');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);
        $data['siswa'] = $this->Model_siswa->getCount($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/admin_head', $data);
        $this->load->view('admin/siswa', $data);
        $this->load->view('templates/admin_footer');
    }

    public function addSiswa()
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Model_siswa->getSiswa();
        $data['agama'] = [
            "Islam", "Kristen protestan", "Katolik", "Buddha", "Hindu", "Kong hu cu"
        ];
        // $data['jenis'] = [
        //     "Laki - Laki", "Perempuan"
        // ];
        $data['tinggal'] = $this->M_data->get_data('tinggal')->result();
        $data['trans'] = $this->M_data->get_data('transportasi')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nis', 'NIS', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('nisn', 'NISN', 'required|is_unique[siswa.nisn]|integer|max_length[10]');
        $this->form_validation->set_rules('nik', 'Nik', 'required|integer|max_length[16]');
        $this->form_validation->set_rules('tmp', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email|is_unique[siswa.email]');
        $this->form_validation->set_rules('tinggal', 'Tempat Tinggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/add_siswa', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_siswa->addSiswa();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/Siswa');
        }
    }

    public function delSiswa($id)
    {
        $this->Model_siswa->del($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/Siswa');
    }

    public function editSiswa($id)
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['siswa'] = $this->Model_siswa->getSiswaId($id);
        $data['agama'] = [
            "Islam", "Kristen protestan", "Katolik", "Buddha", "Hindu", "Kong hu cu"
        ];
        // $data['jenis'] = [
        //     "Laki - Laki", "Perempuan"
        // ];
        $data['tinggal'] = $this->M_data->get_data('tinggal')->result();
        $data['trans'] = $this->M_data->get_data('transportasi')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nis', 'NIS', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('nisn', 'NISN', 'required|integer|max_length[10]');
        $this->form_validation->set_rules('nik', 'Nik', 'required|integer|max_length[16]');
        $this->form_validation->set_rules('angkatan', 'Angkatan', 'integer|max_length[4]');
        $this->form_validation->set_rules('tmp', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('tinggal', 'Tempat Tinggal', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/edit_siswa', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_siswa->editSiswa();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/Siswa');
        }
    }


    //akhir fungsi siswa

    //fungsi bagian ayah

    public function ayah()
    {
        $data['title'] = "Halaman Admin";
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
        $config['base_url'] = 'http://localhost/bukuinduksiswa/admin/ayah';
        $this->db->like('nama', $data['keyword']);
        $this->db->from('ayah');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);
        $data['ayah'] = $this->Model_orangtua->getCount($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('templates/admin_head', $data);
        $this->load->view('admin/ayah', $data);
        $this->load->view('templates/admin_footer');
    }

    public function addAyah()
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['ayah'] = $this->Model_orangtua->getAyah();
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required|is_unique[ayah.siswa_idsiswa]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/add_ayah', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_orangtua->addA();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ayah');
        }
    }

    public function delAyah($id)
    {
        $this->Model_orangtua->delA($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/ayah');
    }

    public function editAyah($id)
    {

        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['ayah'] = $this->Model_orangtua->getAyahId($id);
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/edit_ayah', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_orangtua->editA();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ayah');
        }
    }
    //fungsi bagian Ibu

    public function ibu()
    {
        $data['title'] = "Halaman Admin";
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
        $config['base_url'] = 'http://localhost/bukuinduksiswa/admin/ibu';
        $this->db->like('nama', $data['keyword']);
        $this->db->from('ibu');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;

        //initialize
        $this->pagination->initialize($config);


        $data['start'] = $this->uri->segment(3);
        $data['ibu'] = $this->Model_orangtua->getCountI($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('templates/admin_head', $data);
        $this->load->view('admin/ibu', $data);
        $this->load->view('templates/admin_footer');
    }

    public function addIbu()
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['ibu'] = $this->Model_orangtua->getIbu();
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required|is_unique[ibu.siswa_idsiswa]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/add_ibu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_orangtua->addI();
            $this->session->set_flashdata('message2', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ibu');
        }
    }

    public function delIbu($id)
    {
        $this->Model_orangtua->delI($id);
        $this->session->set_flashdata('message2', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/ibu');
    }

    public function editIbu($id)
    {

        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['ibu'] = $this->Model_orangtua->getIbuId($id);
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/edit_ibu', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_orangtua->editI();
            $this->session->set_flashdata('message2', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/ibu');
        }
    }


    //akhir fungsi orang tua

    //fungsi wali

    public function wali()
    {
        $data['title'] = "Halaman Admin";
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
        $config['base_url'] = 'http://localhost/bukuinduksiswa/admin/wali/getWali';
        $this->db->like('nama', $data['keyword']);
        $this->db->from('wali');
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 30;


        //initialize
        $this->pagination->initialize($config);



        $data['start'] = $this->uri->segment(4);
        $data['wali'] = $this->Model_wali->getWali($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('templates/admin_head', $data);
        $this->load->view('admin/wali', $data);
        $this->load->view('templates/admin_footer');
    }

    public function addWali()
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['wali'] = $this->Model_wali->getAllWali();
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required|is_unique[wali.siswa_idsiswa]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/add_wali', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_wali->add();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Ditambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/wali');
        }
    }

    public function delWali($id)
    {
        $this->Model_wali->del($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil Dihapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/wali');
    }

    public function editWali($id)
    {
        $data['title'] = "Halaman Admin";
        $data['panggilan'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['wali'] = $this->Model_wali->getWaliID($id);
        $data['pendidikan'] = [
            'tidak sekolah', 'putus sekolah', 'SD sederajat',
            'SMP sederajat', 'SMA sederajat', 'D1', 'D2', 'D3', 'D4/S1',
            'S2', 'S3'
        ];
        $data['peker'] = [
            'tidak bekerja', 'Nelayan', 'Petani', 'Peternak', 'PNS/TNI/POLRI',
            'Karyawan Swasta', 'Pedagang Kecil', 'Pedagang Besar', 'Wiraswasta', 'Wirausaha', 'Buruh',
            'Pensiunan', 'lain - lain'
        ];
        $data['peng'] = [
            'kurang dari 500.000', '500.000 - 999.999', '1 juta - 1.999.999', '2 juta - 4.999.999', '5 juta - 20 juta',
            'lebih dari 20 juta'
        ];

        $data['siswa'] = $this->M_data->get_data_siswa('siswa')->result();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required');
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required');
        $this->form_validation->set_rules('penghasilan', 'Penghasilan', 'required');
        $this->form_validation->set_rules('siswa', 'Siswa', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/admin_head', $data);
            $this->load->view('admin/edit_wali', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Model_wali->edit();
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil Diupdate!<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/wali');
        }
    }

    //akhir fungsi wali

    public function cetak()
    {
        $tampil = $this->Model_siswa->getData();

        $spreadsheet = new Spreadsheet;

        //set default font
        $spreadsheet->getDefaultStyle()
            ->getFont()
            ->setName('Arial')
            ->setSize(12);

        //set wrap text
        $spreadsheet->getDefaultStyle()->getAlignment()->setWrapText(true);

        //set default alignment text center
        $spreadsheet->getDefaultStyle()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getDefaultStyle()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        //heading
        $spreadsheet->getActiveSheet()
            ->setCellValue('A2', "LAPORAN BUKU INDUK SISWA");

        //merge heading
        $spreadsheet->getActiveSheet()->mergeCells("A2:V2");

        //merge cell
        $spreadsheet->getActiveSheet()->mergeCells("A4:A5");
        $spreadsheet->getActiveSheet()->mergeCells("B4:B5");
        $spreadsheet->getActiveSheet()->mergeCells("C4:C5");
        $spreadsheet->getActiveSheet()->mergeCells("D4:D5");
        $spreadsheet->getActiveSheet()->mergeCells("E4:E5");
        $spreadsheet->getActiveSheet()->mergeCells("F4:F5");
        $spreadsheet->getActiveSheet()->mergeCells("G4:G5");
        $spreadsheet->getActiveSheet()->mergeCells("H4:H5");
        $spreadsheet->getActiveSheet()->mergeCells("I4:I5");
        $spreadsheet->getActiveSheet()->mergeCells("J4:J5");
        $spreadsheet->getActiveSheet()->mergeCells("K4:K5");
        $spreadsheet->getActiveSheet()->mergeCells("L4:L5");
        $spreadsheet->getActiveSheet()->mergeCells("M4:M5");
        $spreadsheet->getActiveSheet()->mergeCells("N4:N5");
        $spreadsheet->getActiveSheet()->mergeCells("O4:O5");
        $spreadsheet->getActiveSheet()->mergeCells("P4:P5");
        $spreadsheet->getActiveSheet()->mergeCells("Q4:Q5");
        $spreadsheet->getActiveSheet()->mergeCells("R4:R5");
        $spreadsheet->getActiveSheet()->mergeCells("S4:S5");
        $spreadsheet->getActiveSheet()->mergeCells("T4:U4");
        $spreadsheet->getActiveSheet()->mergeCells("V4:V5");

        //set font style
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A2')->getFont()->setBold('A2');
        $spreadsheet->getActiveSheet()->getStyle('A4:V4')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A5:V5')->getFont()->setBold(true);

        //set coloum widht
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize('A');
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize('B');
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize('C');
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize('D');
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize('E');
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize('F');
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize('G');
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize('H');
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize('I');
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize('J');
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize('K');
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize('L');
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize('M');
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize('N');
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize('O');
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize('P');
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize('Q');
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize('R');
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize('S');
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize('T');
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize('U');


        //set data
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A4', 'No.')
            ->setCellValue('B4', 'Nama Lengkap')
            ->setCellValue('C4', 'Jenis Kelamin')
            ->setCellValue('D4', 'NIS')
            ->setCellValue('E4', 'NISN')
            ->setCellValue('F4', 'NIK')
            ->setCellValue('G4', 'Angkatan')
            ->setCellValue('H4', 'Tempat, tanggal lahir')
            ->setCellValue('I4', 'Agama')
            ->setCellValue('J4', 'Alamat')
            ->setCellValue('K4', 'Dusun')
            ->setCellValue('L4', 'Kelurahan/Desa')
            ->setCellValue('M4', 'Kecamatan')
            ->setCellValue('N4', 'Kode Pos')
            ->setCellValue('O4', 'Jenis Tinggal')
            ->setCellValue('P4', 'Alat transportasi')
            ->setCellValue('Q4', 'No. Telepon Rumah/hp')
            ->setCellValue('R4', 'E-mail Pribadi')
            ->setCellValue('S4', 'Penerima KPS')
            ->setCellValue('T4', 'Orang tua')
            ->setCellValue('T5', 'Ayah')
            ->setCellValue('U5', 'Ibu')
            ->setCellValue('V4', 'Wali');

        $kolom = 6;
        $nomor = 1;

        foreach ($tampil as $t) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $t->nmSiswa)
                ->setCellValue('C' . $kolom, $t->jenisKelamin)
                ->setCellValue('D' . $kolom, $t->nis)
                ->setCellValue('E' . $kolom, $t->nisn)
                ->setCellValue('F' . $kolom, $t->nik)
                ->setCellValue('G' . $kolom, $t->angkatan)
                ->setCellValue('H' . $kolom, $t->tempatLhr . ', ' . date('d/m/Y', strtotime($t->tglLhr)))
                ->setCellValue('I' . $kolom, $t->agama)
                ->setCellValue('J' . $kolom, $t->alamat)
                ->setCellValue('K' . $kolom, $t->dusun)
                ->setCellValue('L' . $kolom, $t->desa)
                ->setCellValue('M' . $kolom, $t->kecamatan)
                ->setCellValue('N' . $kolom, $t->kodePos)
                ->setCellValue('O' . $kolom, $t->nmTinggal)
                ->setCellValue('P' . $kolom, $t->nmTransportasi)
                ->setCellValue('Q' . $kolom, $t->telpon)
                ->setCellValue('R' . $kolom, $t->email)
                ->setCellValue('S' . $kolom, $t->bansos)
                ->setCellValue('T' . $kolom, $t->nmAyah)
                ->setCellValue('U' . $kolom, $t->nmIbu)
                ->setCellValue('V' . $kolom, $t->nmWali);

            $kolom++;
            $nomor++;
        }

        //set border
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];
        $kolom = $kolom - 1;
        $spreadsheet->getActiveSheet()->getStyle('A4:V' . $kolom)->applyFromArray($styleArray);


        //for download
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Daftar Siswa.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}