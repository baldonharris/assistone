<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_reports');
    }
    
    private function sort_us($data){
        function make_comparer() {
            $criteria = func_get_args();
            foreach ($criteria as $index => $criterion) {
                $criteria[$index] = is_array($criterion)
                    ? array_pad($criterion, 3, null)
                    : array($criterion, SORT_ASC, null);
            }

            return function($first, $second) use ($criteria) {
                foreach ($criteria as $criterion) {
                    list($column, $sortOrder, $projection) = $criterion;
                    $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;

                    if ($projection) {
                        $lhs = call_user_func($projection, $first[$column]);
                        $rhs = call_user_func($projection, $second[$column]);
                    }
                    else {
                        $lhs = $first[$column];
                        $rhs = $second[$column];
                    }

                    if ($lhs < $rhs) {
                        return -1 * $sortOrder;
                    }
                    else if ($lhs > $rhs) {
                        return 1 * $sortOrder;
                    }
                }

                return 0;
            };
        }
        usort($data, make_comparer('customer_name', 'date_of_release'));
        return $data;
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
        $data['data'] = $this->m_reports->get_collection_statement( ($due_date) ? 'p.due_date="'.$due_date.'"' : NULL );
        $data['sub_detail']['total_paid_amount'] = 0;
        $data['sub_detail']['total_due_amount'] = 0;
        
        for($x=0; $x<count($data['data']); $x++){
            $raw_data = $this->m_reports->get_raw_collection_statement(array('p.id'=>$data['data'][$x]['payment_id'], 'p.due_date'=>$due_date));
            $data['data'][$x]['due_amount'] = $raw_data[0]['payment_due_amount'];
            $data['data'][$x]['amount_paid'] = $raw_data[0]['amount_paid'];
            $data['data'][$x]['total_paid_amount'] = $this->m_reports->get_total_paid_amount(array('p.loans_id'=>$data['data'][$x]['id']))[0]['total_amount_paid'];
            
            $data['sub_detail']['total_paid_amount'] += $data['data'][$x]['amount_paid'];
            $data['sub_detail']['total_due_amount'] += $data['data'][$x]['due_amount'];
        }
        $data['data'] = $this->sort_us($data['data']);
        echo json_encode(array('status'=>1, 'data'=>$data));
    }

}
