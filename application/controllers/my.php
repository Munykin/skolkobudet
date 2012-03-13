<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class my extends CI_Controller {

	function __construct() { parent::__construct(); session_start(); $_SESSION['user'] = 'sjdcsd'; }
    private $dash   = '/objects/',
            $login  = '', // сделать страницу для логина отдельно
            $uid    = false,
            $err    = array(
                'wrongLoginPass'    => 'Комбинация <strong>логин/пароль</strong> указана не верно'    
            ),
            $titles = array(
                'objects' => 'Мои объекты | Сколько будет.ru',
                'settings'=> 'Мои настройки | Сколько будет.ru'
            ),

            $currentpage = array(
                'objects' => '',
                'settings'=> ''
            );

    function do_login() {
        if ( $this->input->is_ajax_request() ) {
            $result = array(); 
            $result = $this->customer->checkLoginFields();
            if ( $result['status'] == 'error' ) { print json_encode( $result ); } // VALIDATION ERRORS
            else {
                if ($this->userlib->login( $result['AccessUser'], $result['AccessCode'] ) ){ // DO AUTH
                    $result['status'] = 'success';
                    print json_encode( $result );
                } else {
                    $result['status']       = 'error';
                    $result['error_text']   = $this->customer->constructError( $this->err['wrongLoginPass'] );
                    print json_encode( $result );
                }   // AUTH ERRORS
            }       // VALIDATION SUCCESS
        }           // IS_AJAX
    }

/** === СТРАНИЦЫ ============================== */
    
    function objects() {
        $this->ifLogged();
        $data = $this->requiredData( __FUNCTION__ );
        $data['objects'] = $this->customer->getMyObjects($this->uid);
        $calcData = $this->calcData();
        $this->load->view( 'header', $data );
        $this->load->view( 'my/calc', $calcData);
        $this->load->view( 'my/objectslist', $data );
        $this->load->view( 'footer' );
    }
    
    function object($id,$mode='view'){
        $this->ifLogged();
        
        
    } 
    
    function settings() {
        $this->ifLogged();
        $data = $this->requiredData( __FUNCTION__ );
        $this->load->view( 'header', $data );
        $this->load->view( 'my/settings', $data );
        $this->load->view( 'footer' );
    }
    
    function calcData(){
        $data = array();
        $data[ 'microregion_sity' ]         = $this->common->get_field( 'microregion_sity' );
		$data[ 'city_region_administrat' ]  = $this->common->get_field( 'city_region_administrat' );
		$data[ 'count_room' ]               = $this->common->get_field( 'count_room' );
		$data[ 'floor_of_house' ]           = $this->common->get_field( 'floor_of_house' ); 
		$data[ 'type_repair' ]              = $this->common->get_field( 'type_repair' );
        
        return $data;
    }


 /** ХЕЛПЕРЫ */   
    function requiredData( $methodName ) {
        
        if ($methodName!='object'){
            $data['title']      = $this->titles[ $methodName ];
        } else {
            $data['title']  = 'Объект';
        }
        
        $data['curentpage'] = $this->currentpage[ $methodName ];
        $data['loged']      = $this->uid;
        $data['user']       = $this->customer->getUser( $this->uid );
        return $data;
    }
    /*
    function comfirmAction ($email,$operationHash){
        $action = $this->customer->getOperaion($operaionHash);
        $user = $this->customer->getUserByMail;
    }
    */
    
    function logout()       { $this->userlib->logout(); $this->goToLogin(); }
    function goToDash()     { redirect( $this->dash, 'location', 301); }
    function goToLogin()    { redirect( $this->login,'location', 301); }
    function login()        { $this->ifLogged( 'not' ); $this->load->view( 'my/login' ); }
    
    function ifLogged ( $not = false ) {
        if ( $not == 'not' ) {
            if( $this->userlib->logged_in() ){ $this->goToDash(); }
        } else {
            if( !$this->userlib->logged_in() ){ $this->goToLogin(); } else { $this->uid = $this->userlib->logged_in(); }
        }
    }
    
    
    function RandString() {
        $length = rand(6,80);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $string = '';    
        for ($p = 0; $p < $length; $p++) {
            $string .= $characters[mt_rand(0, strlen($characters)-1)];
        }
        return $string;
    } 
    
// CLASS END    
}