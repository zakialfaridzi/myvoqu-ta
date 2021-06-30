<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Group extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Group_model');
        $this->load->library('form_validation');

        if (empty($this->session->userdata('id'))) {
            redirect('auth');
        }

        $topup_berhasil_terakhr = $this->User_model->last_transaksi_topup($this->session->userdata('id'));

        $saldo_dpt = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        if (!is_null($topup_berhasil_terakhr)) {

            if ($topup_berhasil_terakhr['status_code'] == 200) {
                $saldo_skrg = $saldo_dpt['saldo'] + $topup_berhasil_terakhr['gross_amount'];

                $where = [
                    'id_user' => $this->session->userdata('id'),
                    'status_code' => 200,
                ];

                $this->db->update('transaksi_topup_dompet', ['status_code' => 199], $where);

                $data_saldo = [
                    'saldo' => $saldo_skrg,
                ];

                $this->db->update('dompet', $data_saldo, ['id_user' => $this->session->userdata('id')]);
            }
        }
    }

    public function sessionLogin()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		Login first!!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');
        redirect('auth');
    }

    public function index()
    {
        $data['postgen'] = $this->User_model->getPostgen();
        $iduser = $this->session->userdata['id'];
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['allgroup'] = $this->Group_model->getGroup();
        $data['detgroup'] = $this->Group_model->specGroup($iduser);
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['title'] = 'Group';
        $data['suggestion'] = $this->User_model->getSuggest();
        $data['pengumuman'] = $this->User_model->getPengumuman();

        // $data['saldo_wallet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        // $data['postgen'] = $this->User_model->getPostgen();

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $data['otherUser'] = $this->User_model->getOherUserData();
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('group/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function tambahGroup()
    {
        $data['title'] = 'Buat Group';
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $data['otherUser'] = $this->User_model->getOherUserData();
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('desc', 'Desc', 'required');
            if ($this->form_validation->run() == true) {
                $datagroup = [
                    "nama" => $this->input->post('nama', true),
                    "deskripsi" => $this->input->post('desc', true),
                    "image" => $this->input->post('image', true),
                    "owner" => $this->input->post('id', true),
                ];
                $this->Group_model->tambahDataGroup($datagroup);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                    Gagal Dibuat, ada yang belum terisi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            }
            redirect('group');
        }
    }

    public function ubahGroup($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Ubah Group';
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['allgroup'] = $this->Group_model->getGroup();
        $data['active'] = 'active';
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $data['otherUser'] = $this->User_model->getOherUserData();
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('desc', 'Desc', 'required');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates_newsfeed/topbar', $data);
                $this->load->view('templates_profile/bg_groupProfile', $data);
                $this->load->view('templates_profile/sidebar_editGroup', $data);
                $this->load->view('group/ubah', $data);
                $this->load->view('templates_profile/end_group', $data);
            } else {
                $idgroup = $this->input->post('id');
                $datagroup = [
                    "nama" => $this->input->post('name', true),
                    "deskripsi" => $this->input->post('desc', true),
                ];
                $this->Group_model->ubahDataGroup($idgroup, $datagroup);
                redirect('group/inGroup/' . $id);
            }
        }
    }

    public function ubahPhotoGroup($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Ubah Foto Group';
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['allgroup'] = $this->Group_model->getGroup();
        $data['active'] = 'active';
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $data['otherUser'] = $this->User_model->getOherUserData();
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('desc', 'Desc', 'required');
            if ($this->form_validation->run() == false) {
                $this->load->view('templates_newsfeed/topbar', $data);
                $this->load->view('templates_profile/bg_groupProfile', $data);
                $this->load->view('templates_profile/sidebar_editGroup', $data);
                $this->load->view('group/ubahPhoto', $data);
                $this->load->view('templates_profile/end_group', $data);
            } else {
                $idgroup = $this->input->post('id');
                $datagroup = [
                    "nama" => $this->input->post('name', true),
                    "deskripsi" => $this->input->post('desc', true),
                ];
                $this->Group_model->ubahDataGroup($idgroup, $datagroup);
                redirect('group');
            }
        }
    }

    public function getData($type, $id, $idg = null)
    {
        if ($type == 'postHafalan') {
            $data = $this->Group_model->getStoredHafalan($id, $idg)->result();
            echo json_encode($data);
        }elseif ($type == "anggota") {
            $data = $this->Group_model->getAnggotaGroup($id);
            echo json_encode($data);
        }
    }

    public function inGroup($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['title'] = 'Group Feeds';
        $data['active'] = 'active';
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        // $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);
        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/ingroup', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function inGroupSetoran($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['postingan'] = $this->Group_model->getPostinganSetoran($id);
        $data['title'] = 'Group Feeds';
        $data['active'] = 'active';
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);
        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/inHafalan', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function listAnggota($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Group Profile';
        $data['active'] = 'active';
        $data['anggota'] = $this->Group_model->getAnggota();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/anggota', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function info($id)
    {
        // $this->load->model('GroupProfile_model');
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['idgroup'] = $this->Group_model->getGroupbyId($id);
        $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Group Information';
        $data['active'] = 'active';
        $data['allinfo'] = $this->Group_model->getInfoGroup();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/information', $data);
            $this->load->view('templates_profile/end_group', $data);
            // $this->load->view('templates_newsfeed/footer');
        }
    }

    public function chatGroup($id)
    {
        // $this->load->model('GroupProfile_model');
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['idgroup'] = $this->Group_model->getGroupbyId($id);
        $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Group Chat';
        $data['active'] = 'active';
        $data['allinfo'] = $this->Group_model->getInfoGroup();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['nama_user'] = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/chatGroup', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function quiz($id)
    {
        // $this->load->model('GroupProfile_model');
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        // $data['idgroup'] = $this->Group_model->getGroupbyId($id);
        $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Group Information';
        $data['active'] = 'active';
        $data['allinfo'] = $this->Group_model->getInfoGroup();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/chatGroup', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function deleteGroup($id)
    {
        $this->Group_model->hapusGroup($id);
        redirect('Group');
    }

    public function tambahInfo($type, $idg)
    {
        if ($type == 'tugas') {
            $this->form_validation->set_rules('nama', 'Nama Surah', 'required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                    Gagal Dibuat, ada yang belum terisi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>');
                redirect('group/info/' . $idg);
            } else {
                $datainfo = [
                    "nama_surah" => $this->input->post('nama', true),
                    "id_group" => $idg,
                    "from_ayat" => $this->input->post('fromAyat', true),
                    "to_ayat" => $this->input->post('toAyat', true),
                    'catatan' => $this->input->post('catatan', true),
                    'id_user' => $this->input->post('iduser', true)
                ];
                $this->Group_model->addInfo('tugas_hafalan', $datainfo);
                redirect('group/info/' . $idg);
            }
        } else {
            $this->form_validation->set_rules('informasi', 'Informasi', 'required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                    Gagal Dibuat, ada yang belum terisi
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
            </div>');
                redirect('group/info/' . $idg);
            } else {
                $datainfo = [
                    "info" => $this->input->post('informasi', true),
                    "id_group" => $idg,
                    "id_user" => $this->input->post('iduser', true)
                ];
                $this->Group_model->addInfo('group_information', $datainfo);
                redirect('group/info/' . $idg);
            }
        }
    }

    public function tambahAnggota($id)
    {
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        $data['posting'] = $this->Group_model->getUserPostProfile();
        $data['postingan'] = $this->Group_model->getPostingan($id);
        $data['search'] = '';
        $data['colorSearch'] = 'black';
        $data['user'] = $this->User_model->getUser();
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['title'] = 'Group Profile';
        $data['active'] = 'active';
        $data['getAllUser'] = $this->Group_model->getAllUser();
        $data['cek'] = $this->Group_model->cekAnggota();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($id)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($id)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($id);
        $data['columnReport'] = $this->Group_model->columnReport($id);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
              Your access is only for admin, sorry :(
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>');
            redirect('admin');
        } else {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/tambahAnggota', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function getUserByName($name)
    {
        $data['type'] = $this->Group_model->getUserName($name);

        $this->load->view('ajax/friend.php', $data);
    }

    public function inviteUser($idg, $id)
    {
        $data = [
            'id_user' => $id,
            'id_group' => $idg,
        ];
        $this->Group_model->tambahUser($data);
        redirect('group/tambahAnggota/' . $idg);
    }

    public function kickUser($idg)
    {
        $id = $this->input->post('iduser');
        $this->Group_model->kickAnggota($id);
        redirect('group/listAnggota/' . $idg);
    }

    public function posting($type, $idg)
    {
        if ($type == 'postingan') {
            $this->form_validation->set_rules('caption', 'Caption', 'trim');

            if ($this->form_validation->run() == false) {
                $this->index();
            } else {
                $caption = htmlspecialchars($this->input->post('caption', true));
                $id_user = htmlspecialchars($this->input->post('id_user', true));
                $fileName = $this->_uploadFile($idg);

                if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'flv')) {
                    $html = '<div class="video-wrapper">';
                    $html .= '<video class="post-video" controls>';
                    $html .= '<source src=' . base_url('assets_user/file_upload/');
                    $html .= $fileName . ' type="video/mp4">';
                    $html .= '</video></div>';
                } else {
                    $html = '<img src=' . base_url('assets_user/file_upload/');
                    $html .= $fileName . ' alt="post-image"';
                    $html .= 'class="img-responsive post-image" />';
                }

                $data = [
                    'caption' => $caption,
                    'id_group' => $idg,
                    'id_user' => $id_user,
                    'fileName' => $fileName,
                    'html' => $html,
                ];

                //siapkan token
                $this->session->set_flashdata('message', '<small> br</small>');

                $this->db->insert('group_postingan', $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
		<strong>Selamat!</strong> postinganmu berhasil diupload.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');

                redirect('group/inGroup/' . $idg);
            }
        } else {
            $this->form_validation->set_rules('nama_surah', 'Nama Surah', 'trim');

            if ($this->form_validation->run() == false) {
                $this->ingroup($idg);
            } else {
                $surah = $this->input->post('nama_surah', true);
                $ayat = $this->input->post('from_ayat', true);
                $ayat2 = $this->input->post('to_ayat', true);
                $id_user = $this->input->post('id_user', true);
                $id_group = $idg;
                $id_tugas = $this->input->post('id_tugas', true);
                $fileName = $this->_uploadFile($idg);

                if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'flv')) {
                    $html = '<div class="video-wrapper">';
                    $html .= '<video class="post-video" controls>';
                    $html .= '<source src=' . base_url('assets_user/file_upload/');
                    $html .= $fileName . ' type="video/mp4">';
                    $html .= '</video></div>';
                } else {
                    $html = '<img src=' . base_url('assets_user/file_upload/');
                    $html .= $fileName . ' alt="post-image"';
                    $html .= 'class="img-responsive post-image" />';
                }
                if ($ayat2 != null) {
                    $data = [
                        'caption' => 'Setoran surah '. $surah . ' ayat '. $ayat . '-' . $ayat2,
                        'id_group' => $idg,
                        'id_user' => $id_user,
                        'fileName' => $fileName,
                        'html' => $html,
                        'tugas' => $id_tugas
                    ];
                }else{
                    $data = [
                        'caption' => 'Setoran surah '. $surah . ' ayat '. $ayat,
                        'id_group' => $idg,
                        'id_user' => $id_user,
                        'fileName' => $fileName,
                        'html' => $html,
                        'tugas' => $id_tugas
                    ];
                }
                $report = [
                    'id_tugas' => $id_tugas,
                    'id_user' => $id_user,
                    'id_group' => $idg
                ];
                //siapkan token
                $this->session->set_flashdata('message', '<small> br</small>');

                $this->db->insert('group_postingan', $data);
                $this->db->insert('report_hafalan', $report);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
		<strong>Selamat!</strong> hafalanmu berhasil diupload.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');

                redirect('group/inGroup/' . $idg);
            }
        }
    }
    private function _uploadFile($id)
    {
        $namaFiles = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $eror = $_FILES['file']['error'];
        // $nama_file = str_replace(" ", "_", $namaFiles);
        $tmpName = $_FILES['file']['tmp_name'];
        // $nama_folder = "assets_user/file_upload/";
        // $file_baru = $nama_folder . basename($nama_file);

        // if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($ukuranFile < 8000000)) {

        //   move_uploaded_file($tmpName, $file_baru);
        //   return $file_baru;
        // }
        if ($eror === 4) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
			Chose an image or video first!
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>');
            redirect('group/inGroup/' . $id);
            return false;
        }
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      	Your uploaded file, is not image or video!
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
     	 </button>
 		 </div>');
            redirect('group/inGroup/' . $id);
            return false;
        }
        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function deletePost($id)
    {
        $idPost = $this->input->post('id_post');
        $this->Group_model->deletePostGroup($idPost);

        $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
      	Postinganmu berhasil dihapus.
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
      	</button>
  		</div>');
        redirect('group/inGroup/' . $id);
    }

    public function getIdposting($idg, $idp)
    {
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->Group_model->getPostById($idp);
        $data['comment'] = $this->Group_model->getCommentById($idp);
        $data['postingan'] = $this->Group_model->getPostingan($idp);
        $data['suka'] = $this->Group_model->getSukaById($idp);
        $data['sukaa'] = $this->Group_model->getSukaaById($idp);
        $data['allUser'] = $this->Group_model->getUserData($this->session->userdata('id'));
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['datagroup'] = $this->Group_model->getDataGroup($idg);
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data['active'] = 'active';
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data2['notification'] = $this->Group_model->getNotification();
        $data['notifGroup'] = $this->Group_model->getNotif($idg);
        // $data['idpost'] = $this->Group_model->getidpost();
        // $data['report'] = $this->Group_model->getReport();
        // $data['jumlahfollowers'] = $this->Group_model->getJumlahFollowers();

        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['hafalan'] = $this->Group_model->gethafalan($idg)->result();
        $data['postHafalan'] = $this->Group_model->getPostHafalan($idg)->result();
        $data['reportHafalan'] = $this->Group_model->reportHafalan($idg);
        $data['columnReport'] = $this->Group_model->columnReport($idg);

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $this->load->helper('smiley');
            $this->load->library('table');
            $image_array = get_clickable_smileys(base_url() . 'assets/smileys/', 'comment');
            $col_array = $this->table->make_columns($image_array, 20);

            $data['smiley_table'] = $this->table->generate($col_array);
            $data['otherUser'] = $this->User_model->getOherUserData();

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_groupProfile', $data);
            $this->load->view('group/posting', $data);
            $this->load->view('templates_profile/end_group', $data);
        }
    }

    public function commentPost($id)
    {
        $data = array(
            'id_comment' => '',
            'comment' => $this->input->post('comment'),
            'id_posting' => $this->input->post('id_posting'),
            'date' => time(),
            'id_user' => $this->input->post('id'),
        );
        //   $data2 = array(
        //   'id_notification' => '',
        //   'notif' => $this->input->post('notifComment'),
        //   'date' => time(),
        //   'id_posting' => $this->input->post('id_posting'),
        //   'id' => $this->input->post('id')
        // );
        $this->Group_model->addComment($data);
        $idp = $this->input->post('id_posting');
        //$this->Group_model->addNotification($data2);
        redirect("group/getIdposting/" . $id . '/'. $idp);
    }

    public function deleteComment($id, $idg, $idp)
    {
        $this->Group_model->deleteComment($id);
        //$this->Group_model->deleteNotification();
    //     $this->session->set_flashdata('nn', '<div class="alert alert-success alert-dismissible show" role="alert">
    //   Komentar berhasil dihapus.
    //   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //       <span aria-hidden="true">&times;</span>
    //   </button>
  	// 	</div>');
        redirect("group/getIdposting/" . $idg . '/'. $idp);
    }

    public function updatePhoto($id)
    {
        $potolama = $this->input->post('potolama');
        $file = 'assets/img/group/' . $potolama;

        $filename = $this->_uploadFile2();
        $data = [
            'image' => $filename,
        ];
        if ($potolama == 'default.png') {
            if (is_readable($file)) {
                $this->Group_model->editPhoto($id, $data);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				Berhasil diubah
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>');

                redirect('Group/inGroup/' . $id);
            } else {
                echo "The file was not found or not readable and could not be deleted";
            }
        } else {
            if (is_readable($file) && unlink($file)) {

                $this->Group_model->editPhoto($id, $data);

                $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
				Berhasil diubah
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				</div>');

                redirect('Group/inGroup/' . $id);
            } else {
                echo "The file was not found or not readable and could not be deleted";
            }
        }
    }

    private function _uploadFile2()
    {
        $namaFiles = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $eror = $_FILES['file']['error'];

        // $nama_file = str_replace(" ", "_", $namaFiles);
        $tmpName = $_FILES['file']['tmp_name'];
        // $nama_folder = "assets_user/file_upload/";
        // $file_baru = $nama_folder . basename($nama_file);

        // if ((($type == "video/mp4") || ($type == "video/3gpp")) && ($ukuranFile < 8000000)) {

        //   move_uploaded_file($tmpName, $file_baru);
        //   return $file_baru;
        // }

        if ($eror === 4) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
				Chose an image or video first!
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>');

            redirect('Group/inGroup/' . $id);

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
					Your uploaded file, is not image or video!
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>');

            redirect('Group/inGroup/' . $id);
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets/img/group/' . $namaFilesBaru);

        return $namaFilesBaru;
    }
}
