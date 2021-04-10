<?php

class Profile_model extends CI_model
{
    public function getUser()
    {
        return $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
            'role_id' => $this->session->userdata('role_id'),
            'id' => $this->session->userdata('id'),
        ])->row_array();
    }

    public function getUserData()
    {
        return $this->db->get_where('user', [
            'id' => $this->session->userdata('id'),
        ])->result();
    }

    public function getUserPostProfile()
    {
        return $this->db->query('SELECT * FROM posting p join user u on(p.id_user = u.id) where id = ' . $this->session->userdata('id') . ' order by p.id_posting desc')->result();
    }

    public function getInfoProfile()
    {
        $query = $this->db->query('SELECT * from user where id = ' . $this->session->userdata('id'));

        return $query->result();
    }

    public function deletePostUser($id)
    {
        $this->db->where('id_posting', $id);
        $this->db->delete('posting');
    }

    public function editBasicModel($data)
    {
        $this->db->set($data);
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user');
    }

    public function getFollowing()
    {
        return $this->db->query('SELECT id_usertarget, namatarget, imagetarget, biotarget FROM follow f join user u on(u.id = f.id_userfollow) where id_userfollow =' . $this->session->userdata('id') . ' and stat = 1')->result();
    }

    public function getFollowers()
    {
        return $this->db->query('SELECT * FROM follow f join user u on(u.id = f.id_userfollow) where id_usertarget = ' . $this->session->userdata('id') . ' and stat = 1')->result();
    }

    public function editPhoto($data)
    {
        $this->db->set($data);
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('user');
    }
}