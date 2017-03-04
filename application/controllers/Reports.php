<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_reports');
    }
    
    public function collection_statement(){
        $id = $this->input->post('id');
        $this->generate_page('reports/collection_statement', [
            'title'         =>  'assistone | interest report',
            'header'        =>  'Collection',
            'subheader'     =>  'Statement',
            'js'            =>  array('angular/collection_statement.js')
        ]);
    }
    
    public function get_collection_statement(){
        $data = $this->m_reports->get_collection_statement();
        for($x=0; $x<count($data['data']); $x++){
            for($y=0; $y<count($data['raw_data']); $y++){
                if($data['data'][$x]['id'] == $data['raw_data'][$y]['loan_id']){
                    if(empty($data['raw_data'][$y]['payment_actual_paid_date'])){
                        $data['data'][$x] = array_merge($data['data'][$x], array('due_amount'=>$data['raw_data'][$y]['payment_due_amount']));
                        break;
                    }
                }
            }
        }
        echo json_encode(array('status'=>1, 'data'=>$data['data']));
    }

}
