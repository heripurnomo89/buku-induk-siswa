<?php

class Model_wali extends CI_Model
{

    public function getAllWali()
    {
        $this->db->order_by('nama', 'ASC');
        $this->db->select('wali.*, siswa.nmSiswa');
        $this->db->from('wali');
        $this->db->join('siswa', 'siswa.idsiswa = wali.siswa_idsiswa', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function getWali($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }
        $this->db->order_by('nama', 'ASC');
        $this->db->order_by('nama', 'ASC');
        $this->db->select('wali.*, siswa.nmSiswa');
        $this->db->from('wali');
        $this->db->join('siswa', 'siswa.idsiswa = wali.siswa_idsiswa', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll()
    {
        return $this->db->get('wali')->num_rows();
    }

    public function add()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->insert('wali', $data);
    }

    public function del($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('wali', ['idwali' => $id]);
    }

    public function getWaliId($id)
    {
        return $this->db->get_where('wali', ['idwali' => $id])->row_array();
    }

    public function edit()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "lahir" => $this->input->post('tanggal', true),
            "pendidikan" => $this->input->post('pendidikan', true),
            "pekerjaan" => $this->input->post('pekerjaan', true),
            "penghasilan" => $this->input->post('penghasilan', true),
            "siswa_idsiswa" => $this->input->post('siswa', true)
        ];

        $this->db->where('idwali', $this->input->post('id'));
        $this->db->update('wali', $data);
    }
}