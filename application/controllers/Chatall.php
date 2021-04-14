<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chatall extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');

        if (empty($this->session->userdata('id'))) {
            redirect('Auth');
        }

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
        $data['saldo_wallet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['comment'] = $this->User_model->getComment();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data2['notification'] = $this->User_model->getNotification();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();

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
            $data['otherUser'] = $this->User_model->getOtherUserData();

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('chatall/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

}