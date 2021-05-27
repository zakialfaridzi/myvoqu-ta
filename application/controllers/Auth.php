<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');

        //abizard
    }

    public function index()
    {

        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else if ($this->session->userdata('role_id') == 3) {
            redirect('user');
        }

        //commit helmi

        // /asdadas
        //sadasdas

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'User Login';
            $this->load->view('templates/auth_header2', $data);
            $this->load->view('auth/login2');
            $this->load->view('templates/auth_footer2');
        } else {
            // validate success
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', [
            'email' => $email,
        ])->row_array();
        // ada user
        if ($user) {
            // jika aktif

            if ($user['is_active'] == 1) {

                //cek password
                if (password_verify($password, $user['passsword'])) {

                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id'],
                        'id' => $user['id'], 
                        'gender' => $user['gender'],
                        'image' => $user['image']
                    ];

                    $this->session->set_userdata($data);

                    if ($user['role_id'] == 1) {

                        redirect('admin');
                    } else {
                        $this->db->set('status', 'online-dot');
                        $this->db->where('email', $email);
                        $this->db->update('user');

                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Salah!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email belum aktif
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');

                redirect('auth');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Email belum terdaftar
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');

            redirect('auth');
        }
    }

    public function registration()
    {

        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else if ($this->session->userdata('role_id') == 3) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email ini sudah ada!',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek!',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('gender', 'Gender', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('templates/auth_header2', $data);
            $this->load->view('auth/registration2');
            $this->load->view('templates/auth_footer2');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'gender' => htmlspecialchars($this->input->post('gender')),
                'email' => htmlspecialchars($email),
                'image' => 'default_' . strtolower($this->input->post('gender')) . '.png',
                'passsword' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time(),
                'bio' => 'Hello World!',
            ];

            //siapkan token

            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time(),
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat</strong> akun anda sudah dibuat. Tolong aktivasi akun anda melalui email!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {

        $this->load->library('email');
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'tepung1123@gmail.com',
            'smtp_pass' => 'haM9p{&3r?GRP{.}',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);
        $this->email->from('tepung1123@gmail.com', 'Admin MyVoQu');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {

            $this->email->subject('Account Verification');
            $this->email->message('Klik link ini untuk aktivasi akun anda : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a> <br> Token aktivasi akan berlaku selama 2x24 jam, lebih dari itu token tidak akan berlaku kembali');
        } else if ($type == 'forgot') {

            $this->email->subject('Reset Password');
            $this->email->message('Klik link ini untuk mengubah password akun anda : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a> <br> Token aktivasi akan berlaku selama 2x24 jam, lebih dari itu token tidak akan berlaku kembali');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', [
            'email' => $email,
        ])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Selamat!</strong> ' . $email . ' sudah aktif. Silahkan Login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        Token expired!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           Aktivasi akun gagal! Token salah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			Aktivasi akun gagal! Email salah.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('auth');
        }
    }

    public function logout()
    {

        if (empty($this->session->userdata('email'))) {

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Apa yang kamu lakukan ?
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('auth');
        }

        $this->db->set('status', 'offline-dot');
        $this->db->where('email', $this->session->userdata('email'));
        $this->db->update('user');

        $this->load->model('Admin_model');
        $data['user'] = $this->Admin_model->getAdmin();

        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
           Kamu sudah keluar!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth');
    }

    public function forgotPassword()
    {
        if (!empty($this->session->userdata('role_id'))) {
            redirect('auth');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header2', $data);
            $this->load->view('auth/forgot-password2');
            $this->load->view('templates/auth_footer2');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time(),
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
               Tolong cek email kamu untuk reset password!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth/forgotPassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Email belum aktif!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth/forgotPassword');
            }
        }
    }

    public function resetpassword()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {

            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Reset password gagal! Token salah
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               Reset password gagal! Email salah
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {

        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Paassword', 'trim|required|min_length[3]|matches[password2]', [
            'matches' => '',
            'min_length' => '',
        ]);
        $this->form_validation->set_rules('password2', 'Repeat Paassword', 'trim|required|min_length[3]|matches[password1]', [
            'matches' => 'Password Tidak Sama!!',
            'min_length' => 'Password Terlalu Pendek!',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('templates/auth_header2', $data);
            $this->load->view('auth/change-password2');
            $this->load->view('templates/auth_footer2');
        } else {

            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('passsword', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->db->delete('user_token', ['email' => $email]);

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
               Password sudah diubah ! Silahkan Login
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
            redirect('auth');
        }
    }

    public function registMentor()
    {

        if ($this->session->userdata('role_id') == 1) {
            redirect('admin');
        } else if ($this->session->userdata('role_id') == 2) {
            redirect('user');
        } else if ($this->session->userdata('role_id') == 3) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This Email Has Already Registered!',
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password Dont Match!!',
            'min_length' => 'Password To Short!',
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|trim');
        // $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Mentor Registration';
            $this->load->view('templates/auth_header2', $data);
            $this->load->view('auth/registrationMentor', $data);
            $this->load->view('templates/auth_footer2');
        } else {
            $email = $this->input->post('email', true);
            $fileName = $this->_uploadSertif();
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'gender' => htmlspecialchars($this->input->post('gender')),
                'email' => htmlspecialchars($email),
                'image' => 'default_' . strtolower($this->input->post('gender')) . '.png',
                'passsword' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 3,
                'is_active' => 0,
                'date_created' => time(),
                'bio' => 'Hello World!',
                'sertif' => $fileName,
            ];

            $this->db->insert('user', $data);
            // $this->db->insert('infaq', $data);

            //gausah kirim aktivasi ke email, admin nge acc baru kirim aktivasi ke email

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Selamat</strong> akun berhasil didaftarkan. Tunggu verifikasi dari admin dan link aktivasi akan dikirim ke email anda.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>');

            redirect('auth');
        }
    }

    private function _uploadSertif()
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

            $this->session->set_flashdata('message', '<small style="color: red;">Pilih gambar dulu ya!</small>');

            redirect('Auth/registMentor');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('message', '<small style="color: red;">Yang kamu upload bukan foto/video!</small>');

            redirect('Auth/registMentor');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets/foto/' . $namaFilesBaru);

        return $namaFilesBaru;
    }
}