<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        session_start(); $_SESSION['user'] = 'sjdcsd'; // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ 
		$this->load->model('common','common');
        
    }

    
    private $uid         = false,   // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ
            $currentpage = 'home';  // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ
    // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ        
    function ifLogged () { $this->uid = $this->userlib->logged_in(); }
    // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ	  
    function showpage($page){
        $this->ifLogged();                          	   
        $data['curentpage'] = $page;                
        $data['loged']      = $this->uid;           
		$data['title']      = "Раздел в разработке";	     
        $this->load->view('header', $data);
        $this->load->view('commingsoon');
        $this->load->view('footer');    
    }
    
    

	
	function index() { 
	    $this->ifLogged();                           // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ	   
        $data['curentpage'] = $this->currentpage;   // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ
        $data['loged']      = $this->uid;           // ВОТ ЭТУ ХУЙНЮ НЕ УДАЛЯЙ

		$data['title']="Сколько будет";		
		$data['microregion_sity']=$this->common->get_field('microregion_sity');
		$data['city_region_administrat']=$this->common->get_field('city_region_administrat');
		$data['count_room']=$this->common->get_field('count_room');
		$data['floor_of_house']=$this->common->get_field('floor_of_house');
		$this->db->order_by("order", "asc"); 
		$data['type_repair']=$this->common->get_field('type_repair');
		$data['series']=$this->common->get_field('series');
		$order="date_of_pub";
		$desc="desc";
		$bool_check = (isset($_POST['status']))&&(isset($_POST['microregion_sity']))&&(isset($_POST['count_room']))&&(isset($_POST['floor_of_house']))&&(isset($_POST['floors']))&&(isset($_POST['type_repair']))&&(isset($_POST['microregion_sity']));
		if($bool_check){
		$validation = ($_POST['status']!="")&&($_POST['microregion_sity']!="")&&($_POST['count_room']!="")&&($_POST['floor_of_house']!="")&&($_POST['floors']!="")&&($_POST['type_repair']!="")&&($_POST['microregion_sity']!="");
		if($validation)
		{
			$query = $this->db->get_where('microregion_sity', array('id' => $_POST['microregion_sity']));
			$row_microregion_sity = $query->row();
			
			//$query = $this->db->get_where('city_region_administrat', array('id' => $_POST['city_region_administrat']));
			//$row_city_region_administrat = $query->row();
			
			$query = $this->db->get_where('count_room', array('id' => $_POST['count_room']));
			$row_count_room = $query->row();
			
			if($_POST['floor_of_house']==1)//надобы на свич переделать xD))))
			{
				$floor_selected=1;
			}
			else
			{
				if($_POST['floor_of_house']==$_POST['floors'])
				{
					$floor_selected=3;
				}
				else
				{
					$floor_selected=2;
				}
			}
			$data['floor_target_ball']=$_POST['floors'];
			$query = $this->db->get_where('floor_of_house', array('id' => $floor_selected));
			$row_floor_of_house = $query->row();
			
			$query = $this->db->get_where('type_repair', array('id' => $_POST['type_repair']));
			$row_type_repair = $query->row();
			
			$this->load->model('calc_model','cal_mod');
			$etalon = $this->cal_mod->count_etalon($this->common->get_field("summary"));
			
			$data['resultat'] =  $row_microregion_sity->correction
			//*$row_city_region_administrat->correction
			*$row_count_room->correction
			*$row_floor_of_house->correction
			*$row_type_repair->correction
			*$etalon;
			if($_POST['area']>200){
			$correct_area=200;
			}
			else
			{
				$correct_area=$_POST['area'];
			}
			$data['resultat_sum'] = $data['resultat']*$correct_area;
			$arr_input = array(
			'microregion_sity_id'=>$_POST['microregion_sity'],
			'floor_of_house_id'=>$floor_selected,
			'count_room_id'=>$_POST['count_room'],
			'area'=>$correct_area,
			'type_indor_id'=>$_POST['type_repair'],
			'cost'=>$data['resultat_sum']
			);
			$data['new_input_flat']=$arr_input;
			$this->db->insert('added_flat',$arr_input);
		}
		}
		
		$this->db->order_by($order,$desc);
		$query = $this->db->get('added_flat',10);
		$data['added_flat']=$query->result_array();
		/*$data['count_room_value']=$this->common->get_field('count_room');
		$data['floor_of_house_value']=$this->common->get_field('floor_of_house');
		$data['type_repair_value']=$this->common->get_field('type_repair');*/
		
		$this->load->view('header',$data);
		$this->load->view('index',$data);
		$this->load->view('footer',$data);
	}
	
	function add_float()
	{
		$data_indor = array(
			'wall_age' =>$_POST['wall'],
			'floor_age' =>$_POST['floor'],
			'roof_age' =>$_POST['roof'],
			'door_age' =>$_POST['door'],
			'window_age' =>$_POST['window'],
			'internal_devices_age' =>$_POST['internal_devices'],
			'wall_id' =>$_POST['state_indor_door'],
			'floor_id' =>$_POST['state_indor_floor'],
			'roof_id' =>$_POST['state_indor_internal_devices'],
			'door_id' =>$_POST['state_indor_roof'],
			'window_id' =>$_POST['state_indor_wall'],
			'internal_devices_id' =>$_POST['state_indor_window']
		);
		$this->db->insert('state_indor', $data_indor);
		$data_indor_id = mysql_insert_id();
		$data_insert = array(
			'count_room_id' => $_POST['cnt_rm'] ,
			'city_region_administrat_id' => $_POST['city_regadm'],
			'microregion_sity_id' => $_POST['microreg'],
			'area' => $_POST['plmnt'],
			'placement' => $_POST['area'],
			'location_section' => $_POST['location_section'],
			'floor_of_house_id' => $_POST['floor_of_house'],
			'floors' => $_POST['floors'],
			'wall_material_id' => $_POST['wall_material'],
			'series_id' => $_POST['series'],
			'entrance_status' => $_POST['entrance_status'],
			'type_indor_id' => $_POST['type_indor'],
			'state_indor_id' => $data_indor_id,
			'reapir_room' => $_POST['reapir_room'],
			'age_house' => $_POST['age_house'],
			'tranfer_right' => $_POST['tranfer_right'],
			'fin_terms_sale' => $_POST['fin_terms_sale'],
			'terms_sale' => $_POST['terms_sale'],
			'character_price_id' => $_POST['character_price'],
			'object_name_id' => $_POST['obj_name'],
			'segment_id' => $_POST['segment']
		);
		//$this->db->insert('header', $data_insert);
		$this->db->insert('summary', $data_insert);
	}
// CLASS END
}?>