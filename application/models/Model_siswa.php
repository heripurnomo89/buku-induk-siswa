<?php

class Model_siswa extends CI_Model
{
    public function getSiswa()
    {

        $this->db->select('siswa.*, tinggal.nmTinggal, transportasi.nmTransportasi');
        $this->db->from('siswa');
        $this->db->join('tinggal', 'tinggal.idtinggal = siswa.tinggal_idtinggal');
        $this->db->join('transportasi', 'transportasi.idtransportasi = siswa.transportasi_idtransportasi', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function addSiswa()
    {
        $data = [
            "nmSiswa" => $this->input->post('nama', true),
            "jenisKelamin" => $this->input->post('jenis', true),
            "nis" => $this->input->post('nis', true),
            "nisn" => $this->input->post('nisn', true),
            "nik" => $this->input->post('nik', true),
            "angkatan" => $this->input->post('angkatan', true),
            "tempatLhr" => $this->input->post('tmp', true),
            "tglLhr" => $this->input->post('tanggal', true),
            "agama" => $this->input->post('agama', true),
            "alamat" => $this->input->post('alamat', true),
            "dusun" => $this->input->post('dusun', true),
            "desa" => $this->input->post('desa', true),
            "kecamatan" => $this->input->post('kecamatan', true),
            "kodePos" => $this->input->post('kode', true),
            "tinggal_idtinggal" => $this->input->post('tinggal', true),
            "transportasi_idtransportasi" => $this->input->post('alat', true),
            "telpon" => $this->input->post('telpon', true),
            "email" => $this->input->post('email', true),
            "bansos" => $this->input->post('bansos', true)

        ];

        $this->db->insert('siswa', $data);
    }

    public function del($id)
    {
        //$this->db->where('id', $id);
        $this->db->delete('siswa', ['idsiswa' => $id]);
    }

    public function getSiswaId($id)
    {
        return $this->db->get_where('siswa', ['idsiswa' => $id])->row_array();
    }

    public function editSiswa()
    {
        $data = [
            "nmSiswa" => $this->input->post('nama', true),
            "jenisKelamin" => $this->input->post('jenis', true),
            "nis" => $this->input->post('nis', true),
            "nisn" => $this->input->post('nisn', true),
            "nik" => $this->input->post('nik', true),
            "angkatan" => $this->input->post('angkatan', true),
            "tempatLhr" => $this->input->post('tmp', true),
            "tglLhr" => $this->input->post('tanggal', true),
            "agama" => $this->input->post('agama', true),
            "alamat" => $this->input->post('alamat', true),
            "dusun" => $this->input->post('dusun', true),
            "desa" => $this->input->post('desa', true),
            "kecamatan" => $this->input->post('kecamatan', true),
            "kodePos" => $this->input->post('kode', true),
            "tinggal_idtinggal" => $this->input->post('tinggal', true),
            "transportasi_idtransportasi" => $this->input->post('alat', true),
            "telpon" => $this->input->post('telpon', true),
            "email" => $this->input->post('email', true),
            "bansos" => $this->input->post('bansos', true)

        ];

        $this->db->where('idsiswa', $this->input->post('id'));
        $this->db->update('siswa', $data);
    }

    public function getCount($limit, $start, $KEyword = null)
    {
        if ($KEyword) {
            $this->db->like('nmSiswa', $KEyword);
            $this->db->or_like('nisn', $KEyword);
            $this->db->or_like('nik', $KEyword);
            $this->db->or_like('angkatan', $KEyword);
        }
        $this->db->order_by('nmSiswa', 'ASC');
        $this->db->select('siswa.*, tinggal.nmTinggal, transportasi.nmTransportasi');
        $this->db->from('siswa');
        $this->db->join('tinggal', 'tinggal.idtinggal = siswa.tinggal_idtinggal');
        $this->db->join('transportasi', 'transportasi.idtransportasi = siswa.transportasi_idtransportasi', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllSiswa($limit, $start, $keyword = null)
    {

        if ($keyword) {
            $this->db->like('nmSiswa', $keyword);
            $this->db->or_like('nisn', $keyword);
            $this->db->or_like('nik', $keyword);
            $this->db->or_like('angkatan', $keyword);
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

    public function getData()
    {

        $this->db->select('*,ayah.nama AS nmAyah, ibu.nama AS nmIbu, wali.nama AS nmWali');
        $this->db->from('siswa');
        $this->db->join('tinggal', 'tinggal.idtinggal = siswa.tinggal_idtinggal', 'left');
        $this->db->join('transportasi', 'transportasi.idtransportasi = siswa.transportasi_idtransportasi', 'left');
        $this->db->join('ayah', 'ayah.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->join('ibu', 'ibu.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->join('wali', 'wali.siswa_idsiswa = siswa.idsiswa', 'left');
        $this->db->order_by('nmSiswa', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }
}