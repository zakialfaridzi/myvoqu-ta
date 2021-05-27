<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Library extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Materi_model');
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
        $data['search'] = '';
        $data['upload'] = '';
        $data['postgen'] = $this->User_model->getPostgen();
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['title'] = 'Surat-Surat';
        $data['allSurat'] = $this->Materi_model->getAllSurat();
        $data['suggestion'] = $this->User_model->getSuggest();
        $idlog = $this->session->userdata('id');
        $data['idlogin'] = $this->Materi_model->getLog($idlog);
        $data['pengumuman'] = $this->User_model->getPengumuman();
        $data['saldo_wallet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        $saldo_dompet = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

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
            $this->load->view('library/index', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function addSurat()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('arti', 'Arti', 'required');
        $this->form_validation->set_rules('ayat', 'Ayat', 'required');
        $this->form_validation->set_rules('suratke', 'Suratke', 'required');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Something Wrong!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('Library');
        } else {
            $datasurat = [
                'nama' => $this->input->post('nama', true),
                'arti' => $this->input->post('arti', true),
                'ayat' => $this->input->post('ayat', true),
                'suratke' => $this->input->post('suratke', true),
            ];
            $this->Materi_model->tambahSurat($datasurat);
            redirect('Library');
        }
    }

    public function materi($id)
    {
        $idlog = $this->session->userdata('id');
        $data['search'] = '';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['title'] = 'Materi';
        $data['suggestion'] = $this->User_model->getSuggest();
        $data['idlogin'] = $this->Materi_model->getLog($idlog);
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
            $idm = $this->uri->segment('3');
            //PAGINATION
            $this->load->library('pagination');
            //config
            $config['base_url'] = 'http://localhost/myvoqu/library/materi/' . $id;
            $config['total_rows'] = $this->Materi_model->countMateri($idm);
            $config['per_page'] = 4;

            //style
            $config['full_tag_open'] = '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul></nav>';

            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item">';
            $config['first_tag_close'] = '</li>';

            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item">';
            $config['last_tag_close'] = '</li>';

            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="page-item">';
            $config['next_tag_close'] = '</li>';

            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="page-item">';
            $config['prev_tag_close'] = '</li>';

            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';

            $config['num_tag_open'] = '<li class="page-item">';
            $config['num_tag_close'] = '</li>';

            $config['attributes'] = array('class' => 'page-link');

            //inisialisasi pagination
            $this->pagination->initialize($config);
            $data['start'] = $this->uri->segment('4');
            $data['materi'] = $this->Materi_model->getAllMateri($idm, $config['per_page'], $data['start']);
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('library/materi', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function posting($idm)
    {
        $this->form_validation->set_rules('ayat', 'Ayat', 'trim');
        if ($this->form_validation->run() == false) {
            // $this->materi($idm);
            redirect('library/materi/' . $idm);
        } else {
            $ayat = htmlspecialchars($this->input->post('ayat', true));
            $id_user = htmlspecialchars($this->input->post('id_user', true));
            $nama_mentor = htmlspecialchars($this->input->post('ustad', true));
            $fileName = $this->_uploadFile($idm);

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
                'nama' => $ayat,
                'id_surat' => $idm,
                'id_user' => $id_user,
                'fileName' => $fileName,
                'html' => $html,
            ];

            //siapkan token
            $this->session->set_flashdata('message', '<small> br</small>');
            $this->db->insert('materi', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
      <strong>Congratulations!</strong> your post is uploaded.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('library/materi/' . $idm);
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
            redirect('library/materi/' . $id);
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
            redirect('library/materi/' . $id);
            return false;
        }
        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
    }
}