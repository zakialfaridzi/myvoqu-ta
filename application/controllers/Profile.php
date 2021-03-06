<?php
defined('BASEPATH') or exit('No direct script access allowed');
//test
class Profile extends CI_Controller
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

        if (!is_null($topup_berhasil_terakhr)) {

            if ($topup_berhasil_terakhr['status_code'] == 200) {
                $saldo_skrg = $saldo_dpt['saldo'] + $topup_berhasil_terakhr['gross_amount'];

                $where = [
                    'id_user' => $this->session->userdata('id'),
                    'status_code' => 200,
                ];

                $this->db->update('transaksi_topup_dompet', ['status_code' => 199], $where);

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

        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Profile';
        $data['active'] = 'active';
        $data['saldo_dompet'] = $this->db->get_where('dompet', ['id_user' => $this->session->userdata('id')])->row_array();

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                  Your access is only for admin, sorry :(
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
            redirect('admin');
        } else {

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('profile/index', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function posting()
    {

        $this->form_validation->set_rules('caption', 'Caption', 'trim');

        if ($this->form_validation->run() == false) {

            $this->index();
        } else {
            $caption = htmlspecialchars($this->input->post('caption', true));
            $id_user = htmlspecialchars($this->input->post('id_user', true));
            $fileName = $this->_uploadFile();

            if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'flv')) {
                $html = '<div class="video-wrapper">';
                $html .= '<video class="post-video" controls>';
                $html .= '<source src=' . base_url('assets_user/file_upload/');
                $html .= $fileName . ' type="video/mp4">';
                $html .= '</video></div>';
            } else {
                $html = '<img src=' . base_url('assets_user/file_upload/');
                $html .= $fileName . ' alt="post-image"';
                $html .= 'class="img-responsive post-image" style="height: 500px;" />';
            }

            $data = [
                'caption' => $caption,
                'id_user' => $id_user,
                'fileName' => $fileName,
                'html' => $html,
                'date_post' => time(),
            ];

            //siapkan token
            $this->session->set_flashdata('message', '<small> br</small>');

            $this->db->insert('posting', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
      <strong>Selamat!</strong> postingan mu berhasil diunggah.
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('profile');
        }
    }

    private function _uploadFile()
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
      Pilih foto atau video terlebih dahulu!
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('profile');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Yang kamu upload bukan foto/video
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('profile');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function deletePost($id, $filename)
    {

        $file = 'assets_user/file_upload/' . $filename;

        if (is_readable($file) && unlink($file)) {

            $this->User_model->deletePostUser($id);

            $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
      	<strong>Selamat!</strong> postingan berhasil dihapus.
      	<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      	</button>
  		</div>');
            redirect('profile');
        } else {
            echo "The file was not found or not readable and could not be deleted";
        }
    }

    public function editProfile()
    {
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Profile';
        $data['active'] = '';

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                  Your access is only for admin, sorry :(
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
            redirect('admin');
        } else {

            $data['on_f'] = 'active';
            $data['on_s'] = '';
            $data['on_p'] = '';

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('templates_profile/sidebar_edit', $data);
            $this->load->view('profile/editProfile', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function followers()
    {

        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Yang mengikuti';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
        $data['followers'] = $this->Profile_model->getFollowers();

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
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
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('profile/followers', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function following()
    {

        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Yang diikuti';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
        $data['following'] = $this->Profile_model->getFollowing();

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
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
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('profile/following', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function editBasic()
    {

        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email', [
            'valid_email' => 'Email tidak valid',
        ]);

        if ($this->session->userdata('role_id') == 3) {
            $this->form_validation->set_rules('instansi', 'Instansi', 'required|min_length[1]|max_length[15]');
        }

        if ($this->form_validation->run() == false) {
            $this->editProfile();
        } else {
            $name = htmlspecialchars($this->input->post('name', true));
            $email = htmlspecialchars($this->input->post('email', true));
            $birtdate = htmlspecialchars($this->input->post('date', true));
            $gender = htmlspecialchars($this->input->post('gender', true));
            $city = htmlspecialchars($this->input->post('city', true));
            $bio = htmlspecialchars($this->input->post('bio', true));
            $work = htmlspecialchars($this->input->post('work', true));
            if ($this->session->userdata('role_id') == 3) {
                $instansi = strtoupper(str_replace(['-', ' ', '.', '_', '!', '/', '(', ')', '#', '&'], "", htmlspecialchars($this->input->post('instansi', true))));
            }

            $data = [

                'name' => $name,
                'email' => $email,
                'birthdate' => $birtdate,
                'gender' => $gender,
                'city' => $city,
                'bio' => $bio,
                'work' => $work,
                'instansi' => $instansi,
            ];

            $id = $this->session->userdata('id');

            $datas = $this->db->query("SELECT * FROM user where id ='$id'")->result();

            foreach ($datas as $d) {

                if ($d->email == $email) {

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
            <strong>Selamat!</strong> profil berhasil diperbarui!
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
                    $this->Profile_model->editBasicModel($data);
                    // var_dump();die();

                    redirect('profile/editProfile');
                } else {
                    $cekdulu = $this->db->query("select * from user where email ='$email'");

                    if ($cekdulu->num_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">
            <strong>Sorry :( </strong>' . $email . ' email already used!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
                        redirect('profile/editProfile');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">
                        <strong>Congratulastions </strong> your profile is updated <br> Please login again!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>');

                        $this->Profile_model->editBasicModel($data);

                        $this->session->unset_userdata('email');
                        $this->session->unset_userdata('role_id');
                        $this->session->unset_userdata('id');

                        redirect('auth');
                    }
                }
            }
        }

        // $this->Profile_model->editBasicModel($data);
    }

    public function editPassword()
    {

        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Profile';
        $data['active'] = 'active';
        $data['on_f'] = '';
        $data['on_s'] = 'active';
        $data['on_p'] = '';

        $this->form_validation->set_rules('password1', 'Paassword', 'trim|required|min_length[3]', [
            // 'matches' => '',
            'min_length' => 'Password terlalu pendek',
            'required' => 'Password tidak boleh kosong',
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Paassword', 'trim|required|min_length[3]|matches[password1]', [
            'matches' => 'Password tidak cocok',
            'min_length' => 'Password terlalu pendek',
            'required' => 'Password tidak boleh kosong',
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('templates_profile/sidebar_edit', $data);
            $this->load->view('profile/editPassword', $data);
            $this->load->view('templates_profile/end', $data);
        } else {

            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            // $email = $this->session->userdata('reset_email');

            $this->db->set('passsword', $password);
            $this->db->where('id', $this->session->userdata('id'));
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
			Password berhasil diperbarui
			<button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>');
            redirect('profile/editPassword');
        }

    }

    public function editPhoto()
    {
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'Profile';
        $data['active'] = '';

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
                  Your access is only for admin, sorry :(
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
            redirect('admin');
        } else {

            $data['on_f'] = '';
            $data['on_s'] = '';
            $data['on_p'] = 'active';

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('templates_profile/sidebar_edit', $data);
            $this->load->view('profile/editPhoto', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

    public function updatePhoto()
    {
        $potolama = $this->input->post('potolama');
        $file = 'assets_user/images/' . $potolama;

        $filename = $this->_uploadFile2();
        $data = [
            'image' => $filename,
        ];

        $gender = strtolower($this->session->userdata('gender'));

        if ($potolama == "default_" . $gender . ".png") {

            $this->Profile_model->editPhoto($data);

            $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
			Berhasil diubah
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>');

            redirect('profile/editPhoto');
        } elseif ($potolama != "default_" . $gender . ".png") {

            if (is_readable($file) && unlink($file)) {

                $this->Profile_model->editPhoto($data);

                $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
		Berhasil diubah
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
		</div>');

                redirect('profile/editPhoto');
            } else {
                echo "The file was not found or not readable and could not be deleted";
            }
        }
    }

    private function _uploadFile2()
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

        //8000000 = 8Mb

        if ($ukuranFile > 5000000) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
			Ukuran gambar terlalu besar
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
				</div>');

            redirect('profile/editPhoto');

            return false;
        }

        if ($eror === 4) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Pilih foto terlebih dahulu
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('profile/editPhoto');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Yang anda pilih bukan gambar
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  		</div>');

            redirect('profile/editPhoto');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/images/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function aboutMe()
    {
        $data['posting'] = $this->Profile_model->getUserPostProfile();
        $data['search'] = 'none';
        $data['upload'] = 'none';
        $data['colorSearch'] = '#0486FE';
        $data['user'] = $this->Profile_model->getUser();
        $data['info'] = $this->Profile_model->getInfoProfile();
        $data['title'] = 'tentang';
        $data['active'] = 'active';
        $data['allUser'] = $this->Profile_model->getUserData();
        $data['following'] = $this->Profile_model->getFollowing();

        if (empty($data['user']['email'])) {

            $this->sessionLogin();
        } else if ($data['user']['role_id'] == 1) {
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
            $this->load->view('templates_profile/bg_profile', $data);
            $this->load->view('profile/aboutMe', $data);
            $this->load->view('templates_profile/end', $data);
        }
    }

}
