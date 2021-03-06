<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaMentor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['mentor'] = $this->Admin_model->tampil_mentor();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data Mentor";
        $this->load->view('templates/headerMentor', $dats);
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
        redirect('KelolaMentor/');
    }

    public function detailMentor($id)
    {
        $this->load->model('Admin_model');
        $detail = $this->Admin_model->detail_mentor($id);
        $data['detail'] = $detail;
        $data['jumlahfollowers'] = $this->Admin_model->getJumlahFollowers($id);
        $data['jumlahfollowing'] = $this->Admin_model->getJumlahFollowing($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $data['allgroup'] = $this->Admin_model->detail_mentor2();
        $dats['judul'] = "Admin | Detil Data Mentor";
        $this->load->view('templates/headerMentor', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_mentor', $data);
        $this->load->view('templates/footer');
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

        redirect('KelolaMentor/');
    }

    public function printMentor()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_mentor();
        $data['judul'] = "Print Data Mentor MyVoQu";
        $this->load->view('templates/headerMentor', $data);
        $this->load->view('admin/print_mentor', $data);
        $this->load->view('templates/footer');
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
        $obj->getActiveSheet()->setCellValue('F1', 'Status Aktivasi');
        $obj->getActiveSheet()->setCellValue('G1', 'Status');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->id);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->instansi);
            $obj->getActiveSheet()->setCellValue('E' . $baris, $mhs->email);
            if ($mhs->is_active == 2 || $mhs->is_active == 0) {
                $statusaktivasi = "Tidak Aktif";
            } else {
                $statusaktivasi = "Aktif";
            }
            $obj->getActiveSheet()->setCellValue('F' . $baris, $statusaktivasi);
            if ($mhs->status == "offline-dot" || $mhs->status == "") {
                $statusjaringan = 'Luring';
            } else {
                $statusjaringan = 'Daring';
            }
            $obj->getActiveSheet()->setCellValue('G' . $baris, $statusjaringan);

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
        $dats['judul'] = "Admin | Kelola Data Mentor";
        $this->load->view('templates/headerMentor', $dats);
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
        redirect('KelolaMentor/');

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
        redirect('KelolaMentor/');
    }

    private function _sendEmail($mail, $token)
    {

        $this->load->library('email');

        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'leoleopold555@gmail.com',
            'smtp_pass' => 'planetocean5',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
        ];

        $this->email->initialize($config);
        $this->email->from('leoleopold555@gmail.com', 'Admin MyVoQu');
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
}
