<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UnggahMateriUmum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Unggah Materi Umum";
        $this->load->view('templates/headerPostGen', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_postgeneral');
        $this->load->view('templates/footer');
    }

    public function postingGen()
    {
        $caption = htmlspecialchars($this->input->post('caption', true));
        $id_user = htmlspecialchars($this->input->post('id_user', true));
        $fileName = $this->_uploadFileGen();

        if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'mkv') || (substr($fileName, -3, 3) == 'flv')) {

            $html .= '<video class="post-video" controls width="500" height="500">';
            $html .= '<source src=' . base_url('assets_user/file_upload/');
            $html .= $fileName . ' type="video/mp4">';
            $html .= '</video>';
        } else {
            $html = '<img src=' . base_url('assets_user/file_upload/');
            $html .= $fileName . ' alt="post-image"';
            $html .= 'class="img-responsive post-image"  style="border-radius: 5px 5px 5px 5px;"/>';
        }

        $data = [
            'caption' => $caption,
            'fileName' => $fileName,
            'html' => $html,
            'date_post' => time(),
            'id_user' => $id_user,
            'state' => 0,
        ];

        //siapkan token
        $this->session->set_flashdata('message', '<small> br</small>');

        // $this->db->insert('postgen', $data);
        $this->Admin_model->addPostGen($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
        Unggahan Materi Umum <strong>Berhasil</strong> Ditampilkan, Silahkan Terbitkan Di Halaman Kelola Unggah Materi Umum
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        redirect('UnggahMateriUmum');
    }

    private function _uploadFileGen()
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

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show" role="alert">
        Tolong pilih gambar atau video terlebih dahulu!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

            redirect('UnggahMateriUmum');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv', 'mkv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible show" role="alert">
        Berkas yang ingin anda unggah bukan berformat gambar atau video!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

            redirect('UnggahMateriUmum');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
    }
}
