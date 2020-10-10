<?php

class Model_addAdmin extends CI_Model

{
    public function getUser()
    {

        return $this->db->get('user')->result();
    }

    public function getCount($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }

        return $this->db->get('user', $limit, $start)->result();
    }

    public function addAdmin()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "email" => $this->input->post('email', true),
            "username" => $this->input->post('username', true),
            "password" => password_hash(
                $this->input->post('password', true),
                PASSWORD_DEFAULT
            ),
            "role_id" => $this->input->post('role', true)
        ];

        $this->db->insert('user', $data);
    }

    public function hapusUser($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('user', ['id' => $id]);
    }

    public function getUserId($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }

    public function editAdmin()
    {
        $data = [
            "nama" => htmlspecialchars($this->input->post('nama', true)),
            "username" => htmlspecialchars($this->input->post('username', true)),
            "password" => password_hash(
                $this->input->post('password'),
                PASSWORD_DEFAULT
            ),

            "role_id" => htmlspecialchars($this->input->post('role', true)),

        ];

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user', $data);
    }


    public function getSiswa($limit, $start, $Keyword = null)
    {
        if ($Keyword) {
            $this->db->like('nmSiswa', $Keyword);
            $this->db->or_like('nisn', $Keyword);
            $this->db->or_like('nik', $Keyword);
            $this->db->or_like('angkatan', $Keyword);
        }
        $this->db->order_by('nmSiswa', 'ASC');

        $this->db->select('*,ayah.nama AS nmAyah, ibu.nama AS nmIbu, wali.nama AS nmWali');
        $this->db->from('siswa');
        $this->db->join('tinggal', 'tinggal.idtinggal = siswa.tinggal_idtinggal');
        $this->db->join('transportasi', 'transportasi.idtransportasi = siswa.transportasi_idtransportasi', 'left');
        $this->db->join('ayah', 'ayah.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->join('ibu', 'ibu.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->join('wali', 'wali.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }
}