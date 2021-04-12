<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Friend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $data['upload'] = 'none';
        $data['search'] = '';
        $data['colorSearch'] = 'black';
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['otherUser'] = $this->User_model->getOherUserData();
        $data['allotherUser'] = $this->User_model->getallOtherUserData();
        $data['title'] = 'Pencarian teman';
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
            $this->load->view('friend/index');
            $this->load->view('templates_newsfeed/footer');
        }
    }

    public function getUserByName($name = "")
    {
        $data['type'] = $this->User_model->getUserName($name);

        $this->load->view('ajax/friend', $data);
    }

    public function addFollow($id)
    {
        $data = array(
            'date' => time(),
            'stat' => 1,
            'id_userfollow' => $this->input->post('id_userfollow'),
            'id_usertarget' => $this->input->post('id_usertarget'),
            'namatarget' => $this->input->post('nama'),
            'biotarget' => $this->input->post('bio'),
            'imagetarget' => $this->input->post('image'),
        );
        $this->User_model->addFollow($data);
        redirect("friend/visitProfile/" . $id);
    }

    public function updateUnFollow($id)
    {
        $data = array(
            'stat' => 2,
            'date' => time(),
            'id_userfollow' => $this->input->post('id_userfollow'),
            'id_usertarget' => $this->input->post('id_usertarget'),
            'namatarget' => $this->input->post('nama'),
            'biotarget' => $this->input->post('bio'),
            'imagetarget' => $this->input->post('image'),
        );
        $this->User_model->updateUnFollow($data);
        redirect("friend/visitProfile/" . $id);
    }

    public function updateFollow($id)
    {
        $data = array(
            'stat' => 1,
            'date' => time(),
            'id_userfollow' => $this->input->post('id_userfollow'),
            'id_usertarget' => $this->input->post('id_usertarget'),
            'namatarget' => $this->input->post('nama'),
            'biotarget' => $this->input->post('bio'),
            'imagetarget' => $this->input->post('image'),
        );
        $this->User_model->updateFollow($data);
        redirect("friend/visitProfile/" . $id);
    }

    public function visitProfile($id)
    {
        $data['posting'] = $this->User_model->getUserPostProfile($id);
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->User_model->getUser($id);
        $data['info'] = $this->User_model->getInfoProfile($id);
        $data['follow2'] = $this->User_model->getFollow($id);
        $data['follow3'] = $this->User_model->getFollow2($id);
        $data['follow4'] = $this->User_model->getFollow4($id);
        $data['pollow'] = $this->User_model->getpollow($id);
        $data['title'] = 'Profil teman';
        $data['active'] = 'active';

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
            $this->load->view('templates_profile/bg_profile_visit', $data);
            $this->load->view('friend/visitProfile', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function followersVisit($id)
    {

        $data['posting'] = $this->User_model->getUserPostProfileVisit();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['info'] = $this->User_model->getInfoProfileVisit($id);
        $data['title'] = 'Yang Mengikuti';
        $data['active'] = 'active';
        $data['followersVisit'] = $this->User_model->getFollowersVisit($id);
        $data['pollow'] = $this->User_model->getpollow($id);

        $data['otherUser'] = $this->User_model->getOherUserData();
        $this->load->view('templates_newsfeed/topbar', $data);
        $this->load->view('templates_profile/bg_profile_visit', $data);
        $this->load->view('templates_profile/followersVisit', $data);
        $this->load->view('templates_profile/end', $data);
    }

    public function followingVisit()
    {
        $data['posting'] = $this->User_model->getUserPostProfileVisit();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['info'] = $this->User_model->getInfoProfileVisit();
        $data['title'] = 'Yang diikuti';
        $data['active'] = 'active';
        $data['followingVisit'] = $this->User_model->getFollowingVisit();
        $data['pollow'] = $this->User_model->getpollow();

        $data['otherUser'] = $this->User_model->getOherUserData();
        $this->load->view('templates_newsfeed/topbar', $data);
        $this->load->view('templates_profile/bg_profile_visit', $data);
        $this->load->view('templates_profile/followingVisit', $data);
        $this->load->view('templates_profile/end', $data);

    }

    public function aboutMeVisit()
    {
    $data['posting'] = $this->User_model->getUserPostProfileVisit();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['info'] = $this->User_model->getInfoProfileVisit();
        $data['title'] = 'tentang';
        $data['active'] = 'active';
        $data['pollow'] = $this->User_model->getpollow();

        $data['otherUser'] = $this->User_model->getOherUserData();
        $this->load->view('templates_newsfeed/topbar', $data);
        $this->load->view('templates_profile/bg_profile_visit', $data);
        $this->load->view('profile/aboutMeVisit', $data);
        $this->load->view('templates_profile/end', $data);
}

}