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
        $this->db->select('m.id as "id_post_m", m.id_user, m.nama, u.name, m.id_surat, m.filename, m.date_post, u.image');
        $this->db->from('materi m');
        $this->db->join('user u', 'm.id_user = u.id');
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

    public function getTitleMateri($id)
    {
        $this->db->select('*');
        $this->db->from('katmateri');
        $this->db->where('id', $id);
        return $this->db->get();
    }

    public function addMateriComment($data)
    {
        $this->db->insert('materi_comment', $data);
    }

    public function getCommentMateri($idmp)
    {
        $this->db->select('*');
        $this->db->from('materi_comment mc');
        $this->db->join('user u', 'mc.id_user=u.id');
        $this->db->where('id_materi', $idmp);
        return $this->db->get()->result_array();
    }

    public function hapusKomen($idmk)
    {
        $this->db->where('id_m_comment', $idmk);
        $this->db->delete('materi_comment');
    }

    public function deleteMateri($idm)
    {
        $this->db->where('id', $idm);
        $this->db->delete('materi');
    }
}
