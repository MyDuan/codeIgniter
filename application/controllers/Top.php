<?php
class Top extends CI_Controller {
    
    public function __construct() {
        
        parent::__construct();
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }
    
    public function index($page = 'home') {
        
        $ion_auth = new Ion_auth();
        if (!$ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
        
        if ( ! file_exists(APPPATH.'views/top/'.$page.'.php'))
        {
            // Whoops, we don't have a page for that!
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('top/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}