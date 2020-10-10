<?php

class Model_orangtua extends CI_Model
{
    //bagian ayah
    public function getAyah()
    {
        $this->db->order_by('nama', 'ASC');
        $this->db->select('ayah.*, siswa.nmSiswa');
        $this->db->from('ayah');
        $this->db->join('siswa', 'siswa.idsiswa = ayah.siswa_idsiswa', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCount($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }
        $this->db->order_by('nama', 'ASC');
        $this->db->order_by('nama', 'ASC');
        $this->db->select('ayah.*, siswa.nmSiswa');
        $this->db->from('ayah');
        $this->db->join('siswa', 'siswa.idsiswa = ayah.siswa_idsiswa', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll()
    {
        return $this->db->get('ayah')->num_rows();
    }

    public function addA()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->insert('ayah', $data);
    }

    public function delA($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('ayah', ['idayah' => $id]);
    }

    public function getAyahId($id)
    {
        return $this->db->get_where('ayah', ['idayah' => $id])->row_array();
    }

    public function editA()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->where('idayah', $this->input->post('id'));
        $this->db->update('ayah', $data);
    }

    //bagian Ibu
    public function getIbu()
    {
        $this->db->order_by('nama', 'ASC');
        $this->db->select('ibu.*, siswa.nmSiswa');
        $this->db->from('ibu');
        $this->db->join('siswa', 'siswa.idsiswa = ibu.siswa_idsiswa', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getCountI($limit, $start, $keyword = null)
    {

        if ($keyword) {
            $this->db->like('nama', $keyword);
        }
        $this->db->order_by('nama', 'ASC');
        $this->db->select('ibu.*, siswa.nmSiswa');
        $this->db->from('ibu');
        $this->db->join('siswa', 'siswa.idsiswa = ibu.siswa_idsiswa', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAllI()
    {
        return $this->db->get('ibu')->num_rows();
    }

    public function addI()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->insert('ibu', $data);
    }

    public function delI($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('ibu', ['idibu' => $id]);
    }

    public function getIbuId($id)
    {
        return $this->db->get_where('ibu', ['idibu' => $id])->row_array();
    }

    public function editI()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->where('idibu', $this->input->post('id'));
        $this->db->update('ibu', $data);
    }
}