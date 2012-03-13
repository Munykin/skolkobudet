<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show_base extends CI_Controller {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('common','common');
    }
	
	function index()
	{	
		$query = $this->db->get_where('summary', array('microregion_sity_id' => 1));
		$data['summary']=$query->result_array();
		$data['microregion_sity']=$this->common->get_field('microregion_sity');
		$data['city_region_administrat']=$this->common->get_field('city_region_administrat');
		$data['count_room']=$this->common->get_field('count_room');
		$data['floor_of_house']=$this->common->get_field('floor_of_house');
		$this->db->order_by("order", "asc"); 
		$data['type_repair']=$this->common->get_field('type_repair');
		$data['series']=$this->common->get_field('series');
		$this->load->view('header',$data);
		$this->load->view('show_base',$data);
		$this->load->view('footer',$data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>