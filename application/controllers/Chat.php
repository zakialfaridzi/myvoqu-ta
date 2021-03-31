<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model');
        $this->load->model('User_model');

        $this->load->library('form_validation');
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
        $data['pesan'] = $this->User_model->getPesanById();
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Chat';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
        $data['otherUser'] = $this->User_model->getOherUserData();
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

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('chat/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }
    public function chat2($id)
    {
        $data['pesan3'] = $this->User_model->getPesanByIdsendiri2($id);
        $data['otherUser'] = $this->User_model->getOherUserData();
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Chat';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
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
            $this->load->helper('smiley');
            $this->load->library('table');

            $image_array = get_clickable_smileys(base_url() . 'assets/smileys/', 'comment');
            $col_array = $this->table->make_columns($image_array, 20);

            $data['smiley_table'] = $this->table->generate($col_array);
            $data['otherUser'] = $this->User_model->getOherUserData();

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('chat/chat2', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function pilihUser()
    {
        $data['pesan'] = $this->User_model->getPesanById();
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Chat';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
        $data['otherUser'] = $this->User_model->getOherUserData();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();
        $data['getChat'] = $this->User_model->getChat();

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
            $this->load->view('chat/pilihUser', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function kirimPesan($id)
    {
        $data = array(
            'id_pesan' => '',
            'id_penerima' => $id,
            'id_pengirim' => $this->input->post('id'),
            'date' => time(),
            'pesan' => $this->input->post('isi_pesan'),
            'sudah_dibaca' => 'belum'
        );
        $this->User_model->kirimPesan($data);
        redirect("chat/chat2/" . $id);
    }
}
