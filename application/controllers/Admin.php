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
            Login first!!
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
            You have been logged out
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('auth/');
    }

    ////////////////////////////////////////////////////////////////////
    //Profile Admin
    ////////////////////////////////////////////////////////////////////

    public function indexProfile()
    {
        $data['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
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
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_profad', $data);
        $this->load->view('templates/footer');

        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
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
        }
    }

    public function updateProfile()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('nama');
        $email = $this->input->post('email');
        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
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
        <strong>Successfully</strong> Updated
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('Admin/indexProfile/');
    }

    ////////////////////////////////////////////////////////////////////
    //Penghafal Admin
    ////////////////////////////////////////////////////////////////////

    public function indexPenghafal()
    {
        $data['user'] = $this->Admin_model->tampil_data();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_user', $data);
        $this->load->view('templates/footer');
    }

    public function hapusPenghafal($id)
    {
        $where = array(
            'id' => $id,
        );

        $where2 = array(
            'id_user' => $id,
        );

        $this->Admin_model->hapus_data($where2, $where, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Successfully</strong> Deleted
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('Admin/indexPenghafal');
    }

    public function activatePenghafal($id)
    {
        $data = array(
            'is_active' => "1",
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->activate_data($where, $data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        User has been <strong>Activated</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('Admin/indexPenghafal');
    }

    public function deactivatePenghafal($id)
    {
        $data = array(
            'is_active' => "2",
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->deactivate_data($where, $data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    User has been <strong>Deactivated</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('Admin/indexPenghafal');
    }

    // public function editPenghafal($id)
    // {
    //     $where = array(
    //         'id' => $id,
    //     );
    //     $data['mahasiswa'] = $this->Admin_model->edit_data($where, 'user')->result();
    //     $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
    //     $this->load->view('templates/header');
    //     $this->load->view('templates/sidebar', $dats);
    //     $this->load->view('admin/edit', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function updatePenghafal()
    // {
    //     $id = $this->input->post('id');
    //     $name = $this->input->post('nama');
    //     $gender = $this->input->post('gender');
    //     $email = $this->input->post('email');

    //     $data = array(
    //         'name' => $name,
    //         'gender' => $gender,
    //         'email' => $email,
    //     );

    //     $where = array(
    //         'id' => $id,
    //     );

    //     $this->Admin_model->update_data($where, $data, 'user');
    //     $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
    // <strong>Successfully</strong> Updated
    //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //     <span aria-hidden="true">&times;</span>
    //     </button>
    //     </div>');
    //     redirect('Admin/indexPenghafal');
    // }

    public function detailPenghafal($id)
    {
        $this->load->model('Admin_model');
        $detail = $this->Admin_model->detail_data($id);
        $data['detail'] = $detail;
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail', $data);
        $this->load->view('templates/footer');
    }

    public function printPenghafal()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_data();
        $this->load->view('admin/print_users', $data);
    }

    public function pdfPenghafal()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_data();
        $this->load->view('admin/pdfPenghafal', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_penghafal.pdf", array('Attachment' => 0));
    }

    public function excelPenghafal()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_data();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List Penghafal Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Nama');
        $obj->getActiveSheet()->setCellValue('C1', 'Email');
        $obj->getActiveSheet()->setCellValue('D1', 'Jenis Kelamin');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->email);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->gender);

            $baris++;
        }

        $filename = "Penghafal Data Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Penghafal Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function searchPenghafal()
    {
        $search = $this->input->post('search');
        $data['user'] = $this->Admin_model->get_search($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_user', $data);
        $this->load->view('templates/footer');
    }

    ////////////////////////////////////////////////////////////////////
    //Mentors Admin
    ////////////////////////////////////////////////////////////////////

    public function indexMentor()
    {
        $data['mentor'] = $this->Admin_model->tampil_mentor();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerMentor');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_mentor', $data);
        $this->load->view('templates/footer');
    }

    public function hapusMentor($id)
    {
        $where = array(
            'id' => $id,
        );

        $where2 = array(
            'id_user' => $id,
        );

        $where3 = array(
            'owner' => $id,
        );

        $this->Admin_model->hapus_mentor($where3, $where2, $where, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Successfully</strong> Deleted
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('Admin/indexMentor');
    }

    // public function editMentor($id)
    // {
    //     $where = array(
    //         'id' => $id,
    //     );
    //     $data['mentor'] = $this->Admin_model->edit_mentor($where, 'mentor');
    //     $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
    //     $this->load->view('templates/headerMentor');
    //     $this->load->view('templates/sidebar', $dats);
    //     $this->load->view('admin/edit_mentor', $data);
    //     $this->load->view('templates/footer');
    // }

    // public function updateMentor()
    // {
    //     $id = $this->input->post('id');
    //     $nama = $this->input->post('nama');
    //     $kode_mentor = $this->input->post('kode_mentor');
    //     $email = $this->input->post('email');

    //     $data = array(
    //         'nama' => $nama,
    //         'kode_mentor' => $kode_mentor,
    //         'email' => $email,
    //     );

    //     $where = array(
    //         'id' => $id,
    //     );

    //     $this->Admin_model->update_mentor($where, $data, 'mentor');
    //     $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
    //     <strong>Successfully</strong> Updated
    //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //       <span aria-hidden="true">&times;</span>
    //     </button>
    //   </div>');
    //     redirect('Admin/indexMentor');
    // }

    public function detailMentor($id)
    {
        $this->load->model('Admin_model');
        $detail = $this->Admin_model->detail_mentor($id);
        $data['detail'] = $detail;
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $this->load->view('templates/headerMentor');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_mentor', $data);
        $this->load->view('templates/footer');
    }

    public function printMentor()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_mentor();
        $this->load->view('admin/print_mentor', $data);
    }

    public function verifyMentor($id)
    {
        $data = array(
            'verified' => "1",
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->activate_data($where, $data, 'user');

        //data udh verfied, tinggal aktifasi dari mentor
        //ambil email dari id_usernya

        $get_email = $this->db->get_where('user', ['id' => $id])->row_array();

        $email = $get_email['email'];

        // var_dump($email);die();

        //siapkan token

        $token = base64_encode(random_bytes(32));
        $user_token = [
            'email' => $email,
            'token' => $token,
            'date_created' => time(),
        ];
        $this->db->insert('user_token', $user_token);

        $this->_sendEmail($email, $token);

        $this->session->set_flashdata('toast', '<div role="alert" aria-live="assertive" aria-atomic="true" class="toast position-fixed mr-2" data-autohide="false"
		style="position: fixed; bottom: 0; right: 0;">
		<div class="toast-header">
			<span style="font-size: 1.5em; color: #06db00; margin-right: 10px;">
				<i class="fas fa-check-circle"></i>
			</span>
			<strong class="mr-auto text-success">Perhatian!</strong>

			<small>Baru saja</small>
			<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="toast-body">
			Berhasil Mengaktifasi mentor dan email aktifasi berhasil dikirim! <span
				style="font-size: 1em; color: #06db00;">
				<i class="fas fa-smile"></i>
			</span>
		</div>
	</div>');

        redirect('Admin/indexMentor');
    }

    public function pdfMentor()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_mentor();
        $this->load->view('admin/pdfMentor', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_mentor.pdf", array('Attachment' => 0));
    }

    public function excelMentor()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_mentor();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List Mentor Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Nama');
        $obj->getActiveSheet()->setCellValue('C1', 'Kode Mentor');
        $obj->getActiveSheet()->setCellValue('D1', 'Instansi');
        $obj->getActiveSheet()->setCellValue('E1', 'Email');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->id);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->instansi);
            $obj->getActiveSheet()->setCellValue('E' . $baris, $mhs->email);

            $baris++;
        }

        // $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $filename = "Mentor Data Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Posting Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function searchMentor()
    {
        $search = $this->input->post('search');
        $data['mentor'] = $this->Admin_model->get_searchMentor($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $this->load->view('templates/headerMentor');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_mentor', $data);
        $this->load->view('templates/footer');
    }

    public function pagepostMentor()
    {
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerMentor');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/post_general');
        $this->load->view('templates/footer');
    }

    public function postingMentor()
    {
        $caption = htmlspecialchars($this->input->post('caption', true));
        $id_user = htmlspecialchars($this->input->post('id_user', true));
        $fileName = $this->_uploadFileMentor();

        if ((substr($fileName, -3, 3) == 'mp4') || (substr($fileName, -3, 3) == 'mkv') || (substr($fileName, -3, 3) == 'flv')) {
            $html = '<div class="video-wrapper">';
            $html .= '<video class="post-video" controls width="500" height="500">';
            $html .= '<source src=' . base_url('assets_user/file_upload/');
            $html .= $fileName . ' type="video/mp4">';
            $html .= '</video></div>';
        } else {
            $html = '<img src=' . base_url('assets_user/file_upload/');
            $html .= $fileName . ' alt="post-image"';
            $html .= 'class="img-responsive post-image" style="height: 300px;" />';
        }

        $data = [
            'caption' => $caption,
            'fileName' => $fileName,
            'html' => $html,
            'date_post' => time(),
            'id_user' => $id_user,
        ];

        //siapkan token
        $this->session->set_flashdata('message', '<small> br</small>');

        $this->db->insert('postgen', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
        <strong>Congratulations!</strong> your post is uploaded.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        redirect('Admin/pagepostMentor');
    }

    private function _uploadFileMentor()
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

            $this->session->set_flashdata('message', '<small style="color: red;">Chose an image or video first!</small>');

            redirect('Admin/pagepostMentor');

            return false;
        }

        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'mp4', 'flv', 'mkv'];
        $ekstensiGambar = explode('.', $namaFiles);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $this->session->set_flashdata('message', '<small style="color: red;">Your uploaded file is not image/video!</small>');

            redirect('Admin/pagepostMentor');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
    }

    public function activateMentor($id)
    {
        $data = array(
            'is_active' => "1",
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->activate_data($where, $data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        Mentor has been <strong>Activated</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('Admin/indexMentor');
    }

    public function deactivateMentor($id)
    {
        $data = array(
            'is_active' => "2",
        );

        $where = array(
            'id' => $id,
        );

        $this->Admin_model->deactivate_data($where, $data, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Mentor has been <strong>Deactivated</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('Admin/indexMentor');
    }

    ////////////////////////////////////////////////////////////////////
    //Postingan Admin
    ////////////////////////////////////////////////////////////////////

    public function indexPosting()
    {
        $data['post'] = $this->Admin_model->tampil_post();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPosting');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_post', $data);
        $this->load->view('templates/footer');
    }

    public function hapusPosting($id)
    {
        $where = array(
            'id_posting' => $id,
        );

        $this->Admin_model->hapus_post($where, 'posting');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Posting Successfully</strong> Deleted
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
        redirect('Admin/indexPosting');
    }

    public function detailPosting($id)
    {
        $data['post'] = $this->Admin_model->detail_post($id);
        $data['post2'] = $this->Admin_model->detail_post2($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPosting');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_post', $data);
        $this->load->view('templates/footer');
    }

    public function printPosting()
    {
        $data['post'] = $this->Admin_model->tampil_post();
        $this->load->view('admin/print_post', $data);
    }

    public function pdfPosting()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_post();
        $this->load->view('admin/pdfPosting', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_posting.pdf", array('Attachment' => 0));
    }

    public function excelPosting()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_post();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List Postingan Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Nama');
        $obj->getActiveSheet()->setCellValue('C1', 'id_posting');
        $obj->getActiveSheet()->setCellValue('D1', 'caption');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->id_posting);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->caption);

            $baris++;
        }

        $filename = "Posting Data Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Posting Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function searchPosting()
    {
        $search = $this->input->post('search');
        $data['post'] = $this->Admin_model->get_searchPost($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPosting');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_post', $data);
        $this->load->view('templates/footer');
    }

    ////////////////////////////////////////////////////////////////////
    //Postingan General
    ////////////////////////////////////////////////////////////////////

    public function indexPostingGen()
    {
        $data['post'] = $this->Admin_model->tampil_postgen();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPostGen');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_postgen', $data);
        $this->load->view('templates/footer');
    }

    public function DelPosGen($id)
    {
        $where = array(
            'id_posting' => $id,
        );

        $this->Admin_model->hapus_postgen($where, 'postgen');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Posting Successfully</strong> Deleted
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
        redirect('Admin/indexPostingGen');
    }

    public function detailPostingGen($id)
    {
        $this->load->model('Admin_model');
        $detail = $this->Admin_model->detail_postgen($id);
        $data['post'] = $detail;
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPostGen');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_postgen', $data);
        $this->load->view('templates/footer');
    }

    public function printPostingGen()
    {
        $data['post'] = $this->Admin_model->tampil_postgen();
        $this->load->view('admin/print_postgen', $data);
    }

    public function pdfPostingGen()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_postgen();
        $this->load->view('admin/pdfPostingGen', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_postingGen.pdf", array('Attachment' => 0));
    }

    public function excelPostingGen()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_postgen();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List Postingan General Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'id_posting');
        $obj->getActiveSheet()->setCellValue('C1', 'caption');
        $obj->getActiveSheet()->setCellValue('D1', 'date post');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->id_posting);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->caption);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->date_post);

            $baris++;
        }

        $filename = "Posting General Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Posting Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function searchPostingGen()
    {
        $search = $this->input->post('search');
        $data['post'] = $this->Admin_model->get_searchPostgen($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPostGen');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_postgen', $data);
        $this->load->view('templates/footer');
    }

    ////////////////////////////////////////////////////////////////////
    //Group Admin
    ////////////////////////////////////////////////////////////////////

    public function indexGroup()
    {
        $data['group'] = $this->Admin_model->tampil_group();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerGroup');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_group', $data);
        $this->load->view('templates/footer');
    }

    public function detailGroup($id)
    {
        $data['post'] = $this->Admin_model->detail_group($id);
        $data['post2'] = $this->Admin_model->detail_group2($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerGroup');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_group', $data);
        $this->load->view('templates/footer');
    }

    public function hapusGroup($id)
    {
        $where = array(
            'id' => $id,
        );

        $this->Admin_model->hapus_group($where, 'grup');
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Group Successfully</strong> Deleted
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
        redirect('Admin/indexGroup');
    }

    public function printGroup()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_group();
        $this->load->view('admin/print_group', $data);
    }

    public function pdfGroup()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_group();
        $this->load->view('admin/pdfGroup', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_group.pdf", array('Attachment' => 0));
    }

    public function excelGroup()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_group();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List Group Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Nama');
        $obj->getActiveSheet()->setCellValue('C1', 'Deskripsi');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->nama);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->deskripsi);

            $baris++;
        }

        $filename = "Group Data Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Group Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    public function searchGroup()
    {
        $search = $this->input->post('search');
        $data['group'] = $this->Admin_model->get_searchGroup($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerGroup');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_group', $data);
        $this->load->view('templates/footer');
    }

    //TODO: to-do list

    public function indexTodo()
    {
        $this->load->model('Admin_model');
        $data['todo'] = $this->Admin_model->tampil_todo();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_todo', $data);
        $this->load->view('templates/footer');
    }

    public function createTodo()
    {
        $data['todotitle'] = 'Tambah To-Do';
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/new_todo');
        $this->load->view('templates/footer');
    }

    public function saveTodo()
    {
        $this->load->model('Admin_model');
        $this->Admin_model->tambah_todo();
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
      Data To-Do <strong>Berhasil</strong> di Simpan
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexTodo');
    }

    public function doneTodo($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->done_todo($id);
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
      Data To-Do <strong>Berhasil</strong> di Set Selesai
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexTodo');
    }

    public function undoneTodo($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->undone_todo($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Data To-Do <strong>Berhasil</strong> di Set Tidak Selesai
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexTodo');
    }

    public function editTodo($id)
    {
        $this->load->model('Admin_model');
        $data['row'] = $this->Admin_model->edit_todo($id);
        $data['row2'] = $this->Admin_model->getTodoById($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/edit_todo', $data);
        $this->load->view('templates/footer');
    }

    public function updateTodo($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->update_todo($id);
        redirect('Admin/indexTodo');
    }

    public function deleteTodo($id)
    {
        $where = array(
            'id' => $id,
        );
        $this->load->model('Admin_model');
        $this->Admin_model->delete_todo($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Data To-Do <strong>Berhasil</strong> di Hapus
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexTodo');
    }

    public function printTodo()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_todo();
        $this->load->view('admin/print_todo', $data);
    }

    public function pdfTodo()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_todo();
        $this->load->view('admin/pdfTodo', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_todo.pdf", array('Attachment' => 0));
    }

    public function excelTodo()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_todo();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("List To-Do Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Nama To-Do');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->task_name);

            $baris++;
        }

        $filename = "Admin To-Do Data Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('To-Do Data Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    private function _sendEmail($mail, $token)
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
        $this->email->to($mail);

        $this->email->subject('Account Verification');
        $this->email->message('click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $mail . '&token=' . urlencode($token) . '">Activate</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    // public function findTodo($id)
    // {
    //     $this->load->model('Admin_model');
    //     $data['row'] = $this->Admin_model->edit_todo($id);
    //     echo $data['row']['task_name'];
    // }
}