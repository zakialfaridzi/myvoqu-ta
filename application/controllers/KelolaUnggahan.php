<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaUnggahan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
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
        redirect('KelolaUnggahan/');
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
}
