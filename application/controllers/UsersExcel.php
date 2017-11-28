<?php

class UsersExcel extends CI_Controller {

    public function __construct() {
        
        parent::__construct();
        $this->load->model('duanusers_model');
        $this->load->helper('url_helper');
        $this->load->library('excel');
    }

    public function index() {
        
        $query = $this->db->get('duanusers');
        $data_list = $query->result_array();
        
        $excel = new Excel();
        
        //activate worksheet number 1
        $excel->setActiveSheetIndex(0);
        //name the worksheet
        $excel->getActiveSheet()->setTitle('users');
        
        //set cell 
        $excel->getActiveSheet()
                ->setCellValue('A1', 'ID')
                ->setCellValue('B1', '名前')
                ->setCellValue('C1', '性別')
                ->setCellValue('D1', '身分');
        
        $i = 2;
        foreach ($data_list as $data) {
            $excel->getActiveSheet()
                ->setCellValue('A'.$i, $data['id'])
                ->setCellValue('B'.$i, $data['name'])
                ->setCellValue('C'.$i, $data['gender'])
                ->setCellValue('D'.$i, $data['identity']);
            $i++;
        }
        
        $filename='userlist'; //save our workbook as this file name
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');      
        //save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output');
    }
}

