<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calc extends CI_Controller {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('common','common');
		$this->load->model('calc_model','cal_mod');
    }
	
	function index()
	{	
		$data['arr_table'] = array(
			array('count_room','count_room_id'),
			array('city_region_administrat','city_region_administrat_id'),
			array('floor_of_house','floors'),
			array('microregion_sity','microregion_sity_id'),
			array('series','series_id'),
			//array('type_indor',''),
			array('type_repair','type_indor_id'),
			array('area_correction','area')
			); 
		$data['title'] = "Оценка рынойчной стоймости объекта";
		$data['all_base'] = $this->common->get_field("summary");
		$this->load->view('header',$data);
		$this->load->view('calc',$data);
		$this->load->view('footer',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>