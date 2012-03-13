<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->model('common','common');
    }
	
	function index()
	{	
		$name = $_POST['check_cost'];
		$this->db->where('cost <=', $name); 
		$query = $this->db->get('added_flat');
		$a_f = $query->row();
        //$types = $this->cms_db->get_x_organisators_buy();
		$street = $this->common->get_by_id('microregion_sity',$a_f->microregion_sity_id).$a_f->placement;
        $floor = $this->common->get_by_id('floor_of_house',$a_f->floor_of_house_id);
        $count_room = $this->common->get_by_id('count_room',$a_f->count_room_id);
        $area = $a_f->area;
        $repair = $this->common->get_by_id('type_repair',$a_f->type_indor_id);
        $cost = $a_f->cost;
        $result = array('type'=>'success',
		'street'=>$street,
		'floor'=>$floor,
		'count_room'=>$count_room,
		'area'=>$area,
		'repair'=>$repair,
		'cost'=>$cost);
        print json_encode($result);
	}
	
	function sortit(){
		$this->load->helper('date');
		if(isset($_POST['sort_value'])){$this->db->where($_POST['sort_field'], $_POST['sort_value']);}
		if(isset($_POST['check_cost']))
		{
			$max = (int)$_POST['check_cost']+500000;
			$min = (int)$_POST['check_cost']-500000;
			$this->db->where('cost <', $max);
			$this->db->where('cost >', $min);
		}
		if(isset($_POST['sort_row'])){$this->db->order_by($_POST['sort_row'],$_POST['sort_type']);}
		//$this->db->limit(10);
		$query = $this->db->get('added_flat');
		$added_flat=$query->result_array();
		$i=1;
		$html='<tr><td style="padding:0px;margin:0px;"><div class="coda-slider-wrapper">
						<div class="coda-slider preload" id="coda-slider-1">
							<div class="panel">
								<div class="panel-wrapper">
									<h2 class="title">1</h2>
										<table>';
		/*$html='<table><table class="p10">
        
        <tr>
            <th class="tdate" id="tdate"><a href="#" class="sort-triger active desc"></a></th>
            <th class="tao"><a ="#" class="sort-triger"></a><div id="taoss">fuuck</div></th>
            <th class="tfloor" id=""><a href="#" class="sort-triger"></a></th>
            <th class="trooms" id=""><a href="#" class="sort-triger"></a></th>
            <th class="tsq" id=""><a href="#" class="sort-triger"></a></th>
            <th class="twalls" id=""><a href="#" class="sort-triger"></a></th>
            <th class="tcost last-child" id=""><a href="#" class="sort-triger"></a></th>
        </tr>';*/
		$j=1;
		$k=1;
        foreach($added_flat as $a_f){
			if(fmod($j,10)==0)
			{
				$k++;
				$html.='</table>
				</div>
			</div>
			<div class="panel">
				<div class="panel-wrapper">
				<h2 class="title">'.$k.'</h2>
					<table>';
			}
			$j++;
			$html.="<tr ";
			$daysDiff = mysql_to_unix($a_f['date_of_pub']);
			$daysDiff = timespan($daysDiff);
			$arr_date = explode(",",$daysDiff);
			$daysDiff = explode(" ",$arr_date[0]);
			if($daysDiff[1]=="Часов"||$daysDiff[1]=="Час"||$daysDiff[1]=="Секунда"||$daysDiff[1]=="Секунд"||$daysDiff[1]=="Минут")
			{	
				if($daysDiff[1]=="Часов"||$daysDiff[1]=="Час")
				{
					$megatrone = explode(":",mdate("%h",time()));
					$hours_diff = $megatrone[0]-$daysDiff[0];
					if($hours_diff>=0)
					{
						$formated_date = "сегодня в ".date('G:i',strtotime($a_f['date_of_pub']));
					}
					else
					{
						$formated_date = "вчера в ".date('G:i',strtotime($a_f['date_of_pub']));
					}
				}
				else
				{
					$formated_date = "сегодня в ".date('G:i',strtotime($a_f['date_of_pub']));
				}
			}
			else
			{
				if(($daysDiff[1]=="Дней"||$daysDiff[1]=="День")&&($daysDiff[1]=="1"))
				{
					$formated_date = "вчера в ".date('G:i',strtotime($a_f['date_of_pub']));
				}
				else
				{
				$formated_date =date('d-m-Y G:i',strtotime($a_f['date_of_pub']));
				}
			}
			$resultat_sum = round($a_f['cost'],-4);
			$res = number_format($resultat_sum, 0, ',', ' ' );
			if(fmod($j,2)==0){$html.='class="odd"';}
			$html.=">
		<td class=\"tdate\"><p>".$formated_date."</p></td>
            <td class=\"tao\">".$this->common->get_by_id('microregion_sity',$a_f['microregion_sity_id'])."<i style=\"display:none;\">".$a_f['microregion_sity_id']."</i></td>
            <td class=\"tfloor\">".$this->common->get_by_id('floor_of_house',$a_f['floor_of_house_id'])."<i style=\"display:none;\">".$a_f['floor_of_house_id']."</i></td>
            <td class=\"trooms\">".$this->common->get_by_id('count_room',$a_f['count_room_id'])."<i style=\"display:none;\">".$a_f['count_room_id']."</i></td>
            <td class=\"tsq\">".$a_f['area']."<i style=\"display:none;\">".$a_f['area']."</i> м²</td>
            <td class=\"twalls\">".$this->common->get_by_id('type_repair',$a_f['type_indor_id'])."<i style=\"display:none;\">".$a_f['type_indor_id']."</i></td>
            <td class=\"tcost last-child\">".$res."<i style=\"display:none;\">".$res."</i></td>
        </tr>";
		}
        $html.="</table></div></div></div></div></td></tr>";
		$result = array('type'=>$html);
        print json_encode($result);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>