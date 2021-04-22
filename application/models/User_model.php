<?php

class User_model extends CI_model
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

    public function getOherUserData()
    {
        return $this->db->query('SELECT * FROM user
        where id != ' . $this->session->userdata('id') . ' and gender = "' . $this->session->userdata('gender') . '"  and role_id <> 1 and role_id <> 3')->result();
    }

    public function getOtherUserData()
    {
        return $this->db->query('SELECT * FROM user u join follow f on (u.id = f.id_usertarget) where id_usertarget not in (select id_usertarget from follow where id_userfollow =' . $this->session->userdata('id') . ') and role_id = 2 and id !=' . $this->session->userdata('id'))->result();
    }

    public function getSuggest()
    {
        return $this->db->query('SELECT distinct id, name, id_usertarget, bio, image FROM user u join follow f on (u.id = f.id_usertarget) where id_usertarget not in (select id_usertarget from follow where id_userfollow =' . $this->session->userdata('id') . ') and role_id = 2 and gender ="' . $this->session->userdata('gender') . '" and id !=' . $this->session->userdata('id') . ' limit 4')->result();
    }

    // public function getFollow()
    // {
    //     return $this->db->query('select distinct id_follow, id_userfollow,id_usertarget, namatarget, biotarget FROM follow where id_usertarget in (select id_usertarget from follow where id_userfollow ='  . $this->session->userdata('id') . ')')->result();
    // }

    public function getallOtherUserData()
    {
        return $this->db->query('SELECT * FROM user')->result();
    }

    public function addPosting($data)
    {
        return $this->db->insert('posting', $data);
    }

    //tampilsemua tapi masih ada dikit bug
    // public function getPosting()
    // {
    //     return $this->db->query('SELECT distinct * FROM posting p join user u on(p.id_user = u.id) join follow f on(f.id_usertarget = u.id) where id_usertarget in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . '  and stat = 1 and role_id = 2) and stat = 1 or id_userfollow and id_usertarget = ' . $this->session->userdata('id') . ' and stat = 2 or id_userfollow = id_usertarget and status = 2  order by id_posting desc')->result();
    // }

    public function getPosting()
    {
        return $this->db->query('SELECT distinct * FROM posting p join user u on(p.id_user = u.id) join follow f on(f.id_usertarget = u.id) where id_usertarget in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . '  and stat = 1 and role_id = 2) and id_userfollow = ' . $this->session->userdata('id') . ' or id_userfollow and id_usertarget = ' . $this->session->userdata('id') . ' and stat = 2 GROUP BY(id_posting) order by id_posting desc')->result();
    }

    // public function getPosting1()
    // {
    //     return $this->db->query('SELECT distinct * FROM posting p join user u on(p.id_user = u.id) join follow f on(f.id_usertarget = u.id) where id_usertarget in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . '  and stat = 1 and role_id = 2) and id_userfollow = ' . $this->session->userdata('id') . ' order by id_posting desc')->result();
    // }

    public function getMentorData()
    {
        $gender = $this->session->userdata('gender');

        return $this->db->query("SELECT *,(SELECT ROUND(avg(rating)) FROM infaq WHERE id_mentor = id) avg_rating FROM user where role_id = 3 AND gender = '$gender' ORDER BY id ASC LIMIT 6")->result();
    }

    public function deletePostUser($id)
    {
        $this->db->where('id_posting', $id);
        $this->db->delete('posting');
    }

    public function viewAllUsers()
    {
        $query = $this->db->query('SELECT * from user where id !=' . $this->session->userdata('id') . ' and is_active = 1');

        return $query->result();
    }

    public function getUserName($name)
    {
        $id = $this->session->userdata('id');
        $gender = $this->session->userdata('gender');

        $query = $this->db->query("SELECT * FROM user where id <> '$id' and name LIKE '%$name%' and role_id IN(2) and gender = '$gender'");

        return $query->result();
    }

    public function getUserNameMentor($name)
    {
        $id = $this->session->userdata('id');
        $gender = $this->session->userdata('gender');

        $query = $this->db->query("SELECT *,(SELECT ROUND(avg(rating)) FROM infaq i JOIN user u on(i.id_mentor = u.id) WHERE u.name LIKE '%$name%') avg_rating FROM user where id <> '$id' and name LIKE '%$name%' and role_id IN(3) and gender = '$gender' ORDER BY id ASC LIMIT 6");

        return $query->result();
    }

    public function getNotification()
    {
        $id = $this->session->userdata('id');
        return $this->db->query("SELECT * FROM notification n join user u using(id) where id_tujuan = $id and id != $id order by id_notification desc")->result();
    }

    public function kirimPesan($data)
    {
        return $this->db->insert('pesan', $data);
    }

    public function addComment($data)
    {
        return $this->db->insert('comment', $data);
    }

    public function deleteComment($id)
    {
        $this->db->where('id_comment', $id);
        $this->db->delete('comment');
        $this->db->where('id_notification', $id);
        $this->db->delete('notification');
    }

    public function deleteNotification($id)
    {
        $this->db->where('id_notification', $id);
        $this->db->delete('notification');
    }

    public function getComment()
    {
        return $this->db->query('SELECT * FROM comment c join user u using(id) order by id_comment desc')->result();
    }

    public function addReport($data)
    {
        return $this->db->insert('report', $data);
    }

    public function getReport()
    {
        return $this->db->query('SELECT report FROM report p join user u on(p.id_user = u.id)')->result();
    }

    public function addSuka($data)
    {
        return $this->db->insert('suka', $data);
    }

    public function updateSuka($data)
    {
        $this->db->set($data);
        $this->db->where('id_posting', $this->input->post('id_posting'));
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('suka');
    }

    public function updateGaSuka($data)
    {
        $this->db->set($data);
        $this->db->where('id_posting', $this->input->post('id_posting'));
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('suka');
    }

    public function getPostById($id)
    {
        $query = $this->db->query("SELECT * from posting p  join user u on(u.id = p.id_user) where id_posting = $id");

        return $query->result();
    }

    public function getPostGenById($id)
    {
        $query = $this->db->query("SELECT * from postgen p  join user u on(u.id = p.id_user) where id_posting = $id");

        return $query->result();
    }

    public function getCommentById($id)
    {
        $query = $this->db->query("SELECT * FROM comment c join user u using(id) where id_posting = $id order by id_comment desc");

        return $query->result();
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

    public function getFollow2($id)
    {
        return $this->db->query("SELECT id_userfollow, id_usertarget, stat, count(stat) jumlahfollowers FROM follow
        where stat = 1 and id_usertarget = $id ")->result();
    }

    public function getFollow4()
    {
        return $this->db->query('SELECT id_userfollow, id_usertarget, stat, count(stat) jumlahfollowers FROM follow where id_usertarget in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . ') ')->result();
    }

    public function getFollow3($id)
    {
        return $this->db->query("SELECT id_userfollow, id_usertarget, stat FROM follow
        where id_usertarget = $id ")->result();
    }

    public function getFollow()
    {
        return $this->db->query('SELECT * FROM follow
        where id_usertarget != ' . $this->session->userdata('id') . ' order by id_follow asc')->result();
    }

    public function getPollow()
    {
        return $this->db->query('SELECT *, count(*) as total FROM follow where id_userfollow = ' . $this->session->userdata('id') . ' and id_usertarget = ' . $this->uri->segment('3') . '')->result();
    }

    // public function getFollow()
    // {
    //     return $this->db->query('SELECT distinct id_follow, stat, id_userfollow, id_usertarget, name, id, image, bio FROM user right join follow on follow.id_userfollow = user.id
    //     where id_usertarget not in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . ')')->result();
    // }

    // public function getFollow()
    // {
    //     return $this->db->query('SELECT DISTINCT * FROM follow join user on follow.id_usertarget = user.id where id_userfollow !=' . $this->session->userdata('id') . ' and stat != 1 and id_usertarget in (select id_usertarget where id_userfollow = ' . $this->session->userdata('id') . ')')->result();
    // }

    public function getidpost()
    {
        $query = $this->db->query("SELECT id_posting+1 id_posting FROM suka order by id_posting desc limit 1");
        return $query->result();
    }

    public function addFollow($data)
    {
        return $this->db->insert('follow', $data);
    }

    public function updateFollow($data)
    {
        $this->db->set($data);
        $this->db->where('id_userfollow', $this->session->userdata('id'));
        $this->db->where('id_usertarget', $this->input->post('id_usertarget'));
        $this->db->update('follow');
    }

    public function updateUnFollow($data)
    {
        $this->db->set($data);
        $this->db->where('id_userfollow', $this->session->userdata('id'));
        $this->db->where('id_usertarget', $this->input->post('id_usertarget'));
        $this->db->update('follow');
    }

    public function getJumlahFollowers()
    {
        return $this->db->query('SELECT count(id_usertarget) jumlahfollowers FROM follow where id_usertarget =' . $this->session->userdata('id') . ' and stat =1')->result();
    }

    public function getPesanById()
    {
        // $query = $this->db->query('SELECT * FROM pesan p join user u on (p.id_pengirim = u.id) where id_penerima = ' . $this->session->userdata('id') . ' and id_pengirim !=\'$id\'');
        // return $query->result();

        $id_user = $this->session->userdata('id');

        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('user', 'pesan.id_pengirim = user.id');
        $this->db->where('id_penerima =', $id_user);
        $this->db->group_by('id_pengirim');
        $this->db->order_by('pesan' . ' desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getChat()
    {
        return $this->db->query('SELECT * FROM user u join follow f on (u.id = f.id_userfollow) where id_usertarget in (select id_usertarget from follow where id_userfollow = ' . $this->session->userdata('id') . ') and id_userfollow = ' . $this->session->userdata('id') . '  and role_id = 2' . ' and stat = 1')->result();
    }

    // public function getPesanByIdsendiri($id)
    // {
    //     // $query = $this->db->query('SELECT * FROM pesan p join user u on (p.id_pengirim = u.id) where id_pengirim =' . $this->session->userdata('id') . ' ');
    //     // return $query->result();
    //     $id_user = $this->session->userdata('id');

    //     $this->db->select('*');
    //     $this->db->from('pesan');
    //     $this->db->join('user', 'pesan.id_pengirim = user.id');
    //     $this->db->where('id_penerima =', $id);
    //     $this->db->where('id_pengirim =', $id_user);
    //     $this->db->order_by('date' . ' desc');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function getPesanByIdsendiri2($id)
    {
        // $query = $this->db->query('SELECT * FROM pesan p join user u on (p.id_pengirim = u.id) where id_pengirim =' . $this->session->userdata('id') . ' ');
        // return $query->result();
        $id_user = $this->session->userdata('id');

        $this->db->select('*');
        $this->db->from('pesan');
        $this->db->join('user', 'pesan.id_pengirim = user.id');
        $this->db->where('id_penerima =', $id);
        $this->db->where('id_pengirim =', $id_user);
        $this->db->or_where('id_penerima =', $id_user);
        $this->db->where('id_pengirim =', $id);
        $this->db->order_by('date' . ' asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getUserPostProfile($id)
    {
        return $this->db->query("SELECT * FROM posting p join user u on(p.id_user = u.id) where id = '$id' order by p.id_posting desc")->result();
    }

    public function getUserVisit()
    {
        return $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
            'role_id' => $this->session->userdata('role_id'),
            'id' => $this->uri->segment('3'),
        ])->row_array();
    }

    public function getInfoProfile($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id =', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getInfoProfileChat()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id =', $this->uri->segment('3'));
        $query = $this->db->get();
        return $query->result();
    }

    // public function getFollowingVisit()
    // {
    //     $this->db->select('id_usertarget, namatarget, imagetarget, biotarget');
    //     $this->db->from('follow');
    //     $this->db->join('user', 'follow.id_userfollow = user.id');
    //     $this->db->where('id_userfollow =', $this->uri->segment('3'));
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    // public function getFollowersVisit()
    // {
    //     return $this->db->query("SELECT * FROM follow f join user u on(u.id = f.id_userfollow) where id_usertarget =$")->result();
    // }

    public function getPostgen()
    {
        return $this->db->query('SELECT * FROM postgen p join user u on(p.id_user = u.id) order by p.id_posting desc limit 3')->result();
    }

    public function getPengumuman()
    {
        return $this->db->query('SELECT * FROM pengumuman order by id desc limit 1')->result();
    }

    public function getFollowingVisit()
    {
        return $this->db->query('SELECT id_usertarget, namatarget, imagetarget, biotarget FROM follow f join user u on(u.id = f.id_userfollow) where id_userfollow =' . $this->uri->segment('3') . ' and stat = 1')->result();
    }

    public function getFollowersVisit()
    {
        return $this->db->query('SELECT * FROM follow f join user u on(u.id = f.id_userfollow) where id_usertarget = ' . $this->uri->segment('3') . ' and stat = 1')->result();
    }

    //
    public function getInfoProfileVisit()
    {
        $query = $this->db->query('SELECT * from user where id = ' . $this->uri->segment('3'));

        return $query->result();
    }

    public function getUserPostProfileVisit()
    {
        return $this->db->query('SELECT * FROM posting p join user u on(p.id_user = u.id) where id = ' . $this->uri->segment('3') . ' order by p.id_posting desc')->result();
    }

    public function getRatingMentor()
    {
        return $this->db->query('SELECT avg(rating) avg_rating FROM infaq GROUP BY id_mentor')->result();
    }

    public function getUserInfaqSum($id)
    {

        return $this->db->query("SELECT sum(nominal) jml_infaq FROM `infaq` WHERE tanggal_infaq = DATE(NOW()) AND id_user_infaq = '$id'")->row_array();
    }

    public function last_transaksi_topup($id)
    {
        return $this->db->query("SELECT * FROM `transaksi_topup_dompet` WHERE status_code = 200 AND id_user ='$id' ORDER BY transaction_time DESC")->row_array();
    }

}
