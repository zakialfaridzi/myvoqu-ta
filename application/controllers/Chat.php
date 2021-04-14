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
        $data['saldo_wallet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
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
        $data['pengumuman'] = $this->User_model->getPengumuman();

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
        $data['getChat'] = $this->User_model->getChat();
        $data['getInfoChat'] = $this->User_model->getInfoProfileChat();
<<<<<<< HEAD
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['postgen'] = $this->User_model->getPostgen();

        $saldo_dompet = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        $topup_berhasil_terakhr = $this->User_model->last_transaksi_topup($this->session->userdata('id'));

        $data['saldosekarang'] = $saldo_dompet['saldo'] + $topup_berhasil_terakhr['gross_amount'];
=======
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
>>>>>>> 6dd12ebafd2c38f384b2162bfb17f424de8b0896

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
<<<<<<< HEAD
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['postgen'] = $this->User_model->getPostgen();

        $saldo_dompet = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        $topup_berhasil_terakhr = $this->User_model->last_transaksi_topup($this->session->userdata('id'));

        $data['saldosekarang'] = $saldo_dompet['saldo'] + $topup_berhasil_terakhr['gross_amount'];
=======
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['postgen'] = $this->User_model->getPostgen();
>>>>>>> 6dd12ebafd2c38f384b2162bfb17f424de8b0896

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
            'pesan' => htmlspecialchars($this->input->post('isi_pesan')),
            'sudah_dibaca' => 'belum',
        );
        $this->User_model->kirimPesan($data);
        redirect("chat/chat2/" . $id);
    }
}
