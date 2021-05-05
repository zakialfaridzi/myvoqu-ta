<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PengumumanAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $this->load->model('Admin_model');
        $data['pengumuman'] = $this->Admin_model->tampil_pengumuman();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data Pengumuman Admin";
        $this->load->view('templates/headerPengumuman', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_pengumuman', $data);
        $this->load->view('templates/footer');
    }

    public function createPengumuman()
    {
        $data['todotitle'] = 'Tambah Pengumuman';
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Buat Pengumuman Admin";
        $this->load->view('templates/headerPengumuman', $dats);
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

        redirect('PengumumanAdmin');
    }

    public function editPengumuman($id)
    {
        $this->load->model('Admin_model');
        $data['row'] = $this->Admin_model->edit_pengumuman($id);
        $data['row2'] = $this->Admin_model->getPengumumanById($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Sunting Data Pengumuman Admin";
        $this->load->view('templates/headerPengumuman', $dats);
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

        redirect('PengumumanAdmin');
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

        redirect('PengumumanAdmin');
    }

    public function printPengumuman()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_pengumuman();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Print Data Pengumuman Admin";
        $this->load->view('templates/headerPengumuman', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/print_pengumuman', $data);
        $this->load->view('templates/footer');
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
        $obj->getActiveSheet()->setCellValue('C1', 'Pembuat');
        $obj->getActiveSheet()->setCellValue('D1', 'Tanggal Buat');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->isi_pengumuman);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->name);
            $obj->getActiveSheet()->setCellValue('D' . $baris, date("Y-m-d H:i:s", strtotime('+5 hours', $mhs->datepost)));

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

    public function searchPengumuman()
    {
        $search = $this->input->post('search');
        $data['pengumuman'] = $this->Admin_model->get_searchPengumuman($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();

        $dats['judul'] = "Admin | Kelola Data Pengumuman";
        $this->load->view('templates/headerPengumuman', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_pengumuman', $data);
        $this->load->view('templates/footer');
    }
}
