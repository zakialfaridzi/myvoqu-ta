<?php
class Admin_model extends CI_model
{
    public function getAdmin()
    {
        return $this->db->get_where('user', [
            'email' => $this->session->userdata('email'),
            'role_id' => $this->session->userdata('role_id'),
        ])->row_array();
    }

    public function profileAdmin()
    {
        return $this->db->get_where('user', [
            'id' => $this->session->userdata('id'),
        ])->result();
    }

    public function tampil_data()
    {
        $query = $this->db->query("CALL tampilpenghafal()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function hapus_data($id2, $id)
    {
        $this->db->delete('anggota', $id2);
        $this->db->delete('user', $id);
    }

    public function activate_data($where, $data)
    {
        $this->db->update('user', $data, $where);
    }

    public function deactivate_data($where, $data)
    {
        $this->db->update('user', $data, $where);
    }

    public function edit_data($where)
    {
        return $this->db->get_where('user', $where);
    }

    public function update_data($where, $data)
    {
        $this->db->update('user', $data, $where);
    }

    public function detail_data($id = null)
    {
        $query = $this->db->get_where('user', array('id' => $id))->row();
        return $query;
    }

    public function getJumlahFollowers($id = null)
    {
        return $this->db->query("SELECT count(id_usertarget) jumlahfollowers FROM follow where id_usertarget = $id  and stat =1")->result();
    }

    public function getJumlahFollowing($id = null)
    {
        return $this->db->query("SELECT count(id_userfollow) jumlahfollowing FROM follow where id_userfollow = $id  and stat =1")->result();
    }

    public function get_search($search)
    {
        $this->db->select('*');
        $this->db->like('name', $search);
        $this->db->where("role_id='2'");
        return $this->db->from('user')
            ->get()
            ->result();
    }

    public function countUser()
    {
        $query = $this->db->query('SELECT count(id) as jumlah FROM user where role_id="2"');
        return $query->result();
    }

    public function countUserOnline()
    {
        $query = $this->db->query('SELECT count(id) as jumlahonline FROM user where role_id="2" and status="online-dot"');
        return $query->result();
    }

    public function countMentorOnline()
    {
        $query = $this->db->query('SELECT count(id) as jumlahmentoronline FROM user where role_id="3" and status="online-dot"');
        return $query->result();
    }

    public function countUserActive()
    {
        $query = $this->db->query('SELECT count(id) as jumlahactive FROM user where role_id="2" and is_active="1"');
        return $query->result();
    }

    public function countPost()
    {
        $query = $this->db->query('SELECT count(id_posting) as jumlahpost FROM posting');
        return $query->result();
    }

    public function countMentor()
    {
        $query = $this->db->query('SELECT count(id) as jumlahmentor FROM user where role_id="3"');
        return $query->result();
    }

    public function countGroup()
    {
        $query = $this->db->query('SELECT count(id) as jumlahgroup FROM grup');
        return $query->result();
    }

    public function userChart()
    {
        $query = $this->db->query("CALL chartuser()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function PostingUserChart()
    {
        $query = $this->db->query("CALL chartpost()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function mentorChart()
    {
        $query = $this->db->query("CALL chartinstansi()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function roleidChart()
    {
        $query = $this->db->query("CALL chartroleid()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    /////////////////////////////////////////////////////
    //Mentor//
    /////////////////////////////////////////////////////

    public function tampil_mentor()
    {
        $query = $this->db->query("CALL tampilmentor()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function detail_mentor($id = null)
    {
        $query = $this->db->get_where('user', array('id' => $id))->row();
        return $query;
    }

    public function detail_mentor2()
    {
        return $this->db->get('grup')->result_array();
    }

    public function hapus_mentor($where3, $where2, $where)
    {
        $this->db->delete('posting', $where2);
        $this->db->delete('group_information', $where2);
        $this->db->delete('group_postingan', $where2);
        $this->db->delete('grup', $where3);
        $this->db->delete('user', $where);
    }

    // public function edit_mentor($where)
    // {
    //     return $this->db->get_where('user', $where);
    // }

    // public function update_mentor($where, $data)
    // {
    //     $this->db->update('user', $data, $where);
    // }

    public function get_searchMentor($search)
    {
        $this->db->select('*');
        $this->db->like('name', $search);
        $this->db->or_like('instansi', $search);
        $this->db->where("role_id", "3");
        return $this->db->from('user')
            ->get()
            ->result();
    }

    /////////////////////////////////////////////////////
    //Post//
    /////////////////////////////////////////////////////

    public function tampil_post()
    {
        $query = $this->db->query("CALL tampilpost()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function detail_post($id)
    {
        $query = $this->db->query("CALL detailpost($id)");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function getSukaById($id)
    {
        $query = $this->db->query("SELECT id, status, count(status) jumlahsuka FROM suka s where status = 1 and id_posting = $id");

        return $query->result();
    }

    public function detail_post2($id)
    {
        $query = $this->db->query("select * from posting where id_posting = $id");
        return $query->result();
    }

    public function hapus_post($where)
    {
        $this->db->delete('posting', $where);
    }

    // public function edit_post($where)
    // {
    //     return $this->db->get_where('posting', $where);
    // }

    public function get_searchPost($search)
    {
        $this->db->select('*');
        $this->db->from('posting');
        $this->db->like('caption', $search);
        $this->db->or_like('user.name', $search);
        $this->db->join('user', 'posting.id_user=user.id');
        return $this->db->get()->result();
    }

    public function addPostGen($data)
    {
        $this->db->insert('postgen', $data);
    }

    public function tampil_postgen()
    {
        $query = $this->db->query("CALL tampilpostgen()");
        $res = $query->result();

        $query->next_result();
        $query->free_result();

        return $res;
    }

    public function detail_postgen($id_posting = null)
    {
        $query = $this->db->get_where('postgen', array('id_posting' => $id_posting))->row();
        return $query;
    }

    public function detail_postgen2($id)
    {
        $query = $this->db->query("SELECT * FROM postgen p join user u on p.id_user=u.id where p.id_posting = $id");
        return $query->result();
    }

    public function hapus_postgen($where)
    {
        $this->db->delete('postgen', $where);
    }

    public function publish_postgen($id)
    {
        $data = array(
            'state' => '1',
            'date_post' => time(),
        );

        $this->db->where('id_posting', $id);
        $this->db->update('postgen', $data);
    }

    // public function edit_postgen($where)
    // {
    //     return $this->db->get_where('postgen', $where);
    // }

    public function get_searchPostgen($search)
    {
        $this->db->select('*');
        $this->db->from('postgen');
        $this->db->like('caption', $search);
        $this->db->or_like('id_posting', $search);
        return $this->db->get()->result();
    }

    //////////////////////////////////////////
    ///////////Groups/////////////
    /////////////////////////////////////////

    public function tampil_group()
    {
        $query = $this->db->query("SELECT *, grup.id as gid, user.id as uid, grup.image as img FROM grup join user on grup.owner = user.id");
        return $query->result();
    }

    public function detail_group($id)
    {
        $query = $this->db->query("select a.*, g.*, count(a.id_group) as ca, u.name from grup g join anggota a on g.id=a.id_group join user u on g.owner = u.id where g.id = $id");
        return $query->result();
    }

    public function detail_group2($id)
    {
        $query = $this->db->query("select u.name as naus from anggota a join user u on a.id_user = u.id join grup g on a.id_group = g.id where a.id_group= $id order by u.name asc");
        return $query->result();
    }

    public function hapus_group($where)
    {
        $this->db->delete('grup', $where);
    }

    public function get_searchGroup($search)
    {
        $this->db->select('*');
        $this->db->from('grup');
        $this->db->like('nama', $search);
        return $this->db->get()->result();
    }

    ///////////////todo
    public function tampil_todo()
    {
        $id = $this->session->userdata('id');
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where('tasks', ['id_user' => $id]);
        return $query->result();
    }

    public function tambah_todo()
    {
        $data = ['task_name' => $this->input->post('namatodo', true), 'datepost' => time(), 'id_user' => $this->session->userdata('id')];

        $this->db->insert('tasks', $data);
    }

    public function done_todo($id)
    {
        $data = array(
            'state' => '1',
            'datepost' => time(),
        );

        $this->db->where('id', $id);
        $this->db->update('tasks', $data);
    }

    public function undone_todo($id)
    {
        $data = array(
            'state' => '0',
            'datepost' => time(),
        );

        $this->db->where('id', $id);
        $this->db->update('tasks', $data);
    }

    public function edit_todo($id)
    {
        $this->db->from('tasks');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function update_todo($id)
    {
        $data = ['task_name' => $this->input->post('namatodo', true), 'datepost' => time()];

        $this->db->where('id', $id);
        $this->db->update('tasks', $data);

    }

    public function delete_todo($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tasks');
    }

    public function getTodoById($id)
    {
        return $this->db->get_where('tasks', ['id' => $id])->row_array();
    }

    public function get_searchTodo($search)
    {
        $this->db->select('*');
        $this->db->from('tasks');
        $this->db->like('task_name', $search);
        $this->db->or_like('id', $search);
        return $this->db->get()->result();
    }

    public function tampil_pengumuman()
    {
        $data = $this->db->query('select p.id,p.isi_pengumuman,p.datepost,u.name from pengumuman p join user u on p.id_user=u.id order by id desc')->result();
        return $data;
    }

    public function tambah_pengumuman()
    {
        $data = ['isi_pengumuman' => $this->input->post('namapengumuman', true), 'datepost' => time(), 'id_user' => $this->session->userdata('id')];

        $this->db->insert('pengumuman', $data);
    }

    public function edit_pengumuman($id)
    {
        $this->db->from('pengumuman');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function update_pengumuman($id)
    {
        $data = ['isi_pengumuman' => $this->input->post('namapengumuman', true), 'datepost' => time(), 'id_user' => $this->session->userdata('id')];

        $this->db->where('id', $id);
        $this->db->update('pengumuman', $data);

    }

    public function delete_pengumuman($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pengumuman');
    }

    public function getPengumumanById($id)
    {
        return $this->db->get_where('pengumuman', ['id' => $id])->row_array();
    }

    public function get_searchPengumuman($search)
    {
        $this->db->select('pengumuman.id, pengumuman.isi_pengumuman, pengumuman.datepost, user.name');
        $this->db->from('pengumuman');
        $this->db->like('isi_pengumuman', $search);
        $this->db->join('user', 'pengumuman.id_user=user.id');
        return $this->db->get()->result();
    }
}
