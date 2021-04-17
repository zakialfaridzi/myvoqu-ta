<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

class Snap extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *         http://example.com/index.php/welcome
     *    - or -
     *         http://example.com/index.php/welcome/index
     *    - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-NIJu49puPJ6azOCJv8BnxFgE', 'production' => false);
        $this->load->library('midtrans');
        $this->midtrans->config($params);
        $this->load->helper('url');
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('checkout_snap');
    }

    public function token()
    {

        $nominal = $this->input->post('nominal');
        $email = $this->input->post('email');

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $nominal, // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => 'a1',
            'price' => $nominal,
            'quantity' => 1,
            'name' => "Top Up Wallet",
        );

        // // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 50000,
        //     'quantity' => 1,
        //     'name' => "Orange",
        // );

        // Optional
        $item_details = array($item1_details);

        $user_topup = $this->db->get_where('user', ['id' => $this->session->userdata('id')])->row_array();
        $nama_user = $user_topup['name'];
        // Optional
        $customer_details = array(
            'first_name' => "$nama_user",
            'last_name' => "",
            'email' => "$email",
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'day',
            'duration' => 1,
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details' => $item_details,
            'customer_details' => $customer_details,
            'credit_card' => $credit_card,
            'expiry' => $custom_expiry,
        );

        $id_user = $this->session->userdata('id');

        $this->session->set_userdata("transaksi_" . $id_user, $item1_details['name']);

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $id_user = $this->session->userdata('id');

        $result = json_decode($this->input->post('result_data'), true);

        $transaction_name = $this->session->userdata('transaksi_' . $id_user);

        // $this->session->unset_userdata('transaksi_' . $id_user);

        // var_dump($this->session->userdata('transaksi_' . $id_user));

        // die();

        $data = [
            'order_id' => $result['order_id'],
            'name' => $transaction_name,
            'gross_amount' => $result['gross_amount'],
            'payment_type' => $result['payment_type'],
            'transaction_time' => $result['transaction_time'],
            'bank' => $result['va_numbers'][0]['bank'],
            'va_number' => $result['va_numbers'][0]['va_number'],
            'pdf_url' => $result['pdf_url'],
            'status_code' => $result['status_code'],
            'id_user' => $this->session->userdata('id'),
        ];

        $this->db->insert('transaksi_topup_dompet', $data);

        $this->session->set_flashdata('alert', '<div class="alert alert-success alert-dismissible show" role="alert">
			<strong>Berhasil!</strong> Silahkan lakukan pembayaran.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  	</div>');

        $this->session->unset_userdata('transaksi_' . $id_user);

        redirect("user");

    }
}