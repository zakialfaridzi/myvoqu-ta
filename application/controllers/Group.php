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

        $topup_berhasil_terakhr = $this->User_model->last_transaksi_topup($this->session->userdata('id'));

        $saldo_dpt = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        if ($topup_berhasil_terakhr['status_code'] == 200) {
            $saldo_skrg = $saldo_dpt['saldo'] + $topup_berhasil_terakhr['gross_amount'];
            $this->db->update('transaksi_topup_dompet', ['status_code' => 199], ['id_user' => $this->session->userdata('id')]);

            $data_saldo = [
                'saldo' => $saldo_skrg,
            ];

            $this->db->update('dompet', $data_saldo, ['id_user' => $this->session->userdata('id')]);
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
            $datagroup = [
                "nama" => $this->input->post('nama', true),
                "deskripsi" => $this->input->post('desc', true),
                "image" => $this->input->post('image', true),
                "owner" => $this->input->post('id', true),
            ];
            $this->Group_model->tambahDataGroup($datagroup);
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
        $data['title'] = 'Group Information';
        $data['active'] = 'active';
        $data['allinfo'] = $this->Group_model->getInfoGroup();
        $data['notifGroup'] = $this->Group_model->getNotif($id);
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();

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

    public function tambahInfo($idg)
    {
        $this->form_validation->set_rules('informasi', 'Informasi', 'required');
        if ($this->form_validation->run() == false) {
            redirect('group');
        } else {
            $datainfo = [
                "info" => $this->input->post('informasi', true),
                "id_group" => $this->input->post('idgroup', true),
                "id_user" => $this->input->post('iduser', true),
            ];
            $this->Group_model->addInfo($datainfo);
            redirect('group/info/' . $idg);
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

    public function inviteUser($idg)
    {
        $data = [
            'id_user' => $this->input->post('iduser'),
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

    public function posting($idg)
    {
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
		<strong>Congratulations!</strong> your post is uploaded.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');

            redirect('group/inGroup/' . $idg);
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
      	<strong>Congratulations!</strong> your post is deleted.
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          	<span aria-hidden="true">&times;</span>
      	</button>
  		</div>');
        redirect('group/inGroup/' . $id);
    }

    public function getIdposting($id)
    {
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->Group_model->getPostById($id);
        $data['comment'] = $this->Group_model->getCommentById($id);
        $data['postingan'] = $this->Group_model->getPostingan($id);
        // $data['suka'] = $this->Group_model->getSukaById($id);
        // $data['sukaa'] = $this->Group_model->getSukaaById($id);
        $data['allUser'] = $this->Group_model->getUserData($this->session->userdata('id'));
        $data['info'] = $this->Group_model->getInfoProfile($this->session->userdata('id'));
        $data['datagroup'] = $this->Group_model->getDataGroup($id);
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data2['notification'] = $this->Group_model->getNotification();
        // $data['idpost'] = $this->Group_model->getidpost();
        // $data['report'] = $this->Group_model->getReport();
        // $data['jumlahfollowers'] = $this->Group_model->getJumlahFollowers();

        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();

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
            // $this->load->view('templates_newsfeed/header', $data);
            //$this->load->view('templates_profile/bg_groupProfile', $data);
            //$this->load->view('user/getIdposting', $data);
            $this->load->view('group/posting', $data);
            //$this->load->view('templates_profile/end_group', $data);
            // $this->load->view('templates_newsfeed/footer');
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
        //$this->Group_model->addNotification($data2);
        redirect("group/getIdposting/" . $id);
    }

    public function deleteComment($id)
    {
        $this->Group_model->deleteComment($id);
        //$this->Group_model->deleteNotification();

        $this->session->set_flashdata('nn', '<div class="alert alert-success alert-dismissible show" role="alert">
      <strong>Congratulations!</strong> your comment is deleted.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');
        redirect("group/getIdposting/" . $id);
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