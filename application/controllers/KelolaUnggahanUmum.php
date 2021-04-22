<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaUnggahanUmum extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $data['post'] = $this->Admin_model->tampil_postgen();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPostGen');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_postgen', $data);
        $this->load->view('templates/footer');
    }

    public function HapusPostGen($id)
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
        redirect('KelolaUnggahanUmum');
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
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $this->load->view('templates/headerPostGen');
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/print_postgen', $data);
        $this->load->view('templates/footer');
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

        $obj->getActiveSheet()->setTitle('Data Unggahan Materi Umum');

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
}
