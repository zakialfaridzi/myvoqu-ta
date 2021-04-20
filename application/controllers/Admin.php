<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['user'] = $this->Admin_model->getAdmin();
        $data['title'] = 'My Profile';

        if (empty($data['user']['email'])) {

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Masuk kedalam aplikasi terlebih dahulu
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('auth');
        } else if ($data['user']['role_id'] == 2) {
            redirect('user');
        } else {

            $data['count'] = $this->Admin_model->countUser(); //penghafal counter dash
            $data['countpost'] = $this->Admin_model->countPost(); //post counter dash
            $data['countmentor'] = $this->Admin_model->countMentor(); //mentor counter dash
            $data['countonline'] = $this->Admin_model->countUserOnline(); //penghafal online counter dash
            $data['countmentoronline'] = $this->Admin_model->countMentorOnline(); //mentor online counter dash
            $data['countactive'] = $this->Admin_model->countUserActive(); //penghafal active counter dash
            $data['countgroup'] = $this->Admin_model->countGroup(); //group counter dash
            $data['hasil'] = $this->Admin_model->userChart(); // chart user gender
            $data['hasil2'] = $this->Admin_model->mentorChart(); // chart agency mentor
            $data['hasil3'] = $this->Admin_model->PostingUserChart(); // chart posting data
            $data['hasil4'] = $this->Admin_model->roleidChart(); // chart role_id
            $dats['mahasiswa'] = $this->Admin_model->profileAdmin(); //sidebar profile
            $dats['active'] = "active";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $dats);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('templates/footer');
        }
    }

    public function logout()
    {
        $this->db->set('status', 'offline-dot');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('user');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Anda berhasil keluar dari aplikasi
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth/');
    }

    // public function findTodo($id)
    // {
    //     $this->load->model('Admin_model');
    //     $data['row'] = $this->Admin_model->edit_todo($id);
    //     echo $data['row']['task_name'];
    // }
}
