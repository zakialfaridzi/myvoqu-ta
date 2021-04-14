<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');

        if (empty($this->session->userdata('id'))) {

            redirect('auth');

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
        $data['upload'] = 'none';
        $data['postgen'] = $this->User_model->getPostgen();
        $data['search'] = '';
        $data['colorSearch'] = 'black';
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['otherUser'] = $this->User_model->getMentorData();
        $data['allotherUser'] = $this->User_model->getallOtherUserData();
        $data['title'] = 'Home';
        $data['allUsers'] = $this->User_model->viewAllUsers();
        $data['follow'] = $this->User_model->getFollow();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();

        //dari sini

        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        //sampai sini khusu algoritma wallet

        $where = [
            'id_user' => $this->session->userdata('id'),
        ];

        $data['transaksi_wallet'] = $this->db->order_by('transaction_time', 'DESC')->get_where('transaksi_topup_dompet', $where)->result();
        $data['transaksi_infaq'] = $this->db->order_by('id_infaq', 'DESC')->get_where('infaq', ['id_user_infaq' => $this->session->userdata('id')])->result();

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
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('transaksi/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

}