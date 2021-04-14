<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
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
        $id = $this->session->userdata('id');
        $data['postgen'] = $this->User_model->getPostgen();
        $data['saldo_wallet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['comment'] = $this->User_model->getComment();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Notifikasi';
        $data['notification'] = $this->User_model->getNotification();
        // $data['notifGroup'] = $this->User_model->getNotifGroup($id);
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();
        $data['pengumuman'] = $this->User_model->getPengumuman();

        $saldo_dompet = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        $topup_berhasil_terakhr = $this->User_model->last_transaksi_topup($this->session->userdata('id'));

        $data['saldosekarang'] = $saldo_dompet['saldo'] + $topup_berhasil_terakhr['gross_amount'];

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
            $this->load->view('notification/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }
}
