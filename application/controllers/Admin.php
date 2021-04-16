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

        // $upload_image = $_FILES['image']['name'];
        // if ($upload_image) {
        //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
        //     $config['max_size'] = '10000';
        //     $config['upload_path'] = './assets/foto/';

        //     $this->load->library('upload', $config);
        //     if ($this->upload->do_upload('image')) {
        //         $new_image = $this->upload->data('file_name');
        //         $this->db->set('image', $new_image);
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // }
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
        $this->load->view('admin/v_penghafal', $data);
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
    Data Penghafal <strong>Berhasil</strong> Dihapus
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
        Data Penghafal <strong>Berhasil</strong> Diaktifasi
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
    Data Penghafal <strong>Berhasil</strong> Di Non Aktivasi
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
        $this->load->view('admin/detail_penghafal', $data);
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
        $obj->getProperties()->setTitle("Data Penghafal Myvoqu");

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

        $filename = "Data Penghafal Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Penghafal Myvoqu');

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
        $this->load->view('admin/v_penghafal', $data);
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
        Data Mentor <strong>Berhasil</strong> Dihapus
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
        $data['allgroup'] = $this->Admin_model->detail_mentor2();

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
			<strong>Berhasil</strong> memverifikasi mentor dan email aktivasi berhasil dikirim!
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
        $obj->getProperties()->setTitle("Data Mentor Myvoqu");

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
        $filename = "Data Mentor Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Mentor Myvoqu');

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
        Data Mentor <strong>Berhasil</strong> Diaktifasi
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
    Data Mentor <strong>Berhasil</strong> Di Non Aktivasi
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>');
        redirect('Admin/indexMentor');
    }

    ////////////////////////////////////////////////////////////////////
    //Postingan Penghafal Mentor
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
      Data Unggahan <strong>Berhasil</strong> Dihapus
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
        $data['suka'] = $this->Admin_model->getSukaById($id);
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
        $obj->getProperties()->setTitle("Data Unggahan Myvoqu");

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

        $filename = "Data Unggahan Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Unggahan Myvoqu');

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
      Data Unggahan <strong>Berhasil</strong> Dihapus
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
        $obj->getProperties()->setTitle("Data Unggahan Materi Umum Myvoqu");

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

        $filename = "Unggahan Materi Umum Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Unggahan Materi Umum Myvoqu');

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

    public function pagepostGen()
    {
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerMentor');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/post_general');
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
        ];

        //siapkan token
        $this->session->set_flashdata('message', '<small> br</small>');

        // $this->db->insert('postgen', $data);
        $this->Admin_model->addPostGen($data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible show" role="alert">
        Unggahan Materi Umum <strong>Berhasil</strong> Di Unggah
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>');

        redirect('Admin/pagepostGen');
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

            redirect('Admin/pagepostGen');

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

            redirect('Admin/pagepostGen');
            return false;
        }

        $namaFilesBaru = uniqid();
        $namaFilesBaru .= '.';
        $namaFilesBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'assets_user/file_upload/' . $namaFilesBaru);

        return $namaFilesBaru;
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
      Data Grup <strong>Berhasil</strong> Dihapus
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
        $obj->getProperties()->setTitle("Data Group Myvoqu");

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

        $filename = "Data Group Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Group Myvoqu');

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
      Data Kegiatan <strong>Berhasil</strong> di Simpan
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
      Data Kegiatan <strong>Berhasil</strong> dibuat Selesai
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
      Data Kegiatan <strong>Berhasil</strong> dibuat Tidak Selesai
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
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Kegiatan <strong>Berhasil</strong> Diperbarui
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

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
      Data Kegiatan <strong>Berhasil</strong> di Hapus
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
        $obj->getProperties()->setTitle("Data Kegiatan Myvoqu");

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

        $filename = "Data Kegiatan Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Kegiatan Myvoqu');

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
        $this->email->message('Klik tautan berikut untuk aktivasi akun anda: <a href="' . base_url() . 'auth/verify?email=' . $mail . '&token=' . urlencode($token) . '">Aktivasi</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    //TODO: to-do list

    public function indexPengumuman()
    {
        $this->load->model('Admin_model');
        $data['pengumuman'] = $this->Admin_model->tampil_pengumuman();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_pengumuman', $data);
        $this->load->view('templates/footer');
    }

    public function createPengumuman()
    {
        $data['todotitle'] = 'Tambah Pengumuman';
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/new_pengumuman');
        $this->load->view('templates/footer');
    }

    public function savePengumuman()
    {
        $this->load->model('Admin_model');
        $this->Admin_model->tambah_pengumuman();
        $this->session->set_flashdata('message', '<div class="alert alert-primary alert-dismissible fade show" role="alert">
      Data Pengumuman <strong>Berhasil</strong> di Umumkan
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexPengumuman');
    }

    public function editPengumuman($id)
    {
        $this->load->model('Admin_model');
        $data['row'] = $this->Admin_model->edit_pengumuman($id);
        $data['row2'] = $this->Admin_model->getPengumumanById($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/edit_pengumuman', $data);
        $this->load->view('templates/footer');
    }

    public function updatePengumuman($id)
    {
        $this->load->model('Admin_model');
        $this->Admin_model->update_pengumuman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Kegiatan <strong>Berhasil</strong> Diperbarui
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexPengumuman');
    }

    public function deletePengumuman($id)
    {
        $where = array(
            'id' => $id,
        );
        $this->load->model('Admin_model');
        $this->Admin_model->delete_pengumuman($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Data Pengumuman <strong>Berhasil</strong> di Hapus
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');

        redirect('Admin/indexPengumuman');
    }

    public function printPengumuman()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_pengumuman();
        $this->load->view('admin/print_pengumuman', $data);
    }

    public function pdfPengumuman()
    {
        $this->load->library('dompdf_gen');
        $data['mahasiswa'] = $this->Admin_model->tampil_pengumuman();
        $this->load->view('admin/pdfPengumuman', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("pdf_pengumuman.pdf", array('Attachment' => 0));
    }

    public function excelPengumuman()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_pengumuman();

        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php';
        require APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php';

        $obj = new PHPExcel();

        $obj->getProperties()->setCreator("Myvoqu");
        $obj->getProperties()->setLastModifiedBy("Myvoqu");
        $obj->getProperties()->setTitle("Data Pengumuman Myvoqu");

        $obj->setActiveSheetIndex(0);

        $obj->getActiveSheet()->setCellValue('A1', 'NO');
        $obj->getActiveSheet()->setCellValue('B1', 'Isi Pengumuman');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->isi_pengumuman);

            $baris++;
        }

        $filename = "Data Pengumuman Myvoqu" . '.xlsx';

        $obj->getActiveSheet()->setTitle('Data Pengumuman Myvoqu');

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename, '"');
        header('Content-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');
        $writer->save('php://output');
        exit;
    }

    // public function findTodo($id)
    // {
    //     $this->load->model('Admin_model');
    //     $data['row'] = $this->Admin_model->edit_todo($id);
    //     echo $data['row']['task_name'];
    // }
}
