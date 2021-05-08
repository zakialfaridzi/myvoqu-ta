<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaPenghafal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['user'] = $this->Admin_model->tampil_data();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data Penghafal";
        $this->load->view('templates/header', $dats);
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
        redirect('KelolaPenghafal/index');
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
        redirect('KelolaPenghafal/');
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
        redirect('KelolaPenghafal/');
    }

    public function detailPenghafal($id)
    {
        $this->load->model('Admin_model');
        $detail = $this->Admin_model->detail_data($id);
        $data['detail'] = $detail;
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $dats['judul'] = "Admin | Detil Data Penghafal";
        $this->load->view('templates/header', $dats);

        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/detail_penghafal', $data);
        $this->load->view('templates/footer');
    }

    public function printPenghafal()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_data();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Print Data Penghafal";
        $this->load->view('templates/header', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/print_users', $data);
        $this->load->view('templates/footer');
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
        $obj->getActiveSheet()->setCellValue('E1', 'Status Aktivasi');
        $obj->getActiveSheet()->setCellValue('F1', 'Status');

        $baris = 2;
        $no = 1;
        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->email);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->gender);
            if ($mhs->is_active == 2 || $mhs->is_active == 0) {
                $statusaktivasi = "Tidak Aktif";
            } else {
                $statusaktivasi = "Aktif";
            }
            $obj->getActiveSheet()->setCellValue('E' . $baris, $statusaktivasi);
            if ($mhs->status == "offline-dot" || $mhs->status == "") {
                $statusjaringan = 'Luring';
            } else {
                $statusjaringan = 'Daring';
            }
            $obj->getActiveSheet()->setCellValue('F' . $baris, $statusjaringan);

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

        $dats['judul'] = "Admin | Kelola Data Penghafal";
        $this->load->view('templates/header', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_penghafal', $data);
        $this->load->view('templates/footer');
    }
}
