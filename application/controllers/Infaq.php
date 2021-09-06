<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Infaq extends CI_Controller
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

        if (!is_null($topup_berhasil_terakhr)) {

            if ($topup_berhasil_terakhr['status_code'] == 200) {
                $saldo_skrg = $saldo_dpt['saldo'] + $topup_berhasil_terakhr['gross_amount'];
                $this->db->update('transaksi_topup_dompet', ['status_code' => 199], ['id_user' => $this->session->userdata('id')]);

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
        $data['upload'] = 'none';
        $data['postgen'] = $this->User_model->getPostgen();
        $data['search'] = '';
        $data['colorSearch'] = 'black';
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['otherUserMentor'] = $this->User_model->getMentorData();
        $data['otherUser'] = $this->User_model->getOherUserData();
        $data['allotherUser'] = $this->User_model->getallOtherUserData();
        $data['title'] = 'Home';
        $data['allUsers'] = $this->User_model->viewAllUsers();
        $data['follow'] = $this->User_model->getFollow();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
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
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('infaq/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function getUserByNameMentor($name = "")
    {
        $data['type'] = $this->User_model->getUserNameMentor($name);

        $this->load->view('ajax/friend', $data);
    }

    public function addInfaq()
    {

        $jumlah = $this->input->post('jumlah');

        $bintang = $this->input->post('star');

        $rating = $this->input->post('rating');

        $id_mentor = $this->input->post('id_mentor');

        if (is_null($bintang)) {
            $this->session->set_flashdata('pesan', '<div id="snackbar" class="show">

			<button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
				<span aria-hidden="true" onclick="myFunction(3000)">&times;</span>
			</button>


			<p>Maaf!! Kamu belum pilih bintang!</p>


			</div>');

        } else {

            // var_dump($bintang);die();

            //cek kalau jumlah infaq nya kurang dari jmlh nominal didompet
            //ambil data domper nya dulu

            $data_dompet = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
            $data_dompet_mentor = $this->db->get_where('dompet', ['id_user' => $id_mentor])->row_array();

            if ($data_dompet['saldo'] - $jumlah < 0) {
                $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible show" role="alert">
				<strong>Infaq gagal!</strong> Saldo tidak cukup.
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>');

                redirect("infaq");
            } else {

                $data = [
                    'rating' => $rating,
                    'nominal' => $jumlah,
                    'id_user_infaq' => $this->session->userdata('id'),
                    'id_mentor' => $id_mentor,
                ];
                $this->db->insert('infaq', $data);

                $jumlah_infaq = $this->User_model->getUserInfaqSum($this->session->userdata('id'));

                $data_dompet_pemberi = [
                    'saldo' => $data_dompet['saldo'] - $jumlah,
                ];

                $data_dompet_penerima = [
                    'saldo' => $data_dompet_mentor['saldo'] + $jumlah,
                ];

                $this->db->update('dompet', $data_dompet_pemberi, ['id_user' => $this->session->userdata('id')]);
                $this->db->update('dompet', $data_dompet_penerima, ['id_user' => $id_mentor]);

                $this->session->set_flashdata('pesan', '<div id="snackbar" class="show">

			<button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
				<span aria-hidden="true" onclick="myFunction(3000)">&times;</span>
			</button>


			<p>Hore!! Kamu sudah infaq sebanyak <b>Rp.' . number_format($jumlah_infaq['jml_infaq'], 2, ',', '.') . '</b> hari ini!</p>


			</div>');
            }
        }

        redirect('infaq/index');

    }

    public function isi_wallet()
    {

        $id_user_login = $this->session->userdata('id');
        $nominal = $this->input->post('nominal_topup');
        $redirect = $this->input->post('redirect');

        $nominal_wallet_user = $this->db->get_where('dompet', ['id_user' => $id_user_login])->row_array();

        if ($nominal < 10000) {

            $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible show" role="alert">
			<strong>Pengisian gagal!</strong> Nominal yang anda masukkan dibawah Rp10.000,00.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>');

            redirect("$redirect");
        } else {

            $data = [
                'nominal' => $nominal,
                'bukti_bayar' => $this->_uploadFile(),
                'id_dompet' => $nominal_wallet_user['id_dompet'],
            ];

            $this->db->insert('transaksi_topup_wallet', $data);

            $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible show" role="alert">
			<strong>Berhasil!</strong> Pengisian berhasil dilakukan, admin akan memeriksa secepatnya.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  	</div>');

            redirect("$redirect");

        }

    }

    private function _uploadFile()
    {
        $redirect = $this->input->post('redirect');
        $namaFiles = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $eror = $_FILES['file']['error'];
        $tmpName = $_FILES['file']['tmp_name'];

        if ($eror === 4) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible show" role="alert">
      	Pilih foto atau video terlebih dahulu!
      	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      	</button>
  		</div>');

            redirect("$redirect");

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('alert', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Yang kamu upload bukan foto!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect("$redirect");
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/file_upload/bukti_trf_wallet/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

}