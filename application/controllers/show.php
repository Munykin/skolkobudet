<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Show extends CI_Controller {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('common','common');
    }
	
	function index()
	{	
		$data['title'] = "Оценка рынойчной стоймости объекта";
		$data['houses'] = $this->common->get_houses(100);
		$this->load->view('show_houses',$data);
	}
	
	function edit($from)
	{	
		$data['title'] = "Оценка рынойчной стоймости объекта";
		$data['houses'] = $this->common->get_houses($from);
		$this->load->view('show_houses',$data);
	}
	
	function add_float()
	{
	}
	
	function export(){
		$csv_arr = $this->common->get_arr_fromcsv();
		$i=1;
		$csv_lines  = file("http://testscript.su/emls.ru-flats.csv");
			for($i=1; $i < count($csv_lines); $i++)
			{
			//echo "<h2>".$i."</h2>";
			/*echo'<hr>count_room_id'.$csv_arr[$i][10]."-".
					'placement'.$csv_arr[$i][5]."-".
					'city_region_administrat_id'.$this->common->get_id_by_caption($csv_arr[$i][6],"city_region_administrat")."-".
					'microregion_sity_id'.$this->common->get_id_by_caption($csv_arr[$i][4],"microregion_sity")."-".
					'area'.$csv_arr[$i][11]."-".
					'floor_of_house_id'.$csv_arr[$i][9]."-".
					'floors'.$csv_arr[$i][8]."-".
					'series_id'.$this->common->get_id_by_caption($csv_arr[$i][16],"series")."-".
					'primech'.$csv_arr[$i][19]."-".
					'cost'.$csv_arr[$i][18]."-".
					'date_input_realter'.$csv_arr[$i][26]."-";*/
				$data_insert = array(
					'count_room_id' => $csv_arr[$i][10],
					'placement' => $csv_arr[$i][5],
					'city_region_administrat_id' => $this->common->get_id_by_caption($csv_arr[$i][6],"city_region_administrat"),
					'microregion_sity_id' => $this->common->get_id_by_caption($csv_arr[$i][4],"microregion_sity"),
					'area' => $csv_arr[$i][11],
					'floor_of_house_id' => $csv_arr[$i][9],
					'floors' => $csv_arr[$i][8],
					'series_id' => $this->common->get_id_by_caption($csv_arr[$i][16],"series"),
					'primech' => $csv_arr[$i][19],
					'cost' => $csv_arr[$i][18],
					'date_input_realter' => $csv_arr[$i][26]
				);
				
				//echo "!!".$csv_arr[$i][5]."-".$csv_arr[$i][26]."!!";
				//echo $this->common->get_id_by_caption($csv_arr[$i][16],"series")."<br>";
				$this->db->insert("summary", $data_insert);
			}
		//echo "количество комнат: ".$this->common->get_id_by_caption($csv_arr[1][10],"count_room").'-';
		//echo "<br>адресс: ".$csv_arr[1][5];//placement
		//echo "<br>административный округ: ".$this->common->get_id_by_caption($csv_arr[1][6],"city_region_administrat").'-';
		//echo "<br>микрорайон: ".$this->common->get_id_by_caption($csv_arr[1][4],"microregion_sity").'-';
		//echo "<br>площадь: ".$csv_arr[1][11].'-';
		//echo "<br>этажность: ".$csv_arr[1][9],"-";
		//echo "<br>этаж: ".$csv_arr[1][8]."-";
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"wall_material");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"state_indor");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"reapir_room");
		//echo ":".$this->common->get_id_by_caption($csv_arr[1][10],"type_indor");
		//echo "<br>дата внесения в базу: ".$csv_arr[1][28];//date
		//echo '<br>цена: '.$csv_arr[1][18];
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"age_house");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"tranfer_right");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"fin_terms_sale");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"terms_sale");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"character_price");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"object_name");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"count_room");//date
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"count_room");
		//echo$this->common->get_id_by_caption($csv_arr[1][10],"count_room");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>