<?php
class Users extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->model('duanusers_model');
        $this->load->helper('url_helper');
        $this->load->helper('html');
        $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
        $this->load->library('ion_auth');
    }

    public function index() {
        
        $ion_auth = new Ion_auth();
        if (!$ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }
   
        $query = $this->db->get('duanusers');
        $data['duanusers'] = $query->result_array();
        
        $data['title'] = 'All Users archive';

        $this->load->view('templates/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function add() {
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'ユーザー新規作成';
        
        $this->form_validation->set_rules('name', '名前', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            
            
            $this->load->view('templates/header', $data);
            $this->load->view('users/add');
            $this->load->view('templates/footer');
        }
        else {
            
            $data = array(
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'identity' => $this->input->post('identity')
            );
    
            $is_insert = $this->db->insert('duanusers', $data);
            if($is_insert){
                redirect('/users/index');
            }
        }
    }
    
    public function edit() {
        
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $data['title'] = 'ユーザー編集';
        $array = $this->uri->uri_to_assoc(3);
        if($array){
            $data['id'] = $array['id'];
        }
        $this->form_validation->set_rules('name', '名前', 'required');
        
        if ($this->form_validation->run() === FALSE) {
        
            $this->db->where('id',  $data['id']);
            $query = $this->db->get('duanusers');
            $data['duanuser'] = $query->row_array();
        
            $this->load->view('templates/header', $data);
            $this->load->view('users/edit', $data);
            $this->load->view('templates/footer');
        }
        else {
            
            $data = array(
                'id'  => $this->input->post('id'),
                'name' => $this->input->post('name'),
                'gender' => $this->input->post('gender'),
                'identity' => $this->input->post('identity')
            );
            
            $this->db->where('id',  $data['id']);
            $is_update = $this->db->update('duanusers', $data);
            if($is_update){
                redirect('/users/index');
            }
        }
    }
}