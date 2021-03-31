<?php

class Materi_model extends CI_Model
{
    public function getMateri($id)
    {
        return $this->db->get_where('materi', array('id_surat' => $id))->result_array();
    }

    public function getLog($idlog)
    {
        return $this->db->get_where('user', array('id' => $idlog))->result_array();
    }

    public function getAllSurat()
    {
        return $this->db->get('katmateri')->result_array();
    }

    public function getAllMateri($idm, $limit, $start)
    {
        $this->db->select('*');
        $this->db->from('materi');
        $this->db->join('user', 'materi.id_user = user.id');
        $this->db->where('id_surat', $idm);
        $this->db->limit($limit);
        $this->db->offset($start);
        return $this->db->get()->result_array();
    }

    public function countMateri($idm)
    {
        return $this->db->get_where('materi', array('id_surat' => $idm))->num_rows();
    }

    public function tambahSurat($data)
    {
        $this->db->insert('katmateri', $data);
    }
}
