<?php
/**
 * @ 
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class customer extends CI_Model {
    public function __construct() { parent::__construct(); }
    function index() {}
    
    private $_form      = 'form/', // путь к шаблонам видов и кусок имени файла формы без триггера
            $users      = 'ss_users',
            $u_         = 'u_',
            $objects    = 'ss_objects',
            $o_         = 'object_';            

/** ВАЛИДАЦИЯ ПОЛЕЙ */
    // авторизация
    function checkLoginFields () {
        $res = array();
        $this->form_validation->set_rules("user", "Логин", "trim|required|xss_clean|min_length[4]|max_length[40]");
        $this->form_validation->set_rules("pass", "Пароль", "trim|required|xss_clean|min_length[4]|max_length[12]|alpha_numeric");
        if ($this->form_validation->run()==TRUE){
            $res['status'] = 'success';
            $res['AccessUser'] = $this->form_validation->set_value('user');
            $res['AccessCode'] = $this->form_validation->set_value('pass');
        } else {
            $res['status'] ='error';
            $res['error_text'] ='';
            $res['error_text'] .= $this->constructError($this->form_validation->error('user'));
            $res['error_text'] .= $this->constructError($this->form_validation->error('pass'));
        }
        return $res;
    }

/** /ВАЛИДАЦИЯ ПОЛЕЙ */
    
/** ВЫБОРКИ */    
    function getUser( $id ){
        $this->db->where( 'u_id', $id );
        $q=$this->db->get( $this->users );
        if( $q->num_rows() == 1 ){
            return (array) $q->row();
        }
        return false;
    }
    
    function getMyObjects( $MyID, $offset=false ) {
        $this->db->where( $this->o_.'uid', $MyID );
        $q = $this->db->get( $this->objects );
        if ( $q->num_rows() > 0 ){ $result = $q->result_array(); } else { $result = FALSE; }
        return $result;
    }
    
/** ==== HELPERS ======= */
    function _getForm( $template, $data = false ){
        if( $data === false ){ $data = array( 'mpt' => '' ); }
        return $this->parser->parse( $this->_form.$template, $data, TRUE );
    }

    function constructError($error){
        if( $error != '' ){ $error = strip_tags($error,'<strong>').'<br />'; }
        return $error;
    }

// class END
}