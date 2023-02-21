<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Config_model', 'login');
        
    }

    public function index()
    {
        $this->load->view('login');
    }

    function process_login()
    {
       $username = htmlspecialchars($this->input->post ('username'));
       $password = htmlspecialchars($this->input->post ('password'));

       $query = $this->login->auth($username,$password);

    
       if ($query->num_rows() < 1) {
           
            $this->session->set_flashdata('out', 'User atau Password Yang Anda Masukan Salah !');

           redirect('login', 'refresh');
           
       }else {

        $data = $query->row_array();
        $session = array(
            'nama'          => $data['namaLengkap'], 
            'user'          => $data['username'], 
            'img'           => $data['gambarProfil'], 
            'level_akses'   => $data['levelAkses'], 
            'id'            => $data['id_admin'], 
            'status_login'  => TRUE, 
        );

        $this->session->set_userdata($session);
        $this->login->auth_update($data['id_admin']);
        
        redirect('/','refresh');
        
       }
    }

    function logout()
    {

        $this->session->set_flashdata('out', 'Sesi Berakhir ! Silahkan Login Kembali Jika Ingin Menggunakan Nya .');
        
        redirect('login','refresh');
        $this->session->sess_destroy();
        
    }
}

/* End of file Auth.php.php and path /application/controllers/Auth.php.php */
