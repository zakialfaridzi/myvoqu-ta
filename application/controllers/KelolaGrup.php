<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaGrup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['group'] = $this->Admin_model->tampil_group();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data Grup Hafalan";
        $this->load->view('templates/headerGroup', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_group', $data);
        $this->load->view('templates/footer');
    }

    public function detailGroup($id)
    {
        $data['post'] = $this->Admin_model->detail_group($id);
        $data['post2'] = $this->Admin_model->detail_group2($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Detil Data Grup Hafalan";
        $this->load->view('templates/headerGroup', $dats);
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
        redirect('KelolaGrup');
    }

    public function printGroup()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_group();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Print Data Grup Hafalan";
        $this->load->view('templates/headerGroup', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/print_group', $data);
        $this->load->view('templates/footer');
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
        $obj->getActiveSheet()->setCellValue('D1', 'Pemilik Grup');

        $baris = 2;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $obj->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $obj->getActiveSheet()->setCellValue('B' . $baris, $mhs->nama);
            $obj->getActiveSheet()->setCellValue('C' . $baris, $mhs->deskripsi);
            $obj->getActiveSheet()->setCellValue('D' . $baris, $mhs->name);

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
        $dats['judul'] = "Admin | Kelola Data Grup Hafalan";
        $this->load->view('templates/headerGroup', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_group', $data);
        $this->load->view('templates/footer');
    }
}
