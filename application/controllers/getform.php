<?php
class Getform extends CI_Controller {
	function __construct() {
        // Call the Model constructor
        parent::__construct();
        //session_start(); $_SESSION['user'] = 'sjdcsd';		
	}
    private     $formName   = false;
    private     $formpath   = 'form/';
    private     $uid        = false;
    
    function index(){
        $this->formName = $_POST['form'];
        print json_encode( $this->_get() );    
    }   
    
    function _get(){
        $data=array('mpt'=>'');
        return $this->parser->parse( $this->formpath.$this->formName, $data, TRUE );
    }

}