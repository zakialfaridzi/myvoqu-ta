 <?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
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
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['comment'] = $this->User_model->getComment();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data2['notification'] = $this->User_model->getNotification();
        $data['idpost'] = $this->User_model->getidpost();
        $data['jumlahfollowers'] = $this->User_model->getJumlahFollowers();
        $data['suggestion'] = $this->User_model->getSuggest();

        if (empty($data['user']['email'])) {
            $this->sessionLogin();
        } elseif ($data['user']['role_id'] == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger ">
            Your access is only for admin, sorry :(
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
            redirect('admin');
        } else {
            $data['otherUser'] = $this->User_model->getOtherUserData();

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates_newsfeed/footer');
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
            $id_posting = '';

            if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'mkv') || (substr($fileName, -3, 3) == 'flv')) {
                $html = '<div class="video-wrapper">';
                $html .= '<video class="post-video" controls  width="500" height="500">';
                $html .= '<source src=' . base_url('assets_user/file_upload/');
                $html .= $fileName . ' type="video/mp4">';
                $html .= '</video></div>';
            } else {
                $html = '<img src=' . base_url('assets_user/file_upload/');
                $html .= $fileName . ' alt="post-image"';
                $html .= 'class="img-responsive post-image" style="height: 350px;" />';
            }

            $data = [
                'id_posting' => $id_posting,
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
      <strong>Congratulations!</strong> your post is uploaded.
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');
        }

        redirect('user');
    }

    private function _uploadFile()
    {
        $namaFiles = $_FILES['file']['name'];
        $ukuranFile = $_FILES['file']['size'];
        $type = $_FILES['file']['type'];
        $eror = $_FILES['file']['error'];
        $tmpName = $_FILES['file']['tmp_name'];

        if ($eror === 4) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Chose an image or video first!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');

            redirect('user');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv', 'mkv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('mm', '<div class="alert alert-danger alert-dismissible show" role="alert">
      Your uploaded file, is not image or video!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');

            redirect('user');
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
      <strong>Congratulations!</strong> your post is deleted.
      <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');
            redirect('user');
        } else {
            echo "The file was not found or not readable and could not be deleted";
        }
    }

    public function reportPost($id)
    {
        $data = array(
            'id_report' => '',
            'report' => 1,
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id' => $this->input->post('id'),
        );
        $this->User_model->reportPost($id);

        $this->session->set_flashdata('mm', '<div class="alert alert-success alert-dismissible show" role="alert">
      <strong>Congratulations!</strong> your post is deleted.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');
        redirect('user');
    }

    public function commentPost($id)
    {
        $data = array(
            'id_comment' => '',
            'comment' => $this->input->post('comment'),
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id' => $this->input->post('id'),
            'id_tujuan' => $this->input->post('id_user'),
        );
        $this->User_model->addComment($data);
        redirect("user/getIdposting/" . $id);
    }

    public function deleteComment($id, $idpost)
    {
        $this->User_model->deleteComment($id);

        $this->session->set_flashdata('nn', '<div class="alert alert-success alert-dismissible show" role="alert">
      <strong>Congratulations!</strong> your comment is deleted.
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>');
        redirect("user/getIdposting/" . $idpost);
    }

    public function updateSuka($id)
    {
        $data = array(
            'status' => 1,
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id' => $this->input->post('id'),
        );
        $this->User_model->updateSuka($data);
        redirect("user/getIdposting/" . $id);
    }

    public function updateGaSuka($id)
    {
        $data = array(
            'status' => 2,
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id' => $this->input->post('id'),
        );
        $this->User_model->updateGaSuka($data);
        redirect("user/getIdposting/" . $id);
    }

    public function addSuka($id)
    {
        $data = array(
            'id_suka' => '',
            'status' => 1,
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id' => $this->input->post('id'),
            'id_tujuan' => $this->input->post('id_user'),
        );
        $this->User_model->addSuka($data);
        redirect("user/getIdposting/" . $id);
    }

    public function addReport()
    {
        $data = array(
            'id_report' => '',
            'report' => 1,
            'date' => time(),
            'id_posting' => $this->input->post('id_posting'),
            'id_user' => $this->input->post('id'),
        );
        $this->User_model->addReport($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success ">
           Success Report Post
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('user');
    }

    public function getIdposting($id)
    {
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPostById($id);
        $data['comment'] = $this->User_model->getCommentById($id);
        $data['suka'] = $this->User_model->getSukaById($id);
        $data['sukaa'] = $this->User_model->getSukaaById($id);
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data2['notification'] = $this->User_model->getNotification();
        $data['idpost'] = $this->User_model->getidpost();
        $data['report'] = $this->User_model->getReport();
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
            $this->load->helper('smiley');
            $this->load->library('table');
            $image_array = get_clickable_smileys(base_url() . 'assets/smileys/', 'comment');
            $col_array = $this->table->make_columns($image_array, 20);

            $data['smiley_table'] = $this->table->generate($col_array);
            $data['otherUser'] = $this->User_model->getOherUserData();

            $this->load->view('templates_newsfeed/topbar', $data);
            $this->load->view('templates_newsfeed/header', $data);
            $this->load->view('user/getIdposting', $data);
            $this->load->view('templates_newsfeed/footer');
        }
    }
    public function addFollow()
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
        redirect("user");
    }

    public function chatall()
    {
        $data['search'] = 'none';
        $data['upload'] = '';
        $data['colorSearch'] = '#0486FE';
        $data['posting'] = $this->User_model->getPosting();
        $data['comment'] = $this->User_model->getComment();
        $data['postgen'] = $this->User_model->getPostgen();
        $data['allUser'] = $this->User_model->getUserData();
        $data['user'] = $this->User_model->getUser();
        $data['title'] = 'Home';
        $data2['notification'] = $this->User_model->getNotification();
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
            $data['otherUser'] = $this->User_model->getOtherUserData();
            $this->load->view('user/gabung', $data);
        }
    }
}
