<?php

class UsersPdf extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->model('duanusers_model');
        $this->load->helper('url_helper');
        $this->load->library('pdf');
    }

    public function index() {
        
        $query = $this->db->get('duanusers');
        $data_list = $query->result_array();

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);//P ->縦, L ->横
        
        $pdf->SetTitle('ユーザー一覧');
        $pdf->SetHeaderMargin(30);
        $pdf->SetTopMargin(20);
        $pdf->setFooterMargin(20);
        
        $pdf->AddPage();
        
        // set cell padding
        $pdf->setCellPaddings(1, 1, 1, 1);

        // set cell margins
        $pdf->setCellMargins(1, 1, 1, 1);
        
        $pdf->MultiCell(30, 5, "ID", 1, 'C', 0, 0, 10 ,20, true);
        $pdf->MultiCell(30, 5, "名前", 1, 'C', 0, 0, 40 ,20, true);
        $pdf->MultiCell(30, 5, "性別", 1, 'C', 0, 0, 70 ,20, true);
        $pdf->MultiCell(30, 5, "身分", 1, 'C', 0, 0, 100 ,20, true);

        $position = 20;
        $count = 10;
        $row = 0;
        
        foreach ($data_list as $data) {
            if($row< $count){
                $position += 10;
            }
            else{
                
                $pdf->AddPage();
                $row = $row - $count;
                $position = 20 + $row*10;
            }
            $row += 1;
            
            $pdf->MultiCell(30, 5, $data['id'], 1, 'L', 0, 0, 10 ,$position, true);
            $pdf->MultiCell(30, 5, $data['name'], 1, 'L', 0, 0, 40 ,$position, true);
            $pdf->MultiCell(30, 5, $data['gender'], 1, 'L', 0, 0, 70 ,$position, true);
            $pdf->MultiCell(30, 5, $data['identity'], 1, 'L', 0, 0, 100 ,$position, true);
        }
        
        $pdf->Output('ユーザー一覧.pdf', 'D');
    }
}
