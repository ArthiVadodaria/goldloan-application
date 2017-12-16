<?php 
 
if (!defined('BASEPATH')) exit('No direct script access allowed'); 
class Our_Chart extends CI_Controller 
 
    { 
    function __construct() 
        { 
        parent::__construct(); 
        $this->load->model('Our_chart_model'); 
		$this->load->database();
        $this->load->helper('string'); 
        } 
 
    public function index() 
        { 
        $this->load->view('Chart_view'); 
        } 
 
    public function getdata() 
        {
		
        $data['q'] = $this->Our_chart_model->get_year(); 
		
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Year", 
            "pattern" => "", 
            "type" => "string" 
        );  
        $responce->cols[] = array( 
            "id" => "", 
            "label" => "Count(No.of Loans)", 
            "pattern" => "", 
            "type" => "number" 
        );
		
      
		foreach( $data['q']['count'] as $key1=>$value1){ 
		$responce->rows[]["c"] = array( 
			array( 
				"v" => $value1['year'], 
				"f" => null 
			),
			array( 
				"v" => $value1['count'], 
				"f" => null 
			) 
		); }
		
        echo json_encode($responce); 
        } 
    }