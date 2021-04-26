<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ToDoListAdmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model');
    }

    public function index()
    {
        $this->load->model('Admin_model');
        $data['todo'] = $this->Admin_model->tampil_todo();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data To-Do List";
        $this->load->view('templates/headerTodo', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_todo', $data);
        $this->load->view('templates/footer');
    }

    public function createTodo()
    {
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Buat Data To-Do List";
        $this->load->view('templates/headerTodo', $dats);
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

        redirect('ToDoListAdmin');
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

        redirect('ToDoListAdmin');
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

        redirect('ToDoListAdmin');
    }

    public function editTodo($id)
    {
        $this->load->model('Admin_model');
        $data['row'] = $this->Admin_model->edit_todo($id);
        $data['row2'] = $this->Admin_model->getTodoById($id);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Sunting Data To-Do List";
        $this->load->view('templates/headerTodo', $dats);
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

        redirect('ToDoListAdmin');
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

        redirect('ToDoListAdmin');
    }

    public function printTodo()
    {
        $data['mahasiswa'] = $this->Admin_model->tampil_todo();
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Print Data To-Do List";
        $this->load->view('templates/headerTodo', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/print_todo', $data);
        $this->load->view('templates/footer');
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

    public function searchTodo()
    {
        $search = $this->input->post('search');
        $data['todo'] = $this->Admin_model->get_searchTodo($search);
        $dats['mahasiswa'] = $this->Admin_model->profileAdmin();
        $dats['judul'] = "Admin | Kelola Data Pengumuman";
        $this->load->view('templates/headerTodo', $dats);
        $this->load->view('templates/sidebar', $dats);
        $this->load->view('admin/v_pengumuman', $data);
        $this->load->view('templates/footer');
    }
}
