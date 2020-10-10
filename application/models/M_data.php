<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_data extends CI_Model
{

    // fungsi ambil data pada database
    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function get_data_siswa($table)
    {
        $this->db->order_by('nmSiswa', 'ASC');
        return $this->db->get($table);
    }

    //fungsi input data
    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    //fungsi edit data
    public function edit_data($where, $table)
    {
        $this->db->get_where($table, $where);
    }

    //fungsi update data pada database
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    //fungsi hapus data
    public function delete_data($where, $table)
    {
        $this->db->delete($table, $where);
    }
}