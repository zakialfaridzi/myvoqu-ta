<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProfileAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Profil Admin";
        $this->load->view('templates/header', $dats);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('admin/v_profad', $data);
        $this->load->view('templates/footer');
    }

    public function editProfile($id)
    {
        $where = array(
            'id' => $id,
        );

        $data['mahasiswa'] = $this->Admin_model->edit_data($where, 'user')->result();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Profil Admin";
        $this->load->view('templates/header', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_profad', $data);
        $this->load->view('templates/footer');
    }

    public function updateProfile()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('nama');
        $email = $this->input->post('email');
        $upload_image = $_FILES['image']['name'];
        if ($upload_image != "") {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = '10000';
            $config['upload_path'] = './assets/foto/';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        } else {
            $new_image = $this->input->post('old');
        }

        $data = array(
            'name' => $name,
            'email' => $email,
            'image' => $new_image,
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->update_data($where, $data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
        Data Profil Admin <strong>Berhasil</strong> Diperbarui
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('ProfileAdmin/index/');
    }
}
