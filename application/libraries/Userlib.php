<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
class Userlib {
	function Userlib() {
		$this->CI =& get_instance();
		log_message('debug', "User Class Initialized");
	}
    
    private $users      = 'ss_users',
            $f_login    = 'u_name',
            $f_mail     = 'u_email',
            $f_pass     = 'u_passhash',
            $f_activ    = 'u_activation';   

	function login( $username, $password ) {
	    $authResult = FALSE;
        $this->CI->db->where(    $this->f_login,mysql_real_escape_string( $username ) );
        $this->CI->db->or_where( $this->f_mail, mysql_real_escape_string( $username ) );
        $qcheck = $this->CI->db->get( $this->users );
        if( $qcheck->num_rows() == 1 ){
            $user = (array) $qcheck->row();
            if (
                $user[ $this->f_activ ] == 'yes' &&
                $user[ $this->f_pass  ] == sha1( md5( $password ) )
            ){
                $newdata = array(
                	'username'	=>	$user[$this->f_mail],
                	'password'	=>	sha1( md5( $password ) )
                );
                $this->CI->session->set_userdata( $newdata );
                $authResult = TRUE;
            }
        }
        return $authResult;  
	}
    
    // проверка на занятость ника
    function nickname_exist($requestedNickname){
        $result = FALSE;
        $this->CI->db->where($this->f_login,$requestedNickname);
        $q = $this->CI->db->select($this->users);
        if ($q->num_rows()!==0){$result = TRUE;}
        return $result;
    }
    
    // проверка на занятость e-mail
    function email_exist($requestedMail){
        $result = FALSE;
        $this->CI->db->where($this->f_mail,$requestedMail);
        $q = $this->CI->db->select($this->users);
        if ($q->num_rows()!==0){$result = TRUE;}
        return $result;
    }

	function logout(){
	   $newsdata = array('username' => "",'password' => "");
       $this->CI->session->unset_userdata($newsdata);
    }
	// --------------------------------------------------------------------

	/** Logged in */
	function logged_in() {
        $username = mysql_real_escape_string( $this->CI->session->userdata( 'username' ) );
        $password = mysql_real_escape_string( $this->CI->session->userdata( 'password' ) );
        if( $username == FALSE || $password == FALSE ){ return FALSE; }
        $this->CI->db->where( $this->f_mail, mysql_real_escape_string( $username ) );
        $this->CI->db->where( $this->f_pass, $password );            
        $lcheck = $this->CI->db->get($this->users);
		if( $lcheck->num_rows() == 1){ 
            $u = $lcheck->row(); 
            return $u->u_id; 
        } else { return FALSE; }
	}
    
// CLASS END
}?>