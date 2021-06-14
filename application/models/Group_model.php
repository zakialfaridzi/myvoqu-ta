<?php

class Group_model extends CI_Model
{
    public function getGroup()
    {
        return $this->db->get('grup')->result_array();
    }
    public function specGroup($id)
    {
        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->join('grup', 'anggota.id_group = grup.id');
        $this->db->where('id_user', $id);
        return $this->db->get()->result_array();
    }

    public function getPostingan($id)
    {
        $this->db->select('*');
        $this->db->from('group_postingan');
        $this->db->join('user', 'group_postingan.id_user = user.id');
        $this->db->where('id_group', $id);
        $this->db->where('tugas is null', null, false);
        $this->db->order_by('date_post', 'DESC');
        return $this->db->get()->result();
    }

    public function getPostinganSetoran($id)
    {
        $this->db->select('*');
        $this->db->from('group_postingan');
        $this->db->join('user', 'group_postingan.id_user = user.id');
        $this->db->where('id_group', $id);
        $this->db->where('tugas is not null', null, false);
        $this->db->order_by('date_post', 'DESC');
        return $this->db->get()->result();
    }

    public function getDataGroup($idg)
    {
        return $this->db->get_where('grup', array('id' => $idg))->result_array();
    }

    public function tambahDataGroup($data)
    {
        $this->db->insert('grup', $data);
    }

    public function ubahDataGroup($idgroup, $data)
    {
        $this->db->where('id', $idgroup);
        $this->db->update('grup', $data);
    }

    public function getInfoProfile($id)
    {
        return $this->db->get_where('user', array('id' => $id))->result();
    }

    public function getUserData($id)
    {
        return $this->db->get_where('user', [
            'id' => $id,
        ])->result();
    }

    public function getUserPostProfile()
    {
        return $this->db->query('SELECT * FROM group_postingan p join grup g on(p.id_group = g.id) where id = ' . $this->uri->segment('3') . ' order by p.id_posting desc')->result();
    }

    public function hapusGroup($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('grup');
    }

    public function addInfo($table, $data)
    {
        $this->db->insert($table, $data);
    }

    public function getInfoGroup()
    {
        return $this->db->query('SELECT info, name, date_post FROM group_information g join user u on(g.id_user=u.id) where id_group = ' . $this->uri->segment('3') . ' order by date_post desc limit 1')->result_array();

        // return $this->db->query('SELECT info, name FROM group_information g join user u on(g.id_user = u.id) where id_group = ' . $this->uri->segment('3') . ' ')->result();
    }

    public function getAllUser()
    {
        $id = $this->session->userdata('id');
        return $this->db->query("SELECT * From USER where id <> '$id' and role_id <> 1 and role_id <> 3")->result_array();
    }

    public function getUserName($name)
    {
        $id = $this->session->userdata('id');

        $query = $this->db->query("select distinct id, image, name from user u left join anggota a on u.id=a.id_user where role_id <> 3 and role_id <> 1 and ifnull(id_group, 0) <> ' . $this->uri->segment('3') . ' and id not in (select id_user from anggota where id_group = ' . $this->uri->segment('3') . ') and where id <> $id and name like '%$name%'");
        // $query = $this->db->query("SELECT * FROM user where id <> '$id' and name LIKE '%$name%'");

        return $query->result();
    }

    public function cekAnggota()
    {
        return $this->db->query('select distinct id, image, name, gender, bio from user u left join anggota a on u.id=a.id_user where role_id <> 3 and role_id <> 1 and ifnull(id_group, 0) <> ' . $this->uri->segment('3') . ' and id not in (select id_user from anggota where id_group = ' . $this->uri->segment('3') . ') and is_active = 1')->result_array();
    }

    public function tambahUser($data)
    {
        $this->db->insert('anggota', $data);
    }

    public function getAnggota()
    {
        return $this->db->query('SELECT id_anggota, id_user, name, bio, image FROM anggota a join user u on(a.id_user=u.id) where id_group = ' . $this->uri->segment('3') . ' ')->result_array();
    }

    public function getAnggotaGroup($id)
    {
        return $this->db->query('SELECT id_anggota, id_user, name, bio, image FROM anggota a join user u on(a.id_user=u.id) where id_group = ' . $id . ' ')->result_array();
    }


    public function kickAnggota($id)
    {
        $this->db->where('id_anggota', $id);
        $this->db->delete('anggota');
    }

    public function deletePostGroup($id)
    {
        $this->db->where('id_posting', $id);
        $this->db->delete('group_postingan');
    }

    public function getPostById($id)
    {
        $query = $this->db->query("SELECT * from group_postingan p  join user u on(u.id = p.id_user) where id_posting = $id");

        return $query->result();
    }
    public function getCommentById($id)
    {
        $query = $this->db->query("SELECT * FROM group_comment c join user u on u.id=c.id_user where id_posting = $id order by id_comment desc");

        return $query->result();
    }

    public function getNotification()
    {
        return $this->db->query('SELECT * FROM notification c join user u using(id) order by id_notification desc')->result();
    }

    public function addComment($data)
    {
        return $this->db->insert('group_comment', $data);
    }
    public function deleteComment($id)
    {
        $this->db->where('id_comment', $id);
        $this->db->delete('group_comment');
        // $this->db->where('id_notification', $id);
        // $this->db->delete('notification');
    }

    public function update_data($where, $data)
    {
        $this->db->update('grup', $data, $where);
    }

    public function editPhoto($id, $data)
    {
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('grup');
    }

    public function getNotif($id)
    {
        return $this->db->query('SELECT role_id, id_user, name, notif, date from group_notif g join user u on g.id_user=u.id where id_group = ' . $id . ' order by date desc limit 5')->result_array();
    }

    public function gethafalan($id)
    {
        return $this->db->get_where('tugas_hafalan', array('id_group' => $id));
    }

    public function getPostHafalan($id)
    {
        $this->db->select('*');
        $this->db->from('group_postingan');
        $this->db->where('tugas is NOT NULL', NULL, FALSE);
        $this->db->where('id_group', $id);
        return $this->db->get();
    }

    public function getStoredHafalan($idt, $idg)
    {
        $this->db->select('a.id_user, u.name, IFNULL((case when rh.id_tugas = ' . $idt . ' then 1 END), 0) assign');
        $this->db->from('anggota a');
        $this->db->join('user u', 'a.id_user=u.id', 'left');
        $this->db->join('report_hafalan rh', 'a.id_user=rh.id_user', 'left');
        $this->db->where('rh.id_group', $idg);
        return $this->db->get();
    }

    public function reportHafalan($idg)
    {
        $idTugas = $this->gethafalan($idg)->result();
        $len = count($idTugas);
        $i = 0;
        foreach ($idTugas as $key => $value) {
            if ($i == 0) {
                if ($value->to_ayat == null) {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat',";
                } else {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat-$value->to_ayat',";
                }
            } else if ($i == $len - 1) {
                if ($value->to_ayat == null) {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat'";
                } else {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat*-*$value->to_ayat'";
                }
            }
            $i++;
        }
        if ($idTugas == null) {
            $theTugas = null;
            return $theTugas;
        } else {
            $this->db->select('u.name,');
            for ($j = 0; $j < count($theTugas); $j++) {
                $this->db->select($theTugas[$j]);
                // $wew = $theTugas[$j];
            }
            $this->db->from('anggota a');
            $this->db->join('user u', 'a.id_user=u.id', 'left');
            $this->db->join('report_hafalan rh', 'a.id_user=rh.id_user', 'left');
            $this->db->where('rh.id_group', $idg);
            return $this->db->get()->result();
        }
    }

    public function columnReport($idg)
    {
        $idTugas = $this->gethafalan($idg)->result();
        $len = count($idTugas);
        $i = 0;
        foreach ($idTugas as $key => $value) {
            if ($i == 0) {
                if ($value->to_ayat == null) {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat',";
                } else {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat-$value->to_ayat',";
                }
            } else if ($i == $len - 1) {
                if ($value->to_ayat == null) {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat'";
                } else {
                    $theTugas[] = "IFNULL((case when rh.id_tugas = $value->id_tugas then 1 END), 0) as '$value->nama_surah*Ayat*$value->from_ayat-$value->to_ayat'";
                }
            }
            $i++;
        }
        if ($idTugas == null) {
            $theTugas = 'Tidak ada data';
            return $theTugas;
        } else {
            $this->db->select('u.name,');
            for ($j = 0; $j < count($theTugas); $j++) {
                $this->db->select($theTugas[$j]);
                // $wew = $theTugas[$j];
            }
            $this->db->from('anggota a');
            $this->db->join('user u', 'a.id_user=u.id', 'left');
            $this->db->join('report_hafalan rh', 'a.id_user=rh.id_user', 'left');
            $this->db->where('rh.id_group', $idg);
            return $this->db->get();
        }
    }

    public function getSukaById($id)
    {
        $query = $this->db->query("SELECT id, status, count(status) jumlahsuka FROM suka s where status = 1 and id_posting = $id");

        return $query->result();
    }

    public function getSukaaById($id)
    {
        $query = $this->db->query('SELECT *, count(*) as total FROM suka where id = ' . $this->session->userdata('id') . ' and id_posting = ' . $this->uri->segment('3') . '');

        return $query->result();
    }

    // public function getidpost()
    // {
    //     $query = $this->db->query("SELECT id_posting+1 id_posting FROM suka order by id_posting desc limit 1");
    //     return $query->result();
    // }
}
