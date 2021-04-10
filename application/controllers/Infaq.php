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

    public function addInfaq()
    {

        $jumlah = $this->input->post('jumlah');

        $bintang = $this->input->post('star');

        // var_dump($bintang);die();

        if (is_null($bintang)) {
            $this->session->set_flashdata('pesan', '<div id="snackbar" class="show">

			<button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
				<span aria-hidden="true" onclick="myFunction(3000)">&times;</span>
			</button>


			<p>Maaf!! Kamu belum pilih bintang!</p>


			</div>');

        } else {
            $this->session->set_flashdata('pesan', '<div id="snackbar" class="show">

			<button type="button" id="close" class="close" data-dismiss="alert" aria-label="Close" style="color: white;">
				<span aria-hidden="true" onclick="myFunction(3000)">&times;</span>
			</button>


			<p>Hore!! Kamu sudah infaq srbanyak ' . $jumlah . ' hari ini!</p>


			</div>');
        }

        redirect('infaq/index');

    }
}