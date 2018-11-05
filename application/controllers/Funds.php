<?php
/**
 * Created by PhpStorm.
 * User: baldonharris
 * Date: 09/10/2017
 * Time: 10:27 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Funds extends MY_Controller {

    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('username')) redirect(base_url());
        $this->load->model('m_buckets');
        $this->load->model('m_returns');
    }

    public function index()
    {
        $this->generate_page('funds/index', [
            'title'			=> 'assistone | fund management',
            'header'		=> 'Fund',
            'subheader'		=> 'Management',
            'js'            => ['angular/funds.js']
        ]);
    }

    public function init_data()
    {
        $buckets = $this->m_buckets->get([], 'ASC');
        $modifiedBuckets = [];
        $finalBuckets = [];

        foreach ($buckets as $index => $bucket) {
            $bName = strtoupper(str_replace(' ', '', $bucket['bucket_name']));

            if ($bName !== 'INVESTORS') {
                if (!isset($modifiedBuckets[$bName])) {
                    $modifiedBuckets[$bName] = ['index'=>$index, 'id'=>[$bucket['id']]];
                } else {
                    array_push($modifiedBuckets[$bName]['id'], $bucket['id']);
                }
            }
        }

        foreach ($modifiedBuckets as $modName => $prop) {
            $bucketName = $buckets[$prop['index']]['bucket_name'];
            $i = array_push($finalBuckets, [
                'name'      => $bucketName,
                'returns'   => []
            ]) - 1;

            foreach ($prop['id'] as $index => $id) {
                array_push($finalBuckets[$i]['returns'], $this->m_returns->get(['r.buckets_id'=>$id]));
            }
        }

        return_json($finalBuckets);
    }
}
