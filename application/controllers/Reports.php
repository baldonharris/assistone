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
            'title'         =>  'assistone | collection statement',
            'header'        =>  'Collection',
            'subheader'     =>  'Statement',
            'js'            =>  array('angular/collection_statement.js')
        ]);
    }
    
    public function get_collection_statement(){
        $due_date = $this->input->post('due_date');
        $hey = ($due_date) ? 'p.due_date="'.$due_date.'"' : NULL;
        $data = $this->m_reports->get_collection_statement( ($due_date) ? 'p.due_date="'.$due_date.'"' : NULL );
        $data['sub_detail']['total_paid_amount'] = 0;
        $data['sub_detail']['total_due_amount'] = 0;
        for($x=0; $x<count($data['data']); $x++){
            $data['data'][$x]['total_paid_amount'] = 0;
            for($y=0; $y<count($data['raw_data']); $y++){
                if($data['data'][$x]['id'] == $data['raw_data'][$y]['loan_id']){
                    $data['data'][$x]['total_paid_amount'] += $data['raw_data'][$y]['amount_paid'];
                    if($data['raw_data'][$y]['payment_actual_paid_date'] === $due_date){
                        $data['data'][$x] = array_merge($data['data'][$x], array('due_amount'=>$data['raw_data'][$y]['payment_due_amount']));
                        $data['data'][$x] = array_merge($data['data'][$x], array('amount_paid'=>$data['raw_data'][$y]['amount_paid']));
                        break;
                    }else{
                        $data['data'][$x] = array_merge($data['data'][$x], array('due_amount'=>$data['raw_data'][$y]['payment_due_amount']));
                    }
                }
            }
            $data['sub_detail']['total_paid_amount'] += $data['data'][$x]['amount_paid'];
            $data['sub_detail']['total_due_amount'] += $data['data'][$x]['due_amount'];
        }
        unset($data['raw_data']);
        echo json_encode(array('status'=>1, 'data'=>$data));
    }

}
